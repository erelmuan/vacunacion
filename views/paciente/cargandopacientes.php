<?php
require 'conexion.php';
require '../google-api-php-client/vendor/autoload.php';
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\bootstrap\Progress; 
/* @var $this yii\web\View */
/* @var $searchModel app\models\AuditoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carga de pacientes';
$this->params['breadcrumbs'][] = "Carga de pacientes";

CrudAsset::register($this);

?>
<div id="w0Audi" class="x_panel">
  <div class="x_title"><h2><i class="fa fa-table"></i> CARGA DE PACIENTES  </h2>
    <div class="clearfix"> <div class="nav navbar-right panel_toolbox"><?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i> Atrás', ['/paciente/index'], ['class'=>'btn btn-danger grid-button']) ?></div>
</div>
</br>
</br>
</br>
<?php

    // $client = new Google_Client();
    // $client->setApplicationName('Google Sheets API PHP Quickstart');
    // $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
    // $client->setAccessType('offline');
    // $client->setAuthConfig('certificados-covid-b8a21025a006.json');
    // $service = new Google_Service_Sheets($client);


    // // Prints the names and majors of students in a sample spreadsheet:
    // // https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
    // $spreadsheetId = "1_bW-F_Kk_j_eIzgZEc3vH7zPromBPQaN62rktYrhseU";
    // $range = "A2:K";

    // $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    // $values = $response->getValues();


    // //INSERT UPDATE DE LA BASE DE DATOS
    // $link = Conectarse();
    // mysqli_query($link, "TRUNCATE TABLE paciente");

    // $cant=0;
    // foreach ($values as $row) {
    //     if (isset($row[0])){
    //         $apellido="'".mysqli_real_escape_string($link,$row[0])."'";

    //     }else{
    //         $apellido="'S/A'";
    //     }
    //     if (isset($row[1])){
    //         $nombre="'".mysqli_real_escape_string($link,$row[1])."'";

    //     }else{
    //         $nombre="'S/A'";
    //     }
    //     if (isset($row[3])){
    //         $edad="'".mysqli_real_escape_string($link,$row[3])."'";
    //     }else{
    //         $edad="'S/A'";
    //     }  
    //     if (isset($row[2])){
    //         $dni="'".mysqli_real_escape_string($link,$row[2])."'";
    //     }else{
    //         $dni="'S/A'";
    //     }

        
    //     if (isset($row[8])){
    //         $inicia_aislamiento="'".mysqli_real_escape_string($link,$row[8])."'";
    //     }else{
    //         $inicia_aislamiento="'S/A'";
    //     }
    //     if (isset($row[9])){
    //         $finaliza_aislamiento="'".mysqli_real_escape_string($link,$row[9])."'";
    //     }else{
    //         $finaliza_aislamiento="'S/A'";
    //     }

    //     $result = mysqli_query($link,"SELECT *  FROM paciente WHERE  nombre LIKE " . $nombre." AND  apellido LIKE".$apellido. " AND edad LIKE".$edad);

    //     // $cantVer = mysqli_num_rows($result);

    //     //      if ($cantVer == 0){           
    //             $query1 = "INSERT INTO  `paciente`(";
    //             $query2 = "VALUES(";
    //             $query1 .= "apellido, ";
    //             $query2 .= trim($apellido). ",";
    //             $query1 .= "nombre , ";
    //             $query2 .= trim($nombre). ",";
    //             $query1 .= "dni , ";
    //             $query2 .= trim($dni).  " ,";
    //             $query1 .= "edad , ";
    //             $query2 .= trim($edad).  " ,";
    //             $query1 .= "inicia_aislamiento , ";
    //             $query2 .= trim($inicia_aislamiento).  " ,";
    //             $query1 .= "finaliza_aislamiento)";
    //             $query2 .= trim($finaliza_aislamiento)." )";
    //         $result3 = mysqli_query($link, $query1.$query2);
    //             // }else {
    //             //    echo "update </br>";
    //             //     while($pac = mysqli_fetch_array( $result ) ){
    //             //                     $paciente= $pac;
    //             //         }			
                    
    //             //         $query = "UPDATE  `estadopaciente` SET 
    //             //         `apellido` = ".$apellido."
    //             //         ,`nombre` = ".$nombre."
    //             //         ,`dni` = ".$dni."
    //             //         ,`edad` = ".$edad."
    //             //         ,`inicia_aislamiento` = ".$inicia_aislamiento."
    //             //         ,`finaliza_aislamiento` = ".$finaliza_aislamiento."
            
    //             //         WHERE
    //             //         id_paciente=".$paciente["id"];
    //             //         $result2 = mysqli_query($link, $query);
    //             //  }
    //     }
    

    // echo "exito";






?>
