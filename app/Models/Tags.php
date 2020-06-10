<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    const NORMAL_STATUS = 1;

    protected $fillable = ['name','created_at','updated_at'];

    /**
     * 标签关联关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function novels()
    {
        return $this->belongsToMany(Novels::class);
    }

    public function getNovels()
    {
        return $this->novels()->get()->map(function ($slip) {
            return [
                'id' => $slip['id'],
                'title' => $slip['title'],
                'img' => $slip['img'],
                'created_at' => $slip['created_at'],
                'view' => $slip['view']
            ];
        });
    }

    public static function getAllTags()
    {
        return self::query()
            ->select('id','name')
            ->where('status',self::NORMAL_STATUS)->get();
    }

    public static function findTag($tag)
    {
        return self::firstOrCreate(['name'=>$tag]);
    }

}
