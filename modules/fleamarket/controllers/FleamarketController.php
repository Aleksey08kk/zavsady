<?php

namespace app\modules\fleamarket\controllers;

use app\models\FleaMarket;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpLoad;
use yii\web\UploadedFile;

/**
 * FleamarketController implements the CRUD actions for Fleamarket model.
 */
class FleamarketController extends Controller
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
     * Lists all Fleamarket models.
     *
     * @return string
     */


    public function actionDeleteOldRecords()
    {
        $count = FleaMarket::deleteRecordsOlderThan30Days();
        echo "Удалено $count записей старше 5 минут.\n";
        return 0;
    }
    public function actionIndex()
    {
        FleaMarket::deleteRecordsOlderThan30Days();

        $FleamarketModel = FleaMarket::find()->all();

        return $this->render('index', [
            'fleamarketModel' => $FleamarketModel,
        ]);
    }
    public function actionMyFleamarket()
    {
        $myFleamarket = FleaMarket::find()->where(['street_and_num' => Yii::$app->user->identity->street])->all();

        return $this->render('my-fleamarket', [
            'myFleamarket' => $myFleamarket
        ]);
    }

    /**
     * Displays a single Fleamarket model.
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
     * Creates a new Fleamarket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Fleamarket();
        if ($this->request->isPost) {
            $model->street_and_num = Yii::$app->user->identity->street;
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
     * Updates an existing Fleamarket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fleamarket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['my-fleamarket']);
    }

    /**
     * Finds the Fleamarket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Fleamarket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fleamarket::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpLoad;

        if (Yii::$app->request->isPost) {
            $fleaMarket = FleaMarket::find()->where(['id' => $id])->one();
            $file = UploadedFile::getInstance($model, 'image');

            if ($fleaMarket->saveImage($model->uploadFile($file, $fleaMarket->photo))) {
                return $this->redirect(['view', 'id' => $fleaMarket->id]);
            }
        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionExpired()
    {
        $date = new \DateTime();
        $date->modify('-30 days');

        $count = FleaMarket::deleteAll(['<', 'date', $date->format('Y-m-d H:i:s')]);
        //echo "Deleted $count expired records.\n";
    }
}
