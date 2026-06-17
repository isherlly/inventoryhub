<?php

use common\models\Orders;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\OrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My Orders';
$this->params['breadcrumbs'][] = $this->title;

// Calculate statistics
$allOrders = \common\models\orders::find()->all();
$totalOrders = count($allOrders);
$totalAmount = 0;

foreach ($allOrders as $order) {
    $totalAmount += $order->amount ?? 0;
}

$avgOrder = $totalOrders > 0 ? $totalAmount / $totalOrders : 0;
?>
<div class="orders-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('➕ Create New Order', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">Total Orders</div>
                    <div class="h3 mb-0"><?= $totalOrders ?></div>
                    <small class="text-muted">All time</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">Total Value</div>
                    <div class="h3 mb-0">Tsh<?= number_format($totalAmount, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">Average Order</div>
                    <div class="h5 mb-0">Tsh<?= number_format($avgOrder, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-warning shadow">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-1 font-weight-bold small">Status</div>
                    <div class="h5 mb-0">✅ Active</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-hover mb-0'],
                'headerRowOptions' => ['class' => 'table-light'],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['style' => 'width: 50px;']
                    ],
                    [
                        'label' => 'Order ID',
                        'attribute' => 'order_id',
                        'value' => function($model) {
                            return Html::tag('span', '#' . $model->order_id, ['class' => 'badge badge-primary']);
                        },
                        'format' => 'html'
                    ],
                    [
                        'label' => 'Stock ID',
                        'attribute' => 'stock_id',
                    ],
                    [
                        'label' => 'User Name',
                        'attribute' => 'user_name',
                        'value' => function($model) {
                            return Html::tag('strong', $model->user_name);
                        },
                        'format' => 'html'
                    ],
                    [
                        'label' => 'Department',
                        'attribute' => 'department',
                        'value' => function($model) {
                            return Html::tag('span', $model->department, ['class' => 'badge badge-info']);
                        },
                        'format' => 'html'
                    ],
                    [
                        'label' => 'Amount',
                        'attribute' => 'amount',
                        'value' => function($model) {
                            return 'Tsh' . number_format($model->amount ?? 0, 0);
                        },
                        'contentOptions' => ['class' => 'text-right']
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('👁', $url, ['class' => 'btn btn-sm btn-info', 'title' => 'View']);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('✏️', $url, ['class' => 'btn btn-sm btn-warning', 'title' => 'Edit']);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('🗑️', $url, ['class' => 'btn btn-sm btn-danger', 'title' => 'Delete', 'data' => ['confirm' => 'Are you sure?', 'method' => 'post']]);
                            },
                        ],
                        'urlCreator' => function ($action, orders $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'order_id' => $model->order_id]);
                         },
                        'contentOptions' => ['style' => 'width: 100px;']
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <style>
        .border-left-primary { border-left: 4px solid #007bff !important; }
        .border-left-success { border-left: 4px solid #28a745 !important; }
        .border-left-warning { border-left: 4px solid #ffc107 !important; }
        .border-left-info { border-left: 4px solid #17a2b8 !important; }
    </style>

</div>
