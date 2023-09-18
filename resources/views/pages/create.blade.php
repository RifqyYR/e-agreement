@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        {{-- Header --}}
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Surat Perjanjian Baru</h1>
            </div>
        </div>

        {{-- Input Form --}}
        <div class="card mt-2">
            <div class="card-body">
                {{-- menampilkan error validasi --}}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <form action="/proses-tambah-perjanjian" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="namaSurat">Judul Surat</label>
                        <input type="text" class="form-control" name="namaSurat" value="{{ old('namaSurat') }}">
                    </div>
                    <div class="form-group">
                        <label for="nomorSurat">Nomor Surat</label>
                        <input type="text" class="form-control" name="nomorSurat" value="{{ old('nomorSurat') }}">
                    </div>
                    <div class="form-group">
                      <label for="jenisPerjanjian">Jenis Perjanjian</label>
                      <select class="custom-select" name="jenisPerjanjian">
                        <option selected hidden value="">Jenis Perjanjian...</option>
                        <option value="sarpras">SARPRAS</option>
                        <option value="sewa bangunan">Sewa Bangunan</option>
                        <option value="sewa kendaraan">Sewa Kendaraan</option>
                        <option value="tuks tersus">TUKS-TERSUS</option>
                        <option value="upp">UPP</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                  </div>
                    <div class="form-group">
                        <label for="mitra">Mitra</label>
                        <input type="text" class="form-control" name="mitra" value="{{ old('mitra') }}">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select class="custom-select" name="unit">
                            <option selected hidden value="">Unit...</option>
                            <option value="1">Satu</option>
                            <option value="2">Dua</option>
                            <option value="3">Tiga</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="tanggalPenandatanganan">Tanggal Penandatanganan</label>
                            <input type="date" class="form-control" name="tanggalPenandatanganan" autocomplete="off"
                                value="{{ old('tanggalPenandatanganan') }}" />
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tanggalBerlaku">Tanggal Berlaku</label>
                            <input type="date" class="form-control" name="tanggalBerlaku" autocomplete="off"
                                value="{{ old('tanggalBerlaku') }}" />
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tanggalBerakhir">Tanggal Berakhir</label>
                            <input type="date" class="form-control" name="tanggalBerakhir" autocomplete="off"
                                value="{{ old('tanggalBerakhir') }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="suratPerjanjian">Upload Surat Perjanjian</label>
                        <input type="file" class="form-control-file" id="suratPerjanjian" name="suratPerjanjian">
                    </div>
                    <div class="form-group mt-5">
                        <input type="submit" class="btn btn-primary" value="Tambah">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
