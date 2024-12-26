<!DOCTYPE html>
<html
  lang="en"
  data-layout="vertical"
  data-topbar="light"
  data-sidebar="dark"
  data-sidebar-size="lg">

<head>
  <meta charset="utf-8" />
  <title>Starter | Velzon - Admin & Dashboard Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta
    content="Premium Multipurpose Admin & Dashboard Template"
    name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

  <!-- Layout config Js -->
  <script src="{{ asset('assets/js/layout.js') }}"></script>
  <!-- Bootstrap Css -->
  <link
    href="{{ asset('assets/css/bootstrap.min.css') }}"
    rel="stylesheet"
    type="text/css" />
  <!-- Filepond css -->
  <link rel="stylesheet" href="{{ asset('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
  <!-- Icons Css -->
  <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- custom Css-->
  <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
  <!-- Begin page -->
  <div id="layout-wrapper">
    <x-header></x-header>
    <!-- ========== App Menu ========== -->
    <x-navbar></x-navbar>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">
          {{ $slot }}
        </div>
        <!-- container-fluid -->
      </div>
      <!-- End Page-content -->

      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <script>
                document.write(new Date().getFullYear());
              </script>
              © Velzon.
            </div>
            <div class="col-sm-6">
              <div class="text-sm-end d-none d-sm-block">
                Design & Develop by Themesbrand
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- end main content-->
  </div>
  <!-- END layout-wrapper -->

  <!--start back-to-top-->
  <button
    onclick="topFunction()"
    class="btn btn-danger btn-icon"
    id="back-to-top">
    <i class="ri-arrow-up-line"></i>
  </button>
  <!--end back-to-top-->
  <!-- JAVASCRIPT -->
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
  <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
  <script src="{{ asset('assets/js/plugins.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


  <!-- App js -->
  <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>