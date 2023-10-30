<?php

namespace app\controllers;
use Yii;
use app\models\Books;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Subs;
use app\models\SubsForm;


/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
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

    public function actionSubscribe($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //$ddd = Yii::$app->request->bodyParams->getBodyParam('id');
        //$ddd=Yii::$app->request->getBodyParam('id');

        $model = new SubsForm();
        $user_id = \Yii::$app->user->getId();
        if (!$user_id) {
            return $this->redirect(['books/sendmail']);
        }
        if ($model->subscribe($id)) {
            Yii::$app->session->setFlash('success', 'Вы успешно подписались на книгу.');

            return $this->redirect(['books/index']);
        }


    }

    public function actionSendmail($id)
    {
        $email='';
        //$model = new SubsForm();
        return $this->render(['books/sendmail', "model" => $this->model]);
    }

    /**
     * Lists all Books models.
     *
     * @return string
     */


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Books::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Books model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $email='';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionGetAuthors() {
        $year = Yii::$app->request->get("year");

        // $author10=Authors::find()->joinwith(['books'])->where(['created_at' => $year])->groupby(['id'])->count()->Limit(10)->orderBy([['id_date' => SORT_DESC]);
       
    }

    
    // public function actionCreateSub() {
    //     //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //     $result = Yii::$app->request->post("id");
    //     $model = new Subs();
    //     $model->book_id = $result["id"];
    //     if (\Yii::$app->user->can('createSub')) {
    //     $model->user_id = $this->user->id;
    //     } else {
    //         $model->user_id = 3;
    //     } 
    //     if ($model->save()) {
    //         return "Подписка добавлена";
    //     }
    //     return $result;
    // }

    public function actionUpdateSub() {
        //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = Yii::$app->request->get("id");
        $model = new Subs();
        $model->book_id = $result["id"];
        if (\Yii::$app->user->can('updateSub')) {
        $model->user_id = $this->user->id;
        } else {
            $model->user_id = 3;
        } 
        if ($model->save()) {
            return "Подписка обновлена";
        }
        return $result;
    }
    
     public function actionCreate()
    {
        $model = new Books();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Books model.
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
     * Deletes an existing Books model.
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
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
