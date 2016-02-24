<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\ArrayHelper;
use app\models\Categories;
use app\models\CategoyLevels;

$topCats = ArrayHelper::map(Categories::findAll(['parent_id'=>'0']), 'id', 'name');
$levels =  CategoyLevels::find()->where(['product_id' => $model->id])->one();
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>    
          
    <?php echo $form->field($model, 'img_url')->textInput(['maxlength' => true, 'id'=>'tagUrl']) ?>  
    
    <?php echo $form->field($model, 'source_url')->textInput(['readonly'=> true ]) ?>  

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
     <!--<input name="tags" id="singleFieldTags2" value="Apple, Orange">-->

    <?php echo $form->field($model, 'tag')->textInput(['maxlength' => true, 'id'=>'tagValues']) ?>

    <?php echo $form->field($model, 'color')->textInput(['maxlength' => true, 'id'=> 'colorPickerFull' ]) ?>
    
    <?php echo $form->field($modelCatlevels, 'product_id')->hiddenInput()->label(false);  ?>
   
    <div id="categories">
    <?php
     //var_dump( $levels->level_2 );
     
     echo $form->field($modelCatlevels, 'level_1')
            ->dropDownList(
                $topCats,
                [
                    
                    'prompt' => ' --- Level 1 --- ',
                    'id' => 'level-1',
                    'class' => 'form-control products subs-of-0',
                    'name'=>'CategoryLevels[level_1]',
                    'onchange'=> 'showUser(this.value, "level-1")',
                    
                ]
            );
     
   
    ?>
    
    </div>
    
    <div class="loader">
        <?php echo Html::img('@web/images/ajax_loading.gif', ['class' => 'img-loader']); ?>
    </div>
    
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
   
    
    <script type="text/javascript">
        
          function showUser(catId, selId) {
               
               jQuery(".img-loader").show();
               
                var idNumber = selId.split("-").pop();
                idNumber = parseInt(idNumber);
                
                if( jQuery.isNumeric( catId )){
                   
                    for (var i = idNumber+1; i <= 8; i++){                        
                        jQuery("#level-"+i).parent('.form-group').remove();
                    }                 
                   
                    jQuery.ajax({
                        type: 'POST',
                        url : '<?php echo Yii::$app->homeUrl; ?>' + 'categories/ajax',
                        data : {category_id: catId, nextLevel: idNumber+1 },
                        success : function(response) {
                            var subsOf = jQuery('.subs-of-'+catId);
                            if( !subsOf.length ){ //dont append if already appended
                                jQuery("#categories").append(response);
                                jQuery(".img-loader").hide();
                            }
                            
                        },
                    });
                
                }else{
                    
                    for (var i = idNumber+1; i <= 8; i++){                        
                        jQuery("#level-"+i).parent('.form-group').remove();
                        jQuery(".img-loader").hide();
                    } 
                    
                }
           }
    </script>
</div>
