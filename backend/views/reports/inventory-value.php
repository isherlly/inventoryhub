<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $productData */
/** @var float $totalInventoryValue */
/** @var float $totalInventoryCost */
/** @var float $totalPotentialProfit */

$this->title = 'Inventory Value Report';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['dashboard']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-inventory-value">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>This shows the total value of all products currently in your store.</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Inventory Cost</h5>
                    <p class="card-text text-danger">₦<?= number_format($totalInventoryCost, 2) ?></p>
                    <small>Amount you invested</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Inventory Value</h5>
                    <p class="card-text text-info">₦<?= number_format($totalInventoryValue, 2) ?></p>
                    <small>Current selling value</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Potential Profit</h5>
                    <p class="card-text text-success">₦<?= number_format($totalPotentialProfit, 2) ?></p>
                    <small>If you sell all items</small>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h3>Product Inventory Details</h3>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Stock</th>
                <th>Cost Price</th>
                <th>Selling Price</th>
                <th>Inventory Cost</th>
                <th>Inventory Value</th>
                <th>Potential Profit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productData as $item): ?>
                <tr>
                    <td><strong><?= $item['product']->product_name ?></strong></td>
                    <td><?= $item['stockQuantity'] ?></td>
                    <td>₦<?= number_format($item['product']->cost_price, 2) ?></td>
                    <td>₦<?= number_format($item['product']->selling_price, 2) ?></td>
                    <td>₦<?= number_format($item['inventoryCost'], 2) ?></td>
                    <td>₦<?= number_format($item['inventoryValue'], 2) ?></td>
                    <td><strong class="text-success">₦<?= number_format($item['potentialProfit'], 2) ?></strong></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
