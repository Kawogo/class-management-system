<?php

namespace backend\models;

use Yii;
use backend\models\Programme;

/**
 * This is the model class for table "attendance".
 *
 * @property int $id
 * @property int $student_id
 * @property int $course_id
 * @property int $teacher_id
 * @property int $program_id
 * @property int $status
 * @property int $date
 *
 * @property Course $course
 * @property User $student
 * @property User $teacher
 * @property Programme $program
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'course_id', 'teacher_id', 'status', 'date'], 'required'],
            [['student_id', 'course_id', 'teacher_id', 'status', 'date'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Programme::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_id' => 'id']],
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
            'teacher_id' => 'Teacher',
            'status' => 'Status',
            'date' => 'Date',
            'program_id' => 'Programme'
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
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'teacher_id']);
    }

        /**
     * Gets query for [[Program]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Programme::className(), ['id' => 'program_id']);
    }
}
