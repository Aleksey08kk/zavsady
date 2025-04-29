<?php

namespace app\controllers;

use app\models\AllLands;
use app\models\Docs;
use app\models\Foto;
use app\models\HistoryPay;
use app\models\ImageUpLoad;
use app\models\News;
use app\models\Protocols;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\User;
use app\models\Gas;
use app\models\Qwestons;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $fotoModel = Foto::find()->all();
        $newsModel = News::find()->where(['views' => 0])->all();
        $lastNew = News::find()->orderBy('id DESC')->one();
        $userModel = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        return $this->render('index', [
            'newsModel' => $newsModel,
            'lastNew' => $lastNew,
            'fotoModel' => $fotoModel,
            'userModel' => $userModel
        ]);
    }

    public function actionOldNews()
    {
        $newsModel = News::find()->where(['views' => 0])->all();
        $oldNewsModel = News::find()->where(['views' => 1])->all();
        return $this->render('old-news', [
            'newsModel' => $newsModel,
            'oldNewsModel' => $oldNewsModel
        ]);
    }

    public function actionQweston()
    {
        $model = new Qwestons();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->qqq()) {
                return;
            }
            Yii::$app->session->setFlash('success', "Сообщение успешно отправлено.");
        }
        
        return $this->render('qweston', [
            'model' => $model,
        ]);
    }
    public function actionFoto()
    {
        return $this->render('foto');
    }
    

    public function actionProfile()
    {
        $docsModel = Docs::find()->where(['not', ['id' => 10]])->all(); // id-8 для локалки id-10 для хостинга
        $protocolModel = Protocols::find()->all();
        $userModel = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $allLandsModel = AllLands::find()->where(['street_and_num' => $userModel->street])->one();
        $historyPayModel = HistoryPay::find()->where(['address' => $userModel->street])->all();
        $lastHistoryPay = HistoryPay::find()->orderBy(['id'=> SORT_DESC])->one();
        $gasModel = Gas::find()->where(['street_and_num' => $allLandsModel->street_and_num])->one();
        $allLandsModelSomeAddress = AllLands::find()->where(['email' => $userModel->email])->all();
        return $this->render('profile', [
            'userModel' => $userModel,
            'allLandsModel' => $allLandsModel,
            'protocolModel' => $protocolModel,
            'docsModel' => $docsModel,
            'historyPayModel' => $historyPayModel,
            'lastHistoryPay' => $lastHistoryPay,
            'gasModel' => $gasModel,
            'allLandsModelSomeAddress' => $allLandsModelSomeAddress
        ]);
    }

    public function actionOtherProfile($idAllLand)
    {
        $docsModel = Docs::find()->where(['not', ['id' => 10]])->all(); // id-8 для локалки id-10 для хостинга
        $protocolModel = Protocols::find()->all();
        $userModel = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $allLandsModel = AllLands::find()->where(['id' => $idAllLand])->one();
        $allLandsModelSomeAddress = AllLands::find()->where(['email' => $userModel->email])->all();
        $historyPayModel = HistoryPay::find()->where(['address' => $allLandsModel->street_and_num])->all();
        $lastHistoryPay = HistoryPay::find()->orderBy(['id' => SORT_DESC])->one();
        $gasModel = Gas::find()->where(['street_and_num' => $allLandsModel->street_and_num])->one();
        $streetNow = $allLandsModel->street_and_num;
        return $this->render('other-profile', [
            'userModel' => $userModel,
            'allLandsModel' => $allLandsModel,
            'protocolModel' => $protocolModel,
            'docsModel' => $docsModel,
            'historyPayModel' => $historyPayModel,
            'lastHistoryPay' => $lastHistoryPay,
            'gasModel' => $gasModel,
            'allLandsModelSomeAddress' => $allLandsModelSomeAddress,
            'streetNow' => $streetNow
        ]);
    }

    public function actionAddLand()
    {
        $model = new AllLands();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->addLand()) {
         }Yii::$app->session->setFlash('success', "Успешно добавили адрес. Теперь в личном кабинете есть возможность переключать адреса. ");
       
        }
        
        return $this->render('add-land', [
            'model' => $model,
        ]);
    }

    
    public function actionUpdate()
    {
        $model = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->saveUser()) {
            return $this->redirect(['profile']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    

public function actionTest()
    {
        return $this->render('test');
    }



    public function actionSetImage()
    {
        $userId = Yii::$app->user->identity->id;
        $model = new ImageUpLoad;

        if (Yii::$app->request->isPost) {
            $user = User::find()->where(['id' => $userId])->one();
            $file = UploadedFile::getInstance($model, 'image');

            if ($user->saveImagee($model->uploadFile($file, $user->photo))) {
                return $this->redirect(['profile']);
            }
        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionSliderImage()
    {
        $fotoModel = new Foto;
        $model = new ImageUpLoad;

        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstance($model, 'image');
            if ($fotoModel->saveImagee($model->uploadFile($file, $fotoModel->photo))) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionCams()
    {
        return $this->render('cams');
    }

}
