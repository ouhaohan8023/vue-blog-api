<?php

namespace App\Http\Controllers\Api;

use \App\Http\Controllers\Controller;
use App\Models\Classify;
use App\Models\Novels;
use App\Models\Tags;
use Illuminate\Http\Request;

class ClassifyController extends Controller
{
    /**
     * 获取首页分类
     */
    public function lists()
    {
        $ctx = Classify::getClassify();
        return callMake($ctx);;
    }

    /**
     * 首页导航
     * @return mixed
     */
    public function menus()
    {
        $ctx = Classify::getHeaderMenu();
        return callMake($ctx);
    }
}
