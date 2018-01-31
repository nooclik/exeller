<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 26.06.2017
 * Time: 20:41
 */

namespace frontend\controllers;

use common\models\User;
use Yii;
use common\models\Request;
use common\models\Payment;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\Deal;
use common\models\Review;
use common\models\Directory;
use yii\web\UploadedFile;
use dosamigos\transliterator\TransliteratorHelper;
use frontend\models\RequestSearch;

class ServiceController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
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

        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $city = ArrayHelper::map(
            Request::find()->select('city')->all(), 'city', 'city'
        );
        $category = ArrayHelper::map(
            Request::find()->select('request_service.category as id ,category_service.name as name')
                ->joinWith('category')->distinct()->all(), 'id' , 'name'
        );

        $minPrice = Request::find()->min('price');

        return $this->render('index', compact('searchModel', 'dataProvider', 'city', 'category', 'minPrice'));
    }

    public function actionCreate()
    {
        $model = new Request();
        $model->payment_id = 1;
        $city = Directory::GetCity();

        $category = Directory::GetServiceCategory();
        $payment = ArrayHelper::map(Payment::find()->all(), 'id', 'name');
        $personal = unserialize(User::findOne(Yii::$app->user->id)->personal_data);
        $my_city = User::findOne(Yii::$app->user->id)->city;
        $my_street = $personal['street'];
        if ($my_city) $model->address = $personal['street'];
        if ($my_city) $model->city = $my_city;
        $model->date_to_time_before = 0;
        $model->date_to_time_after = 0;


        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->date_to_date_before = date('Y-m-d', strtotime($model->date_to_date_before));
            $model->thumnail = UploadedFile::getInstance($model, 'thumnail');
            $model->attachment = TransliteratorHelper::process($model->thumnail->name, '', 'en');
            $model->status = Request::STATUS_ACTIVE;
            $model->save();
            if ($model->thumnail) {
                $model->upload();
            }
            $this->redirect(['create', 'id' => $model->id]);
        }

        return $this->render('create', compact('model', 'payment', 'category', 'city', 'personal', 'my_city'));
    }

    public function actionView()
    {
        $deal = new Deal();
        $request_id = Yii::$app->request->get('id');
        $data = Request::findOne($request_id);
        $payment = Payment::findOne($data->payment_id);
        $candidates = $deal::find()->select('contractor_id, message, publish')->asArray()->where(['request_id' => $request_id])->orderBy(['publish'=>SORT_DESC])->all();

        //ЕСЛИ ВЫБРАН ИСПОЛНИТЕЛЬ
        if (\Yii::$app->request->get('contractor')) {
            $current_deal = Deal::find()->where(['request_id' => $data->id, 'contractor_id' => \Yii::$app->request->get('contractor')])->one();
            $d = Deal::findOne($current_deal->id);
            $data->status = Request::STATUS_SELECTED;
            $d->status = Request::STATUS_SELECTED;
            $d->update();
            $data->update();
        }
        //СОХРАНЯЕМ НОВУЮ СДЕЛКУ НА ВЫПОЛНЕНИЕ УСЛУГИ
        if ($deal->load(Yii::$app->request->post())) {
            $deal->customer_id = $data->user_id;
            $deal->contractor_id = Yii::$app->user->identity->id;
            $deal->request_id = $data->id;
            $deal->publish = date('Y-m-d H:i:s');
            $deal->save();
            $this->redirect(['service/request-list']);
        }
        //ЕСЛИ ВЫПОЛНЕНО ДЕЙСТВИЕ ПОЛЬЗОВАТЕЛЯ
        switch (Yii::$app->request->get('action')) {
            case 'unpublish' :
                $data->delete();
                $this->redirect(['service/request-list']);
                break;
            case 'close':
                $data->status = Request::STATUS_CLOSE;
                $data->update();
                $this->redirect(['view', 'id' => $data->id]);
                break;
            case 'publish':
                $data->status = Request::STATUS_ACTIVE;
                $data->update();
                $this->redirect(['view', 'id' => $data->id]);
                break;
            case 'publish':
                $data->status = Request::STATUS_ACTIVE;
                $data->update();
                $this->redirect(['view', 'id' => $data->id]);
                break;
            default :
                return $this->render('view', compact('data', 'payment', 'deal', 'candidates'));
        }
    }

    public function actionUpdate()
    {
        $model = Request::findOne(Yii::$app->request->get('id'));
        $payment = ArrayHelper::map(Payment::find()->all(), 'id', 'name');
        $category = Directory::GetServiceCategory();
        $city = Directory::GetCity();
        if ($model->date_to_date_before) $model->date_to_date_before = date('d.m.Y', strtotime($model->date_to_date_before));
        //if ($model->date_to_date_after) $model->date_to_date_after = date('d.m.Y', strtotime($model->date_to_date_after));

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->thumnail = UploadedFile::getInstance($model, 'thumnail');
            $model->date_to_date_before = date('Y-m-d', strtotime($model->date_to_date_before));
            //$model->date_to_date_after = date('Y-m-d', strtotime($model->date_to_date_after));
            //$data->attachment = TransliteratorHelper::process($data->thumnail->name, '', 'en');
            $model->attachment = $model->thumnail ? TransliteratorHelper::process($model->thumnail->name, '', 'en') : $model->attachment;
            $model->save();
            if ($model->thumnail) {
                $model->upload();
            }
            $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', compact('model', 'payment', 'category', 'city'));
    }

    public function actionDelete()
    {
        $request = Request::findOne(Yii::$app->request->get('id'));
        $request->delete();
        $this->redirect(['service/request-my-list']);
    }

    public function actionClose($request_id)
    {
        $data = Request::findOne($request_id);
        $deal = Deal::find()->where(['request_id' => $request_id, 'status' => Request::STATUS_SELECTED])->one();
        $contractor = User::findOne($deal->contractor_id);
        $model = new Review();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $model->publish = date('Y-m-d H:i:s');
            $model->save();

            $data->status = Request::STATUS_DONE;
            $data->save();

            $deal->status = Request::STATUS_DONE;
            $deal->update();

            $this->redirect(['user/my-list', 'id' => Yii::$app->user->id, 'type' => 'service']);
        }
        return $this->render('close', compact('data', 'contractor', 'model', 'speed'));
    }
}