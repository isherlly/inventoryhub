<?php

namespace frontend\controllers;

use common\models\Sale;
use common\models\SaleSearch;
use common\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SalesController implements the CRUD actions for Sale model.
 */
class SalesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Sale models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SaleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sale model.
     *
     * @param int $sale_id Sale ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sale_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sale_id),
        ]);
    }

    /**
     * Creates a new Sale model.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Sale();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sale_id' => $model->sale_id]);
            }
        } else {
            $model->loadDefaultValues();
            $model->sale_date = date('Y-m-d H:i:s');
        }

        $products = Product::find()->all();
        return $this->render('create', [
            'model' => $model,
            'products' => $products,
        ]);
    }

    /**
     * Updates an existing Sale model.
     *
     * @param int $sale_id Sale ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sale_id)
    {
        $model = $this->findModel($sale_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sale_id' => $model->sale_id]);
        }

        $products = Product::find()->all();
        return $this->render('update', [
            'model' => $model,
            'products' => $products,
        ]);
    }

    /**
     * Deletes an existing Sale model.
     *
     * @param int $sale_id Sale ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sale_id)
    {
        $this->findModel($sale_id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Sale model based on its primary key value.
     *
     * @param int $sale_id Sale ID
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sale_id)
    {
        if (($model = Sale::findOne(['sale_id' => $sale_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
