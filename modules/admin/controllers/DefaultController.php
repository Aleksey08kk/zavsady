<?php

namespace app\modules\admin\controllers;

use app\models\AllLands;
use app\models\Docs;
use app\models\HistoryPay;
use app\models\Gas;
use Yii;
use app\models\UploadForm;
use app\models\User;
use SplFileObject;
use yii\web\UploadedFile;
use PHPExcel_IOFactory as GlobalPHPExcel_IOFactory;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new UploadForm();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                return Yii::$app->controller->refresh();
            }
        }

        return $this->render('upload', ['model' => $model]);
    }



    public function actionRecDebt()
    {
        $docsModel = Docs::find()->where(['id' => 10])->one(); //id - 8 для локалки. id - 10 для хостинга
        $lines = file("uploads/$docsModel->file");
        $length = count($lines); //считает с 0. если строк 5 то выводит 6. надо 1 минусовать в цикле ниже

        $datePay = array_map(function ($v) {
            return explode(";", $v)[0]; //номер столбца (дата оплаты)
        }, $lines);
        $lands = array_map(function ($v) {
            return explode(";", $v)[5]; //номер столбца (улица)
        }, $lines);
        $name = array_map(function ($v) {
            return explode(";", $v)[6]; //номер столбца (имя кто оплатил)
        }, $lines);
        $messeges = array_map(function ($v) {
            return explode(";", $v)[7]; //номер столбца (сообщение)
        }, $lines);
        $pay = array_map(function ($v) {
            return explode(";", $v)[8]; //номер столбца (оплата)
        }, $lines);


        for ($i = 0; $i < $length - 1; $i++) {

            $date = $datePay[$i];
            $land = $lands[$i]; //индекс строки
            $nameWho = $name[$i];
            $debtPays = $pay[$i]; //индекс строки
            $messege = $messeges[$i];
            $debtPay = str_ireplace(",", ".", $debtPays);

            $historyPayModel = new HistoryPay;
            $historyPayModel->when_date = $date;
            $historyPayModel->address = $land;
            $historyPayModel->name = $nameWho;
            $historyPayModel->sum = $debtPay;
            $historyPayModel->messege = $messege;
            $historyPayModel->save(false);

            $allLandsModel = AllLands::find()->where(['street_and_num' => $land])->one();
            $allLandsModel->debt_str = $allLandsModel->debt_str - $debtPays;
            $allLandsModel->save(false);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionRecDopDebt()
    {
        $docsModel = Docs::find()->where(['id' => 10])->one(); //id - 8 для локалки. id - 10 для хостинга
        $lines = file("uploads/$docsModel->file");
        $length = count($lines); //считает с 0. если строк 5 то выводит 6. надо 1 минусовать в цикле ниже

        $datePay = array_map(function ($v) {
            return explode(";", $v)[0]; //номер столбца (дата оплаты)
        }, $lines);
        $lands = array_map(function ($v) {
            return explode(";", $v)[5]; //номер столбца (улица)
        }, $lines);
        $name = array_map(function ($v) {
            return explode(";", $v)[6]; //номер столбца (имя кто оплатил)
        }, $lines);
        $messeges = array_map(function ($v) {
            return explode(";", $v)[7]; //номер столбца (сообщение)
        }, $lines);
        $pay = array_map(function ($v) {
            return explode(";", $v)[8]; //номер столбца (оплата)
        }, $lines);


        for ($i = 0; $i < $length - 1; $i++) {

            $date = $datePay[$i];
            $land = $lands[$i];
            $nameWho = $name[$i];
            $debtPays = $pay[$i];
            $messege = $messeges[$i];
            $debtPay = str_ireplace(",", ".", $debtPays);

            /*-----запись в историю оплат----*/
            $historyPayModel = new HistoryPay;
            $historyPayModel->when_date = $date;
            $historyPayModel->address = $land;
            $historyPayModel->name = $nameWho;
            $historyPayModel->sum = $debtPay;
            $historyPayModel->messege = $messege;
            $historyPayModel->save(false);
            /*---------*/

            $allLandsModel = AllLands::find()->where(['street_and_num' => $land])->one();
            $allLandsModel->dop_accrual = $allLandsModel->dop_accrual - $debtPays;
            $allLandsModel->save(false);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionRecGas()
    {
        $docsModel = Docs::find()->where(['id' => 10])->one(); //id - 8 для локалки. id - 10 для хостинга
        $lines = file("uploads/$docsModel->file");
        $length = count($lines); //считает с 0. если строк 5 то выводит 6. надо 1 минусовать в цикле ниже

        $datePay = array_map(function ($v) {
            return explode(";", $v)[0]; //номер столбца (дата оплаты)
        }, $lines);
        $lands = array_map(function ($v) {
            return explode(";", $v)[5]; //номер столбца (улица)
        }, $lines);
        $name = array_map(function ($v) {
            return explode(";", $v)[6]; //номер столбца (имя кто оплатил)
        }, $lines);
        $messeges = array_map(function ($v) {
            return explode(";", $v)[7]; //номер столбца (сообщение)
        }, $lines);
        $pay = array_map(function ($v) {
            return explode(";", $v)[8]; //номер столбца (оплата)
        }, $lines);


        for ($i = 0; $i < $length - 1; $i++) {

            $date = $datePay[$i];
            $land = $lands[$i];
            $nameWho = $name[$i];
            $debtPays = $pay[$i];
            $messege = $messeges[$i];
            $debtPay = str_ireplace(",", ".", $debtPays);

            /*-----запись в историю оплат----*/
            $historyPayModel = new HistoryPay;
            $historyPayModel->when_date = $date;
            $historyPayModel->address = $land;
            $historyPayModel->name = $nameWho;
            $historyPayModel->sum = $debtPay;
            $historyPayModel->messege = $messege;
            $historyPayModel->save(false);
            /*---------*/

            if ($debtPays < 2000) {
                $gasModel = Gas::find()->where(['street_and_num' => $land])->one();
                $gasModel->additionally = $messege;
                $gasModel->gas_insurance = $debtPays;
                $gasModel->save(false);
            }
            if ($debtPays > 2000) {
                $gasModel = new Gas;
                $gasModel->street_and_num = $land;
                $gasModel->sum = $debtPays;
                $gasModel->additionally = $messege;
                $gasModel->save(false);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }


    public function sendMail()
    {
        Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom(['lialinaleksey08kk@yandex.ru'])
            ->setSubject('СНТ Завьяловские сады')
            ->setTextBody('Код для подтверждения почты')
            ->setHtmlBody($code . ' Код для подтверждения почты. Письмо создано автоматически. Пожалуйста, не отвечайте на это сообщение')
            ->send();
        return $this->save(false);
    }
}
