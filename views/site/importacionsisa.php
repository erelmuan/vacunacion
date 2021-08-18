<?php
//include('dbconect.php');
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\widgets\AlertBlock;

$this->title = 'Importacion sisa';

// // Dirección o IP del servidor MySQL
// $host = "localhost";
// // Puerto del servidor MySQL
// $puerto="3306";
// // Nombre de usuario del servidor MySQL
// $usuario = "root";
// // Contraseña del usuario
// $contrasena = "";
// // Nombre de la base 	de datos
// $baseDeDatos ="vacunacion";
//  // Nombre de la tabla a trabajar
// $tabla = "sisa";
//
// function Conectarse()
// {
// global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $tabla;
//
// if (!($link = mysqli_connect($host.":".$puerto, $usuario, $contrasena)))
// {
// echo "Error conectando a la base de datos.<br>";
// exit();
// }
// else
// {
// echo "Listo, estamos conectados.<br>";
// mysqli_set_charset($link, 'utf8'); //linea a colocar
// }
// if (!mysqli_select_db($link, $baseDeDatos))
// {
// echo "Error seleccionando la base de datos.<br>";
// exit();
// }
// else
// {
// echo "Obtuvimos la base de datos $baseDeDatos sin problema.<br>";
// }
// return $link;
// }
//
// $link = Conectarse();


// <!-- Begin page content -->
/*
if (isset($_POST["import"]))
{

  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/wps-office.xlsx'];

  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'subidas/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $archivo = "subidas/sisa.xlsx";
        $inputFileType = PHPExcel_IOFactory::identify($archivo);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($archivo);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $type = "success";
        $message = "Excel importado correctamente";
        $result1 = mysqli_query($link,"SELECT count(*) as total FROM sisa ");
        $fila = mysqli_fetch_assoc($result1);
        $size=$fila['total']+2;
        for ($row = $size; $row <= $highestRow; $row++){
          $fecha_format=$sheet->getCell("G".$row)->getValue();
          $query1 = "INSERT INTO  `sisa`(";
          $query2 = "VALUES(";
          $query1 .= "`nombre`, ";
          $query2 .= "'" .mysqli_real_escape_string($link,$sheet->getCell("A".$row)->getValue()). "',";
          $query1 .= "`apellido` , ";
          $query2 .= "'" .mysqli_real_escape_string($link, $sheet->getCell("B".$row)->getValue()). "',";
          $query1 .= "`dni` , ";
          $query2 .= "'" .$sheet->getCell("C".$row)->getValue(). "',";
          $query1 .= "`edad_actual` , ";
          $query2 .="'" . $sheet->getCell("D".$row)->getValue(). "',";
          $query1 .= "`tipo_de_edad_actual`  , ";
          $query2 .="'" . $sheet->getCell("E".$row)->getValue(). "',";
          $query1 .= "`localidad_establecimiento`  , ";
          $query2 .="'" . mysqli_real_escape_string($link,$sheet->getCell("F".$row)->getValue()). "',";
          $query1 .= "`fecha`  , ";
          $query2 .="'" . date($format = "d-m-Y", PHPExcel_Shared_Date::ExcelToPHP($fecha_format)) . "',";
          $query1 .= "`vacuna`  , ";
          $query2 .="'" .mysqli_real_escape_string($link, $sheet->getCell("H".$row)->getValue()). "',";
          $query1 .= "`dosis`  , ";
          $query2 .="'" . mysqli_real_escape_string($link,$sheet->getCell("I".$row)->getValue()). "',";
          $query1 .= "`esquema`  )";
          $query2 .= "'" .mysqli_real_escape_string($link,$sheet->getCell("J".$row)->getValue()). "')";
           $result2 = mysqli_query($link,   $query1.$query2) ;
           if (!$result2){
             $type = "error";
             $message = "Ocurrio un error durante la importarcion";
             break;

           }

        }




  }
  else
  {
        $type = "error";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
  }
}


*/
?>

<div class="content">
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card card-plain">
        <div class="card-header card-header-warning">
          <h3 class="card-title">IMPORTACION ARCHIVO SISA</h3>
          <p class="card-category">Handcrafted by our friends from
            <a target="_blank" href="#">Google</a>
          </p>
        </div>
<!--  -->

  <h3 class="mt-5">Seleccione el archivo sisa.xlsx, importe los registros y espere el mensaje de confirmación</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12">
      <!-- Contenido -->

    <div class="outer-container">
        <form action="<?=Yii::$app->homeUrl."?r=site/importacionsisa"; ?>" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Elija Archivo Excel</label>
                <input type="file"class="form-control"  name="file" id="file" accept=".xls,.xlsx">

                <button type="submit" id="submit" name="import" class="btn btn-warning">Importar Registros</button>

            </div>

        </form>

    </div>

    <?if (Yii::$app->session->hasFlash('error')) {
        echo AlertBlock::widget([
                        'useSessionFlash' => true,
                        'type' => AlertBlock::TYPE_ALERT
                    ]);
      }?>


      <!-- Fin Contenido -->
    </div>
  </div>

<!--  -->
      </div>
    </div>
  </div>
</div>


  <!-- Fin row -->


<script src="assets/jquery-1.12.4-jquery.min.js"></script>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="dist/js/bootstrap.min.js"></script>
