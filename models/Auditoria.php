<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auditoria".
 *
 * @property int $id
 * @property string $tabla
 * @property string $pantalla
 * @property string $usuario
 * @property string $fecha
 * @property string $hora
 * @property string $accion
 * @property string $estado
 */
class Auditoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auditoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tabla', 'pantalla', 'usuario', 'fecha', 'hora', 'accion', 'estado'], 'required'],
            [['fecha', 'hora'], 'safe'],
            [['tabla'], 'string', 'max' => 10],
            [['pantalla', 'usuario', 'accion'], 'string', 'max' => 25],
            [['estado'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tabla' => 'Tabla',
            'pantalla' => 'Pantalla',
            'usuario' => 'Usuario',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'accion' => 'Accion',
            'estado' => 'Estado',
        ];
    }
}
