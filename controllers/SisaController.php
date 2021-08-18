<?php

namespace app\controllers;

use Yii;
use app\models\Auditoria;
use app\models\Noinsertado;

use app\models\Sisa;
use app\models\SisaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
require_once('PHPExcel/Classes/PHPExcel.php');
/**
 * SisaController implements the CRUD actions for Sisa model.
 */
class SisaController extends Controller
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
     * Lists all Sisa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SisaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Sisa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Sisa #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Sisa model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Sisa();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Sisa",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new Sisa",
                    'content'=>'<span class="text-success">Create Sisa success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Create new Sisa",
                    'content'=>$this->renderAjax('create', [
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
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing Sisa model.
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
                    'title'=> "Update Sisa #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Sisa #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Update Sisa #".$id,
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
     * Delete an existing Sisa model.
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

     /**
     * Delete multiple existing Sisa model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

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
    public function actionImportacionsisa(){
      $model = new Sisa();

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
                $model = new Sisa();

                $fecha_format=($sheet->getCell("G".$row)->getValue());
                $model->nombre =trim( $sheet->getCell("A".$row)->getValue());
                $model->apellido =trim( $sheet->getCell("B".$row)->getValue());
                $model->dni =trim($sheet->getCell("C".$row)->getValue());
                $model->edad_actual =trim($sheet->getCell("D".$row)->getValue());
                $model->tipo_de_edad_actual =trim( $sheet->getCell("E".$row)->getValue());
                $model->localidad_establecimiento =trim($sheet->getCell("F".$row)->getValue());
                $model->fecha =( gmdate( "d-m-Y", \PHPExcel_Shared_Date::ExcelToPHP($sheet->getCell("G".$row)->getValue())));
                $model->vacuna =trim( $sheet->getCell("H".$row)->getValue());
                $model->dosis =trim( $sheet->getCell("I".$row)->getValue());
                $model->esquema = trim($sheet->getCell("J".$row)->getValue());

                if (!$model->save()){
                  $modelNoInsertado = new Noinsertado();
                  $modelNoInsertado->id_tabla=$sheet->getCell("A".$row)->getValue();
                  $modelNoInsertado->tabla='sisa';

                  $modelInsertado->save();
                }
                 $importo=true;
                  $registros++;
                 // if ($registros==14000){
                 //   $this->auditoria('SISA','IMPORTAR','INCOMPLETO');
                 //   $restantes=$highestRow-$row;
                 //   \Yii::$app->getSession()->setFlash('success', 'Registros restantes por importar: '.$restantes);
                 //   return $this->redirect(['importacionsisa']);
                 //
                 // }

              }
              $transaction->commit();
            }
              catch(Exception $e) {

                $transaction->rollBack();

                Yii::app()->user->setFlash('error', "{$e->getMessage()}");
                $this->auditoria('SISA','IMPORTAR','ABORTADO','IMPORTACION');

                return $this->redirect(['importacionsisa']);

              }

        }
        else
        {
          \Yii::$app->getSession()->setFlash('error', 'El archivo enviado es invalido. Por favor vuelva a intentarlo.');
          return $this->redirect(['importacionsisa']);

      }
      if ($importo){
        \Yii::$app->getSession()->setFlash('success', 'el archivo xlsx importado correctamente.');
        $this->auditoria('SISA','IMPORTAR','COMPLETO','IMPORTACION');

        }
        else {
          \Yii::$app->getSession()->setFlash('warning', 'el archivo xlsx ya estaba actualizado o el archivo no era el correcto.');
        }
    }
    $modelAuditoria = new Auditoria();
    $auditoria=$modelAuditoria::find()->where(['tabla' => 'SISA','pantalla' => 'IMPORTACION'])->orderBy(['id' => SORT_DESC])->one();

    return $this->render('importacionsisa',['auditoria'=>$auditoria]);

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

   $model = new Sisa();

   if ($model::find()->count()== 0){
         \Yii::$app->getSession()->setFlash('warning', 'No hay registro para eliminar');

   }else {
       $sql ="TRUNCATE `vacunacion`.`sisa`";
       $db = Yii::$app->db;
       $protocolo = $db->createCommand($sql)
                 ->execute();
         \Yii::$app->getSession()->setFlash('success', 'Se eliminaron todos los registros');
         $this->auditoria('SISA','ELIMINAR','COMPLETO','IMPORTACION');
   }

   return $this->redirect(['importacionsisa']);

 }



    /**
     * Finds the Sisa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sisa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sisa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
