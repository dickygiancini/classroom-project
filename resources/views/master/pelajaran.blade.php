@extends('layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Create Class')
@section('content')

@include('layouts.error')

<div class="row mb-2">
    <div class="col d-flex flex-row-reverse">
        <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#tambahKelas"><span class="cil-contrast btn-icon mr-2"></span>Add Pelajaran</button>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        {{ __('List Pelajaran Siswa') }}
    </div>

    <div class="card-body">

        <table class="table" id="list-siswa">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pelajaran</th>
                    <th scope="col">Kode Pelajaran</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Act.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelajaran as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td><button type="button" class="btn btn-sm btn-danger text-white" onclick="deletes({{ $item->id }})">Delete</button></td>
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
          <h5 class="modal-title" id="tambahKelasLabel">Tambah Pelajaran</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.masterpelajaran.create') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama Pelajaran</label>
                  <input type="text" class="form-control" name="nama" aria-describedby="nama" required>
                </div>
                <div class="mb-3">
                  <label for="kode" class="form-label">Kode Pelajaran</label>
                  <input type="text" class="form-control" name="kode" aria-describedby="kode" required onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">
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

    function deletes(id)
    {
        var url = '{{ route("admin.masterpelajaran.delete", ":id") }}';
        url = url.replace(':id', id);

        swal.fire({
            title: 'Yakin untuk menghapus?',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    success: (data) => {
                        swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Berhasil hapus data'
                        }).then((result) => {
                            if(result.isConfirmed)
                            {
                                location.reload()
                            }
                        })
                    }
                })
            }
        })
    }

</script>
