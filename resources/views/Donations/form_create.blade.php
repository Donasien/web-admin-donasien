@extends('layouts.main')

@section('title', 'Donasi')

@section('container')
<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Tambah data Donasi</h5>
          <div class="card">
            <div class="card-body">
              <form action="{{ route('Donasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input type="text" 
                    class="form-control 
                    @error('nama')
                        is-invalid
                    @enderror"
                    value="{{ old('nama') }}" id="nama" name="nama">
                    {{-- pesan error --}}
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <select class="form-control
                    @error('gender')
                        is-invalid
                    @enderror" 
                    name="gender" id="gender">
                        <option selected disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki - laki" @if (old('gender') == "Laki - laki") {{ 'selected' }} @endif>Laki - Laki</option>
                        <option value="Perempuan" @if (old('gender') == "Perempuan") {{ 'selected' }} @endif>Perempuan</option>
                    </select>
                    {{-- pesan error --}}
                    @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_kk" class="form-label">No KK</label>
                    <input class="form-control
                    @error('no_kk')
                        is-invalid
                    @enderror "
                    type="number" name="no_kk" id="no_kk" value="{{ old('no_kk') }}">
                    {{-- pesan error --}}
                    @error('no_kk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="no_telp" class="form-label">No Telpon</label>
                  <input class="form-control
                    @error('no_telp')
                        is-invalid
                    @enderror "
                  type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}">
                  {{-- pesan error --}}
                    @error('no_telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea class="form-control
                    @error('alamat')
                        is-invalid
                    @enderror "
                    type="text" name="alamat" id="alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input class="form-control
                      @error('file')
                          is-invalid
                      @enderror "
                    type="file" name="file" id="file" value="{{ old('file') }}">
                    {{-- pesan error --}}
                      @error('file')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('Donasi.index') }}" class="btn btn-default float-right">Cancel</a>
              </form>
            </div>
          </div>          
        </div>
      </div>
    </div>
</div>
    
@endsection