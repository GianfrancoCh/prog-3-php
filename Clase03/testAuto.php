<?php

include("Auto.php");


$arrayAutos = Auto::LeerAutos();

foreach($arrayAutos as $auto){

    Auto::MostrarAuto($auto);
}

// $auto_1 = new Auto("Toyota", "Rojo");
// $auto_2 = new Auto("Toyota","Negro");


// $auto_3 = new Auto("Volkswagen", "Gris", 8500);
// $auto_4 = new Auto("Volkswagen", "Gris", 9000); 

// $auto_5 = new Auto("Fiat", "Azul", 6000, new DateTime('02-02-2024'));


// $auto_3 -> AgregarImpuestos(500);
// $auto_4 -> AgregarImpuestos(550);
// $auto_5 -> AgregarImpuestos(600);

// echo Auto::Add($auto_1,$auto_2);

// Auto::MostrarAuto($auto_1);
// Auto::MostrarAuto($auto_3);
// Auto::MostrarAuto($auto_5);











