<?php

namespace backend\controllers;

use Yii;
use ZipArchive;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use backend\models\Assignment;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * AssignmentController implements the CRUD actions for Assignment model.
 */
class AssignmentController extends Controller
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
     * Lists all Assignment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main2';

        $assignments = Assignment::find()->where(['teacher_id' => Yii::$app->user->identity->id])->all();

        return $this->render('index', [
            'assignments' => $assignments,
        ]);
    }

    /**
     * Displays a single Assignment model.
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
     * Creates a new Assignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {


        $model = new Assignment();
        $this->layout = 'main2';
        $model->scenario = 'create';

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {
                $model->assignments = UploadedFile::getInstances($model, 'assignments');
               
                if ($model->upload()) {
                    foreach ($model->assignments as $assignment) {
                        $ass = new Assignment();
                        $ass->teacher_id = $model->teacher_id;
                        $ass->ass_cat = $model->ass_cat;
                        $ass->student_id = Yii::$app->user->identity->id;
                        $ass->assignment = $assignment->baseName . '.' . $assignment->extension;
                        $ass->sub_date = Assignment::setDate();
                        $ass->save(false);
                    }                 
                    Yii::$app->session->setFlash('success', 'Submitted successfully!');
                    return $this->redirect(['/site/index']);
                }
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Assignment model.
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
     * Deletes an existing Assignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $assignment = Assignment::findOne($id);
        $filename = $assignment->assignment;
        if ($this->findModel($id)->delete() && unlink("backend/web/uploads/".$filename)) {
        Yii::$app->session->setFlash('success', "Assignment deleted successfully.");
        return $this->redirect(['/site/index']);
        }
    }

    public function actionReceived($id)
    {
        // $this->findModel($id)->delete();
        $ass = Assignment::findOne($id);
        $ass->status = 1;
        if (!$ass->save()) {
        print_r($ass->errors);
        exit;
        }
        
        Yii::$app->session->setFlash('success', 'Submitted successfully!');
        return $this->redirect(['/site/index']);
    }


    public function actionReceivedAll($cat_id)
    {
        $assignments = Assignment::find()->where(['ass_cat' => $cat_id])->andWhere(['teacher_id'=>Yii::$app->user->identity->id])->all();

        foreach ($assignments as $assignment) {
            $ass = Assignment::findOne($assignment->id);
            $ass->status = 1;
            if (!$ass->save()) {
            print_r($ass->errors);
            exit;
            }
        }

        Yii::$app->session->setFlash('success', 'Assignments marked successfully!');
        return $this->redirect(['index']);

    }

    public function actionDownload($id){

        // fetch file to download from database
        $file = Assignment::findOne($id);
        $filename = $file->assignment;
        $filepath = 'backend/web/uploads/' . $filename;
    
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('backend/web/uploads/' . $filename));
            readfile('backend/web/uploads/' . $filename);
            exit;
        }else {
            Yii::$app->session->setFlash('error', "File(s) does not exists,please try again.");
            return $this->redirect(['site/index']);
        }
    }

    public function actionDownloadAll($cat_id){


        $assignments = Assignment::findAll(['ass_cat' => $cat_id]);

        $files = [];
        $zipname = 'file.zip';
        $zip = new ZipArchive;

        foreach ($assignments as $assignment) {
            $file = Assignment::findOne($assignment->id);
            $filename = $file->assignment;
            $filepath = 'backend/web/uploads/' . $filename;
        
            array_push($files, $filepath);
        }

        if ($zip->open($zipname, ZipArchive::CREATE)) {

            foreach ($files as $file) {
                $zip->addFromString(basename($file),  file_get_contents($file));
            }

        }

        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
        exit;

    }

    /**
     * Finds the Assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assignment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
