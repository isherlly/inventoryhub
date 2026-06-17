<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;

// Calculate summary stats
$allProducts = \common\models\Product::find()->all();
$totalProducts = count($allProducts);
$lowStockCount = 0;
$totalValue = 0;

foreach ($allProducts as $product) {
    if ($product->stock_quantity <= $product->min_stock_level) {
        $lowStockCount++;
    }
    $totalValue += $product->stock_quantity * $product->cost_price;
}
?>
<div class="product-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('➕ Add Product', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">Total Products</div>
                    <div class="h3 mb-0"><?= $totalProducts ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-warning shadow">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-1 font-weight-bold small">Low Stock</div>
                    <div class="h3 mb-0"><?= $lowStockCount ?></div>
                    <small class="text-muted">Items below minimum</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">Inventory Value</div>
                    <div class="h5 mb-0">Tsh<?= number_format($totalValue, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">Status</div>
                    <div class="h5 mb-0">✅ Active</div>
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
                'label' => 'Product Name',
                'attribute' => 'product_name',
                'value' => function($model) {
                    return $model->product_name;
                }
            ],
            [
                'label' => 'Category',
                'attribute' => 'category',
                'value' => function($model) {
                    return Html::tag('span', $model->category, ['class' => 'badge badge-info']);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Cost',
                'attribute' => 'cost_price',
                'value' => function($model) {
                    return 'Tsh' . number_format($model->cost_price, 0);
                }
            ],
            [
                'label' => 'Selling',
                'attribute' => 'selling_price',
                'value' => function($model) {
                    return 'Tsh' . number_format($model->selling_price, 0);
                }
            ],
            [
                'label' => 'Profit Margin',
                'value' => function($model) {
                    $margin = (($model->selling_price - $model->cost_price) / $model->cost_price) * 100;
                    return number_format($margin, 1) . '%';
                }
            ],
            [
                'label' => 'Stock',
                'attribute' => 'stock_quantity',
                'value' => function($model) {
                    if ($model->stock_quantity <= $model->min_stock_level) {
                        return Html::tag('span', $model->stock_quantity, ['class' => 'badge badge-danger']);
                    } elseif ($model->stock_quantity <= 20) {
                        return Html::tag('span', $model->stock_quantity, ['class' => 'badge badge-warning']);
                    } else {
                        return Html::tag('span', $model->stock_quantity, ['class' => 'badge badge-success']);
                    }
                },
                'format' => 'html'
            ],
            [
                'label' => 'Min Level',
                'attribute' => 'min_stock_level',
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
