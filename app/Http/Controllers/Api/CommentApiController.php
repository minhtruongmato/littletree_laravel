<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use DateTime;
use Response;
use App\Blog;
use App\BlogComment;
use App\ProductComment;

class CommentApiController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(){
    }

    public function checkBlogCommentExist()
    {
        $id = Input::get('id');

        $exist = DB::table('blog')
            ->select('*')
            ->where('id', '=', $id)
            ->where('is_deleted', '=', 0)
            ->limit(1)
            ->get();

        if(empty($exist)){
            return response()->json(['id' => $id, 'message' => 'not_found'], 404);
        }

        // if($exist[0]->quantity <= 0){
        //     return response()->json(['id' => $id, 'message' => 'out_of_stock'], 200);
        // }

        return response()->json(['id' => $id, 'result' => $exist[0], 'message' => 'success'], 200);
    }

    public function addCommentBlog(Request $request)
    {
    	$keys = ['blog_id','author','email', 'content'];
    	$input = $this->createQueryInput($keys, $request);
    	BlogComment::create($input);
    	return 'ok';
    }

    public function getBlogComment(Request $request)
    {
        $page = 10;
    	$id = $request->input('id');
    	$result = DB::table('blog_comment')
    			->where('blog_id', $id)
    			->where('is_deleted', '=', 0)
    			->where('is_approved', '=', 0)
    			->orderBy('id', 'desc')
    			// ->get();
    			->paginate($page);
                // print_r($result);die;
        $count = DB::table('blog_comment')
                ->where('blog_id', $id)
                ->count();
        $total = ceil($count / $page);
    	return response()->json(['result' => $result, 'total' => $total, 'count' => $count], 200);
    }

    public function addProductComment(Request $request)
    {
        // dd($request);die;
    	$keys = ['product_id','author','email','title', 'rating', 'content'];
    	$input = $this->createQueryInput($keys, $request);
    	ProductComment::create($input);
    	return 'ok';
    }

    public function getProductComment(Request $request)
    {
        $page = 5;
        $id = $request->input('id');
        $result = DB::table('product_comment')
                ->where('product_id', $id)
                ->where('is_deleted', '=', 0)
                ->where('is_approved', '=', 0)
                ->orderBy('id', 'desc')
                // ->get();
                ->paginate($page);
        $count = DB::table('product_comment')
                ->where('product_id', $id)
                ->count();
        
        

        $rating = DB::table('product_comment')
                ->select('rating')
                ->where('product_id', $id)
                ->get();
        $totalRating = 0;
        foreach ($rating as $key => $value) {
            $totalRating = $totalRating + $value->rating;
        }
        
        if($count != 0){
            $total = ceil($count / $page);
            $averageRating = round($totalRating/$count);
        }else{
            $total = 0;
            $averageRating = 0;
        }
        return response()->json(['result' => $result, 'total' => $total, 'averageRating' => $averageRating, 'count' => $count], 200);
    }
}
