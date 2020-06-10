<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Novels extends Model
{
    const RECOMMEND_STATUS = 1; // 推荐

    const NORMAL_STATUS = 1; // 正常
    const HIDDEN_STATUS = 0; // 隐藏

    //    public $timestamps = false;

    public $fillable = [
        'title',
        'content',
        'img',
        'classify_id',
        'tags',
        'status',
        'recommend',
    ];

    public function getCreatedAtAttribute($value)
    {
        return $this->asDateTime($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->asDateTime($value)->diffForHumans();
    }

    /**
     * 文章类别关联关系
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function classify()
    {
        return $this->hasOne(Classify::class, 'id', 'classify_id');
    }

    /**
     * 文章标签关联关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }

    /**
     * 获取文章标签
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getTags()
    {
        return $this->tags()->get()->map(function ($slip) {
            return ['id' => $slip['id'], 'name' => $slip['name']];
        });
    }

    /**
     * 获取推荐列表
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getRecommendNovels($nums = 4, $order = 'id')
    {
        return self::query()->select('id', 'title', 'img', 'created_at', 'view')->where('recommend',
            self::RECOMMEND_STATUS)->where('status', self::NORMAL_STATUS)->orderBy($order, 'desc')->limit($nums)->get();
    }

    public static function getLists()
    {
        $model = self::query();
        $model->where('status', self::NORMAL_STATUS);
        return $model->orderBy('id', 'desc')->paginate(30);

    }

    /**
     * 给文章增加标签
     * @param  array  $tagsId
     */
    public function addTags(array $tagsId)
    {
        $tags = Tags::query()->whereIn('id', $tagsId)->get();
        $this->tags()->saveMany($tags);
    }

    /**
     * 构建前端面包屑
     * @return mixed
     */
    public function path()
    {
        $ctx = $this->classify()->first()->getAncestorsAndSelf(['id', 'name'])->toArray();
        $add['id'] = -1;
        $add['name'] = $this->title;
        $add['route'] = '';
        $ctx[] = $add;
        return $ctx;
    }

    public function getStatusTextAttribute()
    {
        if ($this->status == 1){
            return '公开';
        } else {
            return '隐藏';
        }
    }

    public function getRecommendTextAttribute()
    {
        if ($this->recommend == 1) {
            return '已推荐';
        } else {
            return '未推荐';
        }
    }

    public function getClassifyTextAttribute()
    {
        $classify = $this->classify()->first();
        return $classify['name'];
    }
}
