<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\components\Seguridad;
use Yii;

class Seguridad {

/* tienePermiso()
   Esta funcion toma el parametro r del GET que tiene 2 partes: controlador/accion
   y chequea si el usuario actual tiene permiso sobre esa acción. Tambien se le puede pasar la accion por parametro

   Casos especiales
   controlador/* indica que tiene permiso sobre todas las acciones del controlador

   La seguridad se maneja por grupos y permisos. Un grupo tiene varios permisos. Un usuario pertenece a varios grupo
   @return <boolean>
*/

    public static function tienePermiso($accion=''){
      return true;
       if(Yii::$app->user->isGuest) return false;
       $id_usuario=Yii::$app->user->identity->getId();

      //  if(Yii::$app->user->identity->administrador) return true;
       //
       if (empty($accion)){
           $accion=$_GET['r'];
       }

       $array = explode("/",$accion);
       if (count($array)==1) {
               $controller = $accion;
               $accion = 'index';
       }else {
               $controller = $array[0];
               $accion = $array[1];
       }
       if ($controller =="gii" )
         return true;

       $roles = \app\models\Usuariorol::findall(['idusuario' => $id_usuario]);

      if ($roles==null)
        //no tiene rol el usuario
        return false;
      foreach($roles as $rol) {
        //SE PODRIA HACER DE OTRA FORMA SOLO CON EL ROL!!!
            $permisos=\app\models\Permiso::find()->where(['idrol'=>$rol->idrol ])->all();

            foreach($permisos as $permiso) {
              $modulo=\app\models\Modulo::findOne(['idmodulo'=>$permiso->idmodulo]);

              if ($controller == $modulo->nombre  ){

                //  $accionbd=\app\modesdals\Accion::findOne(['idaccion'=>$permiso->idaccion]);
                //supongo que si le das permiso para ver la grilla tambien le das permiso para ver la vista completa
            if ($accion =="view" || $accion =="select" || $modulo->nombre =="gii" )
              return true;

              if ($permiso->idaccion !== null ){

              $accionbd=\app\models\Accion::find()->where(['idaccion'=>$permiso->idaccion])->one();
                //si algun modulo tiene activado en verdadero la accion
                //prevalece la accion verdadero por sobre el falso y el null
              if ($accionbd->$accion == true)
                  return true;
                }

              }
              //el rol no incluye el permisos

            }

       }
       return false;

      //  $rol=\app\models\Rol::findOne(['idusuario'=> $id_usuario]);
      //$permiso=\app\models\Permiso::findOne(['idusuario'=>$controller.'/'.$accion]);
      //  $permiso2=\app\models\Permiso::findOne(['nombre'=>$controller.'/*']);
       //
      //  if ($permiso1)
      //      $grupos1=$permiso1->getGrupos()->all();
       //
      //  if ($permiso2)
      //       $grupos2=$permiso2->getGrupos()->all();
       //
      //  $grupos = array_merge($grupos1, $grupos2);
      //  $lreturn=false;
      //  foreach($grupos as $grp) {
       //
      //       $user = $grp->hasMany(\app\models\Usuario::className(), ['id' => 'id_usuario'])->viaTable('usuarioGrupo', ['id_grupo' => 'id'])->select(['id'])->where(['id' => $id_usuario])->all();
      //       if ($user)
      //           $lreturn = true;
      //  }

    //   return ($lreturn);

    // if ($accion =='update')
    //  return false;
    //  else
    // return (true);
    }

}
?>
