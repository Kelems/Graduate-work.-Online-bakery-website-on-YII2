<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\IngredientHasProduct;
use app\modules\admin\searchs\IngredienthasproductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IngredienthasproductController implements the CRUD actions for IngredientHasProduct model.
 */
class IngredienthasproductController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all IngredientHasProduct models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IngredienthasproductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IngredientHasProduct model.
     * @param int $ingredient_id Ingredient ID
     * @param int $product_id Product ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ingredient_id, $product_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($ingredient_id, $product_id),
        ]);
    }

    /**
     * Creates a new IngredientHasProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new IngredientHasProduct();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ingredient_id' => $model->ingredient_id, 'product_id' => $model->product_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing IngredientHasProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ingredient_id Ingredient ID
     * @param int $product_id Product ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ingredient_id, $product_id)
    {
        $model = $this->findModel($ingredient_id, $product_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ingredient_id' => $model->ingredient_id, 'product_id' => $model->product_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IngredientHasProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ingredient_id Ingredient ID
     * @param int $product_id Product ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ingredient_id, $product_id)
    {
        $this->findModel($ingredient_id, $product_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IngredientHasProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ingredient_id Ingredient ID
     * @param int $product_id Product ID
     * @return IngredientHasProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ingredient_id, $product_id)
    {
        if (($model = IngredientHasProduct::findOne(['ingredient_id' => $ingredient_id, 'product_id' => $product_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
