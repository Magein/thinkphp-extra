<?php

namespace magein\thinkphp_extra;

use magein\tools\common\Variable;
use think\facade\Db;

/**
 * 生成vue页面
 * 访问 xxx.com/vue-page?table=member_finance&resetful=member_finance
 */
//Route::rule('vue-page', function () {
//    (new \magein\thinkphp_extra\Page())->vue();
//});

/**
 * 根据数据生成文档字段
 * 访问 xxx.com/docs?table=member_finance
 */
//Route::rule('vue-page', function () {
//    (new \magein\thinkphp_extra\Page())->docs();
//});

/**
 * 快速构建vue-page工具
 * Class VuePage
 * @package magein\thinkphp_extra
 */
class Page
{
    /**
     * 构建vue页面
     */
    public function vue()
    {
        $table = request()->get('table');
        $resetful = request()->get('resetful');
        $name = request()->get('name');

        if (empty($table)) {
            echo '请输入表名称';
            exit();
        }

        if (empty($name)) {
            $name = (new Variable())->camelCase($table);
        }

        if (empty($resetful)) {
            $resetful = (new Variable())->underline($table);
        }

        $fields = Db::query('show full columns from ' . (new Variable())->underline($table));

        $dictionary = [];
        $header = '';
        $form = '';
        $search = '';
        $const = [];
        $trans = ['\'create_time\''];
        foreach ($fields as $item) {
            $field = $item['Field'];
            $type = $item['Type'];

            if (in_array($field, ['update_time', 'delete_time'])) {
                continue;
            }
            $comment = $item['Comment'];
            if ($comment) {
                $comment = explode(' ', $comment);
            } else {
                $comment = [];
            }

            if ($comment) {
                $dictionary[$field] = [
                    'text' => $comment[0] ?? '',
                    'desc' => $comment[1] ?? '',
                ];
            }

            if ($field === 'status') {
                $header .= 'page.build.header.switch(\'' . $field . "'),";
            } elseif (in_array($field, ['icon', 'image', 'images', 'photo', 'img', 'head', 'avatar'])) {
                $header .= 'page.build.header.image(\'' . $field . "'),";
            } elseif (in_array($field, ['action', 'type', 'method', 'scene'])) {
                $trans[] = '[\'' . $field . '\',' . $field . ']';
            } else {
                $header .= '\'' . $field . "',";
            }

            if (!in_array($field, ['id', 'create_time'])) {
                if ($field === 'status') {
                    $form .= 'page.build.form.radio(\'' . $field . "'),";
                } else if ($field === 'scene') {
                    $form .= 'page.build.form.checkbox(\'' . $field . "'),";
                } else if (in_array($field, ['icon', 'image', 'images', 'photo', 'img', 'head', 'avatar'])) {
                    $form .= 'page.build.form.image(\'' . $field . "'),";
                } else {
                    $form .= '\'' . $field . "',";
                }
            }

            if (in_array($field, ['id', 'phone', 'order_no', 'good_no'])) {
                $search .= "'" . $field . "',";
            }

            if (preg_match('/^tinyint/', $type) || in_array($field, ['scene'])) {
                $const[] = [
                    'field' => $field,
                    'comment' => $item['Comment'],
                ];
            }
        }

        $trans = implode(',', $trans);

        $const_string = '';
        if ($const) {
            foreach ($const as $item) {
                $comment = explode(' ', $item['comment']);
                $comment = array_slice($comment, 1);
                $comment = array_chunk($comment, 3);

                if (empty($comment)) {
                    continue;
                }

                $const_string .= 'const ' . $item['field'] . ' = ';
                $const_string .= '[';
                foreach ($comment as $com) {
                    $const_string .= '{value:"' . $com[0] . '",text:"' . $com[1] . '"},';
                }
                $const_string = trim($const_string, ',');
                $const_string .= "];\n\n";
            }
        }

        $header = trim($header, ',');
        $form = trim($form, ',');
        $search = trim($search, ',');

        $string = "\n";
        if ($dictionary) {
            foreach ($dictionary as $key => $item) {
                $string .= '        "' . $key . '":' . json_encode($item, JSON_UNESCAPED_UNICODE) . ",\n";
            }
        }
        $string = '{' . $string . '}';

        $dictionary = $string;

        $pages = <<<EOF
<template>
	<div>
		<dataView></dataView>
	</div>
</template>

<script lang="ts">
	import {
		provide,
		reactive,
	} from 'vue'

	import Page from "/@/common/render/js/page.js"

	export default {
		name: '$name',
		setup() {

			const state = reactive({
				list: []
			});
			
			const dictionaries=$dictionary;
			
			$const_string
			
			var page = new Page();
			page.setResetful('$resetful');
			page.setDictionary(dictionaries);
			page.setSearch([$search]);
			page.setToolbar();
			page.setOperate();
			page.setSelection();
			page.setHeader([$header]);
			page.setList(state.list);
			page.setTrans($trans);
			page.setForm([$form]);

			provide('pages', page);
		},

		mounted() {

		},
		methods() {

		}
	};
</script>

<style scoped lang="scss">

</style>        
EOF;

        echo "<pre>";
        echo htmlspecialchars($pages);
        echo "</pre>";
    }

    public function docs()
    {
        $table = request()->get('table');
        $title = request()->get('title');

        $fields = Db::query('show full columns from ' . (new Variable())->underline($table));

        // 获取的数据结果
        $get = [];

        // 提交的数据结果
        $post = [];

        foreach ($fields as $item) {
            $field = $item['Field'];
            $type = $item['Type'];

            if (in_array($field, ['update_time', 'delete_time', 'password', 'username'])) {
                continue;
            }

            $type = preg_replace('/[\d|\(\),]+/', '', $type);

            if ($type === 'varchar' || $type === 'char') {
                $type = 'string';
            } elseif ($type === 'decimal') {
                $type = 'float';
            } elseif ($type === 'int' || $type === 'tinyint') {
                $type = 'integer';
            }

            $data = [
                'type' => $type,
                'comment' => $item['Comment'],
                'field' => $field
            ];

            if (in_array($field, ['id', 'create_time'])) {
                $get[] = $data;
                continue;
            }
            $get[] = $data;
            $post[] = $data;
        }

        $get_string = '* @Apidoc\Method("GET"),' . '<br/>';
        $get_string .= '* @Apidoc\Param("id",type="integer",require=false,desc="主键"),' . '<br/>';
        $get_string .= '* @Apidoc\Param("page",type="integer",require=false,desc="第几页"),' . '<br/>';
        $get_string .= '* @Apidoc\Param("page_size",type="integer",require=false,desc="每页数量"),' . '<br/>';
        if ($get) {
            foreach ($get as $item) {
                $get_string .= '* @Apidoc\Returned("' . $item['field'] . '", type="' . $item['type'] . '", desc="' . $item['comment'] . '"),';
                $get_string .= "<br/>";
            }
        }

        $post_string = '* @Apidoc\Method("POST")' . '<br/>';
        if ($post) {
            foreach ($post as $item) {
                $post_string .= '* @Apidoc\Param("' . $item['field'] . '", type="' . $item['type'] . '",require=true, desc="' . $item['comment'] . '"),';
                $post_string .= "<br/>";
            }
        }

        echo $get_string;
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo $post_string;
    }
}