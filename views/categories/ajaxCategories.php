<?php

if ( !empty($categories)) {
    
    $request = Yii::$app->request;
    $catID = $request->post('category_id'); 
    $level = $request->post('nextLevel'); 
        
    $levelID = "level_".$level;
    $selId = '"level-'.$level.'"';
    echo '<div class="form-group">';
        echo "<select id='level-".$level."' class='form-control products subs-of-".$catID." ' name='CategoryLevels[".$levelID."]'  onchange='showUser(this.value, ".$selId.")'>";
        echo "<option value=''> --- Level ". $level ." --- </option>";  
        foreach ($categories as $key => $value) {
            echo "<option value='".$key."'>". $value ."</option>";  
            
        }
        echo "</select>";
    echo '</div>';
}