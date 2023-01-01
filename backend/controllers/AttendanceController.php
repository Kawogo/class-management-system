<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use common\models\User;
use yii\web\Controller;
use backend\models\Course;
use yii\filters\VerbFilter;
use backend\models\Assignment;
use backend\models\Attendance;
use yii\data\ActiveDataProvider;
use backend\models\StudentCourse;
use yii\web\NotFoundHttpException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller
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
     * Lists all Attendance models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $attendance = Attendance::find()->where(['teacher_id'=>Yii::$app->user->identity->id])->all();
        $this->layout = 'main2';

        return $this->render('index', [
            'attendance' => $attendance,
        ]);
    }
    /**
     * Displays a single Attendance model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        if(Yii::$app->request->isAjax){
           $attendance = json_decode(Yii::$app->request->getBodyParam('student_list'));
           foreach ($attendance as $key => $value) {
            // print_r($value->id .':'. $value->status);
            $model = new Attendance();
            $model->student_id = $value->id;
            $model->status = $value->status;
            $model->course_id = Yii::$app->request->getBodyParam('course_id');
            $model->teacher_id = Yii::$app->request->getBodyParam('teacher_id');
            $model->program_id = Yii::$app->request->getBodyParam('program_id');
            $model->date = User::setTime();
            $model->save();             
           }
        }
    }

    public function actionFetch(){

        if(Yii::$app->request->isAjax){
        $students = Yii::$app->db->createCommand('SELECT user.firstname,user.surname,user.id FROM student_course sc JOIN user ON user.id = sc.student_id JOIN course ON course.id = sc.course_id WHERE sc.course_id=:course_id')
        ->bindValue('course_id',Yii::$app->request->getBodyParam('course_id'))
        ->queryAll();
        return json_encode($students);
        }
    }

    public function actionFetchAttendanceReport($course_id,$program,$date)
    {
   

        $course = Course::findOne($course_id)->course_name;
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $new_date = strtotime(User::setDate($date));
        $attendance_report = Attendance::find(['student_id','status'])->where(['teacher_id'=>Yii::$app->user->identity->id,'date'=>$new_date,'course_id'=>$course_id,'program_id'=>$program])->all();          


        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A1:B1');
        $sheet->mergeCells('A2:B2');
        $sheet->mergeCells('C1:C2');
        $style = array(
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            )
        );
        $sheet->getStyle("A1:B1")->applyFromArray($style);
        $sheet->getStyle("A2:B2")->applyFromArray($style);
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A3:C3')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, $course .' ATTENDANCE');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 2, 'ATTENDANCE FOR '. User::getTime($new_date));
        $sheet->setCellValue('A3', 'TEAMPRENEUR');
        $sheet->setCellValue('C3', 'PROGRAM');
        $sheet->setCellValue('B3', 'STATUS');

        $i = 4;
    
        foreach ($attendance_report as $row) {
          $sheet->setCellValue("A".$i, User::getUsername($row->student_id));
          $sheet->setCellValue("B".$i, ($row->status == 1) ? 'Present' : 'Absent');
          $sheet->setCellValue("C".$i, Html::encode($row->program->program_name).'('.Html::encode($row->program->yos) .')');
          $i++;
        }
    
    
        // (E) SAVE FILE
        $writer = new Xlsx($spreadsheet);
        // echo "OK";
        $filename = $course.'('.User::getTime($new_date). ')'.' Attendance Report.xlsx';
        if (ob_get_contents()) ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='. $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }



    /**
     * Updates an existing Attendance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Attendance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attendance::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
