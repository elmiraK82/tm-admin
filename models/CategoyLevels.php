<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_levels".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $level_1
 * @property string $level_2
 * @property string $level_3
 * @property string $level_4
 * @property string $level_5
 * @property string $level_6
 * @property string $level_7
 * @property string $level_8
 */
class CategoyLevels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_levels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['level_1', 'level_2', 'level_3', 'level_4', 'level_5', 'level_6', 'level_7', 'level_8'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'level_1' => 'Categories',
            'level_2' => '',
            'level_3' => '',
            'level_4' => '',
            'level_5' => '',
            'level_6' => '',
            'level_7' => '',
            'level_8' => '',
        ];
    }
    
     /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        
        if (($model = CategoyLevels::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
