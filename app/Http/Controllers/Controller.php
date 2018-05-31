<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $commonMessage = [
        'isNotEmpty' => '%s %s không trống, không thể %s'
    ];

    protected function buildUniqueSlug($table, $id, $slug){
        $slugCount = count(DB::table($table)->select('*')->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$'")->where('id', '<>', $id)->get());
        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }

    protected function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }

    protected function countForCheckEmptyObject($object, $check,  $id){
        $count = DB::table($object)
            ->where($check, $id)
            ->where('is_deleted', 0)
            ->count();
        return $count;
    }
}
