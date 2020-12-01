<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Blog;
use Auth;
class ManageBlog extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data = Blog::orderBy('created_at', 'DESC')->paginate(10);
        // return $data;
        return view('admin.blog.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {   
        $validasi = $this->validate($request, [
            'judul'     => 'required|string',
            'artikel'   => 'required|string',
            'gambar'    => 'image|mimes:jpeg,png,jpg|max:3072'
        ]);

        $data = new Blog;
        $data->judul = $request->judul;
        $data->slug = Str::slug($request->judul);


            $gambar = $request->file('gambar');
            if ($gambar) {
                $gambar_path = $gambar->store('gambar', 'public');
                $data->gambar = $gambar_path;
            }

        $data->artikel = $request->artikel;
        $data->admin_id = Auth::guard('admin')->user()->id;
        $data->save();

        return redirect()->back()->with('success', '/blog' );
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $data = Blog::where('slug', $id)->first();
        if($data == '') {
            abort(404);
        } 
        // return $data;
        return view('admin.blog.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $data = Blog::findOrFail($id);
        if ($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) {
                \Storage::delete('public/' . $data->gambar);
            }
        $data->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Blog');
    }
}
