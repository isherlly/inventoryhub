<?php

use yii\helpers\Html;

$this->title = 'Profit & Loss Report - ' . date('F Y', strtotime($month . '-01'));
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['dashboard']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-profit-loss">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text text-success">₦<?= number_format($totalRevenue, 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Cost of Goods Sold</h5>
                    <p class="card-text text-warning">₦<?= number_format($totalRevenue - $totalProfit, 2) ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-info">
                <div class="card-body">
                    <h5 class="card-title">Gross Profit</h5>
                    <p class="card-text text-info">₦<?= number_format($totalProfit, 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="card-title">Operating Expenses</h5>
                    <p class="card-text text-danger">₦<?= number_format($totalExpenses, 2) ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="card">
        <div class="card-body">
            <h3>NET PROFIT</h3>
            <h2 class="<?= $netProfit >= 0 ? 'text-success' : 'text-danger' ?>">
                ₦<?= number_format($netProfit, 2) ?>
            </h2>
        </div>
    </div>

    <hr>

    <h3>Expense Breakdown</h3>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Expense Type</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($expenses as $expense): ?>
                <tr>
                    <td><?= $expense->expense_type ?></td>
                    <td><?= $expense->description ?></td>
                    <td>₦<?= number_format($expense->amount, 2) ?></td>
                    <td><?= date('M d, Y', strtotime($expense->expense_date)) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
