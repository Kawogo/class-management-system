<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property int|null $student_id
 * @property int $programme
 *
 * @property Programme $programme0
 * @property User $student
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'programme'], 'integer'],
            [['programme'], 'required'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['programme'], 'exist', 'skipOnError' => true, 'targetClass' => Programme::className(), 'targetAttribute' => ['programme' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'programme' => '',
        ];
    }

    /**
     * Gets query for [[Programme0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramme0()
    {
        return $this->hasOne(Programme::className(), ['id' => 'programme']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }
}
