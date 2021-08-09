<?php

namespace magein\thinkphp_extra;

use magein\tools\common\Variable;
use think\facade\Db;

/**
 * 在路由文件中添加一下代码
 *
 * 访问 xxx.com/vue-page?table=member_finance&resetful=member_finance
 */
//Route::rule('vue-page', function () {
//    (new \magein\thinkphp_extra\VuePage())->version1();
//});

/**
 * 快速构建vue-page工具
 * Class VuePage
 * @package magein\thinkphp_extra
 */
class VuePage
{
    public function version1()
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
        $trans = [];
        foreach ($fields as $item) {
            $field = $item['Field'];
            $type = $item['Type'];

            if (in_array($field, ['create_time', 'update_time', 'delete_time'])) {
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

            $header .= '\'' . $field . "',";
            if (!in_array($field, ['id'])) {
                $form .= '\'' . $field . "',";
            }

            if (in_array($field, ['id', 'phone', 'order_no', 'good_no'])) {
                $search .= "'" . $field . "',";
            }

            if (preg_match('/^tinyint/', $type)) {
                $trans[] = [
                    'field' => $field,
                    'comment' => $item['Comment'],
                ];
            }
        }

        $trans_string = '';
        if ($trans) {
            foreach ($trans as $item) {
                $comment = explode(' ', $item['comment']);
                $comment = array_slice($comment, 1);
                $comment = array_chunk($comment, 3);
                $trans_string .= 'const ' . $item['field'] . ' = ';
                $trans_string .= '[';
                foreach ($comment as $com) {
                    $trans_string .= '{value:"' . $com[0] . '",text:"' . $com[1] . '"},';
                }
                $trans_string = trim($trans_string, ',');
                $trans_string .= "];\n\n";
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
			
			$trans_string
			
			var page = new Page();
			page.setResetful('$resetful');
			page.setDictionary(dictionaries);
			page.setSearch([$search]);
			page.setToolbar();
			page.setOperate();
			page.setSelection();
			page.setHeader([$header]);
			page.setList(state.list);
			page.setTrans();
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
}