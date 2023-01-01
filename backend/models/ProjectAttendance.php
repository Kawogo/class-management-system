<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "project_attendance".
 *
 * @property int $id
 * @property int $project_id
 * @property int $member_id
 * @property int $status
 * @property int $date
 *
 * @property User $member
 * @property Project $project
 */
class ProjectAttendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'member_id', 'status', 'date'], 'required'],
            [['project_id', 'member_id', 'status', 'date'], 'integer'],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'member_id' => 'Member ID',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(User::className(), ['id' => 'member_id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
