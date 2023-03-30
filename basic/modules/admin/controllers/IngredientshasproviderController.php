<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Ingredientshasprovider;
use app\modules\admin\models\IngredientshasproviderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IngredientshasproviderController implements the CRUD actions for Ingredientshasprovider model.
 */
class IngredientshasproviderController extends Controller
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
     * Lists all Ingredientshasprovider models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IngredientshasproviderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ingredientshasprovider model.
     * @param int $ingredients_id Ingredients ID
     * @param int $provider_id Provider ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ingredients_id, $provider_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($ingredients_id, $provider_id),
        ]);
    }

    /**
     * Creates a new Ingredientshasprovider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ingredientshasprovider();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ingredients_id' => $model->ingredients_id, 'provider_id' => $model->provider_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ingredientshasprovider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ingredients_id Ingredients ID
     * @param int $provider_id Provider ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ingredients_id, $provider_id)
    {
        $model = $this->findModel($ingredients_id, $provider_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ingredients_id' => $model->ingredients_id, 'provider_id' => $model->provider_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ingredientshasprovider model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ingredients_id Ingredients ID
     * @param int $provider_id Provider ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ingredients_id, $provider_id)
    {
        $this->findModel($ingredients_id, $provider_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ingredientshasprovider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ingredients_id Ingredients ID
     * @param int $provider_id Provider ID
     * @return Ingredientshasprovider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ingredients_id, $provider_id)
    {
        if (($model = Ingredientshasprovider::findOne(['ingredients_id' => $ingredients_id, 'provider_id' => $provider_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
