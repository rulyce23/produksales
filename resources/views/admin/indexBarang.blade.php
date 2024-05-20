
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
                    <h6 class="m-0 font-weight-bold" style="color: #192446;">Data Master Barang</h6>
                </div>
                <div class="card-body">

                 

      <div class="row">
      <p>
      <div class="pull-right mb-2">
                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </p>


        <div class="col-sm-12">
        <table class="table table-hover table-bordered" id="ajax-crud-datatable" style="width: 100%;
       overflow-x: auto;">
            <thead>
              <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Jenis</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            
          </table>
        </div>
      </div>

    <div class="modal fade" id="Barang-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Master Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="BarangForm" name="BarangForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_barang" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Enter Kode" maxlength="50" required="">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name" maxlength="50" required="true">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Harga</label>
                            <div class="col-sm-12">
                            <input type="number" class="form-control" id="harga" name="harga" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Enter Jenis" required="true">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10"><br/>
                        <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
    
</div>
</div>
        </div>
        </div>

    </div>
   
    <script type="text/javascript">
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
    $('#ajax-crud-datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        rowReorder: {
        selector: 'td:nth-child(2)'
    },
        ajax: "{{ url('ajax-crud-datatable') }}",
        columns: [
            { data: 'kode', name: 'kode' },
            { data: 'nama', name: 'nama' },
            { data: 'harga', name: 'harga' },
            { data: 'jenis', name: 'jenis' },
            { data: 'action', name: 'action', orderable: false},
        ],
        order: [[0, 'desc']]
    });
});
 
function add(){
    $('#BarangForm').trigger("reset");
    $('#BarangModal').html("Add Barang");
    $('#Barang-modal').modal('show');
    $('#id').val('');
}   
     
function editFunc(id){
    $.ajax({
        type:"POST",
        url: "{{ url('edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#BarangModal').html("Edit Barang");
            $('#Barang-modal').modal('show');
            $('#id').val(res.id);
            $('#kode').val(res.kode);
            $('#nama').val(res.nama);
            $('#harga').val(res.harga);            
            $('#jenis').val(res.jenis);
        }
    });
}  
 
function deleteFunc(id){
    Swal.fire({
        title: 'Delete Record?',
        text: "Are you sure you want to delete this record?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var id = id;
            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('delete') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    });
}

 
$('#BarangForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "{{ url('store')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            $("#Barang-modal").modal('hide');
            var oTable = $('#ajax-crud-datatable').dataTable();
            oTable.fnDraw(false);
            $("#btn-save").html('Submit');

            Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                });

            $("#btn-save"). attr("disabled", false);
        },
        error: function(data){
            console.log(data);
            Swal.fire({
                    icon: 'error',
                    title: 'Data gagal disimpan,silahkan cek kembali!',
                    showConfirmButton: false,
                    timer: 1500
                });
        }
    });
});
</script>
@endsection