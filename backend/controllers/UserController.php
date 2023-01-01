<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\User;
use yii\web\UploadedFile;
use backend\models\AssCat;
use backend\models\Student;
use yii\filters\VerbFilter;
use backend\models\SignupForm;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use backend\models\ProjectMember;
use backend\models\StudentCourse;
use backend\models\TeacherCourse;
use yii\web\NotFoundHttpException;
use backend\models\ProjectAttendance;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                'corsFilter' => [
                    'class' => \yii\filters\Cors::className(),
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['update','index','signup','user-update','delete','profile','view'],
                            'roles' => ['@'],
                        ],
                        [
                            'actions' => ['logout','profile','update','user-update'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                        ]
                ]               
            ]
        );
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $users = User::find()->all();
        $this->layout = 'main2';
        foreach ($users as $user) {
            $date = User::getTime($user->created_at);
            $thismonth = Yii::$app->db->createCommand
            (
                'SELECT * FROM user
                WHERE MONTH(FROM_UNIXTIME(created_at)) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH))
                AND YEAR(FROM_UNIXTIME(created_at)) = YEAR(DATE_ADD(NOW(), INTERVAL -1 MONTH))'
            )
            ->queryAll();
           
        }

        return $this->render('index',['users'=>$users,'thismonth'=>$thismonth]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    // public function actionSignup()
    // {
    //     $this->layout = 'main';

    //     $model = new SignupForm();

    //     if ($model->load(Yii::$app->request->post()) && $model->signup()) {
    //         Yii::$app->session->setFlash('success', 'Thank you for registration. Please contact the new user to check inbox for verification email.');
    //         return $this->redirect(['index']);
    //     }

    //     return $this->render('signup', ['model' => $model]);
    // }
    public function actionSignup()
    {
        $this->layout = 'main2';

        $model = new SignupForm();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {         
            if ($model->signup()) {
            Yii::$app->session->setFlash('success', 'User created successfully!');
             return $this->redirect(['index']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $this->layout = 'main2';

        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
            $update = User::findOne($id);
            $update->firstname = $model->firstname;
            $update->surname = $model->surname;
            $update->email = $model->email;
            $update->phone = $model->phone;
            $update->role = $model->role;
            $update->save(false);
            Yii::$app->session->setFlash('success', 'Congratulation,user details updated successfully!');
            return $this->redirect(['index']);
            }
        }

        return $this->render('userUpdate', [
            'model' => $model,
        ]);
    }


    public function actionProfile($id){

    if (Yii::$app->user->identity->id == $id) {
        $model = $this->findModel($id);
        return $this->render('profile',['model'=>$model]);
    }
    else {
        return $this->redirect(['/site/forbidden']);
    }

    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        
        if(StudentCourse::findOne(['student_id'=>$id])){
            StudentCourse::deleteAll(['student_id'=>$id]);
        }
        
        if(Student::findOne(['student_id'=>$id])){
            Student::deleteAll(['student_id'=>$id]);
        }

        if(ProjectMember::findOne(['member_id'=>$id])){
            ProjectMember::deleteAll(['member_id'=>$id]);
        }

        if(ProjectAttendance::findOne(['member_id'=>$id])){
            ProjectAttendance::deleteAll(['member_id'=>$id]);
        }
        
        
        if(TeacherCourse::findOne(['teacher_id'=>$id])){
            TeacherCourse::deleteAll(['teacher_id'=>$id]);
        }
        
        if(AssCat::findOne(['teacher_id'=>$id])){
            AssCat::deleteAll(['teacher_id'=>$id]);
        }

        
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'User deleted successfully.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
