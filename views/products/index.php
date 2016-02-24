<?php

use yii\helpers\Html;
//use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="products-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?php echo Html::a('Add New Product', ['create'], ['class' => 'btn btn-primary']); ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'category_id', 
            'title',
            'img_url:url',            
            'source_url:url',            
            'tag',
            'color',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
