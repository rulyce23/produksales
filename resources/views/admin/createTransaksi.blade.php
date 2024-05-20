<!-- resources/views/sales/create.blade.php -->
@extends('auth.adminlayouts')

@section('main-content')
<div class="container">
    <h2>Form Transaksi Penjualan</h2>
    <form id="salesForm" method="post" action="{{ route('store') }}">
        @csrf
        <div class="form-group">
            <label for="kode">No Transaksi:</label>
            <input type="text" class="form-control" id="kode" name="kode" placeholder="(autogenerate)" readonly>
        </div>
        <div class="form-group">
            <label for="tgl">Tanggal:</label>
            <input type="date" class="form-control" id="tgl" name="tgl">
        </div>
        <div class="form-group">
            <label for="kode">Kode Customer:</label>
            <input type="text" class="form-control" id="kode_customer" name="kode" readonly> 
            <br>
            <div class="input-group-btn">
            <button data-toggle="modal" data-target="#modal_akun" type="button" class="btn btn-primary" title="Tampilkan data"><i class="fas fa-folder-open-o"></i>tampilkan
           </div>
           <br>
           <br>
        <div class="form-group">
            <label for="nama">Nama Customer:</label>
            <input type="hidden" class="form-control" id="id_cust" name="id_cust" readonly>
            <input type="text" class="form-control" id="nama" name="nama" readonly>
        </div>
        <div class="form-group">
            <label for="telepon">Telepon:</label>
            <input type="text" class="form-control" id="telepon" name="telepon" readonly> 
        </div>
        <br>
           <br>
        <div class="modal fade" id="modal_akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Cari Akun</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
                <table id="xakun" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($akun as $d1)
                        <tr>
                            <td>{{ $d1->kode }}</td>
                            <td>{{ $d1->nik }}</td>
                            <td>{{ $d1->nama }}</td>
                            <td>{{ $d1->alamat }}</td>
                            <td>
                                <button class="btn btn-success btn-xs" onclick="pilih_akun('{{ $d1->kode }}','{{ $d1->id }}','{{ $d1->nama }}','{{ $d1->telepon }}')" data-dismiss="modal">PILIH</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="input-group-btn">
    <button data-toggle="modal" data-target="#modal_barang" type="button" class="btn btn-primary" title="Tampilkan data"><i class="fas fa-folder-open-o"></i>Tambah
</div>

<div class="modal fade" id="modal_barang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Cari Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
                <table id="xakun" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jenis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barang as $d2)
                        <tr>
                            <td>{{ $d2->kode }}</td>
                            <td>{{ $d2->nama }}</td>
                            <td>{{ $d2->harga }}</td>
                            <td>{{ $d2->jenis }}</td>
                            <td>
                                <button class="btn btn-success btn-xs" onclick="pilih_barang('{{ $d2->id }}','{{ $d2->kode }}','{{ $d2->nama }}')" data-dismiss="modal">PILIH</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br><br>
<!-- <table id="tabelInput" class="table table-striped">
    <thead>
        <tr>
            <th colspan="2">Kode Barang</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Harga Bandrol</th>
            <th colspan="2">Diskon</th>
            <th>Harga Diskon</th>
            <th>Total</th>
            <th colspan="2">Action</th>
        </tr>
        <tr>
            <th colspan="5"></th>
            <th>%</th>
            <th>(Rp)</th>
            <th colspan="5"></th>
        </tr>
    </thead>
    <tbody>
        <tr class="firstRow">
            <td><input type="hidden" id="id_barang" name="id_barang[]" style="width:100px;"></td>
            <td><input type="text" id="kode_barang" name="kode[]" style="width:100px;"></td>
            <td><input type="text" id="nama_barang" name="nama[]" style="width:120px;"></td>
            <td><input type="text" id="qty" name="qty[]" placeholder="2" required style="width:50px;"></td>
            <td><input type="text" id="harga_bandrol" name="harga_bandrol[]" placeholder="5000" required style="width:115px;"></td>
            <td>
                <input type="text" name="diskon_pct[]" placeholder="5" style="width:50px;">
            </td>
            <td>
                <input type="text" name="diskon_nilai[]" placeholder="5000" style="width:95px;">
            </td>
            <td>
                <input type="text" name="harga_diskon[]" style="width:120px;">
            </td>
            <td>
                <input type="text" name="total[]" style="width:95px;">
            </td>
            <td><button type="button" class="btn btn-danger updateRow" data-toggle="modal" data-target="#modal_barang" data-id="{{ $d2->id }}">Ubah</button></td>
            <td><button type="button" class="btn btn-danger deleteRow">Hapus</button></td>
        </tr>
    </tbody>
