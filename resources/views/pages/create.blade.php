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
                        <input type="text" class="form-control @error('namaSurat') is-invalid @enderror" name="namaSurat"
                            value="{{ old('namaSurat') }}">
                        @error('namaSurat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomorSurat">Nomor Surat</label>
                        <input type="text" class="form-control @error('nomorSurat') is-invalid @enderror"
                            name="nomorSurat" value="{{ old('nomorSurat') }}">
                        @error('nomorSurat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenisPerjanjian">Jenis Perjanjian</label>
                        <select class="custom-select @error('jenisPerjanjian') is-invalid @enderror" name="jenisPerjanjian">
                            <option selected hidden value="">Jenis Perjanjian...</option>
                            <option value="sarpras">SARPRAS</option>
                            <option value="sewa bangunan">Sewa Bangunan</option>
                            <option value="sewa kendaraan">Sewa Kendaraan</option>
                            <option value="tuks tersus">TUKS-TERSUS</option>
                            <option value="upp">UPP</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        @error('jenisPerjanjian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mitra">Mitra</label>
                        <input type="text" class="form-control @error('mitra') is-invalid @enderror" name="mitra"
                            value="{{ old('mitra') }}">
                        @error('mitra')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit"
                            value="{{ old('unit') }}">
                        @error('unit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="tanggalPenandatanganan">Tanggal Penandatanganan</label>
                            <input type="date" class="form-control @error('tanggalPenandatanganan') is-invalid @enderror"
                                name="tanggalPenandatanganan" autocomplete="off"
                                value="{{ old('tanggalPenandatanganan') }}" />
                            @error('tanggalPenandatanganan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tanggalBerlaku">Tanggal Berlaku</label>
                            <input type="date" class="form-control @error('tanggalBerlaku') is-invalid @enderror" name="tanggalBerlaku" autocomplete="off"
                                value="{{ old('tanggalBerlaku') }}" />
                            @error('tanggalBerlaku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tanggalBerakhir">Tanggal Berakhir</label>
                            <input type="date" class="form-control @error('tanggalBerakhir') is-invalid @enderror" name="tanggalBerakhir" autocomplete="off"
                                value="{{ old('tanggalBerakhir') }}" />
                            @error('tanggalBerakhir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="suratPerjanjian">Upload Surat Perjanjian</label>
                        <input type="file" class="form-control-file @error('suratPerjanjian') is-invalid @enderror" id="suratPerjanjian" name="suratPerjanjian">
                        @error('suratPerjanjian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-5">
                        <input type="submit" class="btn btn-primary" value="Tambah">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
