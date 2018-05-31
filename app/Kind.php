<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kind';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
