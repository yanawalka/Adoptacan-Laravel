<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logomuni.ico')}}">
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/bootstrap/css/bootstrap-select.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('vendor/bootstrap/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- ************************* -->
    <!-- MetisMenu CSS
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">-->

    <!-- DataTables CSS -->
    <link href="{{asset('vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
    <script src="{{asset('pace/pace.js')}}"> </script>
    <link rel="stylesheet" href="{{asset('pace/themes/blue/pace-theme-loading-bar.css')}}">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="">

                </div>
                <ul class="nav navbar-top-links navbar-left">
                  <img src="{{asset('images/logo-saltaciudad.png')}}" alt="" height="600px" width="250px" class="img-thumbnail">
                </ul>

                <a class="navbar-brand" href="{{url('tipopersona/empleado')}}">Sistema Municipal de Seguimiento de Animales</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
              <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>

                  </a>
                  <ul class="dropdown-menu dropdown-user">
                    <li>
                      <a href="{{URL::action('UsersController@show', Auth::user()->id)}}"><i class="fa fa-lock fa-fw"></i> Cambiar contraseña</a>
                    </li>
                      <li>
                        <a href="{{url('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                      </li>
                  </ul>
                  <!-- /.dropdown-user -->
              </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
<br><br><br>
            <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <!--SUB MENU USUARIOS-->
                        @if (Auth::user()->tipo == 'admin')
                            <li onclick="move()">
                                <a href="{{url('admin/users')}}" ><i class="glyphicon glyphicon-user"></i> Usuarios</a>
                            </li>
                        @endif        

                        <li onclick="move()">
                            <a href="{{url('admin/propietarios')}}" ><i class="fa fa-users"></i> Propietarios</a>

                        </li>
                        <!--SUB-MENU EMPLEADOS-->
                        <li onclick="move()">
                            <a href="{{url('admin/perros')}}" ><i class="fa fa-users"></i> Animales en Adopcion</a>

                        </li>
                        <li onclick="move()">
                            <a href="{{url('admin/seguimientos')}}" ><i class="fa fa-users"></i> Seguimiento</a>

                        </li>
                        <li onclick="move()">
                            <a href="{{url('admin/solicitudes')}}" ><i class="fa fa-users"></i> solicitudes</a>

                        </li>
                        <li onclick="move()">
                            <a href="{{url('admin/adopciones')}}" ><i class="fa fa-users"></i> Adopciones</a>

                        </li>                        
                        <!--SUB-MENU RAZAS-->
                        <li onclick="move()">
                            <a href="{{url('admin/razas')}}" ><i class="fa fa-users"></i> Razas</a>

                        </li>
                        <!--SUB-MENU Solicitudes-->


                        <!--SUB-MENU Adopciones-->

                        <!--SUB-MENU Adopciones-->
                       
                        
                        <!--MANUAL DE USUARIO-->
                        <li>
                          <a href="{{url('public/download')}}">
                            <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                            <small class="pull-right"><strong>PDF</strong></small>
                          </a>
                        </li>
                        <!---->
                    </ul>
                    <div class="hidden-xs hidden-sm .hidden-md"> 
                    <ul class="nav navbar-top-links navbar-left">
                      <img src="{{asset('images/mancilla.jpg')}}" alt="" height="600px" width="250px" class="img-thumbnail">
                    </ul>
                    </div>


                </div>
                <!-- /.sidebar-collapse -->
            </div>                
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="panel-heading">
                <h2 >@yield('title') </h2><hr>
            </div>
            <div class="row">

                <!--Contenido -->

                  @yield('content')
                </div>
                    @include('admin.template.partials.footer')  

                <!--Fin Contenido -->
            </div>


        </div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    @stack('scripts')
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap-select.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('data/morris-data.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('plugins/bootstrap/js/sb-admin-2.js')}}"></script>


    <!---***************************************-->
    <!-- DataTables JavaScript -->
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>


</html>
