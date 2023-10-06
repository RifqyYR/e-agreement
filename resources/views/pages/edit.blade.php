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

                <form action="{{ route('edit.proses', ['id' => $agreement->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="namaSurat">Judul Surat</label>
                        <input type="text" class="form-control @error('namaSurat') is-invalid @enderror" name="namaSurat" value="{{ $agreement->title }}">
                        @error('namaSurat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomorSurat">Nomor Surat</label>
                        <input type="text" class="form-control @error('nomorSurat') is-invalid @enderror" name="nomorSurat"
                            value="{{ $agreement->agreementNumber }}">
                        @error('nomorSurat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenisPerjanjian">Jenis Perjanjian</label>
                        <select class="custom-select @error('jenisPerjanjian') is-invalid @enderror" name="jenisPerjanjian">
                            <option hidden value="">Jenis Perjanjian...</option>
                            <option @if ($agreement->agreementType == 'sarpras') selected @endif value="sarpras">SARPRAS</option>
                            <option @if ($agreement->agreementType == 'sewa bangunan') selected @endif value="sewa bangunan">Sewa Bangunan
                            </option>
                            <option @if ($agreement->agreementType == 'sewa kendaraan') selected @endif value="sewa kendaraan">Sewa Kendaraan
                            </option>
                            <option @if ($agreement->agreementType == 'tuks tersus') selected @endif value="tuks tersus">TUKS-TERSUS
                            </option>
                            <option @if ($agreement->agreementType == 'upp') selected @endif value="upp">UPP</option>
                            <option @if ($agreement->agreementType == 'lainnya') selected @endif value="lainnya">Lainnya</option>
                        </select>
                        @error('jenisPerjanjian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mitra">Mitra</label>
                        <input type="text" class="form-control @error('mitra') is-invalid @enderror" name="mitra" value="{{ $agreement->partner }}">
                        @error('mitra')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ $agreement->unit }}">
                        @error('unit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label for="tanggalPenandatanganan">Tanggal Penandatanganan</label>
                            <input type="date" class="form-control @error('tanggalPenandatanganan') is-invalid @enderror" name="tanggalPenandatanganan" autocomplete="off"
                                value="{{ $agreement->signDate }}" />
                            @error('tanggalPenandatanganan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tanggalBerlaku">Tanggal Berlaku</label>
                            <input type="date" class="form-control @error('tanggalBerlaku') is-invalid @enderror" name="tanggalBerlaku" autocomplete="off"
                                value="{{ $agreement->startDate }}" />
                            @error('tanggalBerlaku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tanggalBerakhir">Tanggal Berakhir</label>
                            <input type="date" class="form-control @error('tanggalBerakhir') is-invalid @enderror" name="tanggalBerakhir" autocomplete="off"
                                value="{{ $agreement->endDate }}" />
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
                        <input type="submit" class="btn btn-primary" value="Ubah">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
