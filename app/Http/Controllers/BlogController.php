<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
class BlogController extends Controller
{
    public function blog($slug)
    {
    	$data = Blog::where('slug', $slug)->first();
        if($data == '') {
            abort(404);
        } 
    	return view('blog', ['data' => $data]);
    }
}
