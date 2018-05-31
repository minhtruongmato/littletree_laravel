<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'origin';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
