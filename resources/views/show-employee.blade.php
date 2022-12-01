@extends('layout.app')

@section('css')
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Show Karyawan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Show Karyawan</li>
    </ol>
</div>
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">{{ $employee->name }}</h5>
              <p class="text-muted mb-1">{{ $employee->position->name }}</p>
              <p class="text-muted mb-4">{{ $employee->departemen }}</p>
              <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-primary">Follow</button>
                <button type="button" class="btn btn-outline-primary ms-1">Message</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Name</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ $employee->name }}</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">NIP</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ $employee->nip }}</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Phone</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ $employee->phone }}</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Tanggal Lahir</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ $employee->tanggal_lahir }}</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Alamat</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ $employee->alamat }}</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Agama</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">{{ $employee->agama }}</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Status</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0">
                        @if ($employee->status == 'active')
                            <span class="badge badge-success">{{ $employee->status }}</span>
                        @else
                        <span class="badge badge-danger">{{ $employee->status }}</span>
                        @endif
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
@endsection

@push('js')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush
