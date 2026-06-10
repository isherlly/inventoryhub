<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Create Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-2">🚀 Join Us Today</h2>
                        <p class="text-muted">Create your Business Management Account</p>
                    </div>

                    <p class="text-muted text-center mb-4">
                        Get instant access to powerful business tools
                    </p>

                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username')
                            ->textInput(['autofocus' => true, 'class' => 'form-control form-control-lg', 'placeholder' => 'Choose a username'])
                            ->label('Username', ['class' => 'form-label fw-bold'])
                        ?>

                        <?= $form->field($model, 'email')
                            ->textInput(['class' => 'form-control form-control-lg', 'placeholder' => 'your.email@example.com'])
                            ->label('Email Address', ['class' => 'form-label fw-bold'])
                        ?>

                        <?= $form->field($model, 'password')
                            ->passwordInput(['class' => 'form-control form-control-lg', 'placeholder' => 'Create a strong password'])
                            ->label('Password', ['class' => 'form-label fw-bold'])
                            ->hint('Password must contain at least 8 characters')
                        ?>

                        <div class="form-group mt-4">
                            <?= Html::submitButton('✨ Create Account', ['class' => 'btn btn-primary btn-lg w-100 fw-bold', 'name' => 'signup-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                    <hr class="my-4">

                    <p class="text-center text-muted mb-0">
                        Already have an account? 
                        <?= Html::a('Sign in here', ['site/login'], ['class' => 'text-decoration-none fw-bold']) ?>
                    </p>

                    <!-- Benefits -->
                    <div class="mt-4 pt-3 border-top">
                        <p class="small fw-bold text-muted mb-2">What you'll get:</p>
                        <ul class="small text-muted list-unstyled">
                            <li>✅ Complete inventory management</li>
                            <li>✅ Real-time sales tracking</li>
                            <li>✅ Automatic profit calculation</li>
                            <li>✅ Business analytics & reports</li>
                            <li>✅ Stock forecasting</li>
                            <li>✅ Expense tracking</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                <small class="text-muted">
                    © 2024 Business Management System. All rights reserved.
                </small>
            </div>
        </div>
    </div>

    <style>
        .site-signup {
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</div>
