<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Response;
use App\ProductComment;
use App\BlogComment;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchProductComment($id)
    {
    	$productComments = DB::table('product_comment')
    						->select('product_comment.*', 'product.name')
    						->join('product', 'product.id', '=', 'product_comment.product_id')
    						->where('product_id', $id)
    						->where('product_comment.is_deleted', 0)
    						->orderBy('id','desc')
    						->paginate(10);
    	return view('admin/comment/index', ['comments' => $productComments]);
    }

    public function deleteProductComment($id, $product_id)
    {
    	productComment::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->intended('admin/comment/product/'.$product_id);
    }

    public function fetchBlogComment($id)
    {
    	$blogComments = DB::table('blog_comment')
    						->select('blog_comment.*', 'blog.title')
    						->join('blog', 'blog.id', '=', 'blog_comment.blog_id')
    						->where('blog_id', $id)
    						->where('blog_comment.is_deleted', 0)
    						->orderBy('id','desc')
    						->paginate(10);
    						// print_r($blogComments);die;
    	return view('admin/comment/blog', ['comments' => $blogComments]);
    }

    public function deleteBlogComment($id, $blog_id)
    {
    	BlogComment::where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->intended('admin/comment/blog/'.$blog_id);
    }
}
