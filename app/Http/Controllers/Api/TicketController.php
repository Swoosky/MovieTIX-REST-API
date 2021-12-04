<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    //method utk tampil semua
    public function index() {
        $tickets = Ticket::All(); //mengambil semua
        
        if(count($tickets) > 0) {
            return response([
                'message' => 'Retrieve all success!',
                'data' => $tickets
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
        //
    }
    
    //method utk tampil semua untuk satu user
    public function indexOneUser($name) {
        $tickets = Ticket::where('user', $name)->get(); //mengambil yang dari author name
        
        if(count($tickets) > 0) {
            return response([
                'message' => 'Retrieve all success!',
                'data' => $tickets
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    //method utk tampil 1
    public function show($id) {
        $ticket = Ticket::find($id); //mengambil 1
        
        if(!is_null($ticket)) {
            return response([
                'message' => 'Retrieve Ticket success!',
                'data' => $ticket
            ], 200); //return success
        }

        return response([
            'message' => 'Ticket not found',
            'data' => null
        ], 400); //return tidak ketemu

    }

    //method utk tambah 1 data
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'user' => 'required',
            'judul' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'jenis' => 'required',
            'total' => 'required'
        ]); //membuat rule validasi input

        if($validate->fails()) {
            return response([
                'message' => $validate->errors()
            ], 400); //return error invalid input
        }

        $ticket = Ticket::create($storeData);
        return response([
            'message' => 'Add Ticket success!',
            'data' => $ticket
        ], 200); //membuat course baru
    }

    //method utk menghapus 1
    public function destroy($id) {
        $ticket = Ticket::find($id); //mengambil 1
        
        if(is_null($ticket)) {
            return response([
                'message' => 'Ticket not found',
                'data' => null
            ], 404); //return tidak ditemukan
        }
        
        if($ticket->delete()) {
            return response([
                'message' => 'Delete Ticket success!',
                'data' => $ticket
            ], 200); //return tidak ditemukan
        }

        return response([
            'message' => 'Delete Ticket failed',
            'data' => null
        ],400); //return gagal hapus
    }

    //method utk update
    public function update(Request $request, $id) {
        $ticket = Ticket::find($id);
        
        if(is_null($ticket)) {
            return response([
                'message' => 'Ticket not found',
                'data' => null
            ], 404); //return tidak ditemukan
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'user' => 'required',
            'judul' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'jenis' => 'required',
            'total' => 'required'
        ]); //membuat validasi

        if($validate->fails()) {
            return response([
                'message' => $validate->errors()
            ], 400); //return error invalid input
        }
        
        $ticket->user = $updateData['user'];
        $ticket->judul = $updateData['judul'];
        $ticket->waktu = $updateData['tempat'];
        $ticket->tanggal = $updateData['tanggal'];
        $ticket->waktu = $updateData['waktu'];
        $ticket->jenis = $updateData['jenis'];
        $ticket->total = $updateData['total'];

        if($ticket->save()) {
            return response([
                'message' => 'Update Ticket Success!',
                'data' => $ticket
            ], 200);
        } //return data yang diedit dlm json

        return response([
            'message' => 'Update Ticket Failed',
            'data' => null
        ], 400);
        
    }
}
