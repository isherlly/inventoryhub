<?php

namespace backend\controllers;

use common\models\Staff;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class StaffController extends Controller
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
            'query' => Staff::find(),
            'pagination' => ['pageSize' => 20],
            'sort' => ['defaultOrder' => ['staff_id' => SORT_DESC]]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($staff_id)
    {
        return $this->render('view', ['model' => $this->findModel($staff_id)]);
    }

    public function actionCreate()
    {
        $model = new Staff();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'staff_id' => $model->staff_id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($staff_id)
    {
        $model = $this->findModel($staff_id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'staff_id' => $model->staff_id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($staff_id)
    {
        $this->findModel($staff_id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($staff_id)
    {
        if (($model = Staff::findOne(['staff_id' => $staff_id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
