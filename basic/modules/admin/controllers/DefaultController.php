<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\Ingredients;
use app\modules\admin\models\IngredientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
