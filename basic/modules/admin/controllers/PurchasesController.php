<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Purchases;
use app\modules\admin\models\PurchasesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\modules\admin\models\Ingredientshasprovider;
/**
 * PurchasesController implements the CRUD actions for Purchases model.
 */
class PurchasesController extends Controller
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
     * Lists all Purchases models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PurchasesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Purchases model.
     * @param int $id ID заказа
     * @param int $ingredients_has_provider_ingredients_id Ингредиент
     * @param int $ingredients_has_provider_provider_id Поставщик
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $ingredients_has_provider_ingredients_id, $ingredients_has_provider_provider_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $ingredients_has_provider_ingredients_id, $ingredients_has_provider_provider_id),
        ]);
    }

    /**
     * Creates a new Purchases model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Purchases();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect([
                  'view', 'id' => $model->id,
                  'ingredients_has_provider_ingredients_id' => $model->ingredients_has_provider_ingredients_id,
                  'ingredients_has_provider_provider_id' => $model->ingredients_has_provider_provider_id
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Purchases model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID заказа
     * @param int $ingredients_has_provider_ingredients_id Ингредиент
     * @param int $ingredients_has_provider_provider_id Поставщик
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $ingredients_has_provider_ingredients_id, $ingredients_has_provider_provider_id)
    {
        $model = $this->findModel($id, $ingredients_has_provider_ingredients_id, $ingredients_has_provider_provider_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'ingredients_has_provider_ingredients_id' => $model->ingredients_has_provider_ingredients_id, 'ingredients_has_provider_provider_id' => $model->ingredients_has_provider_provider_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Purchases model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID заказа
     * @param int $ingredients_has_provider_ingredients_id Ингредиент
     * @param int $ingredients_has_provider_provider_id Поставщик
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $ingredients_has_provider_ingredients_id, $ingredients_has_provider_provider_id)
    {
        $this->findModel($id, $ingredients_has_provider_ingredients_id, $ingredients_has_provider_provider_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Purchases model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID заказа
     * @param int $ingredients_has_provider_ingredients_id Ингредиент
     * @param int $ingredients_has_provider_provider_id Поставщик
     * @return Purchases the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $ingredients_has_provider_ingredients_id, $ingredients_has_provider_provider_id)
    {
        if (($model = Purchases::findOne(['id' => $id, 'ingredients_has_provider_ingredients_id' => $ingredients_has_provider_ingredients_id, 'ingredients_has_provider_provider_id' => $ingredients_has_provider_provider_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
