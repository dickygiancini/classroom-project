@extends('layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <th scope="col">Tingkat</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Act.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->namakelas }}</td>
                        <td>{{ $item->kodekelas }}</td>
                        <td>{{ $item->tingkat }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning text-white" onclick="edit({{ $item->id }})">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger text-white" onclick="deletes({{ $item->id }})">Delete</button>
                        </td>
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
                  <input type="text" class="form-control" name="kodekelas" aria-describedby="kodekelas" required onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="tingkat" class="form-label">Tingkat</label>
                  <select name="tingkat" id="tingkat" class="form-select" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
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

<div class="modal fade" id="editKelas" tabindex="-1" aria-labelledby="editKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editKelasLabel">Edit Kelas</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="update-form">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label for="namaKelas" class="form-label">Nama Kelas</label>
                  <input type="text" class="form-control" name="namakelas" id="namakelas_edit" aria-describedby="namakelas" required>
                </div>
                <div class="mb-3">
                  <label for="kodekelas" class="form-label">Kode Kelas</label>
                  <input type="text" class="form-control" name="kodekelas" id="kodekelas_edit" aria-describedby="kodekelas" required onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">
                </div>
                <div class="mb-3">
                  <label for="tingkat" class="form-label">Tingkat</label>
                  <select name="tingkat" id="tingkat_edit" class="form-select" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateId">Update</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

<script type="text/javascript">

    function deletes(id)
    {
        var url = '{{ route("admin.masterkelas.delete", ":id") }}';
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

    function edit(id)
    {
        var url = '{{ route("admin.masterkelas.edit", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            type: 'PUT',
            url: url,
            success: (data) => {
                $("#editKelas").modal('show');

                $('#namakelas_edit').val(data.namakelas)
                $('#kodekelas_edit').val(data.kodekelas)
                $('#tingkat').val(data.tingkat).change()
                $('#updateId').val(data.id)
            }
        })
    }

    // $('#update-form').click((e) => {
    //     e.preventDefault();

    //     $.ajax({
    //         type: 'POST',
    //         url: "{{ route('admin.masterkelas.update') }}",
    //         data: $('#update-form').serialize(),
    //         success: (data) => {
    //             swal.fire({
    //                 icon: 'success',
    //                 title: 'Sukses!',
    //                 text: 'Berhasil update data'
    //             }).then((result) => {
    //                 if(result.isConfirmed)
    //                 {
    //                     location.reload()
    //                 }
    //             })
    //         }
    //     })
    // })

</script>
