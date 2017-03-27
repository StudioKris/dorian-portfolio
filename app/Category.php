<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $appends = ['assetsCount'];

    public function assets()
    {
        return $this->belongsToMany('App\Asset', 'categories_assets', 'category_id', 'asset_id')->withPivot('position')->orderBy('position', 'asc');
    }

    public function getAssetsCountAttribute()
    {
        return $this->assets->count();
    }
}
