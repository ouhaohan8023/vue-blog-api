<?php

namespace App\Http\Controllers\Api;

use \App\Http\Controllers\Controller;
use App\Models\Classify;
use App\Models\Novels;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * 获取首页分类
     */
    public function lists()
    {
        $ctx = Tags::getAllTags();
        return callMake($ctx);;
    }
}
