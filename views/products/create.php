<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Create Products';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-8">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form_create', [
        'model' => $model,
        'modelCatlevels' => $modelCatlevels
    ]) ?>
    </div>
    
    <div class="col-lg-4">    
        <h2 class="text-center">Images</h2>
        <div id="imagesContainer"></div>
    </div>
    

</div>
