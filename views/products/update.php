<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Update Product: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-lg-8">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php 
            echo $this->render('_form', [
                'model' => $model,
                'modelCatlevels' => $modelCatlevels
            ]); 
        ?>
    </div>
    <div class="col-lg-4">    
        <h2 class="text-center">Images</h2>
        <?php 
            $img_str = $model->img_url;
            $img_array = explode(",", $img_str);
            foreach ($img_array as $img ) {
        ?>                
            <div id="imagesContainer">                    
              
                <img id="test" src="<?php echo $img; ?>" />
                
            </div>
        
            <div id="result_test"></div>
        <?php   }?>
    </div>
    

</div>
