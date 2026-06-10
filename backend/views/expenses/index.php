<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Expenses';
$this->params['breadcrumbs'][] = $this->title;

// Calculate summary stats
$allExpenses = \common\models\Expense::find()->all();
$totalExpenses = count($allExpenses);
$totalAmount = 0;
$thisMonthExpenses = 0;
$monthStart = date('Y-m-01');
$monthEnd = date('Y-m-t');
$expensesByType = [];

foreach ($allExpenses as $expense) {
    $totalAmount += $expense->amount;
    if ($expense->expense_date >= $monthStart && $expense->expense_date <= $monthEnd) {
        $thisMonthExpenses += $expense->amount;
    }
    if (!isset($expensesByType[$expense->expense_type])) {
        $expensesByType[$expense->expense_type] = 0;
    }
    $expensesByType[$expense->expense_type] += $expense->amount;
}

$avgExpense = $totalExpenses > 0 ? $totalAmount / $totalExpenses : 0;
$topExpenseType = !empty($expensesByType) ? array_key_first($expensesByType) : 'N/A';
?>
<div class="expense-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>💰 <?= Html::encode($this->title) ?></h1>
        <?= Html::a('➕ Add Expense', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-danger shadow">
                <div class="card-body">
                    <div class="text-danger text-uppercase mb-1 font-weight-bold small">Total Expenses</div>
                    <div class="h3 mb-0">Tsh<?= number_format($totalAmount, 0) ?></div>
                    <small class="text-muted"><?= $totalExpenses ?> entries</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-warning shadow">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-1 font-weight-bold small">This Month</div>
                    <div class="h3 mb-0">Tsh<?= number_format($thisMonthExpenses, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">Avg Expense</div>
                    <div class="h5 mb-0">Tsh<?= number_format($avgExpense, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">Top Category</div>
                    <div class="h5 mb-0"><?= $topExpenseType ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-danger text-white py-3">
            <h6 class="m-0 font-weight-bold">Expense Tracking</h6>
        </div>
        <div class="card-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover mb-0'],
        'headerRowOptions' => ['class' => 'table-light'],
        'columns' => [
            [
                'label' => 'Type',
                'attribute' => 'expense_type',
                'value' => function($model) {
                    $colors = [
                        'Rent' => 'primary',
                        'Utilities' => 'info',
                        'Transportation' => 'secondary',
                        'Maintenance' => 'warning',
                        'Salary' => 'success',
                        'Marketing' => 'danger',
                        'Other' => 'dark'
                    ];
                    $color = $colors[$model->expense_type] ?? 'secondary';
                    return Html::tag('span', $model->expense_type, ['class' => 'badge badge-' . $color]);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Description',
                'attribute' => 'description',
                'value' => function($model) {
                    return Html::tag('strong', $model->description);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Amount',
                'value' => function($model) {
                    return Html::tag('span', 'Tsh' . number_format($model->amount, 0), ['class' => 'badge badge-danger']);
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-right']
            ],
            [
                'label' => 'Date',
                'attribute' => 'expense_date',
                'value' => function($model) {
                    return date('M d, Y', strtotime($model->expense_date));
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
        .border-left-warning { border-left: 4px solid #ffc107 !important; }
        .border-left-danger { border-left: 4px solid #dc3545 !important; }
        .border-left-info { border-left: 4px solid #17a2b8 !important; }
    </style>

</div>
