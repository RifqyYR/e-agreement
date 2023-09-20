<!-- Bootstrap core JavaScript-->
<script src="{{ url('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('backend/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ url('backend/vendor/chart.js/Chart.min.js') }}"></script>

{{-- Ajax --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

{{-- Gijgo --}}
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

{{-- Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- Search Function --}}
<script>
    $('#search').on('keyup', function() {
        search();
    });
    search();

    function search() {
        var keyword = $('#search').val();
        if (window.location.pathname == "/sarpras") {
            $.post('{{ route('sarpras.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                    console.log(data);
                });
        } else if (window.location.pathname == "/sewa-bangunan") {
            $.post('{{ route('sewaBangunan.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                    console.log(data);
                });
        } else if (window.location.pathname == "/sewa-kendaraan") {
            $.post('{{ route('sewaKendaraan.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                    console.log(data);
                });
        } else if (window.location.pathname == "/tuks-tersus") {
            $.post('{{ route('tuksTersus.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                    console.log(data);
                });
        } else if (window.location.pathname == "/upp") {
            $.post('{{ route('upp.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                    console.log(data);
                });
        } else if (window.location.pathname == "/lainnya") {
            $.post('{{ route('lainnya.search') }}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword
                },
                function(data) {
                    table_post_row(data);
                    console.log(data);
                });
        }

        // Disable Enter Button on Search
        $(document).keypress(
            function(event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });
    }
    // table row with ajax
    function table_post_row(res) {
        let htmlView = '';
        if (res.agreements.length <= 0) {
            htmlView += `
         <tr>
            <td colspan="7">Tidak ada data.</td>
        </tr>`;
        }
        for (let i = 0; i < res.agreements.length; i++) {
            htmlView += `
          <tr>
             <th scope="row">` + (i + 1) + `</th>
                <td>` + res.agreements[i].title + `</td>
                 <td>` + res.agreements[i].agreementNumber + `</td>
                 <td>` + res.agreements[i].partner + `</td>
                 <td>` + res.agreements[i].unit + `</td>
                 <td>` + res.agreements[i].endDate + `</td>
                 <td>
                    <div class="d-flex align-items-center">
                        <a href="{{ url('/detail/` + res.agreements[i].id +`') }}"><button type="button"
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
                        <a href="{{ url('/edit/` + res.agreements[i].id +`') }}"><button type="button" class="btn btn-warning btn-sm">
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
                        <a href="{{ url('/delete/` + res.agreements[i].id +`') }}"><button type="button" class="btn btn-danger btn-sm">
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
                            </button></a>
                    </div>
                </td>
          </tr>`;
        }
        $('tbody').html(htmlView);
    }
</script>

{{-- Alert --}}
<script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>