</table> -->
<table id="tabelInput" class="table table-striped">
<thead>
    <tr>
        <th colspan="2">Kode Barang</th>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Harga Bandrol</th>
        <th colspan="2">Diskon</th>
        <th>Harga Diskon</th>
        <th>Total</th>
        <th colspan="2">Action</th>
    </tr>
    <tr>
        <th colspan="5"></th>
        <th>%</th>
        <th>(Rp)</th>
        <th colspan="5"></th>
    </tr>
</thead>

<?php
// Lakukan koneksi ke database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_produksales";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel yang diinginkan dengan melakukan join
$sql = "SELECT tsd.*, mb.kode AS kode_barang, mb.nama AS nama_barang, mc.kode AS kode_customer
        FROM t_sales_detail tsd
        JOIN t_sales ts ON tsd.id_sales = ts.id
        JOIN m_barang mb ON tsd.id_barang = mb.id
        JOIN m_customer mc ON ts.id_cust = mc.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output data dari setiap baris
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td><input type='hidden' name='id_barang[]' value='" . $row["id_barang"] . "' style='width:100px;'></td>";
    echo "<td><input type='text' name='kode[]' value='" . $row["kode_barang"] . "' style='width:100px;'></td>";
    echo "<td><input type='text' name='nama[]' value='" . $row["nama_barang"] . "' style='width:120px;'></td>";
    echo "<td><input type='text' name='qty[]' value='" . $row["qty"] . "' style='width:50px;' placeholder='2' required></td>";
    echo "<td><input type='text' name='harga_bandrol[]' value='" . $row["harga_bandrol"] . "' style='width:115px;' placeholder='5000' required></td>";
    echo "<td><input type='text' name='diskon_pct[]' value='" . $row["diskon_pct"] . "' style='width:50px;' placeholder='%'></td>";
    echo "<td><input type='text' name='diskon_nilai[]' value='" . $row["diskon_nilai"] . "' style='width:95px;' placeholder='(Rp)'></td>";
    echo "<td><input type='text' name='harga_diskon[]' value='" . $row["harga_diskon"] . "' style='width:120px;'></td>";
    echo "<td><input type='text' name='total[]' value='" . $row["total"] . "' style='width:95px;'></td>";
    echo "<td><button type='button' class='btn btn-danger updateRow' data-toggle='modal' data-target='#modal_barang' data-id='" . $row["id_barang"] . "'>Ubah</button></td>";
    echo "<td><button type='button' class='btn btn-danger deleteRow'>Hapus</button></td>";
    echo "</tr>";
  }
} else {
  echo "0 hasil";
}
$conn->close();
?>
</table>
<div class="modal fade" id="modal_barang_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Cari Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
                <table id="xakun" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jenis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barang as $d2)
                        <tr>
                            <td>{{ $d2->kode }}</td>
                            <td>{{ $d2->nama }}</td>
                            <td>{{ $d2->harga }}</td>
                            <td>{{ $d2->jenis }}</td>
                            <td>
                                <button class="btn btn-success btn-xs" onclick="pilih_barang2('{{ $d2->id }}','{{ $d2->kode }}','{{ $d2->nama }}')" data-dismiss="modal">PILIH</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        <div class="form-group">
            <label for="subtotal">Sub Total:</label>
            <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
        </div>
        <div class="form-group">
            <label for="diskon">Diskon:</label>
            <input type="number" class="form-control" id="diskon" name="diskon">
        </div>
        <div class="form-group">
            <label for="ongkir">Ongkir:</label>
            <input type="number" class="form-control" id="ongkir" name="ongkir">
        </div>
        <div class="form-group">
            <label for="total_bayar">Total Bayar:</label>
            <input type="number" class="form-control" id="total_bayar" name="total_bayar" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-secondary">Batal</button>
    </form>
</div>

<script>

