<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
use app\models\Categories;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="row">
    <div class="col-lg-8">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table class="table table-hover table-bordered">
    <tbody>
      <tr>
        <td>ID</td>
        <td><?php echo $model->id; ?></td>
      </tr>
      <tr>
        <td>Title</td>
        <td><?php echo $model->title; ?></td>
      </tr>
      <tr>
        <td>Image URLs</td>
        <td><?php echo str_replace(',', '<br/>', $model->img_url); ?></td>
      </tr>
      <tr>
        <td>Image Source</td>
        <td><?php echo str_replace(',', '<br/>', $model->source_url); ?></td>
      </tr>
      <tr>
        <td>Tag</td>
        <td><?php echo $model->tag; ?></td>
      </tr>
      <tr>
        <td>Color</td>
        <td><?php echo $model->color; ?></td>
      </tr>
    <?php if($categoryLevels) {?>  
    <?php foreach ($categoryLevels as $key => $value) { ?>
        <?php if($key != 'id' && $key != 'product_id'){ ?>
        <?php  
       $categoryName = "NULL"; 
             if ($value != "NULL" && $value != "" ){
                $category = Categories::find()
                ->where(['id' => $value])
                ->one();
                $categoryName = $category->name;            
              
        ?>
        <tr>
           <td style="text-transform: capitalize;"><?php echo str_replace('_', ' ', $key); ?></td>
           <td><?php echo $categoryName; ?></td>
        </tr>  
        <?php } ?>
       <?php } ?>
     <?php } ?>
    <?php } ?>
      
    </tbody>
  </table>

    
    </div>
    <div class="col-lg-4">
        
        <?php 
            $img_str = $model->img_url;
            if ( $img_str ){ 
                $img_array = explode(",", $img_str);
                foreach ($img_array as $img ) {
            ?>
                    <p>
                        <a href="<?php echo $img; ?>" target="_blank">
                            <img src="<?php echo $img; ?>" style="max-width: 180px; max-height: 180px;"/>
                        </a> 
                    </p>
            <?php   }?>
            <?php }?>
    </div>

</div>
