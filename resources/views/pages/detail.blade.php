@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-body font-weight-bold">{{ $agreement->title }}</h1>
        </div>
        <div class="row mb-4">
            <div class="col-md-7">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item"
                        src="{{ asset('/laraview/#../storage/' . $agreement->fileName) }}"></iframe>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col">
                        <p><b>Nomor perjanjian</b>
                            <br>
                            {{ $agreement->agreementNumber }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p><b>Tipe Perjanjian</b>
                            <br>
                            {{ strtoupper($agreement->agreementType) }}
                        </p>
                    </div>
                    <div class="col-6">
                        <p><b>Mitra</b>
                            <br>
                            PT. Pelindo Jasa Maritim
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p><b>Unit</b>
                            <br>
                            {{ $agreement->unit }}
                        </p>
                    </div>
                    <div class="col-6">
                        <p><b>Tanggal Penandatanganan</b>
                            <br>
                            {{ $agreement->signDate }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p><b>Tanggal Berlaku</b>
                            <br>
                            {{ $agreement->startDate }}
                        </p>
                    </div>
                    <div class="col-6">
                        <p><b>Tanggal Berakhir</b>
                            <br>
                            {{ $agreement->endDate }}
                        </p>
                    </div>
                </div>
                <div class="row m-1">
                    <a href="{{ asset('storage/' . $agreement->fileName) }}"><button class="btn btn-info">Unduh Perjanjian</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
