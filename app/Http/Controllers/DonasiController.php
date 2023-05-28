<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_donasi = DB::table('donasi')->get();
        return view('Donations.index', compact('ar_donasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Donations.form_create');
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
                'file' => 'required'
            ],
            [
                'nama.required' => 'Kolom Nama harus diisi',
                'gender.required' => 'Kolom Gender harus diisi',
                'no_kk.required' => 'Kolom No KK harus diisi',
                'no_telp.required' => 'Kolom No Telp harus diisi',
                'alamat.required' => 'Kolom Alamat harus diisi',
                'file.required' => 'Kolom File harus diisi'
            ]
            

        );

        if(!empty($request->file)){
            $request->validate([
            'file' => 'image|mimes:jpg,jpeg,png,giff|max:20000',
            ]);
            $fileName = $request->nama.'_'.$request->gender.'_'.$request->no_kk.'_'.$request->no_telp.'_'.$request->alamat.'.'.$request->file->extension();
            //$fileName = tanggal_idcustomer_judul.'.jpg';
            $request->file->move(public_path('images/Donasi'), $fileName);
        }   
        else {
            $fileName = '';
        }

        DB::table('donasi')->insert(
            [
                'nama'=>$request->nama,
                'gender'=>$request->gender,
                'no_kk'=>$request->no_kk,
                'no_telp'=>$request->no_telp,
                'alamat'=>$request->alamat,
                'file'=>$fileName,
            ]
        );

        return redirect('/Donasi')->with('success','Data berhasil ditambahkan');
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
        $data = DB::table('donasi')
         ->where('id', '=', $id)
         ->get();
         return view('Donations.form_update', compact('data'));
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
                'file' => 'required'
            ],
            [
                'nama.required' => 'Kolom Nama harus diisi',
                'gender.required' => 'Kolom Gender harus diisi',
                'no_kk.required' => 'Kolom No KK harus diisi',
                'no_telp.required' => 'Kolom No Telp harus diisi',
                'alamat.required' => 'Kolom Alamat harus diisi',
                'file.required' => 'Kolom File harus diisi'
            ]
            
        );

        if(!empty($request->file)){
            //ambil isi kolom file lalu hapus file filenya di folder images
            $file = DB::table('donasi')->select('file')->where('id','=',$id)->get();
            foreach($file as $f){
                $namaFile = $f->file;
            }
            File::delete(public_path('images/Donasi/'.$namaFile));
            //proses upload file baru
            $request->validate([
                'file' => 'image|mimes:jpg,jpeg,png,giff|max:20000',
            ]);
            $fileName = $request->nama.'_'.$request->gender.'_'.$request->no_kk.'_'.$request->no_telp.'_'.$request->alamat.'.'.$request->file->extension();
            //$fileName = tanggal_idcustomer_judul.'.jpg';
            $request->file->move(public_path('images/Donasi'), $fileName);
        }
        // Kode program di bawah ini merupakan lanjutan dari proses edit data pembayaran jika tidak  mengubah file pembayaran
        else{
            //ambil isi kolom file lalu hapus file filenya di folder images
            $file = DB::table('donasi')->select('file')->where('id','=',$id)->get();
            foreach($file as $f) {
                $namaFile = $f->file;
            }
            $fileName = $namaFile;
        }

        DB::table('donasi')->where('id', '=', $id)->update(
            [
                'nama'=>$request->nama,
                'gender'=>$request->gender,
                'no_kk'=>$request->no_kk,
                'no_telp'=>$request->no_telp,
                'alamat'=>$request->alamat,
                'file'=>$fileName,
            ]
        );

        // 2. Landing Page
        return redirect('/Donasi')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = DB::table('donasi')->select('file')
        ->where('id','=',$id)->get();
        foreach($file as $f){
            $namaFile = $f->file;
        }
        File::delete(public_path('images/Donasi/'.$namaFile));

        // Menghapus Data
        DB::table('donasi')->where('id', $id)->delete();
        return redirect('Donasi')->with('success','Data berhasil dihapus');
    }
}