function simpanPerubahan() {
        // Ambil data dari form edit
        var id_barang = $("#id_barang_edit").val();
        var qty = $("#qty_edit").val();
        var harga_bandrol = $("#harga_bandrol_edit").val();
        var diskon_pct = $("#diskon_pct_edit").val();
        var diskon_nilai = $("#diskon_nilai_edit").val();

        // Update nilai input pada tabelInput
        var tr = $('#tabelInput tbody tr').find('input[name^="id_barang"][value="' + id_barang + '"]').closest('tr');
        tr.find('input[name^="qty"]').val(qty);
        tr.find('input[name^="harga_bandrol"]').val(harga_bandrol);
        tr.find('input[name^="diskon_pct"]').val(diskon_pct);
        tr.find('input[name^="diskon_nilai"]').val(diskon_nilai);

        // Hitung ulang subtotal
        hitungSubtotal();
        
        // Sembunyikan modal
        $('#modal_barang_edit').modal('hide');
    }

    function pilih_barang2(id, kode, nama) {
    // Dapatkan baris yang sedang diubah
    var tr = $('#tabelInput tbody').find('input[name^="id_barang"][value="' + id + '"]').closest('tr');

    // Update nilai-nilai pada baris yang dipilih
    tr.find('input[name^="kode"]').val(kode);
    tr.find('input[name^="nama"]').val(nama);

    // Sembunyikan modal
    $('#modal_barang_edit').modal('hide');
}

    function pilih_barang(id, kode, nama) {
        $("#id_barang").val(id);
        $("#kode_barang").val(kode);
        $("#nama_barang").val(nama);
              // Menambahkan baris baru pada tabelInput
        var rowCount = $('#tabelInput tbody tr').length + 1;
        var newRow = `
            <tr>
               
                <td><input type="hidden" name="id_barang[]" value="${id}" readonly style="width:100px;"></td>
                <td><input type="text" name="kode[]" value="${kode}" readonly style="width:100px;"></td>
                <td><input type="text" name="nama[]" value="${nama}" readonly style="width:120px;"></td>
                <td><input type="text" name="qty[]" placeholder="2" required style="width:50px;"></td>
                <td><input type="text" name="harga_bandrol[]" required style="width:115px;"></td>
                <td><input type="text" name="diskon_pct[]" style="width:50px;" placeholder="5"></td>
                <td><input type="text" name="diskon_nilai[]" style="width:95px;" placeholder="5000"></td>
                <td><input type="text" name="harga_diskon[]" style="width:120px;"></td>
                <td><input type="text" name="total[]" style="width:95px;"></td>
                <td><button type="button" class="btn btn-danger updateRow">Ubah</button></td>
                <td><button type="button" class="btn btn-danger deleteRow">Hapus</button></td>
            </tr>
        `;
        $('#tabelInput tbody').append(newRow);
    }

    $('.addField').click(function(){
        var rowCount = $('#tabelInput tbody tr').length + 1;
        $('#tabelInput tbody').append(`
            <tr>
                <td><input type="hidden" name="id_barang[]"></td>
                <td><input type="text" name="kode[]"></td>
                <td><input type="text" name="nama[]"></td>
                <td><input type="text" name="qty[]" required></td>
                <td><input type="text" name="harga_bandrol[]" required></td>
                <td><input type="text" name="diskon_pct[]" placeholder="%" class="w-100"></td>
                <td><input type="text" name="diskon_nilai[]" placeholder="(Rp)" class="w-100"></td>
                <td><input type="text" name="harga_diskon[]" placeholder="Harga Diskon" class="w-100"></td>
                <td><input type="text" name="total[]" placeholder="Total" class="w-100"></td>
                <td><button type="button" class="btn btn-danger updateRow">Ubah</button></td>
                <td><button type="button" class="btn btn-danger deleteRow">Hapus</button></td>
            </tr>
        `);
    });

    $(document).on('click', '.deleteRow', function(){
    var row = $(this).closest('tr');
    
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus saja!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            row.remove();
            // Di sini Anda bisa menambahkan logika untuk mengirim permintaan penghapusan data ke server menggunakan Ajax.
            // Jika menggunakan Ajax, pastikan untuk menangani penghapusan data di sisi server juga.
            Swal.fire(
                'Terhapus!',
                'Data telah dihapus.',
                'success'
            );
        }
    });
});

    $(document).on('click', '.updateRow', function(){
        // Dapatkan baris yang ingin diubah
        var tr = $(this).closest('tr');
        
        // Isi nilai input dengan data yang ingin diubah
        var id_barang = tr.find('input[name^="id_barang"]').val();
        var kode = tr.find('input[name^="kode"]').val();
        var nama = tr.find('input[name^="nama"]').val();
        var qty = tr.find('input[name^="qty"]').val();
        var harga_bandrol = tr.find('input[name^="harga_bandrol"]').val();
        var diskon_pct = tr.find('input[name^="diskon_pct"]').val();
        var diskon_nilai = tr.find('input[name^="diskon_nilai"]').val();

        // Isi kembali modal dengan data yang ingin diubah
        $("#id_barang_edit").val(id_barang);
        $("#kode_barang_edit").val(kode);
        $("#nama_barang_edit").val(nama);
        $("#qty_edit").val(qty);
        $("#harga_bandrol_edit").val(harga_bandrol);
        $("#diskon_pct_edit").val(diskon_pct);
        $("#diskon_nilai_edit").val(diskon_nilai);
        
        // Tampilkan kembali modal
        $('#modal_barang_edit').modal('show');
    });

    
    // Fungsi untuk menghitung diskon nilai
    $(document).on('input', 'input[name^="diskon_pct"], input[name^="harga_bandrol"], input[name^="diskon_nilai"]', function() {
        var tr = $(this).closest('tr');
        var harga_bandrol = parseFloat(tr.find('input[name^="harga_bandrol"]').val()) || 0;
        var diskon_pct = parseFloat(tr.find('input[name^="diskon_pct"]').val()) || 0;
        var diskon_nilai = parseFloat(tr.find('input[name^="diskon_nilai"]').val()) || 0;

        // Menghitung diskon nilai dan menampilkan hasilnya
        var diskon = (harga_bandrol * diskon_pct) / 100;
        tr.find('input[name^="diskon_nilai"]').val(diskon);

        // Menghitung harga diskon dan menampilkan hasilnya
        var harga_diskon = harga_bandrol - diskon - diskon_nilai;
        tr.find('input[name^="harga_diskon"]').val(harga_diskon);

        // Menghitung total dan menampilkan hasilnya
        var qty = parseFloat(tr.find('input[name^="qty"]').val()) || 0;
        var total = harga_diskon * qty;
        tr.find('input[name^="total"]').val(total);

        hitungSubtotal();
    });

    function hitungSubtotal() {
        var subtotal = 0;
        $('#tabelInput tbody tr').each(function() {
            var total = parseFloat($(this).find('input[name^="total"]').val()) || 0;
            subtotal += total;
        });
        $('#subtotal').val(subtotal);
    }
    
    function hitungTotalBayar() {
        var subtotal = parseFloat($('#subtotal').val()) || 0;
        var diskon = parseFloat($('#diskon').val()) || 0;
        var ongkir = parseFloat($('#ongkir').val()) || 0;

        var totalBayar = subtotal - diskon - ongkir;
        $('#total_bayar').val(totalBayar);
    }

    // Panggil fungsi hitungTotalBayar saat ada perubahan pada subtotal, diskon, atau ongkir
    $(document).on('input', '#subtotal, #diskon, #ongkir', function() {
        hitungTotalBayar();
    });


    function simpanData() {
        // Ambil data dari form
        var formData = $('#salesForm').serializeArray();
        // Kirim data ke server
        $.ajax({
            url: "{{ route('store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                // Jika penyimpanan berhasil, lakukan sesuatu (misalnya, tampilkan pesan sukses)
                console.log("Data berhasil disimpan:", response);
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            error: function(xhr, status, error) {
                // Jika terjadi kesalahan, tampilkan pesan error
                console.error("Terjadi kesalahan:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Data gagal disimpan. silahkan cek kembali!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    function pilih_akun(kode,id,nama,telepon){
    $("#kode_customer").val(kode);
    $("#id_cust").val(id);
    $("#nama").val(nama);
    $("#telepon").val(telepon);
  }

    // Panggil fungsi simpanData saat form disubmit
    $('#salesForm').submit(function(e) {
        e.preventDefault(); // Mencegah form untuk melakukan submit standar
        simpanData(); // Panggil fungsi simpanData untuk menyimpan data
    });
</script>



@endsection


