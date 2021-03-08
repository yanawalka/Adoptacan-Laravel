<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title','Default') | Sistema de Adopciones</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('fotos/logomuni.ico')}}">
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


</head>

<body>
    <div class="container-fluid">
        <div class="card" style="width: 10%;">
          <img src="{{asset('images/logo-saltaciudad.png')}}"class="img-fluid" alt="Responsive image" >
        </div>
    	@include('admin.template.partials.nav')
    	<section class="section-admin">
            <div class="panel panel-default">
                <div >
                    <h3 class="panel-title">@yield('title') </h3>
                </div>
                <div class="panel-body">    
                      @include('flash::message')  
    		          @yield('content')
                </div>
             </div>         
    	</section>

    	@include('admin.template.partials.footer')	
    	<script src="{{asset('plugins/jquery/js/jquery-3.3.1.js')}}" ></script>
    	<script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}" ></script>
    </div>    
</body>

</html>
