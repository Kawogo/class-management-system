<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use backend\models\Project;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use backend\models\ProjectMember;
use yii\web\NotFoundHttpException;
use backend\models\ProjectAttendance;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Project models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $projects_completed = Project::find()->where(['status'=>2])->andWhere(['leader'=>Yii::$app->user->identity->id])->all();
        // $projects_progress = Project::find()->where(['status'=>1])->andWhere(['leader'=>Yii::$app->user->identity->id])->all();
        // $projects = Project::find()->where(['leader'=>Yii::$app->user->identity->id])->all();
        $projects_completed = Project::find()->joinWith('projectMembers')->where(['project.status'=>2])->andWhere(['project_member.member_id'=>Yii::$app->user->identity->id])->all();
        $projects_progress = Project::find()->joinWith('projectMembers')->where(['project.status'=>1])->andWhere(['project_member.member_id'=>Yii::$app->user->identity->id])->all();


        $this->layout ='main2';

        return $this->render('index', [
            // 'projects' => $projects,
            'projects_completed' => $projects_completed,
            'projects_progress' => $projects_progress
        ]);
    }

    /**
     * Displays a single Project model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout ='main2';
        $team_members = ProjectMember::findAll(['project_id' => $id]);
       

        return $this->render('view', [
            'model' => $this->findModel($id),
            'team_members' => $team_members
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Project();
        $this->layout ='main2';

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $project = new Project();
                $project->title = $model->title;
                $project->description = $model->description;
                $project->coach = $model->coach;
                $project->leader = Yii::$app->user->identity->id;
                $project->created_at = User::setTime();
                $project->status = 1;
                $members = Yii::$app->request->post('members');

                //adding leader as project member
                array_push($members, Yii::$app->user->identity->id);


                if ($project->save()) {

                    foreach ($members as $member) {
                       $team = new ProjectMember();
                       $team->project_id = $project->id;
                       $team->member_id = $member;
                       $team->save();
                    }

                }else{
                    print_r($model->errors);
                    exit;
                }

                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->layout ='main2';
        $team_members = ProjectMember::findAll(['project_id' => $id]);


        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $project = Project::findOne($id);
                $project->title = $model->title;
                $project->description = $model->description;
                $project->coach = $model->coach;
                $project->leader = Yii::$app->user->identity->id;
                $project->created_at = User::setTime();
                $project->status = 1;
                $members = Yii::$app->request->post('members');

                if ($project->save()) {
                    if ($members) {
                        foreach ($members as $member) {
                            $team = new ProjectMember();
                            $team->project_id = $project->id;
                            $team->member_id = $member;
                            $team->save();
                         }
                    }

                }else{
                    print_r($model->errors);
                    exit;
                }

                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('update', [
            'model' => $model,
            'team_members' => $team_members
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        ProjectMember::deleteAll($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAddLocation(){
        if (Yii::$app->request->isAjax) {
            $lat = Yii::$app->request->getBodyParam('lat');
            $long = Yii::$app->request->getBodyParam('long');
            $project_id = Yii::$app->request->getBodyParam('project_id');

            $addLocation = Project::findOne($project_id);
            $addLocation->latitude = $lat;
            $addLocation->longitude = $long;
            $addLocation->save();

        }
    }

    public function actionGetLocation(){
        if (Yii::$app->request->isAjax) {
            # code...
            $project_id = intval(Yii::$app->request->getBodyParam('project_id'));
            $project = Project::findOne($project_id);
            $project = Yii::$app->db->createCommand('SELECT * FROM project WHERE id=:id')
            ->bindValue(':id', $project_id)
            ->queryAll();
            return json_encode($project);
        }
    }

    public function actionUpdateStatus($id,$stage)
    {
       $project = Project::findOne($id);
       if ($stage == 0) {
        $project->status = 1;
        $project->save();
       }elseif ($stage == 1) {
        $project->status = 2;
        $project->save();
       }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionAttendance($id){
        $members = ProjectMember::find()->where(['project_id'=>$id])->all();
        $this->layout = 'main2';
        return $this->render('attendance',[
            'members' => $members,
            'id' => $id
        ]);
    }

    public function actionSubmitProjectAttendance(){
        if(Yii::$app->request->isAjax){
            $attendance = json_decode(Yii::$app->request->getBodyParam('student_list'));
            foreach ($attendance as $key => $value) {
            $project_attendance = new ProjectAttendance();
            $project_attendance->project_id = Yii::$app->request->getBodyParam('project_id');
            $project_attendance->member_id = $value->id;
            $project_attendance->status = $value->status;
            $project_attendance->date = User::setTime();
            $project_attendance->save();           
            }
         }
    }

    public function actionViewAttendances(){
       

        $projects = Project::find()->where(['leader'=>Yii::$app->user->identity->id])->orWhere(['coach'=>Yii::$app->user->identity->id])->all();
        $this->layout = 'main2';
        return $this->render('viewAttendances',[
            'projects' => $projects,
        ]);

        
    }


    
    public function actionFetchAttendanceReport($project_id,$date)
    {
        
        // $project_id = Yii::$app->request->getBodyParam('project_id');
        $project = Project::findOne($project_id)->title;
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $new_date = strtotime(User::setDate($date));
        $attendance_report = ProjectAttendance::find(['member_id','status'])->where(['date'=>$new_date,'project_id'=>$project_id])->all();          


        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A1:B1');
        $sheet->mergeCells('A2:B2');
        $style = array(
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            )
        );
        $sheet->getStyle("A1:B1")->applyFromArray($style);
        $sheet->getStyle("A2:B2")->applyFromArray($style);
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A3:B3')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, $project .' ATTENDANCE');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 2, 'ATTENDANCE FOR '. User::getTime($new_date));
        $sheet->setCellValue('A3', 'TEAMPRENEUR');
        $sheet->setCellValue('B3', 'STATUS');

        $i = 4;
    
        foreach ($attendance_report as $row) {
          $sheet->setCellValue("A".$i, User::getUsername($row->member_id));
          $sheet->setCellValue("B".$i, ($row->status == 1) ? 'Present' : 'Absent');
          $i++;
        }
    
    
        // (E) SAVE FILE
        $writer = new Xlsx($spreadsheet);
        // echo "OK";
        $filename = User::getTime($new_date). ' ' .$project .' Project Attendance Report.xlsx';
        if (ob_get_contents()) ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='. $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
