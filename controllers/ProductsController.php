<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use app\models\Categories;
use app\models\CategoyLevels;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;


/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index','create','update','view','delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],  
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $categoryLevels = new CategoyLevels; 
        $levelRow = CategoyLevels::find()->where(['product_id' => $id])->one();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'categoryLevels' => $levelRow
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        
        $modelCatlevels = new CategoyLevels; 
        
        if ($model->load(Yii::$app->request->post()) ) {
            
            $prods = Yii::$app->request->post('Products');
            
            $imgUrl = $prods['img_url'];
            $sourceUrl = Yii::$app->mycomponent->getSourceUrl($imgUrl);
            $model->source_url = $sourceUrl;            
            
            if ( $model->save() ){
                $producId = $model->id;
                $catIdsData = Yii::$app->request->post('CategoryLevels');           

                $modelCatlevels->product_id = $producId;

                $modelCatlevels->level_1 = isset($catIdsData['level_1']) ? $catIdsData['level_1'] : "NULL";
                $modelCatlevels->level_2 = isset($catIdsData['level_2']) ? $catIdsData['level_2'] : "NULL";
                $modelCatlevels->level_3 = isset($catIdsData['level_3']) ? $catIdsData['level_3'] : "NULL";
                $modelCatlevels->level_4 = isset($catIdsData['level_4']) ? $catIdsData['level_4'] : "NULL";
                $modelCatlevels->level_5 = isset($catIdsData['level_5']) ? $catIdsData['level_5'] : "NULL";
                $modelCatlevels->level_6 = isset($catIdsData['level_6']) ? $catIdsData['level_6'] : "NULL";
                $modelCatlevels->level_7 = isset($catIdsData['level_7']) ? $catIdsData['level_7'] : "NULL";
                $modelCatlevels->level_8 = isset($catIdsData['level_8']) ? $catIdsData['level_8'] : "NULL";

                if ( $modelCatlevels->save() ){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelCatlevels' => $modelCatlevels
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelCatlevels = new CategoyLevels;      
        
        $levelRow = CategoyLevels::find()->where(['product_id' => $id])->one();
        
        
        $sourceUrl = Yii::$app->mycomponent->getSourceUrl($model->img_url);
        $model->source_url = $sourceUrl;
        
        if ($model->load(Yii::$app->request->post()) ) {
            
            $prods = Yii::$app->request->post('Products');
            
            $imgUrl = $prods['img_url'];
            $sourceUrl = Yii::$app->mycomponent->getSourceUrl($imgUrl);
            $model->source_url = $sourceUrl;
            
            if ( $model->save() ){
                
                $catIdsData = Yii::$app->request->post('CategoryLevels');           

                $level1 = isset($catIdsData['level_1']) ? $catIdsData['level_1'] : "NULL";
                $level2 = isset($catIdsData['level_2']) ? $catIdsData['level_2'] : "NULL";
                $level3 = isset($catIdsData['level_3']) ? $catIdsData['level_3'] : "NULL";
                $level4 = isset($catIdsData['level_4']) ? $catIdsData['level_4'] : "NULL";
                $level5 = isset($catIdsData['level_5']) ? $catIdsData['level_5'] : "NULL";
                $level6 = isset($catIdsData['level_6']) ? $catIdsData['level_6'] : "NULL";
                $level7 = isset($catIdsData['level_7']) ? $catIdsData['level_7'] : "NULL";
                $level8 = isset($catIdsData['level_8']) ? $catIdsData['level_8'] : "NULL";

                if( $levelRow ){
                    Yii::$app->db->createCommand("UPDATE category_levels SET level_1=:L1, level_2=:L2, level_3=:L3, level_4=:L4, level_5=:L5, level_6=:L6, level_7=:L7, level_8=:L8 WHERE product_id=:id")
                    ->bindValues( array(':id'=>$id,':L1'=>$level1,':L2'=>$level2,':L3'=>$level3,':L4'=>$level4,':L5'=>$level5,':L6'=>$level6,':L7'=>$level7,':L8'=>$level8 ) )
                    ->execute();
                }else{
                    $modelCatlevels->product_id = $id;
                    $modelCatlevels->level_1 = $level1;
                    $modelCatlevels->level_2 = $level2;
                    $modelCatlevels->level_3 = $level3;
                    $modelCatlevels->level_4 = $level4;
                    $modelCatlevels->level_5 = $level5;
                    $modelCatlevels->level_6 = $level6;
                    $modelCatlevels->level_7 = $level7;
                    $modelCatlevels->level_8 = $level8;
                }
                            
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
            
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelCatlevels' => $modelCatlevels
            ]);
        }
    }

    
    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        $levelsModel = new CategoyLevels;
        $levelRow = CategoyLevels::find()->where(['product_id' => $id])->one();
        
        CategoyLevels::deleteAll('id='.$levelRow->id);
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
