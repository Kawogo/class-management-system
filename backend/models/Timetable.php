<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property int $id
 * @property string $tittle
 */
class Timetable extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $timetables;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timetable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tittle'], 'required'],
            [['tittle','timetable'], 'string', 'max' => 255],
            // ['timetables','required','on'=>'create'],
            [['timetables'], 'file','skipOnEmpty' => false, 'extensions' => 'pdf,docx,zip,xlsx,rar,csv', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tittle' => 'Tittle',
            'timetable' => 'Timetable',
        ];
    }

    public function upload()
    {
        print_r($this->timetables);
        // print_r('');
        echo '<br>';
        print_r($this->tittle);
        echo '<br>';

        // exit;
        if ($this->validate()) { 
         
            $this->timetables->saveAs('uploads/timetables/' . $this->timetables->baseName . '.' . $this->timetables->extension);
            
            return true;
        } else {
            print_r($this->errors);
            return false;
        }
    }
}
