<?php

namespace backend\controllers;

use common\models\Expense;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class ExpensesController extends Controller
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
            'query' => Expense::find(),
            'pagination' => ['pageSize' => 20],
            'sort' => ['defaultOrder' => ['expense_id' => SORT_DESC]]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new Expense();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete($expense_id)
    {
        $this->findModel($expense_id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($expense_id)
    {
        if (($model = Expense::findOne(['expense_id' => $expense_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
