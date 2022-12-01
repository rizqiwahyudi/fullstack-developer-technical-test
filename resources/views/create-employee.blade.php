@extends('layout.app')

@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <style>
        .img{
            width: 199px;
            height: auto;
            position: relative;
        }

        #close_preview {
            border-radius: 50%;
            position: absolute;
            transform: translate(50%, -45%);
            right:0;
            top: 0;
        }

        span.ui-datepicker-year {
            display: none;
        }
    </style>
@endsection
@section('breadcrumb')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Karyawan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Karyawan</li>
    </ol>
</div>
@endsection
@section('content')
<div class="card sm mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" id="form_employee">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name"
                        placeholder="Name">
                    <span class="text-danger" id="name-error"></span>
                </div>
                <div class="col">
                    <label for="nip">NIP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nip" id="nip"
                        placeholder="NIP">
                    <span class="text-danger" id="nip-error"></span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                        placeholder="Tanggal Lahir">
                    <span class="text-danger" id="tanggal_lahir-error"></span>
                </div>
                <div class="col">
                    <label for="tahun_lahir">Tahun Lahir <span class="text-danger">*</span></label>
                    <select name="tahun_lahir" id="tahun_lahir" class="form-control">
                        <option value="">-- Select Tahun Lahir --</option>
                        @php($years = range(1900, strftime("%Y", time())))
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger" id="tahun_lahir-error"></span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="departemen">Departemen <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="departemen" id="departemen"
                        placeholder="Departemen">
                    <span class="text-danger" id="departemen-error"></span>
                </div>
                <div class="col">
                    <label for="position">Jabatan <span class="text-danger">*</span></label>
                    <select name="position" id="position" class="form-control">
                        <option value="">-- Select Position --</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger" id="position-error"></span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="phone">No HP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" id="phone"
                        placeholder="No HP">
                    <span class="text-danger" id="phone-error"></span>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <label>Agama <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="islam" value="islam" name="agama">
                        <label for="islam" class="form-check-label">Islam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="kristen_protestan" value="kristen protestan" name="agama">
                        <label for="kristen_protestan" class="form-check-label">Kristen Protestan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="katolik" value="katolik" name="agama">
                        <label for="katolik" class="form-check-label">Katolik</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="hindu" value="hindu" name="agama">
                        <label for="hindu" class="form-check-label">Hindu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="budha" value="budha" name="agama">
                        <label for="budha" class="form-check-label">Budha</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="konghucu" value="konghucu" name="agama">
                        <label for="konghucu" class="form-check-label">Konghucu</label>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <span class="text-danger" id="agama-error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Alamat"></textarea>
                    <span class="text-danger" id="alamat-error"></span>
                </div>
                <div class="col">
                    <label for="ktp">Foto KTP <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="ktp" id="ktp"
                        placeholder="Foto KTP">
                    <br>
                    <div class="img">
                        <a class="btn btn-danger btn-sm" id="close_preview"><i class="fas fa-times text-white"></i></a>
                        <img id="image-preview" style="width: 200px;" alt="image preview"/>
                    </div>
                    <span class="text-danger" id="ktp-error"></span>
                </div>
            </div>
            <div class="row mb-3 mt-5">
                <div class="col-lg-12 offset-lg-5">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                        <label class="custom-control-label" for="status">Is Active ?</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js" 
    integrity="sha512-KaIyHb30iXTXfGyI9cyKFUIRSSuekJt6/vqXtyQKhQP6ozZEGY8nOtRS6fExqE4+RbYHus2yGyYg1BrqxzV6YA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/addons/cleave-phone.id.js" 
    integrity="sha512-U479UBH9kysrsCeM3Jz6aTMcWIPVpmIuyqbd+KmDGn6UJziQQ+PB684TjyFxaXiOLRKFO9HPVYYeEmtVi/UJIw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        let phone_number = new Cleave('#phone', {
            phone: true,
            phoneRegionCode: 'ID'
        });

        $('#tanggal_lahir').datepicker({
            dateFormat: "m-d",
            changeMonth: true,
            changeYear: false
        });

        if ($('#ktp').prop('files').length == 0) {
            $('#image-preview').hide();
            $('#close_preview').hide();
        }

        $('#close_preview').click(function() {
            $('#ktp').val('');
            $('#image-preview').attr("src", "");
            $('#close_preview').hide();
            $('#image-preview').hide();
        });

        $('#ktp').change(function() {
            if ($('#ktp').prop('files').length !== 0) {
                let oFReader = new FileReader();
                oFReader.readAsDataURL($('#ktp').prop('files')[0]);
                
                oFReader.onload = function(oFREvent) {
                    $('#image-preview').show();
                    $('#close_preview').show();
                    $('#image-preview').attr("src", oFREvent.target.result);
                }
            }else{
                $('#image-preview').hide();
                $('#close_preview').hide();
            }
        });

        $('#form_employee').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            
            $('#name-error').text('');
            $('#nip-error').text('');
            $('#tanggal_lahir-error').text('');
            $('#tahun_lahir-error').text('');
            $('#departemen-error').text('');
            $('#position-error').text('');
            $('#phone-error').text('');
            $('#agama-error').text('');
            $('#alamat-error').text('');
            $('#ktp-error').text('');

            $.ajax({
                url: "{{ route('employee.store') }}",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        window.location.href = "{{ route('employee.index') }}";
                        sessionStorage.setItem('success', response.message);
                    } else {
                        toastr.error('error', response.message);
                    }
                },
                error: function(response) {
                    $('#name-error').text(response.responseJSON.errors
                        .name);
                    $('#nip-error').text(response.responseJSON.errors
                        .nip);
                    $('#tanggal_lahir-error').text(response.responseJSON.errors
                        .tanggal_lahir);
                    $('#tahun_lahir-error').text(response.responseJSON.errors
                        .tahun_lahir);
                    $('#departemen-error').text(response.responseJSON.errors
                        .departemen);
                    $('#position-error').text(response.responseJSON.errors
                        .position);
                    $('#phone-error').text(response.responseJSON.errors
                        .phone);
                    $('#agama-error').text(response.responseJSON.errors
                        .agama);
                    $('#alamat-error').text(response.responseJSON.errors
                        .alamat);
                    $('#ktp-error').text(response.responseJSON.errors
                        .ktp);
                }
            });
        });
    });
</script>
@endpush
