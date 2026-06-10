<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Staff';
$this->params['breadcrumbs'][] = $this->title;

// Calculate summary stats
$allStaff = \common\models\Staff::find()->all();
$totalStaff = count($allStaff);
$activeStaff = 0;
$totalSalary = 0;

foreach ($allStaff as $staff) {
    if ($staff->status === 'active') {
        $activeStaff++;
    }
    $totalSalary += $staff->salary ?? 0;
}

$avgSalary = $totalStaff > 0 ? $totalSalary / $totalStaff : 0;
?>
<div class="staff-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>👥 <?= Html::encode($this->title) ?></h1>
        <?= Html::a('➕ Add Staff', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">Total Staff</div>
                    <div class="h3 mb-0"><?= $totalStaff ?></div>
                    <small class="text-muted">Employees</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">Active</div>
                    <div class="h3 mb-0"><?= $activeStaff ?></div>
                    <small class="text-muted">Working</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-danger shadow">
                <div class="card-body">
                    <div class="text-danger text-uppercase mb-1 font-weight-bold small">Total Salary</div>
                    <div class="h3 mb-0">Tsh<?= number_format($totalSalary, 0) ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">Avg Salary</div>
                    <div class="h5 mb-0">Tsh<?= number_format($avgSalary, 0) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white py-3">
            <h6 class="m-0 font-weight-bold">Staff Directory</h6>
        </div>
        <div class="card-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover mb-0'],
        'headerRowOptions' => ['class' => 'table-light'],
        'columns' => [
            [
                'label' => 'Name',
                'attribute' => 'staff_name',
                'value' => function($model) {
                    return Html::tag('strong', $model->staff_name);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Position',
                'attribute' => 'position',
                'value' => function($model) {
                    return Html::tag('span', $model->position, ['class' => 'badge badge-info']);
                },
                'format' => 'html'
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
                'label' => 'Salary',
                'value' => function($model) {
                    return 'Tsh' . number_format($model->salary ?? 0, 0);
                },
                'contentOptions' => ['class' => 'text-right']
            ],
            [
                'label' => 'Status',
                'attribute' => 'status',
                'value' => function($model) {
                    $color = $model->status === 'active' ? 'success' : 'danger';
                    $badge = $model->status === 'active' ? '✅ Active' : '❌ Inactive';
                    return Html::tag('span', $badge, ['class' => 'badge badge-' . $color]);
                },
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center']
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
