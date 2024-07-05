<!DOCTYPE html>
<html lang="en">
@include('layouts.backend.head')

<body >
  <!-- loader starts-->
  <!-- <div class="loader-wrapper">
      <div class="loader-index"> <span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div> -->
  <!-- loader ends-->
  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    @include('layouts.backend.header')
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <!-- Page Sidebar Start-->
      @include('layouts.backend.sidebaar')
      <!-- Page Sidebar Ends-->
      <div class="page-body">

        @yield('content')
        <!-- Container-fluid Ends-->
      </div>
      <!-- footer start-->
      @include('layouts.backend.footer')
    </div>
  </div>
   <!-- latest jquery-->
    <script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('backend/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('backend/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{asset('backend/assets/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{asset('backend/assets/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('backend/assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('backend/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('backend/assets/js/sidebar-pin.js')}}"></script>
    <script src="{{asset('backend/assets/js/slick/slick.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/slick/slick.js')}}"></script>
    <script src="{{asset('backend/assets/js/header-slick.js')}}"></script>
    
    <script src="{{asset('backend/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
    

    <script src="{{asset('backend/assets/js/datatable/datatable-extension/custom.js')}}"></script>
    <script src="{{asset('backend/assets/js/tooltip-init.js')}}"></script>
    <!-- Plugins JS Ends-->
    <script src="{{asset('backend/assets/js/notify/bootstrap-notify.min.js')}}"></script>
  <script src="{{asset('backend/assets/js/dashboard/default.js')}}"></script>
  <script src="{{asset('backend/assets/js/notify/index.js')}}"></script>
  <script src="{{asset('backend/assets/js/typeahead/handlebars.js')}}"></script>
  <script src="{{asset('backend/assets/js/typeahead/typeahead.bundle.js')}}"></script>
  <script src="{{asset('backend/assets/js/typeahead/typeahead.custom.js')}}"></script>
  <script src="{{asset('backend/assets/js/typeahead-search/handlebars.js')}}"></script>
  <script src="{{asset('backend/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
  <script src="{{asset('backend/assets/js/height-equal.js')}}"></script>
  <script src="{{asset('backend/assets/js/animation/wow/wow.min.js')}}"></script>
  <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('backend/assets/js/script.js')}}"></script>
    <script src="{{asset('backend/assets/js/theme-customizer/customizer.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- <script src="{{asset('backend/assets/js/theme-customizer/customizer.js')}}"></script> -->
  <!-- <script>
    new WOW().init();
  </script> -->
</body>

</html>



<script>
  $(document).ready(function() {
    $('.lang').on('click', function(e) {
      e.preventDefault();
      var currentLang = $(this).data('lang-change');
      var home_url = '{{ route("dashboard"); }}';

      $.ajax({

        url: '{{ route("language.change") }}',
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        data: {
          locale: currentLang
        },

        success: function(response) {
          location.reload(); 
          // window.location.replace(home_url);
        },

        error: function(xhr, status, error) {

          console.error(error);

        }

      });

    });
  });

  function notify(message) {
    $.notify(
      '<i class="fa fa-bell-o"></i> ' + message, {
        type: "theme",
        allow_dismiss: true,
        delay: 2000,
        showProgressbar: true,
        timer: 300,
        animate: {
          enter: "animated fadeInDown",
          exit: "animated fadeOutUp",
        },
      }
    );
  }


  @if(Session::has('login_success'))
  notify("{{ session('login_success') }}");
  @endif

  @if(Session::has('success'))
  notify("{{ session('success') }}");
  @endif

  @if(Session::has('error'))
  notify("{{ session('error') }}");
  @endif



  
  </script>

@yield('script')