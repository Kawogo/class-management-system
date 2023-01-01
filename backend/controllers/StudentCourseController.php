<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use backend\models\StudentCourse;
use yii\web\NotFoundHttpException;

/**
 * StudentCourseController implements the CRUD actions for StudentCourse model.
 */
class StudentCourseController extends Controller
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
     * Lists all StudentCourse models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $student_courses = StudentCourse::find()->where(['cr'=>Yii::$app->user->identity->id])->all();

        return $this->render('index', [
            'student_courses' => $student_courses,
        ]);
    }

    /**
     * Displays a single StudentCourse model.
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
     * Creates a new StudentCourse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new StudentCourse();
        $this->layout = 'main2';
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

               for ($i=0; $i < count($model->student_id) ; $i++) { 
                   $student = new StudentCourse();
                   $student->student_id = $model->student_id[$i];
                   $student->course_id = $model->course_id;
                   $student->cr = Yii::$app->user->identity->id;
                   $student->save();
               }
               Yii::$app->session->setFlash('success', 'Students added successfully!');
               return $this->redirect(['site/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StudentCourse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->layout = 'main2';

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StudentCourse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Students removed successfully!');
        return $this->redirect(['site/index']);
    }

    /**
     * Finds the StudentCourse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return StudentCourse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentCourse::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
