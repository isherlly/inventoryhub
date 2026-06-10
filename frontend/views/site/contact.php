<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="row mb-5">
        <div class="col-md-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="mb-2">💬 Get In Touch</h1>
                <p class="text-muted fs-5">Have questions about our Business Management System? We're here to help!</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="mb-4 fw-bold">Send us a Message</h5>

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'name')
                                ->textInput(['autofocus' => true, 'class' => 'form-control form-control-lg', 'placeholder' => 'Your full name'])
                                ->label('Full Name', ['class' => 'form-label fw-bold'])
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'email')
                                ->textInput(['class' => 'form-control form-control-lg', 'placeholder' => 'your.email@example.com'])
                                ->label('Email Address', ['class' => 'form-label fw-bold'])
                            ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'subject')
                        ->textInput(['class' => 'form-control form-control-lg', 'placeholder' => 'What is this about?'])
                        ->label('Subject', ['class' => 'form-label fw-bold'])
                    ?>

                    <?= $form->field($model, 'body')
                        ->textarea(['rows' => 6, 'class' => 'form-control form-control-lg', 'placeholder' => 'Please describe your inquiry...'])
                        ->label('Message', ['class' => 'form-label fw-bold'])
                    ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '<div class="row"><div class="col-lg-4 mb-3">{image}</div><div class="col-lg-8">{input}</div></div>',
                    ])->label('Verification Code', ['class' => 'form-label fw-bold']) ?>

                    <div class="form-group mt-4">
                        <?= Html::submitButton('✉️ Send Message', ['class' => 'btn btn-primary btn-lg fw-bold', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center shadow-sm border-0 p-4">
                        <div class="display-6 mb-3">📧</div>
                        <h6 class="fw-bold">Email</h6>
                        <p class="text-muted small mb-0">contact@business-system.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow-sm border-0 p-4">
                        <div class="display-6 mb-3">📱</div>
                        <h6 class="fw-bold">Phone</h6>
                        <p class="text-muted small mb-0">+255 (0) 123 456 789</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center shadow-sm border-0 p-4">
                        <div class="display-6 mb-3">🕐</div>
                        <h6 class="fw-bold">Response Time</h6>
                        <p class="text-muted small mb-0">Within 24 hours</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
</style>
