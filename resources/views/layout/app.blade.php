<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('img/logo/logo.png') }}" rel="icon">
  <title>RuangAdmin - Dashboard</title>
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  @yield('css')
</head>

<body id="page-top">
  <div id="wrapper">
    @include('layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        @include('layout.topbar')
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          @yield('breadcrumb')
          @yield('content')
          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---Container Fluid-->
      </div>
      @include('layout.footer')
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/ruang-admin.min.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @stack('js')
  <script type="text/javascript">
    $(document).ready(function() {
        if (sessionStorage.getItem('success')) {
            let data = sessionStorage.getItem('success');
            toastr.success('', data, {
                timeOut: 1500,
                preventDuplicates: true,
                progressBar: true,
                positionClass: 'toast-top-right',
            });
            sessionStorage.clear();
        }
        if (sessionStorage.getItem('error')) {
            let data = sessionStorage.getItem('error');
            toastr.error('', data, {
                timeOut: 1500,
                preventDuplicates: true,
                progressBar: true,
                positionClass: 'toast-top-right',
            });
            sessionStorage.clear();
        }
        
        const error = '{{session('error')}}';
        if (error) {
            toastr.error('', error, {
                timeOut: 1500,
                preventDuplicates: true,
                progressBar: true,
                positionClass: 'toast-top-right',
            });
            sessionStorage.clear();
        }
        const success = '{{session('success')}}';
        if (success) {
            toastr.success('', success, {
                timeOut: 1500,
                preventDuplicates: true,
                progressBar: true,
                positionClass: 'toast-top-right',
            });
            sessionStorage.clear();
        }
    })
</script>
</body>
</html>
