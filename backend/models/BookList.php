<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "book_list".
 *
 * @property int $id
 * @property int $student_id
 * @property string $book_title
 * @property string $book_author
 * @property int $coach
 * @property int $status
 *
 * @property User $coach0
 * @property User $student
 */
class BookList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_title', 'book_author', 'coach'], 'required'],
            [['student_id', 'coach', 'status'], 'integer'],
            [['book_title', 'book_author'], 'string', 'max' => 255],
            [['coach'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['coach' => 'id']],
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
            'student_id' => 'Student ID',
            'book_title' => 'Book Title',
            'book_author' => 'Book Author',
            'coach' => 'Coach',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Coach0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoach0()
    {
        return $this->hasOne(User::className(), ['id' => 'coach']);
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
