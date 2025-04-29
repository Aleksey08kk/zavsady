<?php

namespace app\modules\admin\controllers;

use app\models\Gas;
use app\models\GasSearch;
use app\models\ImageUpLoad;
use PHPExcel_IOFactory;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GasController implements the CRUD actions for Gas model.
 */
class GasController extends Controller
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
     * Lists all Gas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gas model.
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
     * Creates a new Gas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Gas();

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
     * Updates an existing Gas model.
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
     * Deletes an existing Gas model.
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
     * Finds the Gas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Gas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionUploadGas()
    {
        $model = new ImageUpLoad;

        if (Yii::$app->request->isPost) {
            //$doc = Docs::find()->where(['id' => 10])->one(); // 10 это id изменяемого документа в базе
            $doc = Gas::find()->where(['id' => 1])->one(); // 1 на локальном
            $file = UploadedFile::getInstance($model, 'image');

            if ($doc->saveImage($model->uploadFile($file, $doc->street_and_num))) {
                $this->actionCleanGas();
                $this->actionRecGas();
                return $this->redirect(['index']);
            }
        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionCleanGas()
    {
        /*
        for ($i = 2; $i < 1250; $i++) {
            $models = Gas::find()->all();
            foreach ($models as $model) {
                $model->delete();
            }
        }
*/
        $models = Gas::find()->all();
        $sliced = array_slice($models, 1); // можно использовать в нескольких местах
        foreach ($sliced as $k => $v) {
            $v->delete();
        }
    }

    public function actionRecGas()
    {
        $docGas = Gas::find()->where(['id' => 1])->one()->getImage(); // 1 на локальном
        require_once 'PHPExcel.php';

        $excelDebts = PHPExcel_IOFactory::load($docGas);
        $streets = ['Яблоневая', 'Сливовая', 'Грушевая', 'Персиковая', 'Вишневая', 'Абрикосовая', 'Рябиновая', 'Барбарисовая', 'Малиновая', 'Клубничная', 'Виноградная', 'Брусничная', 'Ежевичная', 'Черничная', 'Апельсиновая', 'Смородиновая', 'Черемуховая', 'Облепиховая', 'Арбузная', 'Земляничная', 'Фруктовая', 'Ореховая', 'Ягодная', 'Гранатовая'];

        for ($iii = 0; $iii < 27; $iii++) { //берем индекс улицы из массива $streets всего улиц 26

            for ($i = 0; $i < 360; $i++) { //берем все строки и перебираем пока не найдем индекс улицы
                $strA = $excelDebts->getActiveSheet()->getCell('A' . $i); //читаем все строки, столбец А

                if (strstr($strA, $streets[$iii])) { //если есть совпадение в строке файла и в индексе $streets то выводим 

                    for ($e = $i + 1; $e < $i + 35; $e++) {
                        $strAe = $excelDebts->getActiveSheet()->getCell('A' . $e);
                        $strBe = $excelDebts->getActiveSheet()->getCell('B' . $e);
                        $strCe = $excelDebts->getActiveSheet()->getCell('C' . $e);

                        if (strstr($strAe, $streets[$iii + 1])) {
                            break 2;
                        }

                        //echo $streets[$iii] . ' ' . $strBe . '-' . $strCe;

                        $gasModel = new Gas();
                        $gasModel->street_and_num = $streets[$iii] . ' ' . $strBe;
                        $gasModel->sum = $strCe;
                        $gasModel->save(false);
                    }
                }
            }
        }
    }

    public function actionRecSorocTis()
    {
        require_once 'PHPExcel.php';
        $docGas = Gas::find()->where(['id' => 1])->one()->getImage();
        $excelDebts = PHPExcel_IOFactory::load($docGas);

        for ($e = 361; $e < 399; $e++) {
            $strBe = $excelDebts->getActiveSheet()->getCell('B' . $e);
            $strCe = $excelDebts->getActiveSheet()->getCell('C' . $e);

            $delete = str_ireplace(",", "", $strBe);

            echo $delete . '-' . $strCe;

            /*
            $gasModel = new Gas();
            $gasModel->street_and_num = $delete;
            $gasModel->sum = $strCe;
            $gasModel->save(false);
            */
        }
    }
}
