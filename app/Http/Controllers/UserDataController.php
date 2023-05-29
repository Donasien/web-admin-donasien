<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_user = DB::table('user_data')->get();
        return view('UserData.index', compact('ar_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('UserData.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'gender' => 'required',
                'no_kk' => 'required',
                'no_telp' => 'required',
                'alamat' => 'required',
            ],
            [
                'nama.required' => 'Kolom Nama harus diisi',
                'gender.required' => 'Kolom Gender harus diisi',
                'no_kk.required' => 'Kolom No KK harus diisi',
                'no_telp.required' => 'Kolom No Telp harus diisi',
                'alamat.required' => 'Kolom Alamat harus diisi',
            ]
            

        );

        DB::table('user_data')->insert(
            [
                'nama'=>$request->nama,
                'gender'=>$request->gender,
                'no_kk'=>$request->no_kk,
                'no_telp'=>$request->no_telp,
                'alamat'=>$request->alamat,
            ]
        );

        return redirect('/UserData')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('user_data')
         ->where('id', '=', $id)
         ->get();
         return view('UserData.form_update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama' => 'required',
                'gender' => 'required',
                'no_kk' => 'required',
                'no_telp' => 'required',
                'alamat' => 'required',
            ],
            [
                'nama.required' => 'Kolom Nama harus diisi',
                'gender.required' => 'Kolom Gender harus diisi',
                'no_kk.required' => 'Kolom No KK harus diisi',
                'no_telp.required' => 'Kolom No Telp harus diisi',
                'alamat.required' => 'Kolom Alamat harus diisi',
            ]
            
        );


        DB::table('user_data')->where('id', '=', $id)->update(
            [
                'nama'=>$request->nama,
                'gender'=>$request->gender,
                'no_kk'=>$request->no_kk,
                'no_telp'=>$request->no_telp,
                'alamat'=>$request->alamat,
            ]
        );

        // 2. Landing Page
        return redirect('/UserData')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Menghapus Data
        DB::table('user_data')->where('id', $id)->delete();
        return redirect('UserData')->with('success','Data berhasil dihapus');
    }
}
