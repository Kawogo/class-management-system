<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ass_cat".
 *
 * @property int $id
 * @property string $cat_name
 * @property int $teacher_id
 *
 * @property Assignment[] $assignments
 * @property User $tecaher
 */
class AssCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ass_cat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['teacher_id'], 'integer'],
            [['cat_name'], 'string', 'max' => 255],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_name' => 'Cat Name',
            'teacher_id' => 'Tecaher ID',
        ];
    }

    /**
     * Gets query for [[Assignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['ass_cat' => 'id']);
    }

    /**
     * Gets query for [[Tecaher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTecaher()
    {
        return $this->hasOne(User::className(), ['id' => 'teacher_id']);
    }
}
