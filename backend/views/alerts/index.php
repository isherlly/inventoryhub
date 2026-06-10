<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stock Alerts';
$this->params['breadcrumbs'][] = $this->title;

// Calculate summary stats
$activeAlerts = \common\models\StockAlert::find()->where(['is_active' => 1])->count();
$resolvedAlerts = \common\models\StockAlert::find()->where(['is_active' => 0])->count();
$totalAlerts = $activeAlerts + $resolvedAlerts;
?>
<div class="stock-alert-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>⚠️ <?= Html::encode($this->title) ?></h1>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-danger shadow">
                <div class="card-body">
                    <div class="text-danger text-uppercase mb-1 font-weight-bold small">Active Alerts</div>
                    <div class="h3 mb-0"><?= $activeAlerts ?></div>
                    <small class="text-muted">Need attention</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">Resolved</div>
                    <div class="h3 mb-0"><?= $resolvedAlerts ?></div>
                    <small class="text-muted">Already fixed</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">Total Alerts</div>
                    <div class="h3 mb-0"><?= $totalAlerts ?></div>
                    <small class="text-muted">All time</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-warning shadow">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-1 font-weight-bold small">Resolution Rate</div>
                    <div class="h5 mb-0"><?= $totalAlerts > 0 ? number_format(($resolvedAlerts / $totalAlerts) * 100, 0) : 0 ?>%</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-danger text-white py-3">
            <h6 class="m-0 font-weight-bold">Low Stock Warnings</h6>
        </div>
        <div class="card-body">
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover mb-0'],
        'headerRowOptions' => ['class' => 'table-light'],
        'rowOptions' => function($model) {
            if ($model->is_active) {
                return ['class' => 'table-danger'];
            }
            return [];
        },
        'columns' => [
            [
                'label' => 'Alert ID',
                'attribute' => 'alert_id',
                'value' => function($model) {
                    return Html::tag('span', '#' . $model->alert_id, ['class' => 'badge badge-info']);
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
                'label' => 'Current Stock',
                'value' => function($model) {
                    $badge = $model->current_stock <= 5 ? 'danger' : 'warning';
                    return Html::tag('span', $model->current_stock, ['class' => 'badge badge-' . $badge]);
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center']
            ],
            [
                'label' => 'Min Level',
                'attribute' => 'min_stock_level',
                'contentOptions' => ['class' => 'text-center']
            ],
            [
                'label' => 'Shortage',
                'value' => function($model) {
                    $shortage = $model->min_stock_level - $model->current_stock;
                    return Html::tag('span', $shortage . ' units', ['class' => 'badge badge-danger']);
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center']
            ],
            [
                'label' => 'Status',
                'value' => function($model) {
                    if ($model->is_active) {
                        return Html::tag('span', '🔴 Active', ['class' => 'badge badge-danger']);
                    } else {
                        return Html::tag('span', '✅ Resolved', ['class' => 'badge badge-success']);
                    }
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center']
            ],
            [
                'label' => 'Alert Date',
                'value' => function($model) {
                    return date('M d, Y H:i', strtotime($model->alert_date));
                },
                'contentOptions' => ['style' => 'width: 150px;']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{resolve}',
                'buttons' => [
                    'resolve' => function ($url, $model, $key) {
                        if ($model->is_active) {
                            return Html::a('✓ Resolve', ['resolve', 'alert_id' => $model->alert_id], [
                                'class' => 'btn btn-sm btn-success',
                                'data' => ['method' => 'post', 'confirm' => 'Mark as resolved?']
                            ]);
                        } else {
                            return '<span class="badge badge-secondary">Resolved</span>';
                        }
                    },
                ],
                'contentOptions' => ['style' => 'width: 120px;']
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
        </div>
    </div>

    <style>
        .border-left-danger { border-left: 4px solid #dc3545 !important; }
        .border-left-success { border-left: 4px solid #28a745 !important; }
        .border-left-info { border-left: 4px solid #17a2b8 !important; }
        .border-left-warning { border-left: 4px solid #ffc107 !important; }
    </style>

</div>
