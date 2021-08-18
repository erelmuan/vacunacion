<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Sisa;
use app\models\Reporte;


require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
 require_once('PHPExcel/Classes/PHPExcel.php');
 // require_once('PHPExcel/Classes/PHPExcel/IOFactory.php');
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $model= new Thcentro();
        // unset($_SESSION['centro_salud']);
        $cantidadSisa= Sisa::find()->count();
        $cantidadReporte= Reporte::find()->count();


         return $this->render('index',['cantidadSisa'=>$cantidadSisa,
         'cantidadReporte'=>$cantidadReporte
       ]);
        //  'cantidadSolicitudes'=>$cantidadSolicitudes,
        //  'cantidadBiopsias'=>$cantidadBiopsias,
        //  'cantidadPacientes'=>$cantidadPacientes,
        //  'cantidadPaps'=>$cantidadPaps,
        //  'cantidadMedicos'=>$cantidadMedicos]);
        // //return $this->redirect(['paciente/index']);


    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionImportacionsisa(){
      if(isset($_POST["import"])){
        $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/wps-office.xlsx'];
        $importo=false;

        if(in_array($_FILES["file"]["type"],$allowedFileType)){

              // $targetPath = 'subidas/'.$_FILES['file']['name'];
              $targetPath = dirname(__FILE__).'/subidas/'.$_FILES['file']['name'];
              move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
              // $archivo = "/opt/lampp/htdocs/vacunacion/controllers/subidas/".$_FILES['file']['name'];
              $inputFileType = \PHPExcel_IOFactory::identify($targetPath);
              $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
              $objPHPExcel = $objReader->load($targetPath);
              $sheet = $objPHPExcel->getSheet(0);
              $highestRow = $sheet->getHighestRow();
              $highestColumn = $sheet->getHighestColumn();

              $fila = Sisa::find()->count();

              $size=$fila+2;
              $importo=false;
               $db = Yii::$app->db;
              for ($row = $size; $row <= $highestRow; $row++){
                $fecha_format=$sheet->getCell("G".$row)->getValue();
                $query1 = "INSERT INTO  `sisa`(";
                $query2 = "VALUES(";
                $query1 .= "`nombre`, ";
                $query2 .= \Yii::$app->db->quoteValue($sheet->getCell("A".$row)->getValue()). ",";
                $query1 .= "`apellido` , ";
                $query2 .= \Yii::$app->db->quoteValue($sheet->getCell("B".$row)->getValue()). ",";
                $query1 .= "`dni` , ";
                $query2 .= "'" .$sheet->getCell("C".$row)->getValue(). "',";
                $query1 .= "`edad_actual` , ";
                $query2 .="'" . $sheet->getCell("D".$row)->getValue(). "',";
                $query1 .= "`tipo_de_edad_actual`  , ";
                $query2 .="'" . $sheet->getCell("E".$row)->getValue(). "',";
                $query1 .= "`localidad_establecimiento`  , ";
                $query2 .= \Yii::$app->db->quoteValue($sheet->getCell("F".$row)->getValue()). ",";
                $query1 .= "`fecha`  , ";
                $query2 .="'" . date($format = "d-m-Y", \PHPExcel_Shared_Date::ExcelToPHP($fecha_format)) . "',";
                $query1 .= "`vacuna`  , ";
                $query2 .=\Yii::$app->db->quoteValue( $sheet->getCell("H".$row)->getValue()). ",";
                $query1 .= "`dosis`  , ";
                $query2 .= \Yii::$app->db->quoteValue($sheet->getCell("I".$row)->getValue()). ",";
                $query1 .= "`esquema`  )";
                $query2 .=\Yii::$app->db->quoteValue($sheet->getCell("J".$row)->getValue()). ")";
                 // $result2 = mysqli_query($link,   $query1.$query2) ;


                 $resultado = \Yii::$app->db->createCommand( $query1.$query2)
                             ->queryColumn();
                 if (!$resultado){
                   \Yii::$app->getSession()->setFlash('error', 'Ocurrio un error durante la importarcion.');
                   return $this->redirect(['site/importacionsisa']);

                 }
                 $importo=true;


              }
        }
        else
        {
          \Yii::$app->getSession()->setFlash('error', 'El archivo enviado es invalido. Por favor vuelva a intentarlo.');
          return $this->redirect(['site/importacionsisa']);

      }
      if ($importo){
        \Yii::$app->getSession()->setFlash('success', 'el archivo xlsx importado correctamente.');
        }
        else {
          \Yii::$app->getSession()->setFlash('warning', 'el archivo xlsx ya estaba actualizado o el archivo no era el correcto.');
        }
    }

    return $this->render('importacionsisa');

  }

    public function actionImportacionreporte(){
      return $this->render('importacionreporte');
    }



}
