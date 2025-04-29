<?php

namespace app\modules\admin\controllers;

use app\models\AllLands;
use app\models\AllLandsSearch;
use app\models\Docs;
use app\models\ImageUpLoad;
use app\models\User;
use yii\filters\VerbFilter;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use PHPExcel_IOFactory as GlobalPHPExcel_IOFactory;

class AllLandsController extends \yii\web\Controller
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
     * Lists all AllLands models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AllLandsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AllLands model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new AllLands();

        if ($model->load(Yii::$app->request->post()) && $model->saveAllLands()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->saveAllLands()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel(int $id)
    {
        if (($model = AllLands::findOne(['id' => $id])) !== null) {
            return $model;
        } else {

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
    public function actionUploadTxtSber()
    {
        $model = new ImageUpLoad;

        if (Yii::$app->request->isPost) {
            $doc = Docs::find()->where(['id' => 10])->one(); // 10 это id изменяемого документа в базе
            //$doc = Docs::find()->where(['id' => 8])->one(); // 8 на локальном
            $file = UploadedFile::getInstance($model, 'image');
            
            if ($doc->saveImage($model->uploadFile($file, $doc->file))) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('image', ['model' => $model]);
    }
    
/*
    public function actionUploadTxtSber()
    {
        $fileout = "text/new.txt";
        $fh = fopen($fileout, "a+");

        $filein = file_get_contents("text/sad.txt");
        $filein = explode("\n", $filein);
        $num = count($filein);

        for ($i = 0; $i < $num; $i++) {
            $buf = explode(";", $filein[$i]);
            $res = substr($buf[0], 0) . "\r\n";
            fwrite($fh, $res);
            $res = substr($buf[5], 0) . "\r\n"; //Если работаете на виндовом сервере, то вместо "\n" нужно ставить "\r\n".
            fwrite($fh, $res);
            $res = substr($buf[6], 0) . "\r\n";
            fwrite($fh, $res);
            $res = substr($buf[8], 0) . "\r\n";
            fwrite($fh, $res);
        }

        fclose($fh);
        return $this->redirect(Yii::$app->request->referrer);
    }
*/
    public function actionSendMail()
    {
        for ($i = 1; $i < 10; $i++) {
            if ($allLandsModel = AllLands::find()->where(['id' => $i])->one()) {
                if ($allLandsModel->debt_str > 0) {
                    Yii::$app->mailer->compose()
                        ->setTo($allLandsModel->email)
                        ->setFrom(['lialinaleksey08kk@yandex.ru'])
                        ->setSubject('СНТ Завьяловские сады')
                        ->setTextBody('Код для подтверждения почты')
                        ->setHtmlBody($allLandsModel->debt_str . ' Письмо создано автоматически. Пожалуйста, не отвечайте на это сообщение')
                        ->send();
                }
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUploadAll()
    {
        require_once 'text/PHPExcel.php';
        $excel = GlobalPHPExcel_IOFactory::load('text/allLands.xlsx');
        for ($i = 1; $i < 1222; $i++) {
            $line = $excel->getActiveSheet()->getCell('A' . $i);
            //echo preg_replace("/тут вставить после какого знака скрыть остальной текст.+/", "", $line);
            $lineAddress = preg_replace("/18:.+/", "", $line); //читаем строку до 18:
            $addressLand = str_replace("№", "", $lineAddress); //удаляем знак номера
            $remuveSpace = preg_replace('/\s{2,}/', ' ', $addressLand); // удаление двойного пробела между улицей и номером

            $allLands = new AllLands();
            $allLands->street_and_num = trim($remuveSpace);
            $allLands->save();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMakeContributions()
    {
        for ($i = 1; $i < 1220; $i++) {
            
            $allLandsModel = AllLands::find()->where(['id' => $i])->one();
            $allLandsSotki = $allLandsModel->how_much_sotok;
            $oldDebt = $allLandsModel->debt_str;

            
            $accrual = $allLandsSotki / 100 * 1180.60; //1180.60 - сумма взноса за 1 сотку
            $allLandsModel->accrual = $accrual;
            $allLandsModel->debt_str = (double)$oldDebt + $accrual;

            $allLandsModel->saveAllLands(); //работает но с ошибкой
        }
        
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMakeNull()
    {
        for ($i = 1; $i < 1220; $i++) {
            
            $allLandsModel = AllLands::find()->where(['id' => $i])->one();

            $allLandsModel->accrual = 0;
            //$allLandsModel->debt_str = 0;
            $allLandsModel->saveAllLands();
            
        }
        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionMakeDopContributions()
    {
        for ($i = 1; $i < 1220; $i++) {
            
            $allLandsModel = AllLands::find()->where(['id' => $i])->one();
            $allLandsSotki = $allLandsModel->how_much_sotok;

            $dopAccrual = $allLandsSotki / 100 * 352.5; //352.50 - сумма дополнительного взноса взноса за 1 сотку
            $allLandsModel->dop_accrual = $dopAccrual;
            $allLandsModel->saveAllLands();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
