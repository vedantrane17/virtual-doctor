<?php

namespace app\controllers;

use Yii;
use app\models\Holidays;
use app\models\HolidaysSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


/**
 * HolidaysController implements the CRUD actions for Holidays model.
 */
class HolidaysController extends Controller
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
     * Lists all Holidays models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $doctor = \app\models\Doctor::findOne(['user_id' => Yii::$app->user->id]);

        if (!$doctor) {
            throw new \yii\web\ForbiddenHttpException('You are not authorized.');
        }

        $searchModel = new HolidaysSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Holidays::find()->where(['doctor_id' => $doctor->id]),
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Holidays model.
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
     * Creates a new Holidays model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Holidays();

        $doctor = \app\models\Doctor::findOne(['user_id' => Yii::$app->user->id]);

        if (!$doctor) {
            throw new \yii\web\ForbiddenHttpException('You are not allowed to add holidays.');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->doctor_id = $doctor->id;

            if (Holidays::find()->where(['doctor_id' => $doctor->id, 'date' => $model->date])->exists()) {
                Yii::$app->session->setFlash('error', 'This date is already marked as a holiday.');
            } else {
                $model->save(false);
                Yii::$app->session->setFlash('success', 'Holiday added successfully.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Updates an existing Holidays model.
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
     * Deletes an existing Holidays model.
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
     * Finds the Holidays model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Holidays the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Holidays::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
