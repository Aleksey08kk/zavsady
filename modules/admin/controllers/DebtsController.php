<?php

namespace app\modules\admin\controllers;

use app\models\AllLands;
use app\models\Debts;
use app\models\DebtsSearch;
use app\models\ImageUpLoad;
use PHPExcel_IOFactory;
use yii\web\UploadedFile;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DebtsController implements the CRUD actions for Debts model.
 */
class DebtsController extends Controller
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
     * Lists all Debts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DebtsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Debts model.
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
     * Creates a new Debts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Debts();

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
     * Updates an existing Debts model.
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
     * Deletes an existing Debts model.
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
     * Finds the Debts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Debts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Debts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionUploadDebts()
    {
        $model = new ImageUpLoad;

        if (Yii::$app->request->isPost) {
            //$doc = Docs::find()->where(['id' => 10])->one(); // 10 это id изменяемого документа в базе
            $doc = Debts::find()->where(['id' => 1])->one(); // 1 на локальном
            $file = UploadedFile::getInstance($model, 'image');

            if ($doc->saveImage($model->uploadFile($file, $doc->street_and_num))) {
                $this->actionCleanDebts();
                $this->actionRecDebts();
                return $this->redirect(['index']);
            }
        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionCleanDebts()
    {

        for ($i = 2; $i < 1250; $i++) {
            $allLandsModel = AllLands::find()->where(['id' => $i])->one();
            if ($allLandsModel) {
                $allLandsModel->debt_str = 0;
                $allLandsModel->save(false);
            }

            $historyPayModel = Debts::find()->where(['id' => $i])->one();
            if ($historyPayModel) {
                $historyPayModel->delete();
            }
        }
    }

    public function actionRecDebts()
    {
        $doc = Debts::find()->where(['id' => 1])->one()->getImage(); // 1 на локальном
        require_once 'PHPExcel.php';

        $excelDebts = PHPExcel_IOFactory::load($doc);
        $streets = ['Яблоневая', 'Сливовая', 'Грушевая', 'Персиковая', 'Вишневая', 'Абрикосовая', 'Рябиновая', 'Барбарисовая', 'Малиновая', 'Клубничная', 'Виноградная', 'Брусничная', 'Ежевичная', 'Черничная', 'Апельсиновая', 'Смородиновая', 'Черемуховая', 'Облепиховая', 'Арбузная', 'Земляничная', 'Фруктовая', 'Ореховая', 'Ягодная', 'Гранатовая'];

        for ($iii = 0; $iii < 26; $iii++) { //берем индекс улицы из массива $streets

            for ($i = 0; $i < 1250; $i++) { //берем все строки и перебираем пока не найдем индекс улицы
                $strA = $excelDebts->getActiveSheet()->getCell('A' . $i); //читаем все строки, столбец А

                if (strstr($strA, $streets[$iii])) { //если есть совпадение в строке файла и в индексе $streets то выводим 
                    for ($e = $i + 1; $e < $i + 20; $e++) {
                        $strAe = $excelDebts->getActiveSheet()->getCell('A' . $e); //номер участка
                        $strBe = $excelDebts->getActiveSheet()->getCell('B' . $e); //долг
                        if (strstr($strAe, 'Долг')) {
                            break 2;
                        }

                        $streetForRec = $streets[$iii] . ' ' . $strAe;
                        $debtForRec = $strBe;

                        $historyPayModel = Debts::find()->where(['street_and_num' => $streetForRec])->one();
                        if ($historyPayModel) {
                            $historyPayModel->street_and_num = $streetForRec;
                            $historyPayModel->debt = $debtForRec;
                            $historyPayModel->save(false);
                        }else{
                            $historyPayModel = new Debts();
                            $historyPayModel->street_and_num = $streetForRec;
                            $historyPayModel->debt = $debtForRec;
                            $historyPayModel->save(false);
                        }
                        
                        $allLandsModel = AllLands::find()->where(['street_and_num' => $streetForRec])->one();
                        if ($allLandsModel) {
                            $allLandsModel->debt_str = $debtForRec;
                            $allLandsModel->save(false);
                        }

                        //echo $streets[$iii] . ' ' . $strAe . '-' . $strBe;
                    }
                }
            }
        }
    }
}
