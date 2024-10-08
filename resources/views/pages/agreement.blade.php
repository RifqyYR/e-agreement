@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            @if (Request::is('semua'))
                <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
            @else
                <h1 class="h3 mb-0 text-gray-800">Surat Perjanjian {{ $title }}</h1>
            @endif
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="table-responsive" id="demo">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Judul</th>
                                <th scope="col" class="text-center">Nomor Surat</th>
                                <th scope="col" class="text-center">Mitra</th>
                                <th scope="col" class="text-center">Unit</th>
                                <th scope="col" class="text-center">Tanggal Berakhir</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($agreements as $agreement)
                                @php
                                    if (isset($agreement)) {
                                        $start_date = strtotime($agreement->startDate);
                                        $end_date = strtotime($agreement->endDate);
                                    }
                                @endphp
                                <tr class={{ round(($end_date - $start_date) / 60 / 60 / 24) <= 10 ? 'text-danger' : '' }}>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $agreement->title }}</td>
                                    <td>{{ $agreement->agreementNumber }}</td>
                                    <td>{{ $agreement->partner }}</td>
                                    <td>{{ $agreement->unit }}</td>
                                    <td>{{ $agreement->endDate }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ url('/detail/' . $agreement->id) }}"><button type="button"
                                                    class="btn btn-info btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                        viewBox="0 0 576 512">
                                                        <style>
                                                            svg {
                                                                fill: #ffffff
                                                            }
                                                        </style>
                                                        <path
                                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                    </svg>
                                                </button></a>
                                            <a href="{{ url('/edit/' . $agreement->id) }}"><button type="button"
                                                    class="btn btn-warning btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                        viewBox="0 0 512 512">
                                                        <style>
                                                            svg {
                                                                fill: #ffffff
                                                            }
                                                        </style>
                                                        <path
                                                            d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                    </svg>
                                                </button></a>
                                            @if (Auth::user()->isAdmin != 0)
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="examplemodal" onclick="hapus($agreement->id)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                        viewBox="0 0 448 512">
                                                        <style>
                                                            svg {
                                                                fill: #ffffff
                                                            }
                                                        </style>
                                                        <path
                                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus item ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    id="btn-delete">Batal</button>
                                                <a id="deleteLink" href="{{ url('/delete/' . $agreement->id) }}">
                                                    <button type="button" class="btn btn-danger">Hapus</button>
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
@endsection
