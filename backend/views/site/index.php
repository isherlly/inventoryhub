<?php

/** @var yii\web\View $this */

$this->title = 'My inventoryhub';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent" style="margin-top: 60px; margin-bottom: 40px;">
        <h1 class="display-1" style="font-size: 4rem; font-weight: bold; color: #667eea; margin-bottom: 20px;">🎉 Congratulations!</h1>
        <p class="lead" style="font-size: 1.8rem; color: #555; margin-bottom: 30px;">You have successfully created your inventoryhub</p>
        
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; font-size: 1.1rem; max-width: 600px; margin: 30px auto;">
            <strong>🚀 Ready to get started?</strong> Explore your dashboard and manage your inventory with ease!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
        </div>

        <div class="mt-5">
            <a href="/inventory-yii2/backend/web/index.php?r=reports%2Fdashboard" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 12px 40px; font-size: 1.1rem; margin: 10px;">📊 Go to Dashboard</a>
            <a href="/inventory-yii2/backend/web/index.php?r=products%2Findex" class="btn btn-outline-primary btn-lg" style="padding: 12px 40px; font-size: 1.1rem; margin: 10px;">📦 View Products</a>
        </div>
    </div>
</div>
