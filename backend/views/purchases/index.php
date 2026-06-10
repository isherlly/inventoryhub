<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Purchases';
$this->params['breadcrumbs'][] = $this->title;

// Calculate summary stats
$allPurchases = \common\models\Purchase::find()->all();
$totalPurchases = count($allPurchases);
$totalCost = 0;
$thisMonthCost = 0;
$monthStart = date('Y-m-01');
$monthEnd = date('Y-m-t');

foreach ($allPurchases as $purchase) {
    $totalCost += $purchase->total_cost;
    if ($purchase->purchase_date >= $monthStart && $purchase->purchase_date <= $monthEnd) {
        $thisMonthCost += $purchase->total_cost;
    }
}

$avgPurchase = $totalPurchases > 0 ? $totalCost / $totalPurchases : 0;
?>
<div class="purchase-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📦 <?= Html::encode($this->title) ?></h1>
        <?= Html::a('➕ New Purchase', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">Total Purchases</div>
                    <div class="h3 mb-0"><?= $totalPurchases ?></div>
                    <small class="text-muted">Transactions</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-danger shadow">
                <div class="card-body">
                    <div class="text-danger text-uppercase mb-1 font-weight-bold small">Total Spent</div>
                    <div class="h3 mb-0">Tsh<?= number_format($totalCost, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">This Month</div>
                    <div class="h3 mb-0">Tsh<?= number_format($thisMonthCost, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">Avg Purchase</div>
                    <div class="h5 mb-0">Tsh<?= number_format($avgPurchase, 0) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover mb-0'],
        'headerRowOptions' => ['class' => 'table-light'],
        'columns' => [
            [
                'label' => 'Purchase ID',
                'attribute' => 'purchase_id',
                'value' => function($model) {
                    return Html::tag('span', '#' . $model->purchase_id, ['class' => 'badge badge-primary']);
                },
                'format' => 'html',
                'contentOptions' => ['style' => 'width: 80px;']
            ],
            [
                'label' => 'Supplier',
                'value' => function($model) { 
                    return Html::tag('strong', $model->supplier->supplier_name ?? 'N/A');
                },
                'format' => 'html'
            ],
            [
                'label' => 'Product',
                'value' => function($model) { 
                    return $model->product->product_name ?? 'N/A';
                }
            ],
            [
                'label' => 'Qty',
                'attribute' => 'quantity_purchased',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => 'Unit Cost',
                'value' => function($model) { 
                    return 'Tsh' . number_format($model->total_cost / $model->quantity_purchased, 0);
                },
                'contentOptions' => ['class' => 'text-right']
            ],
            [
                'label' => 'Total Cost',
                'value' => function($model) { 
                    return Html::tag('span', 'Tsh' . number_format($model->total_cost, 0), ['class' => 'badge badge-danger']);
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-right']
            ],
            [
                'label' => 'Date',
                'attribute' => 'purchase_date',
                'value' => function($model) {
                    return date('M d, Y', strtotime($model->purchase_date));
                },
                'contentOptions' => ['style' => 'width: 120px;']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('👁', $url, ['class' => 'btn btn-sm btn-info', 'title' => 'View']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('🗑️', $url, ['class' => 'btn btn-sm btn-danger', 'title' => 'Delete', 'data' => ['confirm' => 'Are you sure?', 'method' => 'post']]);
                    },
                ],
                'contentOptions' => ['style' => 'width: 80px;']
            ],
        ],
    ]); ?>
        </div>
    </div>

    <style>
        .border-left-primary { border-left: 4px solid #007bff !important; }
        .border-left-success { border-left: 4px solid #28a745 !important; }
        .border-left-danger { border-left: 4px solid #dc3545 !important; }
        .border-left-info { border-left: 4px solid #17a2b8 !important; }
    </style>

</div>
