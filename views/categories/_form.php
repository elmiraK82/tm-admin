<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Categories;
/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */

$parents = Categories::findAll(['parent_id'=>'0']);
$firsOption = ['0' => 'Select Parent' ];
$dropdowncats = Yii::$app->mycomponent->makeDropDown($parents);
$data = array_merge($firsOption, $dropdowncats);
?>

<div class="row">
    <div class="col-md-5">
        <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($model, 'name')->textInput() ?>

        <?php echo $form->field($model, 'parent_id')->dropDownList(
                    $data //$dataCategory,           // Flat array ('id'=>'label')

                );  ?>

        <div class="form-group">
            <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    

</div>
