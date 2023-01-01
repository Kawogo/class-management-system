<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student_course".
 *
 * @property int $id
 * @property $student_id
 * @property int $course_id
 *
 * @property Course $course
 * @property User $cr0
 * @property User $student
 */
class StudentCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'course_id'], 'required'],
            [['student_id', 'course_id'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_id' => 'id']],
            // [['cr'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['cr' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student',
            'course_id' => 'Course',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * Gets query for [[Cr0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCr0()
    {
        return $this->hasOne(User::className(), ['id' => 'cr']);
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
