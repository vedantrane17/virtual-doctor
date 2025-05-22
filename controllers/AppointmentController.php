<?php

namespace app\controllers;

use Yii;
use app\models\Appointment;
use app\models\AppointmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AppointmentController implements the CRUD actions for Appointment model.
 */
class AppointmentController extends Controller
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
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => fn () => Yii::$app->user->identity->role === 'user',
                        ],
                    ],
                ],
            ]
        );
    }

    

    /**
     * Lists all Appointment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AppointmentSearch();

        $user = Yii::$app->user->identity;

        // If the user is a doctor, filter by doctor_id
        if ($user->role === 'doctor') {
            $doctor = \app\models\Doctor::findOne(['user_id' => $user->id]);
            if ($doctor) {
                $searchModel->doctor_id = $doctor->id;
            } else {
                throw new \yii\web\ForbiddenHttpException('Doctor profile not found.');
            }
        }

        // Optional: filter user's own appointments too
        if ($user->role === 'user') {
            $searchModel->user_id = $user->id;
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single Appointment model.
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
     * Creates a new Appointment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Appointment();

        // Pre-fill user_id if needed
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Generate email confirmation file
            $html = $this->renderPartial('_email_template', ['model' => $model]);

            // Ensure the directory exists
            $emailDir = Yii::getAlias('@runtime/emails');
            if (!is_dir($emailDir)) {
                mkdir($emailDir, 0777, true);
            }

            file_put_contents("$emailDir/appointment_{$model->id}.html", $html);

            Yii::$app->session->setFlash('success', 'Appointment booked and confirmation generated.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Appointment model.
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
     * Deletes an existing Appointment model.
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
     * Finds the Appointment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Appointment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Appointment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionAccept($id)
    {
        $model = $this->findModel($id);
        if ($model->doctor_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException();
        }
        $model->status = 'accepted';
        $model->save(false);
        return $this->redirect(['index']);
    }

    public function actionReject($id)
    {
        $model = $this->findModel($id);
        if ($model->doctor_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException();
        }
        $model->status = 'rejected';
        $model->save(false);
        return $this->redirect(['index']);
    }

}
