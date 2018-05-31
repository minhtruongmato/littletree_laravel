<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'library';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function images(){
        return $this->hasMany('App\Image');
    }
}
