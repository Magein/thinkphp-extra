<?php


namespace magein\thinkphp_extra;


use think\Paginator;

class Overt
{
    public static function paginate($paginator, $page_size)
    {
        if (!$paginator instanceof Paginator) {
            return [];
        }

        $pages = [
            // 总数
            'total' => 1,
            // 每页数量
            'per_page' => $page_size,
            // 当前页
            'current_page' => 1,
            // 最后一页
            'last_page' => 1,
            // 是否还要更多
            'has_more' => 0,
        ];

        $pages['total'] = $paginator->total();
        $pages['current_page'] = $paginator->currentPage();
        $pages['last_page'] = $paginator->lastPage();

        if ($pages['current_page'] < $pages['last_page']) {
            $pages['has_more'] = 1;
        }

        return [
            'pages' => $pages,
            'list' => $paginator->items()
        ];
    }
}