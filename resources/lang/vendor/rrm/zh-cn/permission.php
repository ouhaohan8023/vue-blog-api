<?php

return [
    'model'    => '路由',
    'name'     => '名称',
    'url'      => '路径',

    ### 以下为所有路由翻译
    'home'     => '前端首页',
    'login'    => '登陆',
    'logout'   => '登出',
    'register' => '注册',
    'error'    => '无权限报错页面',
    'admin'    => [
        'index'      => '后台首页',
        'test'       => '测试路由',
        'user'       => [
            ''           => '用户管理',
            'index'      => '用户列表',
            'create'     => '新建用户',
            'delete'     => '删除用户',
            'assignment' => '分配角色',
            'update'     => '更新用户'
        ],
        'role'       => [
            ''           => '角色管理',
            'index'      => '角色列表',
            'delete'     => '删除角色',
            'create'     => '新建角色',
            'assignment' => '分配路由',
            'update'     => '更新角色'
        ],
        'permission' => [
            ''       => '路由管理',
            'index'  => '路由列表',
            'delete' => '删除路由',
            'create' => '新建路由',
            'reload' => '路由检测'
        ],
        'menu'       => [
            ''       => '菜单管理',
            'index'  => '菜单列表',
            'delete' => '删除菜单',
            'create' => '新建菜单',
            'make'   => '构建菜单',
            'clear'  => '清除菜单缓存',
            'update' => '更新菜单'
        ],
        'op-log'     => [
            ''      => '操作记录管理',
            'index' => '操作日志',
            'view'  => '查看日志详情',
            'clear' => '清空操作记录'
        ],
        'novels'     => [
            ''       => '文章管理',
            'index'  => '文章列表',
            'create' => '文章创建',
            'update' => '文章更新',
            'delete' => '文章删除',
        ],
        'classifies' => [
            ''       => '分类管理',
            'index'  => '分类列表',
            'create' => '分类创建',
            'update' => '分类更新',
            'delete' => '分类删除',
        ],
        'tags'       => [
            ''       => '标签管理',
            'index'  => '标签列表',
            'create' => '标签创建',
            'update' => '标签更新',
            'delete' => '标签删除',
        ],
    ],
    'tags' => [
        'lists' => '【前端】首页标签列表',
    ],
    'classify' => [
        'menus' => '【前端】首页导航数据',
        'lists' => '【前端】首页分类数据',
    ],
    'novel' => [
        'lists' => '【前端】文章列表',
        'detail' => '【前端】文章详情',
    ],
    //        'password' => [
    //            'reset' => '重置密码'
    //        ]

];
