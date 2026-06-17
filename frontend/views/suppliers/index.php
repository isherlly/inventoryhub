<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;

// Calculate summary stats
$allSuppliers = \common\models\Supplier::find()->all();
$totalSuppliers = count($allSuppliers);
$totalPurchases = \common\models\Purchase::find()->count();
$totalSpent = \common\models\Purchase::find()->sum('total_cost') ?? 0;
$avgSupplierSpend = $totalSuppliers > 0 ? $totalSpent / $totalSuppliers : 0;
?>
<div class="supplier-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>🏢 <?= Html::encode($this->title) ?></h1>
        <?= Html::a('➕ Add Supplier', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">Total Suppliers</div>
                    <div class="h3 mb-0"><?= $totalSuppliers ?></div>
                    <small class="text-muted">Active vendors</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">Purchases</div>
                    <div class="h3 mb-0"><?= $totalPurchases ?></div>
                    <small class="text-muted">Total orders</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-danger shadow">
                <div class="card-body">
                    <div class="text-danger text-uppercase mb-1 font-weight-bold small">Total Spent</div>
                    <div class="h3 mb-0">Tsh<?= number_format($totalSpent, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">Avg per Supplier</div>
                    <div class="h5 mb-0">Tsh<?= number_format($avgSupplierSpend, 0) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white py-3">
            <h6 class="m-0 font-weight-bold">Supplier Directory</h6>
        </div>
        <div class="card-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover mb-0'],
        'headerRowOptions' => ['class' => 'table-light'],
        'columns' => [
            [
                'label' => 'Supplier Name',
                'attribute' => 'supplier_name',
                'value' => function($model) {
                    return Html::tag('strong', $model->supplier_name);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Contact Person',
                'attribute' => 'contact_person',
            ],
            [
                'label' => 'Phone',
                'attribute' => 'phone',
                'value' => function($model) {
                    return Html::a($model->phone, 'tel:' . $model->phone, ['class' => 'text-decoration-none']);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Email',
                'attribute' => 'email',
                'value' => function($model) {
                    return Html::a($model->email, 'mailto:' . $model->email, ['class' => 'text-decoration-none']);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Purchases',
                'value' => function($model) {
                    $count = \common\models\Purchase::find()->where(['supplier_id' => $model->supplier_id])->count();
                    return Html::tag('span', $count, ['class' => 'badge badge-info']);
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center']
            ],
            [
                'label' => 'Total Spent',
                'value' => function($model) {
                    $sum = \common\models\Purchase::find()->where(['supplier_id' => $model->supplier_id])->sum('total_cost') ?? 0;
                    return Html::tag('span', 'Tsh' . number_format($sum, 0), ['class' => 'badge badge-danger']);
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-right']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
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
                'contentOptions' => ['style' => 'width: 100px;']
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
