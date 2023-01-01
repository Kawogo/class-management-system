<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "programme".
 *
 * @property int $id
 * @property string $program_name
 * @property int $yos
 */
class Programme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'programme';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['program_name', 'yos'], 'required'],
            [['yos'], 'integer'],
            [['program_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'program_name' => 'Program Name',
            'yos' => 'Yos',
        ];
    }
}
