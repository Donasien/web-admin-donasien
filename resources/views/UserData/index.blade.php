@extends('layouts.main')

@section('title', 'User Data')

@section('container')
    <div class="container-fluid">
        <div class="card">
            <div class="d-flex justify-content-between" style="margin-bottom:-20px;">
                <a href="{{ route('UserData.create') }}" class="btn btn-primary m-4">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
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
                            @foreach ($ar_user as $row)
                            <tr>
                                <td>{{ $nomor++ }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->gender }}</td>
                                <td>{{ $row->no_kk }}</td>
                                <td>{{ $row->no_telp }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>
                                    <form method="POST" action="{{ route('UserData.destroy', $row->id) }}">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('UserData.edit', $row->id) }}" class="btn btn-primary m-1"><i class="ti ti-edit"></i></a>
                                        <button type="submit" class="btn btn-danger delete m-1"><i class="ti ti-trash"></i></button>
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