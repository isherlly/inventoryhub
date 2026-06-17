<?php

namespace frontend\controllers;

use common\models\Purchase;
use common\models\Product;
use common\models\Supplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class PurchasesController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => ['delete' => ['POST']],
            ],
        ]);
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Purchase::find(),
            'pagination' => ['pageSize' => 20],
            'sort' => ['defaultOrder' => ['purchase_id' => SORT_DESC]]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($purchase_id)
    {
        return $this->render('view', ['model' => $this->findModel($purchase_id)]);
    }

    public function actionCreate()
    {
        $model = new Purchase();
        $suppliers = Supplier::find()->all();
        $products = Product::find()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'purchase_id' => $model->purchase_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'suppliers' => $suppliers,
            'products' => $products,
        ]);
    }

    public function actionDelete($purchase_id)
    {
        $this->findModel($purchase_id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($purchase_id)
    {
        if (($model = Purchase::findOne(['purchase_id' => $purchase_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
