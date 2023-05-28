@extends('layouts.main')

@section('title', 'Donasi')

@section('container')
    <div class="container-fluid">
        <div class="card">
            <div class="d-flex justify-content-between" style="margin-bottom:-20px;">
                <a href="" class="btn btn-primary btn-block m-4"><i class="fas fa-plus-square mr-2"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Gender</th>
                                <th>No KK</th>
                                <th>No Telp</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($ar_donasi as $row)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->gender }}</td>
                                <td>{{ $row->no_kk }}</td>
                                <td>{{ $row->no_telp }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td width="20%">
                                    @php
                                    if(!empty($row->file)){
                                    @endphp
                                        <img src="{{ asset('images/Donasi')}}/{{ $row->file }}" width="80%" />
                                    @php
                                    } 
                                    @endphp
                                </td>
                                    <form method="POST" action="{{ route('donasi.destroy', $row->id) }}">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('donasi.edit', $row->id) }}" class="btn btn-sm btn-primary m-1"><i
                                                class="fas fa-pen"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger delete m-1"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection