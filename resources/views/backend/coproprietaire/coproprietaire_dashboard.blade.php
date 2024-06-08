<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Espace Copropriétaire | DigiSyndic</title>
	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('backend/assets/vendors/core/core.css')}}">
	<!-- endinject -->

<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')}}">
<!-- End plugin css for this page -->


	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{asset('backend/assets/vendors/flatpickr/flatpickr.min.css')}}">
	<!-- End plugin css for this page -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('backend/assets/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->
  <!-- Layout styles -->
	<link rel="stylesheet" href="{{asset('backend/assets/css/demo_1/style.css')}}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.png')}}" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

</head>

<style>

    .dataTables_length {
          float: left;
          margin-bottom: 20px;
        }


    /* Personnaliser l'input de recherche */


    /* Personnaliser la barre de défilement */
    .table-responsive::-webkit-scrollbar {
        height: 8px; /* Hauteur de la barre de défilement */
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1; /* Couleur de l'arrière-plan de la piste de la barre de défilement */
        border-radius: 10px; /* Rayon de la bordure de la piste */
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #007bff; /* Couleur de la barre de défilement */
        border-radius: 10px; /* Rayon de la bordure de la barre de défilement */
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #0056b3; /* Couleur de la barre de défilement au survol */
    }

    .dataTables_filter {
        float: right;
        text-align: right;
    }

    .dataTables_filter input {
        border-radius: 3em;
        padding: 2px 15px;
    }

    /* Personnaliser les boutons de pagination */
    .dataTables_paginate {
        float: right;
        margin-top: 20px;
    }

    .dataTables_paginate .paginate_button {
        color: white !important;
        background-color: #007bff; /* Couleur de fond personnalisée */
        border: none;
        padding: 3px 10px  ;
        border-radius: 5px;
        margin: 0 2px;
    }
    </style>


<body>
	<div class="main-wrapper">

            <!-- partial:partials/_sidebar.html -->
                @include('backend.coproprietaire.sidebar');
            <!-- partial -->

            <div class="page-wrapper">

                <!-- partial:partials/_navbar.html -->
                @include('backend.coproprietaire.header');
                <!-- partial -->

                @yield('coproprietaire');

                <!-- partial:partials/_footer.html -->
                @include('backend.coproprietaire.footer');
                <!-- partial -->

            </div>
        </div>


	<!-- core:js -->
	<script src="{{asset('backend/assets/vendors/core/core.js')}}"></script>
	<!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{asset('backend/assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
  <script src="{{asset('backend/assets/vendors/chartjs/Chart.min.js')}}"></script>
  <script src="{{asset('backend/assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
  <script src="{{asset('backend/assets/vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('backend/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('backend/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="{{asset('backend/assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('backend/assets/js/template.js')}}"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
  <script src="{{asset('backend/assets/js/dashboard.js')}}"></script>
  <script src="{{asset('backend/assets/js/datepicker.js')}}"></script>
	<!-- end custom js for this page -->



  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="{{asset('backend/assets/js/code/code.js')}}"></script>


<!-- Plugin js for this page -->
  <script src="{{asset('backend/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')}}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
<script src="{{asset('backend/assets/js/data-table.js')}}"></script>
<!-- End custom js for this page -->


<script>

  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
     case 'info':
     toastr.info(" {{ Session::get('message') }} ");
     break;

     case 'success':
     toastr.success(" {{ Session::get('message') }} ");
     break;

     case 'warning':
     toastr.warning(" {{ Session::get('message') }} ");
     break;

     case 'error':
     toastr.error(" {{ Session::get('message') }} ");
     break;
  }
  @endif

 </script>


</body>
</html>
