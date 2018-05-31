<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Library;
use File;

class ImageController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

	public function index(){
        $id = $_GET['id'];
        $library = Library::find($id);
        $images = DB::table('image')->where(['library_id' => $id])->get();

		return view('admin/image/index', ['images' => $images, 'library' => $library, 'library_id' => $id]);
	}

    public function create()
    {
        // return view('admin/image/create');
    }

    public function store(Request $request, $id)
    {
        $files = Input::file('image');
        $library = Library::find($id);
        $slug = $library->slug;
        $path = base_path() . '/storage/app/library/'. $slug;
        if(!$library){
            return redirect()->intended('admin/library');
        }
        if($request->hasFile('image')){
            $image = $files->getClientOriginalName();
        }
        $data = ['library_id' => $id, 'image' => $image];
        if(DB::table('image')->insert($data)){
            $files->move($path,$image);
        }
        return redirect()->route('image.index', ['id' => $id]);
        
    }

    public function destroy($id){
        $image = Image::find($id);
        if(!$image){
            return redirect()->intended('admin/library');
        }
        $library_id = $image->library_id;
        $library = Library::find($library_id);
        $slug = $library->slug;
        $path = base_path() . '/storage/app/library/'. $slug .'/'. $image->image;
        if(Image::where('id', $id)->delete()){
            File::delete($path);
        }
        return redirect()->route('image.index', ['id' => $library_id]);
    }
}




