@extends('layouts.app')

@section('title', 'Create Class')
@section('content')

@include('layouts.error')

<div class="row mb-2">
    <div class="col d-flex flex-row-reverse">
        <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#tambahKelas"><span class="cil-contrast btn-icon mr-2"></span>Add Class</button>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        {{ __('List Kelas Siswa') }}
    </div>

    <div class="card-body">

        <table class="table" id="list-siswa">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Kode Kelas</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Tanggal Diubah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->namakelas }}</td>
                        <td>{{ $item->kodekelas }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td><button type="button" class="btn btn-sm btn-danger" onclick="test()">Danger</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahKelas" tabindex="-1" aria-labelledby="tambahKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahKelasLabel">Tambah Kelas</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.masterkelas.create') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label for="namaKelas" class="form-label">Nama Kelas</label>
                  <input type="text" class="form-control" name="namakelas" aria-describedby="namakelas" required>
                </div>
                <div class="mb-3">
                  <label for="kodekelas" class="form-label">Kode Kelas</label>
                  <input type="text" class="form-control" name="kodekelas" aria-describedby="kodekelas" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    function test()
    {
        Swal.fire({
            title: 'Yakin untuk menghapus?',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
            if (result.isConfirmed) {

            }
        })
    }
</script>
