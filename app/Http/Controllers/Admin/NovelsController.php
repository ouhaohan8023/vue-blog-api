<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Models\Classify;
use App\Models\Novels;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NovelsController extends Controller
{
    public function index(Request $request)
    {
        $model = Novels::query();
        $search = request()->all();
        if (!empty($search)) {
            foreach ($search as $k => $v) {
                if ($v == null || $k == 'page') {
                    continue;
                }
                if ($k == 'keyword') {
                    $model = $model->where('title', 'like', '%'.$v.'%');
                    continue;
                }
                $model = $model->where($k, $v);
            }
        }
        $model = $model->orderBy('id', 'DESC')->paginate(30);

        request()->flash();
        $classify = Classify::makeAdminClassifySelect();
        $classify = collect($classify)->sortBy('id');
        return view('novels.index', ['data' => $model, 'classify' => $classify]);
    }

    public function create(Request $request)
    {
        if ($request->method() == "POST") {
            $validatedData = $request->validate([
                'title'       => 'required|unique:novels',
                'content'     => 'required',
                'classify_id' => 'required|integer',
                'status'      => 'required|integer',
                'recommend'   => 'required|integer',
            ]);

            // 处理封面图片
            if ($request->file('img')) {
                $fileName = date('YmdHis').rand(10000, 99999).'.'.$request->file('img')->extension();
                $filePath = Storage::url('novels/'.$fileName);
                Storage::putFileAs('./public/novels', $request->file('img'), $fileName);
            } else {
                $filePath = '';
            }


            $validatedData['img'] = $filePath;

            $create = Novels::create($validatedData);
            if ($create) {
                // 处理tags关系
                if ($tagsStr = $request->get('tags')) {
                    $tagsArr = explode(',', $tagsStr);
                    foreach ($tagsArr as $k => $v) {
                        if ($v) {
                            $tags = Tags::findTag($v);
                            $tags->increment('frequency');
                            $create->tags()->save($tags);
                        }
                    }
                }
                return callMake([]);
            } else {
                Log::error('新增文章出错', [$create, $validatedData]);
                return callMake([], 500, 'error');
            }
        } else {
            $classify = Classify::makeAdminClassifySelect();
            $classify = collect($classify)->sortBy('id');
            return view('novels.form', ['classify' => $classify]);
        }

    }
}
