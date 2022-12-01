@extends('layout.app')

@section('css')
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
    </ol>
</div>
@endsection
@section('content')
<div class="card sm mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
        <a href="{{ route('employee.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Create Employee</a>
    </div>
    <div class="card-body">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
              <thead class="thead-light">
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Jabatan</th>
                  <th>Departemen</th>
                  <th>No HP</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $('#dataTable').DataTable({
        processing: true,
        serverside: true,
        ajax: {
            url: "{{ route('employee.index') }}",
            type: 'GET'
        },
        responsive: true,
        columns: [
            {
                data: 'DT_RowIndex',
            },
            {
                data: 'name',
            },
            {
                data: 'jabatan',
            },
            {
                data: 'departemen',
            },
            {
                data: 'phone',
            },
            {
                data: 'status',
            },
            {
                data: 'action',
            },
        ]
    })

    function deleteItem(e) {
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        let baseUrl = "{{ url('/') }}";

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });
        swalWithBootstrapButtons.fire({
            title: 'Yakin menghapus karyawan ?',
            text: "Karyawan akan di hapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya,Hapus',
            cancelButtonText: 'Tidak, Batal!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: `${baseUrl}/employee/${id}`,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": 'DELETE',
                        },
                        success: function(data) {
                            if (data.success) {
                                toastr.success(name + ' berhasil dihapus.')
                                var oTable = $('#dataTable').DataTable(); //inialisasi datatable
                                oTable.ajax.reload();
                            }
                        }

                    });
                }
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal.fire(
                    'Batal',
                    'Data '+name+' tidak dihapus',
                    'error'
                )
            }
        });
    }
</script>
@endpush
