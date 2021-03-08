@extends('admin')


@section('title','SEGUIMIENTO DEL CAN')


@section('content')




    
<?php
    
    $logo1="../public/images/mancilla.jpg" ;
    $logo2="../public/images/modernizacion.jpg" ; 
    //require('../public/vendor/fpdf181/fpdf.php');
  $pdf = new Fpdf();
  $pdf::AddPage();
  $pdf::SetFont('Arial','',15);
  $pdf::Image($logo2 , 5 ,5, 90 , 18,'JPG', 'http://servicios.municipalidadsalta.gob.ar');
  $pdf::Cell(0,35,"Procedimientos Veterinarios Realizados al Can En Hospital Municipal",0,"","L");
  $pdf::SetFont('Arial','',11);
  $pdf::Text(5, 35, 'Emision:'.date("d/m/Y") );
  $pdf::Line(0, 38, 210, 38);
  $pdf::Ln();
  $pdf::Ln();
  


  $pdf::Text(10,42,"DATOS DEL CAN");
  $pdf::SetFont('Arial','',11);
  $pdf::Text(5, 50, 'IDENTIFICACION:');
  $pdf::Text(50, 50, $perro->chip); 
  $pdf::Text(80, 50, 'RAZA:');
  $pdf::Text(90, 50, $raza->nombre); 
  $pdf::Text(5, 55, 'FECHA NAC APROX.:');
  $pdf::Text(50, 55, date("m/Y",strtotime($perro->fechanac))); 

  $pdf::Text(80, 55, 'PORTE:');
  if ($perro->porte == 'P') {
    $pdf::Text(100, 55, 'PEQ.');   
  } elseif ($perro->porte == 'M'){
     $pdf::Text(100, 55, 'MED.');   
  } elseif ($perro->porte == 'G'){
     $pdf::Text(100, 55, 'GRA.');   
  } elseif ($perro->porte == 'GI'){
     $pdf::Text(100,55, 'GIG.');   
  } else {
     $pdf::Text(100, 55, 'IND.');   
  }
  

  $pdf::Text(5, 60, 'SEXO:');
  if ($perro->sexo == 'M') {
    $pdf::Text(50, 60, 'MACHO');   
  } elseif ($perro->sexo == 'F'){
     $pdf::Text(50,60 , 'FEMENINO');   
  } 

 

  $pdf::Text(80, 60, 'APODO:');
  $pdf::Text(100, 60, $perro->apodo);   


  if (strlen($perro->foto)>0) {

    if (file_exists('../public/images/canes/'.$perro->foto )) {
        $pdf::Image('../public/images/canes/'.$perro->foto , 150 ,40, 35 , 35,'JPG', 'http://servicios.municipalidadsalta.gob.ar');
    } 
  } else {
        $pdf::Image($logo1 , 150 ,40, 35 , 35,'JPG', 'http://servicios.municipalidadsalta.gob.ar');
    }
  $pdf::Line(0, 75, 210, 75);
  $pdf::Text(5, 80, 'ID');
  $pdf::Text(15, 80, 'FECHA');
  $pdf::Text(35, 80, 'DETALLE');

  $i= 0;
  $inicio = 87;
  $pdf::SetFont('Arial','',10);?>
  @foreach($seguimiento as $seg)
    
    <?php
      $i=$i+1;
      $pdf::Text(5, $inicio + ($i - 1) * 6 , $i);  
      $pdf::Text(15, $inicio + ($i - 1) * 6 ,  date('d-m-Y',strtotime($seg->fecha)));  
      $pdf::Text(40, $inicio + ($i - 1) * 6 , $seg->detalle);  
    ?>  

  @endforeach

<?php  
  $pdf::Text(5, 270, 'FIRMA RESPONSABLE:');   



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
