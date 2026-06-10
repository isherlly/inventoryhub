<?php

namespace backend\controllers;

use common\models\Supplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class SuppliersController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => ['delete' => ['POST']],
            ],
        ]);
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Supplier::find(),
            'pagination' => ['pageSize' => 20],
            'sort' => ['defaultOrder' => ['supplier_id' => SORT_DESC]]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($supplier_id)
    {
        return $this->render('view', ['model' => $this->findModel($supplier_id)]);
    }

    public function actionCreate()
    {
        $model = new Supplier();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'supplier_id' => $model->supplier_id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($supplier_id)
    {
        $model = $this->findModel($supplier_id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'supplier_id' => $model->supplier_id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($supplier_id)
    {
        $this->findModel($supplier_id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($supplier_id)
    {
        if (($model = Supplier::findOne(['supplier_id' => $supplier_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
