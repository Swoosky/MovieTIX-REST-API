<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //method utk tampil semua
    public function index() {
        $users = User::All(); //mengambil semua
        
        if(count($users) > 0) {
            return response([
                'message' => 'Retrieve all success!',
                'data' => $users
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);

    }

    //method utk tampil 1
    public function show($id) {
        $user = User::find($id); //mengambil 1
        
        if(!is_null($user)    ) {
            return response([
                'message' => 'Retrieve User success!',
                'data' => $user
            ], 200); //return success
        }

        return response([
            'message' => 'Course not found',
            'data' => null
        ], 400); //return tidak ketemu

    }

    //method utk tambah 1 data
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:users',
            'username' => 'required',
            'password' => 'required',
            'imgURL' => 'required'
        ]); //membuat rule validasi input

        if($validate->fails()) {
            return response([
                'message' => $validate->errors()
            ], 400); //return error invalid input
        }

        $user = User::create($storeData);
        return response([
            'message' => 'Add user success!',
            'data' => $user
        ], 200); //membuat course baru
    }

    //method utk menghapus 1
    public function destroy($id) {
        $user = User::find($id); //mengambil 1
        
        if(is_null($user)) {
            return response([
                'message' => 'User not found',
                'data' => null
            ], 404); //return tidak ditemukan
        }
        
        if($user->delete()) {
            return response([
                'message' => 'Delete user success!',
                'data' => $user
            ], 200); //return tidak ditemukan
        }

        return response([
            'message' => 'Delete user failed',
            'data' => null
        ],400); //return gagal hapus
    }

    //method utk update
    public function update(Request $request, $id) {
        $user = User::find($id);
        
        if(is_null($user)) {
            return response([
                'message' => 'User not found',
                'data' => null
            ], 404); //return tidak ditemukan
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama' => 'required|max:60',
            'email' => ['required','email:rfc,dns',Rule::unique('users')->ignore($user)],
            'username' => 'required',
            'imgURL' => 'required'
        ]); //membuat validasi

        if($validate->fails()) {
            return response([
                'message' => $validate->errors()
            ], 400); //return error invalid input
        }
        
        $user->nama = $updateData['nama'];
        $user->email = $updateData['email'];
        $user->username = $updateData['username'];
        $user->imgURL = $updateData['imgURL'];

        if($user->save()) {
            return response([
                'message' => 'Update user Success!',
                'data' => $user
            ], 200);
        } //return data yang diedit dlm json

        return response([
            'message' => 'Update user Failed',
            'data' => null
        ], 400);
        
    }
}
