<?php

namespace app\models;

use Yii;
use app\models\Categories;
use app\models\CategoryIds;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $img_url
 * @property string $title
 * @property string $tag
 * @property string $color
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['img_url'], 'string'],
            [['source_url','title', 'tag', 'color'], 'string', 'max' => 255],
            [['img_url'], 'checkUrl'], 
        ];
    }
    
   

    public function checkUrl($attribute, $params)
    {
        $external_link = Yii::$app->request->post("Products");
        $img_str = $external_link['img_url'];
        $img_array = explode(",", $img_str);
        //var_dump($img_array); die;
        
        foreach ($img_array as $img) {
            if ( !@getimagesize($img) ) {
                $this->addError('img_url', $img.' image link is not valid');
            }
        }
            
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_url' => 'Img Url',
            'source_url' => 'Image Source',
            'title' => 'Title',
            'tag' => 'Tag',
            'color' => 'Color',
        ];
    }
    
   
    
    public function getCategory() {
        
        $model = new Categories();
        
        $cat = $model->getCategories();
        
        return $cat;
        
    }
}
