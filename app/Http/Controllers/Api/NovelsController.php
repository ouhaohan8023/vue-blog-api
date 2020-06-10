<?php

namespace App\Http\Controllers\Api;

use \App\Http\Controllers\Controller;
use App\Models\Classify;
use App\Models\Novels;
use App\Models\Tags;
use Illuminate\Http\Request;

class NovelsController extends Controller
{
    /**
     * 获取文章详情
     * @param $novelId
     * @return mixed
     */
    public function detail($novelId)
    {
        $slip = Novels::find($novelId);

        $ctx['slips'] = $slip;
        $ctx['path'] = $slip->path();
        $ctx['tags'] = $slip->getTags();
        $ctx['recommends'] = Novels::getRecommendNovels();
        if ($slip) {
            return callMake($ctx);
        } else {
            return callMake([], 500, 'not found');
        }
    }

    /**
     * 获取首页文章列表
     * @param  Request  $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function lists(Request $request)
    {
        $validatedData = $request->validate([
            'tags'     => 'integer',
            'classify' => 'integer',
        ]);
        if ($tag = $request->input('tags', false)) {
            if ($tag != null && $tag > 0) {
                $tag = Tags::find($request->input('tags'));
                if ($tag) {
                    $ctx['slips'] = $tag->novels()->paginate(30);
                    $ctx['path'] = Classify::makePath();

                    return callMake($ctx);
                } else {
                    return callMake([], 500, '此ID不存在');
                }

            }
        }
        if ($classifyId = $request->input('classify', false)) {
            $classify = Classify::find($classifyId);
            if ($classify) {
                $ctx['slips'] = $classify->getAllNovelsWithSelf()->paginate(30);
                $ctx['path'] = Classify::makePath($classifyId);

                return callMake($ctx);
            } else {
                return callMake([], 500, '此ID不存在');
            }
        }
        $ctx['slips'] = Novels::getLists();
        $ctx['path'] = Classify::makePath();
        return callMake($ctx);
    }
}
