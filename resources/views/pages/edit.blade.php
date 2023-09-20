@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        {{-- Header --}}
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ubah Surat Perjanjian</h1>
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

                <form action="{{ route('edit.proses', ["id" => $agreement->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="namaSurat">Judul Surat</label>
                        <input type="text" class="form-control" name="namaSurat" value="{{ $agreement->title }}">
                    </div>
                    <div class="form-group">
                        <label for="nomorSurat">Nomor Surat</label>
                        <input type="text" class="form-control" name="nomorSurat"
                            value="{{ $agreement->agreementNumber }}">
                    </div>
                    <div class="form-group">
                        <label for="jenisPerjanjian">Jenis Perjanjian</label>
                        <select class="custom-select" name="jenisPerjanjian">
                            <option hidden value="">Jenis Perjanjian...</option>
                            <option @if ($agreement->agreementType == 'sarpras') selected @endif value="sarpras">SARPRAS</option>
                            <option @if ($agreement->agreementType == 'sewa bangunan') selected @endif value="sewa bangunan">Sewa Bangunan</option>
                            <option @if ($agreement->agreementType == 'sewa kendaraan') selected @endif value="sewa kendaraan">Sewa Kendaraan</option>
                            <option @if ($agreement->agreementType == 'tuks tersus') selected @endif value="tuks tersus">TUKS-TERSUS</option>
                            <option @if ($agreement->agreementType == 'upp') selected @endif value="upp">UPP</option>
                            <option @if ($agreement->agreementType == 'lainnya') selected @endif value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mitra">Mitra</label>
                        <input type="text" class="form-control" name="mitra" value="{{ $agreement->partner }}">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" name="unit" value="{{ $agreement->unit }}">
                        {{-- <select class="custom-select" name="unit">
                            <option selected hidden value="">Unit...</option>
                            <option value="1">Satu</option>
                            <option value="2">Dua</option>
                            <option value="3">Tiga</option>
                        </select> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="tanggalPenandatanganan">Tanggal Penandatanganan</label>
                            <input type="date" class="form-control" name="tanggalPenandatanganan" autocomplete="off"
                                value="{{ $agreement->signDate }}" />
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tanggalBerlaku">Tanggal Berlaku</label>
                            <input type="date" class="form-control" name="tanggalBerlaku" autocomplete="off"
                                value="{{ $agreement->startDate }}" />
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tanggalBerakhir">Tanggal Berakhir</label>
                            <input type="date" class="form-control" name="tanggalBerakhir" autocomplete="off"
                                value="{{ $agreement->endDate }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="suratPerjanjian">Upload Surat Perjanjian</label>
                        <input type="file" class="form-control-file" id="suratPerjanjian" name="suratPerjanjian">
                    </div>
                    <div class="form-group mt-5">
                        <input type="submit" class="btn btn-primary" value="Ubah">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
