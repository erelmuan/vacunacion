<?


namespace app\components\behaviors;
use yii\db\ActiveRecord;

use yii\base\Behavior;
use app\models\Auditoria;
use yii\helpers\Html;


use Yii;

class AuditoriaBehaviors extends Behavior
{
  //  private $_oldattributes = array();

    public function beforeUpdate($event)
    {
      //NO ESTA FUNCIONANDO EN LAS BIOPSIAS CUANDO ACTUALIZO ME MUESTRA QUE SE MODIFICO LA MACROSCOPIA MICROSCOPIA AUN CUANDO NO SE HALLAN MODIFICADO
$differences = array_diff($this->owner->getOldAttributes(), $this->owner->getAttributes());
      if (!empty($differences)){
          $log=new Auditoria();
          $log->idusuario= Yii::$app->user->identity();
          $log->accion= "MODIFICACIÓN";
          $tabla= substr(get_class($this->owner), 11);
          $log->tabla=  $tabla;
          $log->fecha= date("d/m/Y");
          $log->hora= date("H:i:s");
          $log->ip=  $_SERVER['REMOTE_ADDR'];
          $log->informacion_cliente= $_SERVER['HTTP_USER_AGENT'];
          $model=strtolower($tabla);

                      // new attributes
              $newattributes = $this->owner->getAttributes();
              $oldattributes = $this->owner->getOldAttributes();

                      // compare old and new


             $changes="";
             foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                    } else {
                          $old = '';
                    }
                    if ($value != $old) {
                       $changes = $changes .$name .' (Antes)='.$old.'</br>'.$name.' (Después)='. $value.'</br>';

                      }

              }
            $registro=  Html::a( "Ver", [$model."/view","id"=>  $this->owner->getPrimaryKey()]

                ,[    'class' => 'text-success','title'=>'Datos', 'target'=>'_blank','data-toggle'=>'tooltip' ]
               ).'</br>';


          $log->cambios= "Registro modificado: " .$registro.$changes;


          $log->save();
        }

    }

    public function afterInsert($event)
    {

      $log=new Auditoria();
      $log->idusuario= Yii::$app->user->identity->id_user;
      $log->accion= "CREACIÓN";
      $tabla= substr(get_class($this->owner),11);
      $log->tabla=  $tabla;
      $log->fecha= date("d/m/Y");
      $log->hora= date("H:i:s");
      $log->ip=  $_SERVER['REMOTE_ADDR'];
      $log->informacion_cliente= $_SERVER['HTTP_USER_AGENT'];
      $model=strtolower($tabla);


      $log->cambios=       Html::a( "Registro creado", [$model."/view","id"=>  $this->owner->getPrimaryKey()]

            ,[    'class' => 'text-success','role'=>'modal-remote','title'=>'Datos','data-toggle'=>'tooltip']
           );
      $log->save();

    }
    public function events() {
       return [
          ActiveRecord:: EVENT_BEFORE_UPDATE => 'beforeUpdate',
          ActiveRecord:: EVENT_AFTER_INSERT => 'afterInsert',
          ActiveRecord:: EVENT_BEFORE_DELETE => 'beforeDelete',
       ];
    }

    public function beforeDelete($event)
    {
      $oldattributes = $this->owner->getOldAttributes();
      $log=new Auditoria();
      $log->idusuario= Yii::$app->user->identity->id_user;
      $log->accion= "ELIMINACIÓN";
      $tabla= substr(get_class($this->owner), 11);
      $log->tabla= $tabla;
      $log->fecha= date("d/m/Y");
      $log->hora= date("H:i:s");
      $log->ip=  $_SERVER['REMOTE_ADDR'];
      $log->informacion_cliente= $_SERVER['HTTP_USER_AGENT'];
       $registro="";
       foreach ($oldattributes as $name => $value) {

            $old = $oldattributes[$name];

               $registro = $registro .$name .'='.$old.'</br>' ;
            }
      $log->cambios= "Registro eliminado: " .$registro;

      $log->save();
    }

    public function afterFind($event)
    {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }

    public function getOldAttributes()
    {
        return $this->_oldattributes;
    }

    public function setOldAttributes($value)
    {
        $this->_oldattributes=$value;
    }
}
?>
