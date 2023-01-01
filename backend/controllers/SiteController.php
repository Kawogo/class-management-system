<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use common\models\User;
use yii\web\Controller;
use yii\web\UploadedFile;
use backend\models\Project;
use backend\models\Request;
use yii\filters\VerbFilter;
use backend\models\BookList;
use common\models\LoginForm;
use backend\models\Timetable;
use backend\models\Assignment;
use backend\models\Attendance;
use backend\models\SignupForm;
use yii\filters\AccessControl;
use backend\models\StudentCourse;
use backend\models\VerifyEmailForm;
use yii\web\BadRequestHttpException;
use backend\models\ResetPasswordForm;
use yii\base\InvalidArgumentException;
use backend\models\PasswordResetRequestForm;
use backend\models\ResendVerificationEmailForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['signup','request-password-reset','reset-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout','index','signup','request-password-reset','forbidden','offline','reset-password','dashboard'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

    if (Yii::$app->user->identity->role == 'teampreneur' || Yii::$app->user->identity->role == 'coach' || Yii::$app->user->identity->role == 'project_leader' || Yii::$app->user->identity->role == 'team_leader' || Yii::$app->user->identity->role == 'Admin') {
        # code...
    // return $this->render('index');
    $this->layout = 'main2';


    }
    //  $this->layout = 'main2';

    $ass_count = Assignment::find()->where(['teacher_id' => Yii::$app->user->identity->id])->count();
    $assignments = Assignment::find()->where(['student_id'=> Yii::$app->user->identity->id])->all();
    $teacher_ass = Assignment::find()->where(['teacher_id' => Yii::$app->user->identity->id])->all();
    $students = User::find()->where(['role' => 'teampreneur'])->orWhere(['role'=>'team_leader'])->all();
    $timetables = Timetable::find()->all();
    $attendance = Attendance::find()->where(['teacher_id'=>Yii::$app->user->identity->id])->all();
    $student_book_list = BookList::findAll(['student_id'=> Yii::$app->user->identity->id]);




    return $this->render('index',[
        'ass_count'=>$ass_count,
        'assignments' => $assignments,
        'teacher_ass' => $teacher_ass,
        'students' => $students,
        'timetables' =>  $timetables,
        'attendance'=>$attendance,
        'student_book_list' => $student_book_list,
    ]);

    }

    public function actionForbidden()
    {
        return $this->render('forbidden');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
         
                return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
          /**
     * Signs user up.
     *
     * @return mixed
     */
    // public function actionSignup()
    // {
    //     $this->layout = 'main';

    //     $model = new SignupForm();

    //     if ($model->load(Yii::$app->request->post())) {
    //         $model->signature = UploadedFile::getInstance($model, 'signature');
    //         $model->signature->saveAs('uploads/signatures/' . $model->signature->baseName . '.' . $model->signature->extension);
    //         if ($model->signup()) {
    //         Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
    //         return $this->goHome();
    //         }
    //     }

    //     return $this->render('signup', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'blank';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Reset link sent,check your email.');

                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'blank';
        try {
        $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved, please login');
            return $this->redirect(['/site/login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
