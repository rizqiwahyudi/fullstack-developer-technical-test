@extends('layout.app')

@section('css')
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jabatan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jabatan</li>
    </ol>
</div>
@endsection
@section('content')
<div class="card sm mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
              <thead class="thead-light">
                <tr>
                  <th>No.</th>
                  <th>Name</th>
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
        serverSide: true,
        ajax: "{{ route('position.index') }}",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center"},
            { data: 'name' }
        ]
    })
</script>
@endpush
