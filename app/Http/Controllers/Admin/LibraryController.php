<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Library;
use App\Image;
use File;
use Validator;
use Illuminate\Support\Facades\Cookie;

class LibraryController extends Controller
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
		$library = DB::table('library')->where('is_deleted', 0)->get();
		if($library){
			foreach ($library as $key => $value) {
				$list_image = DB::table('image')->where('library_id', $value->id)->orderBy('id','asc')->first();
				if($list_image){
					$library[$key]->image = $list_image->image;
				}else{
					$library[$key]->image = null;
				}
				
			}
		}
		
		return view('admin/library/index', ['library' => $library]);
	}

	public function create(){
		
		
		return view('admin/library/create');
	}

	public function store(Request $request){
        $slug = $request->input('slug');
        $uniqueSlug = $this->buildUniqueSlug('library', $request->id, $request->slug);
		$path = base_path() . '/' . 'storage/app/library';
        $newFolderPath = $this->buildNewFolderPath($path, $uniqueSlug);
        File::makeDirectory($newFolderPath[1], 0777, true, true);

		$upload = base_path() . '/' . 'storage/app/library/'.$uniqueSlug;
		$image = $this->list_image($upload);
		$data = ['title' => $request->input('title'), 'slug' => $uniqueSlug, 'description'=> $request->input('description'), 'created_at' => date('Y:m:d H:i:s')];
		$data2 = [];
		if(DB::table('library')->insert($data)){
			$library_id = DB::getPdo()->lastInsertId();
			foreach ($image as $key => $item) {
				$data2['library_id'] = $library_id;
				$data2['image'] = $item;
				DB::table('image')->insert($data2);
			}
			
			$this->multiple_upload($upload);
		}


        return redirect()->intended('admin/library');
    }

     public function edit($id){
        $library = Library::find($id);
        // Redirect to product list if updating product wasn't existed
        if ($library == null || count($library) == 0) {
            return redirect()->intended('admin/library');
        }
        return view('admin/library/edit', ['library' => $library]);
    }

    public function update(Request $request, $id)
    {
    	$library = Library::findOrFail($id);
    	$input = $request->all();
    	$uniqueSlug = $this->buildUniqueSlug('library', $request->id, $request->slug);
    	$path = base_path() . '/storage/app/library/';
    	
    	$data = ['title' => $input['title'], 'slug' => $uniqueSlug, 'description' => $input['description'], 'updated_at' => date('Y:m:d H:i:s')];
    	if(DB::table('library')->where('id', $id)->update($data)){
    		if($library->slug != $request->slug){
	    		rename($path . $library->slug, $path . '/' . $uniqueSlug);
	    	}
    	}
    	return redirect()->intended('admin/library');
    }

	public function destroy($id){
		$library = Library::find($id);

		// $images = DB::table('image')->where('library_id', $id)->get();
		// if($images){
		// 	return redirect()->intended('admin/library');
		// }

		$slug = $library->slug;
		$upload = base_path() . '/' . 'storage/app/library/'.$slug;
		
		if(Library::where('id', $id)->update(['is_deleted' => 1])){
			File::deleteDirectory($upload);
		}
        return redirect()->intended('admin/library');
    }
 

	public function multiple_upload($upload) {
	    // getting all of the post data
	    $files = Input::file('image');

	    // Making counting of uploaded images
	    $file_count = count($files);

	    // start count how many uploaded
	    $uploadcount = 0;

	    $list_image = [];
	    foreach($files as $file) {
	        $rules = array('file' => 'required');

	        //'required|mimes:png,gif,jpeg,txt,pdf,doc'

	        $validator = Validator::make(array('file'=> $file), $rules);

	        if($validator->passes()){
	             $destinationPath = $upload;
	             $filename = $file->getClientOriginalName();
	             $upload_success = $file->move($destinationPath, $filename);
	             $uploadcount ++;
	             $list_image[] = $filename;
	         }

	    }
	}

	public function list_image($upload) {
	    // getting all of the post data
	    $files = Input::file('image');

	    // Making counting of uploaded images
	    $file_count = count($files);

	    // start count how many uploaded
	    $uploadcount = 0;

	    $list_image = [];
	    foreach($files as $file) {
	        $rules = array('file' => 'required');

	        //'required|mimes:png,gif,jpeg,txt,pdf,doc'

	        $validator = Validator::make(array('file'=> $file), $rules);

	        if($validator->passes()){
	             $filename = $file->getClientOriginalName();
	             $uploadcount ++;
	             $list_image[] = $filename;
	         }

	    }
	    return $list_image;
	}

	function buildNewFolderPath($path, $fileName){
        $newPath = $path . '/' . $fileName;
        $newName = $fileName;
        $counter = 1;
        while (is_dir($newPath)) {
            $newName = $fileName . '-' . $counter;
            $newPath = $path . '/' . $newName;
            $counter++;
        }

        return array($newName, $newPath);
    }
}
