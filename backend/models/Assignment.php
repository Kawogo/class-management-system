<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "assignment".
 *
 * @property int $id
 * @property int $student_id
 * @property int $teacher_id
 * @property int $ass_cat
 * @property int $sub_date
 * @property int $status
 *
 * @property AssCat $assCat
 * @property User $student
 * @property User $teacher
 */
class Assignment extends \yii\db\ActiveRecord
{
    public $assignments;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'ass_cat'], 'required'],
            [['student_id', 'teacher_id', 'ass_cat','sub_date','status'], 'integer'],
            [['assignment'], 'string', 'max' => 255],
            ['assignments','required','on'=>'create'],
            [['assignments'], 'file', 'extensions' => 'pdf,docx,zip,xlsx,rar,csv', 'maxFiles' => 10],
            [['ass_cat'], 'exist', 'skipOnError' => true, 'targetClass' => AssCat::className(), 'targetAttribute' => ['ass_cat' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_id' => 'id']],
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
            'student_id' => 'Student ID',
            'teacher_id' => 'Instructor',
            'assignment' => 'Assignment(s)',
            'ass_cat' => 'Tittle',
            'sub_date' => 'Submitted',
            'status' => 'Status'
        ];
    }

    /**
     * Gets query for [[AssCat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssCat()
    {
        return $this->hasOne(AssCat::className(), ['id' => 'ass_cat']);
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


    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->assignments as $file) {

                $file->saveAs('backend/web/uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function setDate(){

        date_default_timezone_set("Africa/Dar_es_Salaam");
        $date = date('d-m-Y');
        $timestamp = strtotime($date);
        return $timestamp;

    }

    public static function getDate($timestamp){
    if ($timestamp) {
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $time = date('d-m-Y H:i',$timestamp);
        return $time; 
    }
    return '';

    }
}
