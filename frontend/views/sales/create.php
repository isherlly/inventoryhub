<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Sale $model */
/** @var array $products */

$this->title = 'Create Sale';
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'products' => $products,
    ]) ?>

</div>
