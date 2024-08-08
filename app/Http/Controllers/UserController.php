<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function user(){
        return view('template.user-table');
    }

    public function show(){
        $data['user'] = User::orderby('name', 'asc')->get();
        
        return view( 'template.user-table', $data);
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user) {
            Session::flash('pesan','Data berhasil ditambahkan');
        }else {
            Session::flash('pesan','Data gagal ditambahkan');
        }

        return redirect('/user');
    }

    public function edit(Request $request){
        $data['user'] = User::find($request->id);

        return view ('/user', $data);
    }

    public function update(Request $request){

        $update = User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : DB::raw('password')
        ]);

        if ($update) {
            Session::flash('pesan','Data berhasil diedit');
        }else {
            Session::flash('pesan','Data gagal diedit');
        }

        return redirect('/user');
    }

    public function delete(Request $request){
        $user = User::find($request->id);
        $delete = User::where('id', $request->id)->delete();

        if ($delete) {
            Session::flash('pesan', 'Data berhasil dihapus');
        }else {
            Session::flash('pesan', 'Data gagal dihapus');
        }
        
        return redirect('/user');
    }


}
