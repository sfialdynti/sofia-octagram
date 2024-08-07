<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function index()
    {
        return view('template.index');
    }

    public function show(){
        $data['category'] = Category::orderby('name', 'asc')->get();
        $data['count'] = $data['category']->count();
        return view('template.category-table',$data);
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_publish' => ['required', 'boolean']
        ]);

        $validasi = Category::create([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);

        if ($validasi) {
            Session::flash('pesan','Data berhasil ditambahkan');
        }else {
            Session::flash('pesan','Data gagal ditambahkan');
        }
        return redirect('/category');
    }

    public function edit(Request $request)
    {
        $data['category'] = Category::find($request->id);

        return view('/category', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_publish' => ['required', 'boolean'],
        ]);

        $category = Category::where('id', $request->id)->update([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);

        if ($category) {
            Session::flash('pesan','Data berhasil diedit');
        }else {
            Session::flash('pesan','Data gagal diedit');
        }
        return redirect('/category');
    }

    public function delete(Request $request)
    {
        Category::where('id', $request->id)->delete();
        return redirect('/category');
    }
}
