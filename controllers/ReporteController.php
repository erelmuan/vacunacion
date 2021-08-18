<?php

namespace app\controllers;

use Yii;
use app\models\Reporte;
use app\models\Sisa;
use app\models\Noinsertado;
use app\models\Auditoria;
use app\models\PacienteSisa;


use app\models\ReporteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
require_once('PHPExcel/Classes/PHPExcel.php');
use yii\data\ActiveDataProvider;
/**
 * ReporteController implements the CRUD actions for Reporte model.
 */
class ReporteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Reporte models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Reporte model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> '',
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Reporte model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Reporte();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Reporte",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new Reporte",
                    'content'=>'<span class="text-success">Create Reporte success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Create new Reporte",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing Reporte model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Reporte #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Reporte #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Update Reporte #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Reporte model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }
    public function auditoria($tabla,$accion,$estado,$pantalla){
      $modelAuditoria = new Auditoria();
      $modelAuditoria->tabla= $tabla;
      $modelAuditoria->usuario=\Yii::$app->user->username;
      $modelAuditoria->fecha= date("y-m-d");
      $modelAuditoria->hora= date("H:i:s");
      $modelAuditoria->accion=$accion;
      $modelAuditoria->estado=$estado;
      $modelAuditoria->pantalla=$pantalla;

      $modelAuditoria->save();
    }
     /**
     * Delete multiple existing Reporte model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEliminar()
    {

      $model = new Reporte();

      if ($model::find()->count()== 0){
            \Yii::$app->getSession()->setFlash('warning', 'No hay registro para eliminar');

      }else {
          $sql ="TRUNCATE `vacunacion`.`reporte`";
          $db = Yii::$app->db;
          $protocolo = $db->createCommand($sql)
                    ->execute();
            \Yii::$app->getSession()->setFlash('success', 'Se eliminaron todos los registros');
            $this->auditoria('REPORTE','ELIMINAR','COMPLETO','IMPORTACION');
      }

      return $this->redirect(['importacionreporte']);

    }
    public function actionImportacionreporte(){
      $model = new Reporte();

      if(isset($_POST["import"])){
        $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/wps-office.xlsx'];
        $importo=false;

        if(in_array($_FILES["file"]["type"],$allowedFileType)){

              $targetPath = dirname(__FILE__).'/subidas/'.$_FILES['file']['name'];
              move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
              $inputFileType = \PHPExcel_IOFactory::identify($targetPath);
              $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
              $objPHPExcel = $objReader->load($targetPath);
              $sheet = $objPHPExcel->getSheet(0);
              $highestRow = $sheet->getHighestRow();
              $highestColumn = $sheet->getHighestColumn();

              $fila = $model::find()->count();

              $size=$fila+2;
              $importo=false;

              try{
                $transaction = \Yii::$app->db->beginTransaction();
                $registros=0;
              for ($row = $size; $row <= $highestRow; $row++){
                $model = new Reporte();
                // $fecha_format=$sheet->getCell("H".$row)->getValue();
                $model->id = trim($sheet->getCell("A".$row)->getValue());
                $model->email =trim( $sheet->getCell("B".$row)->getValue());
                $model->ceular =trim( $sheet->getCell("C".$row)->getValue());
                $model->dni =trim($sheet->getCell("D".$row)->getValue());
                $model->nombres =trim($sheet->getCell("E".$row)->getValue());
                $model->apellidos =trim( $sheet->getCell("F".$row)->getValue());
                $model->grupo =trim($sheet->getCell("G".$row)->getValue());
                $model->fecha_nacimiento =trim( $sheet->getCell("H".$row)->getValue());
                $model->edad =trim( $sheet->getCell("I".$row)->getValue());
                $model->grupo_de_riesgo =trim( $sheet->getCell("J".$row)->getValue());
                $model->comorbilidades = trim($sheet->getCell("K".$row)->getValue());
                $model->localidad =trim( $sheet->getCell("L".$row)->getValue());
                $model->estado =trim( $sheet->getCell("M".$row)->getValue());
                $model->vacuna = trim($sheet->getCell("N".$row)->getValue());


                if(\PHPExcel_Shared_Date::isDateTime($sheet->getCell("O".$row)) and is_numeric(trim( $sheet->getCell("O".$row)->getValue()))) {
                  $model->primera_dosis = (gmdate( "d/m/Y", \PHPExcel_Shared_Date::ExcelToPHP($sheet->getCell("O".$row)->getValue())));
                }else {
                  $model->primera_dosis = trim($sheet->getCell("O".$row)->getValue());
                }
                if(\PHPExcel_Shared_Date::isDateTime($sheet->getCell("P".$row))and is_numeric(trim( $sheet->getCell("P".$row)->getValue()))) {
                  $model->segunda_dosis =( gmdate( "d/m/Y", \PHPExcel_Shared_Date::ExcelToPHP($sheet->getCell("P".$row)->getValue())));
                }else {
                  $model->segunda_dosis = trim($sheet->getCell("P".$row)->getValue());
                }

                // 2$model->primera_dosis =  date('d-m-Y', trim( $sheet->getCell("O".$row)->getValue()));
                // $model->segunda_dosis =trim( $sheet->getCell("P".$row)->getValue());
                // 2 $model->segunda_dosis =  date('d-m-Y', trim( $sheet->getCell("P".$row)->getValue()));
                $model->creado_el = trim($sheet->getCell("Q".$row)->getValue());

                if(trim( $sheet->getCell("R".$row)->getValue())==''){
                    $model->modprimeradosis ='NO';
                }else {
                     $model->modprimeradosis =trim( $sheet->getCell("R".$row)->getValue());
                }
                if(trim( $sheet->getCell("S".$row)->getValue())==''){
                    $model->modsegundadosis ='NO';
                }else {
                    $model->modsegundadosis =trim( $sheet->getCell("S".$row)->getValue());
                }


                 if (!$model->save()){
                   $modelNoInsertado = new Noinsertado();
                   $modelNoInsertado->id_tabla=trim($sheet->getCell("A".$row)->getValue());
                   $modelNoInsertado->tabla="reporte";

                   $modelInsertado->save();
                 }
                 $importo=true;
                 $registros++;
                 // if ($registros==14000){
                 //   $this->auditoria('REPORTE','IMPORTAR','INCOMPLETO');
                 //   \Yii::$app->getSession()->setFlash('success', 'Registros restantes por importar: '.$highestRow-$row);
                 //   return $this->redirect(['importacionreporte']);
                 //
                 // }

              }
              $transaction->commit();
            }
              catch(Exception $e) {

                $transaction->rollBack();

                Yii::app()->user->setFlash('error', "{$e->getMessage()}");
                $this->auditoria('REPORTE','IMPORTAR','ABORTADO','IMPORTACION');

                return $this->redirect(['importacionreporte']);

              }

        }
        else
        {
          \Yii::$app->getSession()->setFlash('error', 'El archivo enviado es invalido. Por favor vuelva a intentarlo.');
          return $this->redirect(['importacionreporte']);

      }
      if ($importo){
        \Yii::$app->getSession()->setFlash('success', 'el archivo xlsx importado correctamente.');
        $this->auditoria('REPORTE','IMPORTAR','COMPLETO','IMPORTACION');
        }
        else {
          \Yii::$app->getSession()->setFlash('warning', 'el archivo xlsx ya estaba importado o el archivo no era el correcto.');
        }
    }
      $modelAuditoria = new Auditoria();
      $auditoria=$modelAuditoria::find()->where(['tabla' => 'REPORTE','pantalla' => 'IMPORTACION'])->orderBy(['id' => SORT_DESC])->one();

      return $this->render('importacionreporte',['auditoria'=>$auditoria]);

    }

    public function primeradosis($reporte,$sisa){

      if ($reporte->vacuna== '' or $reporte->primera_dosis == ''){
            if ($reporte->vacuna== '' and $reporte->primera_dosis != ''){
              $reporte->vacuna=$sisa->vacuna;
              $reporte->modprimeradosis="SI";
              $reporte->estado="Vacunado";
              $reporte->save();
          }elseif ($reporte->vacuna!= '' and $reporte->primera_dosis == '') {
              $reporte->primera_dosis=$sisa->fecha;
              $reporte->modprimeradosis="SI";
              $reporte->estado="Vacunado";
              $reporte->save();
          }elseif ($reporte->vacuna== '' and $reporte->primera_dosis == '') {
              $reporte->primera_dosis=$sisa->fecha;
              $reporte->modprimeradosis="SI";
              $reporte->estado="Vacunado";
              $reporte->vacuna=$sisa->vacuna;
              $reporte->save();
          }
        }

    }
    public function segundadosis($reporte,$sisa){

      if ($reporte->vacuna== '' or $reporte->segunda_dosis == ''){
            if ($reporte->vacuna== '' and $reporte->segunda_dosis != ''){
              $reporte->vacuna=$sisa->vacuna;
              $reporte->modsegundadosis="SI";
              $reporte->estado="Vacunado";
              $reporte->save();
          }elseif ($reporte->vacuna!= '' and $reporte->segunda_dosis == '') {
              $reporte->segunda_dosis=$sisa->fecha;
              $reporte->modsegundadosis="SI";
              $reporte->estado="Vacunado";
              $reporte->save();
          }elseif ($reporte->vacuna== '' and $reporte->segunda_dosis == '') {
              $reporte->segunda_dosis=$sisa->fecha;
              $reporte->modsegundadosis="SI";
              $reporte->estado="Vacunado";
              $reporte->vacuna=$sisa->vacuna;
              $reporte->save();
          }
        }

    }

    public function actionActualizacionreporte(){
      $modelReporte = new Reporte();
      $modelSisa = new Sisa();
      $actualizo=false;

      if(isset($_POST["actualizar"])){
        // $sisaModelos= $modelSisa::find()->where(['>', 'id', 43093])->all()
        $sisaModelos= $modelSisa::find()->where(['>', 'id', $_POST["registro"]])->all();
        $model = new Reporte();

        $registros=$model::find()->count();
      if($registros!=0){
          foreach($sisaModelos as $sisa) {
            $modelReporte = new Reporte();

            $cantidad=$modelReporte::find()
            ->where(['dni' => $sisa->dni ])
            ->andWhere(['or',
            ['vacuna' =>''],
            ['primera_dosis' =>''],
            ['segunda_dosis' =>'']
          ])->count();


            if ($cantidad > 0){
              $actualizo=true;
              $reportes=$modelReporte::find()->where(['dni' => $sisa->dni ])->all();

              foreach($reportes as $reporte) {

                  if (strncmp(ltrim($sisa->dosis), "1ra", 3) === 0){
                      $this->primeradosis($reporte,$sisa);
                  }else {
                        if (strncmp(ltrim($sisa->dosis), "2da", 3) === 0){
                          $this->segundadosis($reporte,$sisa);
                          }
                          else{
                            //No se pudo registrar ni primera ni segunda dosis
                          }
                     }

                }
           }

          }
          if ($actualizo){
          \Yii::$app->getSession()->setFlash('success', 'el reporte fue actualizado correctamente.');
          $this->auditoria('REPORTE','ACTUALIZAR','COMPLETO','ACTUALIZACION');
          }
          else {
            \Yii::$app->getSession()->setFlash('warning', 'No se actualizo ningun registro.');
          }

      }else {
        \Yii::$app->getSession()->setFlash('warning', 'Reporte no contiene ningun registro');
      }

    }


    $modelAuditoria = new Auditoria();
    $auditoria=$modelAuditoria::find()->where(['tabla' => 'REPORTE','pantalla' => 'ACTUALIZACION'])->orderBy(['id' => SORT_DESC])->one();

    return $this->render('actualizacionreporte', [
        'auditoria' => $auditoria,
    ]);
  }
    public function actionInsertar(){
      $modelPacienteSisa = new PacienteSisa();
      $pacienteSisaModelos= $modelPacienteSisa::find()->where('Dosis2 IS NULL')->all();
      $actualizo=false;
      foreach($pacienteSisaModelos as $pacienteSisa) {

        $modelReporte = new Reporte();
        $encontro=$modelReporte::find()->where(['dni' => $pacienteSisa->dni ])->count();
        if($encontro==0){
          $actualizo=true;

          // $modelReporte->id = NULL;
          // $modelReporte->email =NULL;
          // $modelReporte->ceular =NULL;
          $modelReporte->dni =trim($pacienteSisa->dni);
          $modelReporte->nombres =trim($pacienteSisa->nombre);
          $modelReporte->apellidos =trim($pacienteSisa->apellido);
          $modelReporte->grupo = trim($pacienteSisa->esquema);
          // $model->fecha_nacimiento =NULL;
          $modelReporte->edad = trim($pacienteSisa->edad_actual);
          // $model->grupo_de_riesgo =NULL;
          // $model->comorbilidades = NULL;
          $modelReporte->localidad =trim($pacienteSisa->localidad_establecimiento);
          $modelReporte->estado ='vacunado sisa';
          $modelReporte->vacuna = trim($pacienteSisa->vacuna);
          $modelReporte->primera_dosis =trim($pacienteSisa->Dosis1);
          $modelReporte->segunda_dosis =trim($pacienteSisa->Dosis2);
          $modelReporte->creado_el = '';

          $modelReporte->modprimeradosis =trim('NO') ;
          $modelReporte->modsegundadosis =trim('NO');
          $modelReporte->save();

        }
      }
      if ($actualizo){
        \Yii::$app->getSession()->setFlash('success', 'Se insertaron los registros del sisa correctamente.');
      }
      else {
        \Yii::$app->getSession()->setFlash('warning', 'No habia registros que insertar.');
      }
      $modelAuditoria = new Auditoria();
      $auditoria=$modelAuditoria::find()->where(['tabla' => 'REPORTE','pantalla' => 'ACTUALIZACION'])->orderBy(['id' => SORT_DESC])->one();

      return $this->render('actualizacionreporte', [
          'auditoria' => $auditoria,
      ]);


    }
    /**
     * Finds the Reporte model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reporte the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reporte::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
