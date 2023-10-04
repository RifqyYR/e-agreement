@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
            @if (Auth::user()->isAdmin == 1)
                <a href="{{ url('/tambah-perjanjian') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <style>
                            svg {
                                fill: #ffffff
                            }
                        </style>
                        <path
                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                    </svg>
                    Perjanjian Baru</a>
            @endif
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Surat Perjanjian Kerja Sama</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_agreements }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Total Surat Perjanjian Kerja Sama yang Akan Berakhir</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_expired_agreements }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="h3 mb-3 text-gray-800">Daftar Perjanjian yang Akan Berakhir</h3>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Judul</th>
                                <th scope="col" class="text-center">Nomor Surat</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($ending_agreements as $agreement)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td class="text-center">{{ $agreement->title }}</td>
                                    <td class="text-center">{{ $agreement->agreementNumber }}</td>
                                    <td class="justify-content-center" style="text-align: center;">
                                        <a href="{{ url('/perpanjang/' . $agreement->id) }}"><button value="perpanjang"
                                                class="btn btn-primary btn-sm mb-1"
                                                style="min-width:8dvw">Perpanjang</button></a>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#archiveModal" style="min-width:8dvw" onclick="arsip('{{ $agreement->id }}')">Arsipkan</button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pengarsipan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin mengarsipkan perjanjian ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    id="btn-delete">Batal</button>
                                                <a id="arsipLink">
                                                    <button type="button" class="btn btn-info">Arsipkan</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contractNotificationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $total_expired_agreements }} Perjanjian Segera
                        Berakhir</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <ul>
                        @foreach ($ending_agreements as $agreement)
                            @php
                                $now = time();
                                $your_date = strtotime($agreement->endDate);
                                $datediff = $your_date - $now;
                            @endphp
                            <li class="text-danger">{{ $agreement->title }} -
                                {{ $datediff > 0 ? round($datediff / (60 * 60 * 24)) . ' hari lagi' : 'Sudah lewat ' . round($datediff / (60 * 60 * 24)) * -1 . ' hari' }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
