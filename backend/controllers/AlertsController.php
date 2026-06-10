<?php

namespace backend\controllers;

use common\models\StockAlert;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

/**
 * AlertsController displays stock alerts.
 */
class AlertsController extends Controller
{
    /**
     * Lists all active stock alerts.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StockAlert::find()->where(['is_active' => 1])->orderBy(['alert_date' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Resolves a stock alert.
     *
     * @param int $alert_id Alert ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionResolve($alert_id)
    {
        $model = $this->findModel($alert_id);
        $model->is_active = 0;
        $model->resolved_date = date('Y-m-d H:i:s');
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StockAlert model based on its primary key value.
     *
     * @param int $alert_id Alert ID
     * @return StockAlert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alert_id)
    {
        if (($model = StockAlert::findOne(['alert_id' => $alert_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
