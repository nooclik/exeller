<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 09.08.2017
 * Time: 14:29
 */

namespace frontend\controllers;

use frontend\models\SearchProduct;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\Product;
use common\models\Delivery;
use common\models\User;
use common\models\Directory;
use Yii;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $modelSearch = new SearchProduct();
        $dataProvider = $modelSearch->search(Yii::$app->request->queryParams);

        $category = ArrayHelper::map(
            Product::find()->select('request_product.category as id ,category_product.name as name')
                ->joinWith('categorys')->distinct()->all(), 'id' , 'name'
        );

        return $this->render('index', compact('dataProvider', 'modelSearch', 'category'));
    }

    public function actionCreate()
    {
        $model = new Product();
        $delivery = Directory::GetDelivery();
        $condition = Directory::GetProductCondition();
        $category = Directory::GEtProductCategory();
        $model->condition = 'Новое';
        $model->delivery_id = '2';

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }

        return $this->render('create', compact('model', 'delivery', 'condition', 'category'));
    }

    public function actionView()
    {
        $product_id = \Yii::$app->request->get('id');
        $data = Product::findOne($product_id);
        $user = User::findOne($data->user_id);

        switch (\Yii::$app->request->get('action')) {
            case 'close':
                $data->status = Product::STATUS_CLOSE;
                $data->update();
                $this->redirect(\Yii::$app->request->referrer);
                break;
            case 'activate':
                $data->status = Product::STATUS_ACTIVE;
                $data->update();
                $this->redirect(\Yii::$app->request->referrer);
                break;
            default:
                return $this->render('view', compact('data', 'user'));
        }
    }

    public function actionUpdate()
    {
        $post_id = \Yii::$app->request->get('id');
        $model = Product::findOne($post_id);

        $shiping = Delivery::find()->all();
        $delivery = ArrayHelper::map($shiping, 'id', 'name');
        $category = Directory::GEtProductCategory();
        $condition = Directory::GetProductCondition();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $model->update();
            $this->redirect(['product/list']);
        }
        return $this->render('update', compact('model', 'delivery', 'category', 'condition'));
    }
}