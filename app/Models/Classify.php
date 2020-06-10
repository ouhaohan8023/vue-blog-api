<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Jiaxincui\ClosureTable\Traits\ClosureTable;

class Classify extends Model
{
    use ClosureTable;

    protected $fillable = ['name'];

    public static function getClassify()
    {
        $model = self::find(1);
        $all = $model->getTree(['id', 'asc'], 'children', ['id', 'name as label']);
        return Arr::get(Arr::get($all, 0, []), 'children', []);
    }

    public static function getHeaderMenu()
    {
        $model = self::find(1);
        return $model->getChildren();
    }

    public function getNovels()
    {
        return $this->hasMany(Novels::class);
    }

    public function getAllNovelsWithSelf()
    {
        $childrenWithSelf = $this->getDescendantsAndSelf(['id'])->pluck('id');
        return Novels::query()->select('id', 'title', 'img', 'created_at', 'view')->whereIn('classify_id',
            $childrenWithSelf);
    }

    /**
     * 前台面包屑
     * @param  int  $id
     * @return array
     */
    public static function makePath($id = 1)
    {
        $data = self::find($id);
        if ($data) {
            return $data->getAncestorsAndSelf(['id', 'name']);
        } else {
            return [];
        }
    }

    /**
     * 后台下拉构建
     */
    public static function makeAdminClassifySelect($root = null, $parent = null)
    {
        if (!$root) {
            $root = self::getClassify();
        }

        //        dd($root);
        foreach ($root as $k => $v) {
            if ($parent) {
                $v['label'] = $parent."---".$v['label'];
            } else {
                $v['label'] = $v['label'];
            }
            if (isset($v['children'])) {
                $children = self::makeAdminClassifySelect($v['children'], $v['label']);
                unset($v['children']);
            } else {
                $children = [];
            }
            $data[] = $v;
            $data = array_merge($children,$data);
        }
        return $data;
    }
}
