@extends('admin')


@section('title','ADOPCIONES REALIZADAS')


@section('content')




    
<?php
    $adopcion = $adopciones->id;
    $logo1="../public/images/mancilla.jpg" ;
    $logo2="../public/images/modernizacion.jpg" ; 
    //require('../public/vendor/fpdf181/fpdf.php');
  $pdf = new Fpdf();
  $pdf::AddPage();
  $pdf::SetFont('Arial','',18);
  $pdf::Image($logo2 , 5 ,5, 90 , 18,'JPG', 'http://servicios.municipalidadsalta.gob.ar');
  $pdf::Cell(0,35,"CERTIFICADO DE ADOPCION",0,"","L");
  $pdf::SetFont('Arial','',11);
  $pdf::Text(5, 35, 'Emision:'.date("d/m/Y") );
  $pdf::Line(0, 38, 210, 38);
  $pdf::Ln();
  $pdf::Ln();
  
  $pdf::Text(5, 45, 'SOLICITUD:');
  $pdf::SetFont('Arial','',11);

  if ($solicitud == null){
    $pdf::Text(50, 45, '---'); 
  } else 
    {$pdf::Text(50, 45, $solicitud->id); }


  $pdf::Text(5, 50, 'APELLIDO:');
  $pdf::Text(50, 50, $personas->apellido); 
  $pdf::Text(5, 55, 'NOMBRES:');
  $pdf::Text(50, 55, $personas->nombres); 
  $pdf::Text(5, 62, 'DNI:');
  $pdf::Text(50, 62, '..........................'); 
  $pdf::Text(5, 67, 'EMAIL:');
  $pdf::Text(50, 67, $personas->email); 
  $pdf::Text(5, 72, 'TELEFONO:');
  $pdf::Text(50, 72, $personas->celular); 
  $pdf::Text(5, 79, 'DOMICILIO:');
  $pdf::Text(50, 79, '......................................................'); 
  $pdf::Line(0, 80, 210, 80);
  $pdf::SetFont('Arial','',18);
  $pdf::Text(10,90,"DATOS DEL CAN");
  $pdf::SetFont('Arial','',11);
  $pdf::Text(5, 100, 'IDENTIFICACION:');
  $pdf::Text(50, 100, $perro->chip); 
  $pdf::Text(5, 105, 'RAZA:');
  $pdf::Text(50, 105, $raza->nombre); 
  $pdf::Text(5, 110, 'FECHA NAC APROX.:');
  $pdf::Text(50, 110, date("m/Y",strtotime($perro->fechanac))); 

  $pdf::Text(5, 115, 'PORTE:');
  if ($perro->porte == 'P') {
    $pdf::Text(50, 115, 'PEQUEÑO');   
  } elseif ($perro->porte == 'M'){
     $pdf::Text(50, 115, 'MEDIANO');   
  } elseif ($perro->porte == 'G'){
     $pdf::Text(50, 115, 'GRANDE');   
  } elseif ($perro->porte == 'GI'){
     $pdf::Text(50, 115, 'GIGANTE');   
  } else {
     $pdf::Text(50, 115, 'INDETERMINADO');   
  }
  

  $pdf::Text(5, 120, 'APTO CHICOS:');
  if ($perro->ninios == '1') {
    $pdf::Text(50, 120, 'SI');   
  } elseif ($perro->ninios == '0'){
     $pdf::Text(50, 120, 'NO');   
  } else {
     $pdf::Text(50, 120, 'INDETERMINADO');   
  }


  $pdf::Text(5, 125, 'ACTIVIDAD:');
  if ($perro->actividad == 'A') {
    $pdf::Text(50, 125, 'ALTA');   
  } elseif ($perro->actividad == 'B'){
     $pdf::Text(50, 125, 'BAJA');   
  } elseif ($perro->actividad == 'M'){
     $pdf::Text(50, 125, 'MEDIA');}   
  else {
     $pdf::Text(50, 125, 'INDETERMINADO');   
  }

  $pdf::Text(5, 130, 'GUARDIAN:');
  if ($perro->guardian == 'S') {
    $pdf::Text(50, 130, 'SI');   
  } elseif ($perro->guardian == 'N'){
     $pdf::Text(50, 130, 'NO');   
  } 
  else {
     $pdf::Text(50, 130, 'INDETERMINADO');   
  }


  $pdf::Text(5, 135, 'SEXO:');
  if ($perro->sexo == 'M') {
    $pdf::Text(50, 135, 'MACHO');   
  } elseif ($perro->guardian == 'F'){
     $pdf::Text(50, 135, 'FEMENINO');   
  } 

  $pdf::Text(5, 140, 'APTO DPTO:');
  if ($perro->dpto == 'S') {
    $pdf::Text(50, 140, 'SI');   
  } elseif ($perro->dpto == 'N'){
     $pdf::Text(50, 140, 'NO');   
  } 
  else {
     $pdf::Text(50, 140, 'INDETERMINADO');   
  }

  $pdf::Text(5, 145, 'TOLERA PERROS:');
  if ($perro->otrosperros == 'S') {
    $pdf::Text(50, 145, 'SI');   
  } elseif ($perro->otrosperros == 'N'){
     $pdf::Text(50, 145, 'NO');   
  } 
  else {
     $pdf::Text(50, 145, 'INDETERMINADO');   
  }

  $pdf::Text(5, 150, 'TOLERA GATOS:');
  if ($perro->gatos == 'S') {
    $pdf::Text(50, 150, 'SI');   
  } elseif ($perro->gatos == 'N'){
     $pdf::Text(50, 150, 'NO');   
  } 
  else {
     $pdf::Text(50, 150, 'INDETERMINADO');   
  }


  $pdf::Text(5, 155, 'APODO:');
  $pdf::Text(50, 155, $perro->apodo);   


  if (strlen($perro->foto)>0) {

    if (file_exists('../public/images/canes/'.$perro->foto )) {
        $pdf::Image('../public/images/canes/'.$perro->foto , 5 ,160, 50 , 50,'JPG', 'http://servicios.municipalidadsalta.gob.ar');
    } 
  } else {
        $pdf::Image($logo1 , 5 ,160, 50 , 50,'JPG', 'http://servicios.municipalidadsalta.gob.ar');
    }

  
  $pdf::Text(5, 220, 'FIRMA ADOPTANTE:');
  $pdf::Text(5, 230, 'FIRMA CENTRO DE ADOPCIONES:');   



  //$pdf::cell(25,8,"SOLICITUD",1,"","C");
  //$pdf::cell(45,8,"Name",1,"","L");
  //$pdf::cell(35,8,"Address",1,"","L");
  //$pdf::Ln();
  //$pdf::SetFont("Arial","",10);
  //$pdf::cell(25,8,"1",1,"","C");
  //$pdf::cell(45,8,"John",1,"","L");
  //$pdf::cell(35,8,"New York",1,"","L");
  //$pdf::Ln();
  $pdf::Output();
  exit;


?>        


@endsection 
