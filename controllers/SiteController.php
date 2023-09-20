<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Sionic\City;
use app\models\Sionic\Product;

class SiteController extends Controller
{

    const ROWS_PER_PAGE = 25;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $page = \Yii::$app->getRequest()->get('page', 1);
        $cities = City::find()->orderBy('id')->asArray()->all();
        $rows = Product::find()
                ->orderBy('id desc')
                ->limit(self::ROWS_PER_PAGE)
                ->offset(($page - 1) * self::ROWS_PER_PAGE)
                ->asArray()
                ->all();
        $count = Product::find()->count();
        $pages = new \yii\data\Pagination(['totalCount' => $count]);
        $params = [
            'cities' => $cities,
            'rows' => $rows,
            'count' => $count,
            'length' => self::ROWS_PER_PAGE,
            'pages' => $pages,
        ];
        return $this->render('index', $params);
    }
}
