<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait CurrentDate
{
    public static function boot(){
        parent::boot();
        static::creating(function ($post) {
            if(empty($post->data)){
                $post->data = Carbon::now();
            }
        });
    }
}
