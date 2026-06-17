<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-2">🔐 Welcome Back</h2>
                        <p class="text-muted">Inventory Control System</p>
                    </div>

                    <p class="text-muted text-center mb-4">
                        Sign in to access your business dashboard
                    </p>

                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')
                            ->textInput(['autofocus' => true, 'class' => 'form-control form-control-lg', 'placeholder' => 'Username'])
                            ->label('Username', ['class' => 'form-label fw-bold']) 
                        ?>

                        <?= $form->field($model, 'password')
                            ->passwordInput(['class' => 'form-control form-control-lg', 'placeholder' => 'Password'])
                            ->label('Password', ['class' => 'form-label fw-bold']) 
                        ?>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <?= $form->field($model, 'rememberMe')
                                ->checkbox(['class' => 'form-check-input'])
                                ->label('Remember Me', ['class' => 'form-check-label'])
                            ?>
                            <small>
                                <?= Html::a('Forgot Password?', ['site/request-password-reset'], ['class' => 'text-decoration-none']) ?>
                            </small>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('🔓 Sign In', ['class' => 'btn btn-primary btn-lg w-100 fw-bold', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                    <hr class="my-4">

                    <p class="text-center text-muted mb-0">
                        Don't have an account? 
                        <?= Html::a('Sign up here', ['site/signup'], ['class' => 'text-decoration-none fw-bold']) ?>
                    </p>

                    <p class="text-center text-muted small mt-3 mb-0">
                        Need verification email? 
                        <?= Html::a('Resend', ['site/resend-verification-email'], ['class' => 'text-decoration-none']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .site-login {
            min-height: 70vh;
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
