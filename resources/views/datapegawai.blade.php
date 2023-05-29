<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Toastr CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet"/> -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <title>CRUD Laravel 8</title>
  </head>
  <body>
    <h1 class="text-center mb-4">Data Pegawai</h1>
        <div class="container">
            <div class="row g-3 align-items-center mb-3 mt-2">
              <div class="col-auto">
                <form action="/pegawai" method="GET">
               <input type="search" name="search" class="form-control" id="inputPassword2" placeholder="Cari data">
                </form>
              </div>
              <div class="col-auto">
                <a href="/tambahpegawai" type="button" class="btn btn-success">Tambah data</a>
              </div>
              <div class="col-auto">
                <a href="/exportpdf" type="button" class="btn btn-primary">Export PDF</a>
              </div>
              <div class="col-auto">
                <a href="/exportexcel" type="button" class="btn btn-secondary">Export Excel</a>
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Import Excel
                </button>
              </div>
            </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih file yang akan diimport (.xlsx)</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/importexcel" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="file" name="file" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

            <div class="row">
              <!-- @if ($message = Session::get('success'))
              <div class="alert alert-success" role="alert">
                {{ $message }}
              </div>
              @endif -->
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No Telpon</th>
                        <th scope="col">Dibuat</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    <tbody>
                        @foreach ($data as $index => $row)
                        {{-- @foreach ($data as $row) --}}
                        <tr>
                            <th scope="row">{{ $index + $data->firstItem() }}</th>
                            {{-- <th scope="row">{{ $no++ }}</th> --}}
                            <td>
                                <img src="{{ asset('fotopegawai/'.$row->foto) }}" alt="" style="width: 40px;">
                            </td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->jeniskelamin }}</td>
                            <td>0{{ $row->notelpon }}</td>
                            <td>0{{ $row->created_at->diffforhumans() }}</td>
                            {{-- format('D M Y') --}}
                            <td>
                                <a href="/ubahdata/{{ $row->id }}" class="btn btn-warning">Ubah</a>
                                <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Hapus</a>
                                {{-- <!-- /hapusdata/{{ $row->id }} --> --}}
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $data->links() }}
            </div>
        </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->

    <!-- Plugin yang diperlukan-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script> -->
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Toastr -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    
<script>
$('.delete').click( function(){
  var id_pegawai = $(this).attr('data-id');
  var nama_pegawai = $(this).attr('data-nama');
Swal.fire({
title: 'Apakah kamu yakin?',
text: "Kamu akan menghapus data pegawai: "+nama_pegawai+"",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
window.location = "/hapusdata/"+id_pegawai+""
  Swal.fire(
'Deleted!',
'Your file has been deleted.',
'success'
)}
})   
});
</script>
   
<script>
@if(Session::has('success'))
toastr.success('{{ Session::get('success') }}')
@endif

</script>

  </body>
</html>