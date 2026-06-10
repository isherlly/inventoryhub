<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $productData */

$this->title = 'Product Analysis';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['dashboard']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-product-analysis">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>This report shows which products give you the most profit and which ones need attention.</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Total Quantity Sold</th>
                <th>Total Profit</th>
                <th>Profit Margin %</th>
                <th>Current Stock</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productData as $item): ?>
                <tr>
                    <td><?= $item['product']->product_name ?></td>
                    <td><?= $item['totalQuantity'] ?></td>
                    <td>₦<?= number_format($item['totalProfit'], 2) ?></td>
                    <td><?= number_format($item['profitMargin'], 2) ?>%</td>
                    <td><?= $item['currentStock'] ?></td>
                    <td>
                        <?php if ($item['currentStock'] <= $item['product']->min_stock_level): ?>
                            <span class="badge badge-danger">Low Stock</span>
                        <?php else: ?>
                            <span class="badge badge-success">Sufficient</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
