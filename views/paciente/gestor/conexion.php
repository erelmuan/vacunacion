<?php 
// Dirección o IP del servidor MySQL
$host = "localhost";
// Puerto del servidor MySQL
$puerto="3306";
// Nombre de usuario del servidor MySQL
$usuario = "root";
// Contraseña del usuario
$contrasena = "";
// Nombre de la base 	de datos
$baseDeDatos ="certificados_covid";
 // Nombre de la tabla a trabajar
$tabla = "paciente";

function Conectarse()
{
global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $tabla;

if (!($link = mysqli_connect($host.":".$puerto, $usuario, $contrasena)))
{
echo "Error conectando a la base de datos.<br>";
exit();
}

if (!mysqli_select_db($link, $baseDeDatos))
{
echo "Error seleccionando la base de datos.<br>";
exit();
}

return $link;
}

// $link = Conectarse();

    // for ($row = 2; $row <= $highestRow; $row++){
	//     $result = mysqli_query($link,"SELECT *  FROM estadopaciente JOIN paciente ON estadopaciente.id_paciente=paciente.id
	// 		WHERE estadopaciente.id_estado=3 and paciente.dni = " . $sheet->getCell("A".$row)->getValue());
	// 		$cantVer = mysqli_num_rows($result);
    //  		if ($cantVer == 0){
	// 		 //muestro los que no encontre
	// 		    echo"No lo encontre";
	// 			 echo $sheet->getCell("A".$row)->getValue();
	// 			 echo"</br>";
	// 			}else {
	// 			  while($pac = mysqli_fetch_array( $result ) ){
	// 							$paciente= $pac;
	// 		    	}			
 	// 		    	$fecha = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($sheet->getCell("B".$row)->getValue()));							$query1 = "INSERT INTO  `estadopaciente`(";
	// 				$query2 = "VALUES(";
	// 				$query1 .= "id_paciente, ";
	// 				$query2 .= $paciente["id"]. ",";
	// 				$query1 .= "fecha , ";
	// 				$query2 .= "'" . $fecha. "',";
	// 				$query1 .= "id_estado , ";
	// 				$query2 .=  "2 ,";
	// 				$query1 .= "orden)";
	// 				$query2 .=  " 1)";
	// 				$result3 = mysqli_query($link, $query1.$query2);
	// 					if ($result3){
	// 					  $query = "UPDATE  `estadopaciente` SET `orden` = `orden` + 1 WHERE
	// 					  fecha != "."'". $fecha. "'"." and
	// 					  id_paciente=".$paciente["id"];
	// 					  $result2 = mysqli_query($link, $query);
	// 					}
	// 				}
	// 	}

	?>