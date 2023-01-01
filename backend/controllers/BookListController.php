<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\BookList;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * BookListController implements the CRUD actions for BookList model.
 */
class BookListController extends Controller
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
     * Lists all BookList models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $book_list = BookList::find()->where(['coach'=>Yii::$app->user->identity->id])->all();
        $this->layout = 'main2';
        return $this->render('index', [
            'book_list' => $book_list,
        ]);
    }

    /**
     * Displays a single BookList model.
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
     * Creates a new BookList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new BookList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $book = new BookList();
                $book->book_author = $model->book_author;
                $book->book_title = $model->book_title;
                $book->coach = $model->coach;
                $book->student_id = Yii::$app->user->identity->id;
                if ($book->save()) {
                    return $this->redirect(['/site/index']);
                }else{
                    print_r($model->errors);
                    exit;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BookList model.
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
     * Deletes an existing BookList model.
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

    //change book reading status
    public function actionChangeStatus()
    {
        if (Yii::$app->request->isAjax) {
            $book = BookList::findOne(['id' => Yii::$app->request->getBodyParam('id')]);
            $book->status = $book->status ? 0 : 1;
            $book->save();
        }
    }

    /**
     * Finds the BookList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return BookList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BookList::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
