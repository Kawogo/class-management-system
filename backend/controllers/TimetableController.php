<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use backend\models\Timetable;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * TimetableController implements the CRUD actions for Timetable model.
 */
class TimetableController extends Controller
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
     * Lists all Timetable models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $timetables = Timetable::find()->all();
$this->layout = 'main2';
        return $this->render('index', [
            'timetables' => $timetables,
        ]);
    }

    /**
     * Displays a single Timetable model.
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
     * Creates a new Timetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Timetable();
        $this->layout = 'main2';
        // $model->scenario = 'create';

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->timetables = UploadedFile::getInstance($model, 'timetables');
               
                // if ($model->upload()) {
                    
                  
                        $timetable = new Timetable();
                        $timetable->tittle = $model->tittle;
                        $timetable->timetable = $model->timetables->name;
                        $model->timetables->saveAs('backend/web/uploads/timetables/' . $model->timetables->baseName . '.' . $model->timetables->extension);
                        $timetable->save(false);
                        
                        
          
                    Yii::$app->session->setFlash('success', 'Timetable uploaded successfully!');
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
     * Updates an existing Timetable model.
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
     * Deletes an existing Timetable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $timetable = Timetable::findOne($id);
        $filename = $timetable->timetable;
        if ($this->findModel($id)->delete() && unlink("backend/web/uploads/timetables/".$filename)) {
        Yii::$app->session->setFlash('success', "Timetable deleted successfully.");
        return $this->redirect(['index']);
        }


    }
    
    public function actionDownload($id){

        // fetch file to download from database
        $file = Timetable::findOne($id);
        $filename = $file->timetable;
        $filepath = 'backend/web/uploads/timetables/' . $filename;
    
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('backend/web/uploads/timetables/' . $filename));
            readfile('backend/web/uploads/timetables/' . $filename);
            exit;
        }else {
            Yii::$app->session->setFlash('error', "File(s) does not exists,please try again.");
            return $this->redirect(['site/index']);
            }
    }
    /**
     * Finds the Timetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Timetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timetable::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
