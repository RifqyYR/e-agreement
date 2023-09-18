@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h5 mb-0 text-body font-weight-bold">{{ $agreement->title }}</h1>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Nomor Perjanjian</th>
                                <td>: {{ $agreement->agreementNumber }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Perjanjian</th>
                                <td>: {{ $agreement->agreementType }}</td>
                            </tr>
                            <tr>
                                <th>Mitra</th>
                                <td>: {{ $agreement->partner }}</td>
                            </tr>
                            <tr>
                                <th>Unit</th>
                                <td>: {{ $agreement->unit }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Penandatanganan</th>
                                <td>: {{ $agreement->signDate }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Berlaku</th>
                                <td>: {{ $agreement->startDate }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Berakhir</th>
                                <td>: {{ $agreement->endDate }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item"
                        src="{{ url('/laraview/#../storage/files/perjanjian/sarpras/1694763196.4. KUNCI CERDAS DAN PRIBADI BINLAT SIP 2021' . '.pdf') }}"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
