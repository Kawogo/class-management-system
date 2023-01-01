<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $longitude
 * @property string $latitude
 * @property int $status
 * @property int $leader
 * @property int $coach
 * @property int $created_at
 * @property string $finish_at
 *
 * @property User $coach0
 * @property User $leader0
 * @property ProjectAttendance[] $projectAttendances
 * @property ProjectMember[] $projectMembers
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'coach'], 'required'],
            [['description'], 'string'],
            [['status', 'leader', 'coach','created_at'], 'integer'],
            [['title', 'longitude','latitude'], 'string', 'max' => 255],
            [['leader'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['leader' => 'id']],
            [['coach'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['coach' => 'id']],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Team name',
            'description' => 'Description',
            'status' => 'Status',
            'leader' => 'Leader',
            'coach' => 'Coach',
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
     * Gets query for [[Leader0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeader0()
    {
        return $this->hasOne(User::className(), ['id' => 'leader']);
    }

    /**
     * Gets query for [[ProjectAttendances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectAttendances()
    {
        return $this->hasMany(ProjectAttendance::className(), ['project_id' => 'id']);
    }

    /**
     * Gets query for [[ProjectMembers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectMembers()
    {
        return $this->hasMany(ProjectMember::className(), ['project_id' => 'id']);
    }
}
