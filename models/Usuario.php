<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idusuario
 * @property string $usuario
 * @property string $contrasenia
 * @property string $nombre
 * @property string $email
 * @property int $activo
 * @property string $observacion
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
     public $pass_ctrl="";
     public $pass_new="";
     public $pass_new_check="";
     public $pass_reset=false;
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'contrasenia', 'nombre'], 'required'],
            [['activo'], 'default', 'value' => null],
            [['activo'], 'integer'],
            [['observacion', 'imagen'], 'string'],
            [['usuario', 'nombre'], 'string', 'max' => 45],
            [['contrasenia'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 35],
            [['usuario', 'email'], 'unique', 'targetAttribute' => ['usuario', 'email']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idusuario' => 'Idusuario',
            'usuario' => 'Usuario',
            'contrasenia' => 'Contrasenia',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'activo' => 'Activo',
            'observacion' => 'Observacion',
            'imagen' => 'Imagen',
            'pass_ctrl' => 'Ingrese Contraseña Actual',
            'pass_new' => 'Ingrese Nueva Contraseña',
            'pass_new_check' => 'Repita Nueva Contraseña',
            'pass_reset' => 'Resetear Contraseña',

        ];
    }

    public function afterFind(){

      // tareas despues de encontrar el objeto
      parent::afterFind();
  }

  public function beforeSave($insert)
  {
      // tareas antes de encontrar el objeto
      if (parent::beforeSave($insert)) {

          if($this->isNewRecord){
              $this->contrasenia=md5($this->contrasenia);
          }else{
              // es un update de usuario , sin cambio de contraseña
          }
          // Place your custom code here
          return true;
      } else {
          return false;
      }
  }

  public function deleteImage($path,$filename) {
             $file =array();
             $file[] = $path.$filename;
             $file[] = $path.'sqr_'.$filename;
             $file[] = $path.'sm_'.$filename;
             foreach ($file as $f) {
               // check if file exists on server
               if (!empty($f) && file_exists($f)) {
                 // delete file
                 unlink($f);
               }
             }
         }

}
