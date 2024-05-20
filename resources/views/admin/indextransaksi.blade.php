@extends('auth.adminlayouts')

@section('main-content')
    <!-- Page Heading -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: #192446;">Data Transaction Sales</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p>
                        <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('create') }}"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                        </p>


                        <div class="col-sm-12">
                            <table class="table table-hover table-bordered" id="ajax-crud-transaksi">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No Transaksi</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Jumlah Barang</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Diskon</th>
                                        <th scope="col">Ongkir</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>

                                
                            </table>
                            <div class="row mt-4">
                <div class="col-sm-12">
                 
                    <div id="grand-total"></div>
                </div>
            </div>
                        </div>
                    </div>



            
                </div>
            </div>

            <!-- Grand Total -->
         

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajax-crud-transaksi').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('ajax-crud-transaksi') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
                    {data: 'kode', name: 'kode'},
                    {data: 'tgl', name: 'tgl'},
                    {data: 'nama', name: 'nama'},
                    {data: 'qty', name: 'qty'},
                    {data: 'subtotal', name: 'subtotal'},
                    {data: 'diskon', name: 'diskon'},
                    {data: 'ongkir', name: 'ongkir'},
                    {data: 'total_bayar', name: 'total_bayar'},
                ],
                order: [[0, 'desc']],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api(), data;

                    // Menghitung total dari kolom total_bayar
                    var totalBayar = api.column(8, {page: 'current'}).data().reduce(function (a, b) {
                        return a + parseFloat(b);
                    }, 0);

                    // Menampilkan total di footer
                    $('#grand-total').html('Grand Total: ' + totalBayar.toFixed(2));
                }
            });
        });

    </script>
@endsection
