
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
                    <h6 class="m-0 font-weight-bold"  style="color: #192446;">Data Master Customer</h6>
                </div>
                <div class="card-body">
      <div class="row">
      <p>
      <div class="pull-right mb-2">
                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </p>


        <div class="col-sm-12">
        <table class="table table-hover table-bordered" id="ajax-crud-customer" style="width: 100%;
       overflow-x: auto;">
            <thead>
              <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Telepon</th>
                <th scope="col">Alamat</th>
                <th scope="col">Goldar</th>
                <th scope="col">Nik</th>
                <th scope="col">Tgl Lahir</th>
                <th scope="col">Jenis Kelamin</th> 
                <th scope="col">Actions</th>
              </tr>
            </thead>
            
          </table>
        </div>
      </div>

    <div class="modal fade" id="Customer-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Master Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="CustomerForm" name="CustomerForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Enter Kode" maxlength="50" required="">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name" maxlength="50" required="true">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Telepon</label>
                            <div class="col-sm-12">
                            <input type="number" class="form-control" id="telepon" maxlength="14" name="telepon" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-12">
                           <textarea name="alamat" id="alamat" required="true" placeholder="Enter Alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Goldar</label>
                            <div class="col-sm-12">
                            <select name="goldar" id="goldar" class="form-control">
                              <option value="O">O</option>
                              <option value="A">A</option>
                              <option value="AB">AB</option>
                              <option value="B">B</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">NIK</label>
                            <div class="col-sm-12">
                            <input type="number" class="form-control" id="nik" maxlength="16" name="nik" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Tgl Lahir</label>
                            <div class="col-sm-12">
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-12">
                            <select name="jk" id="jk" class="form-control">
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                          </select>
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
 
    $('#ajax-crud-customer').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        rowReorder: {
        selector: 'td:nth-child(2)'
    },
        ajax: "{{ url('ajax-crud-customer') }}",
        columns: [
            { data: 'kode', name: 'kode' },
            { data: 'nama', name: 'nama' },
            { data: 'telepon', name: 'telepon' },
            { data: 'alamat', name: 'alamat' },
            { data: 'goldar', name: 'goldar' },
            { data: 'nik', name: 'nik' },
            { data: 'tgl_lahir', name: 'tgl_lahir' },
            { data: 'jk', name: 'jk' },
            { data: 'action', name: 'action', orderable: false},
        ],
        order: [[0, 'desc']]
    });
});
 
function add(){
    $('#CustomerForm').trigger("reset");
    $('#CustomerModal').html("Add Customer");
    $('#Customer-modal').modal('show');
    $('#id').val('');
}   
     
function editFunc(id){
    $.ajax({
        type:"POST",
        url: "{{ url('edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#CustomerModal').html("Edit Customer");
            $('#Customer-modal').modal('show');
            $('#id').val(res.id);
            $('#kode').val(res.kode);
            $('#nama').val(res.nama);
            $('#telepon').val(res.telepon);            
            $('#alamat').val(res.alamat);
            $('#goldar').val(res.goldar);
            $('#nik').val(res.nik);
            $('#tgl_lahir').val(res.tgl_lahir);
            $('#jk').val(res.jk);
            
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
                    var oTable = $('#ajax-crud-customer').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    });
}
 
$('#CustomerForm').submit(function(e) {
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
            $("#Customer-modal").modal('hide');
            var oTable = $('#ajax-crud-customer').dataTable();
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