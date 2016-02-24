<?php

/*
* /protected/components/CommonMethods.php
*
*/

namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\Categories;


class CommonMethods extends Component{

    private $data = array();

    public function makeDropDown($parents)
    {
        
        global $data;
        $data = array();
        $children = array();
        foreach($parents as $parent){
            $data[$parent->id] = $parent->name;
            $children = Categories::findAll(['parent_id'=>$parent->id]);
            $this->subDropDown($children);
        }

        return $data;
    }


    public function subDropDown($children,$space = '-'){
        global $data;

        foreach($children as $child) {
            $data[$child->id] = $space.$child->name;
            $children = Categories::findAll(['parent_id'=>$child->id]);
            $this->subDropDown($children,$space.'-');
        }

    }
    
    public static function getHierarchy() {
        $options = [];
         
        $parents = Categories::find()->where("parent_id=0")->all();
        foreach($parents as $id => $p) {
            $children = Categories::find()->where("parent_id=:parent_id", [":parent_id"=>$p->id])->all();
            $child_options = [];
            foreach($children as $child) {
                $child_options[$child->id] = $child->name;
            }
            $options[$p->name] = $child_options;
        }
        return $options;
    }
    
    
    function getSourceUrl($urls){
      
        $img_array = explode(",", $urls);
        $url = $img_array[0]; //taking firs url for parse
        
        $parsedArray = parse_url($url);
        
        $host = $parsedArray['host'];
        
        return $host;
    }
    


}

?>
