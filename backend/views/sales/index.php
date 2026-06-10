<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SaleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sales';
$this->params['breadcrumbs'][] = $this->title;

// Calculate summary stats
$allSales = \common\models\Sale::find()->all();
$totalSales = count($allSales);
$totalRevenue = 0;
$totalProfit = 0;
$todaySales = 0;

foreach ($allSales as $sale) {
    $totalRevenue += $sale->total_sale_price;
    $totalProfit += $sale->profit;
    if (date('Y-m-d', strtotime($sale->sale_date)) === date('Y-m-d')) {
        $todaySales++;
    }
}

$profitMargin = $totalRevenue > 0 ? ($totalProfit / $totalRevenue) * 100 : 0;
?>
<div class="sale-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('📝 Record Sale', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">Total Revenue</div>
                    <div class="h3 mb-0">Tsh<?= number_format($totalRevenue, 0) ?></div>
                    <small class="text-muted"><?= $totalSales ?> transactions</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">Total Profit</div>
                    <div class="h3 mb-0">Tsh<?= number_format($totalProfit, 0) ?></div>
                    <small class="text-muted"><?= number_format($profitMargin, 1) ?>% margin</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">Today's Sales</div>
                    <div class="h3 mb-0"><?= $todaySales ?></div>
                    <small class="text-muted">Transactions today</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-warning shadow">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-1 font-weight-bold small">Avg Sale</div>
                    <div class="h5 mb-0">Tsh<?= $totalSales > 0 ? number_format($totalRevenue / $totalSales, 0) : 0 ?></div>
                    <small class="text-muted">Per transaction</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-hover mb-0'],
        'headerRowOptions' => ['class' => 'table-light'],
        'columns' => [
            [
                'label' => 'Sale ID',
                'attribute' => 'sale_id',
                'value' => function($model) {
                    return Html::tag('span', '#' . $model->sale_id, ['class' => 'badge badge-primary']);
                },
                'format' => 'html',
                'contentOptions' => ['style' => 'width: 80px;']
            ],
            [
                'label' => 'Product',
                'value' => function($model) {
                    return Html::tag('strong', $model->product->product_name ?? 'N/A');
                },
                'format' => 'html'
            ],
            [
                'label' => 'Customer',
                'attribute' => 'customer_name',
                'value' => function($model) {
                    return $model->customer_name;
                }
            ],
            [
                'label' => 'Qty',
                'attribute' => 'quantity_sold',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => 'Sale Price',
                'value' => function($model) {
                    return 'Tsh' . number_format($model->total_sale_price, 0);
                },
                'contentOptions' => ['class' => 'text-right']
            ],
            [
                'label' => 'Profit',
                'value' => function($model) {
                    $profit = $model->profit;
                    $color = $profit > 0 ? 'success' : 'danger';
                    return Html::tag('span', 'Tsh' . number_format($profit, 0), ['class' => 'badge badge-' . $color]);
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-right']
            ],
            [
                'label' => 'Date',
                'value' => function($model) {
                    return date('M d, Y H:i', strtotime($model->sale_date));
                },
                'contentOptions' => ['style' => 'width: 150px;']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('👁', $url, ['class' => 'btn btn-sm btn-info', 'title' => 'View Details']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('🗑️', $url, ['class' => 'btn btn-sm btn-danger', 'title' => 'Delete', 'data' => ['confirm' => 'Are you sure?', 'method' => 'post']]);
                    },
                ],
                'contentOptions' => ['style' => 'width: 80px;']
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
        </div>
    </div>

    <style>
        .border-left-primary { border-left: 4px solid #007bff !important; }
        .border-left-success { border-left: 4px solid #28a745 !important; }
        .border-left-warning { border-left: 4px solid #ffc107 !important; }
        .border-left-info { border-left: 4px solid #17a2b8 !important; }
    </style>

</div>
