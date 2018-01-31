<?php
/**
 * Created by PhpStorm.
 * User: админ
 * Date: 11.09.2017
 * Time: 11:04
 */

namespace frontend\controllers;

use common\models\Deal;
use common\models\Review;
use common\models\SectionService;
use Yii;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\Request;
use common\models\Product;
use common\models\Resume;
use common\models\Vacancy;
use common\models\Directory;
use yii\web\UploadedFile;
use dosamigos\transliterator\TransliteratorHelper;
use common\models\Message;
use common\models\Notice;


class UserController extends Controller
{
    public function actionMyList($id, $type)
    {
        switch ($type) {
            case 'service' :
                $title = 'Мои заявки';
                $data = Request::find()->where(['user_id' => $id])->all();
                $thead = ['Заголовок', 'Опубликовано', 'Статус', ''];
                $columns = ['short_description', 'publish', 'status'];
                $link_edit = 'service/update';
                $link_view = 'service/view';
                break;
            case 'product' :
                $title = 'Мои товары';
                $data = Product::find()->where(['user_id' => $id])->all();
                $thead = ['Заголовок', 'Опубликовано', 'Статус', ''];
                $columns = ['short_description', 'publish', 'status'];
                $link_edit = 'product/edit';
                $link_view = 'product/view';
                break;
            case 'resume' :
                $title = 'Мои резюме';
                $thead = ['Категория', 'Должность', 'Статус', ''];
                $columns = ['category', 'post', 'status'];
                $data = Resume::find()->where(['user_id' => $id])->all();
                $link_edit = 'work/edit-resume';
                $link_view = 'work/view-resume';
                break;
            case 'vacancy' :
                $title = 'Мои вакансии';
                $thead = ['Компания', 'Должность', 'Город', 'Статус', ''];
                $columns = ['name', 'post', 'city', 'status'];
                $data = Vacancy::find()->where(['user_id' => $id])->all();
                $link_edit = 'work/edit-job';
                $link_view = 'work/view-job';
                break;
        }

        $this->view->title = $title;
        if (Yii::$app->request->get('delete')) {
            switch (Yii::$app->request->get('type')) {
                case 'service' :
                    $item = Request::findOne(Yii::$app->request->get('delete'));
                    $item->delete();
                    $this->redirect(Yii::$app->request->referrer);
                    break;
                case 'product':
                    $item = Product::findOne(Yii::$app->request->get('delete'));
                    $item->delete();
                    $this->redirect(Yii::$app->request->referrer);
                    break;
                case 'resume':
                    $item = Resume::findOne(Yii::$app->request->get('delete'));
                    $item->delete();
                    $this->redirect(Yii::$app->request->referrer);
                    break;
                case 'vacancy' :
                    $item = Vacancy::findOne(Yii::$app->request->get('delete'));
                    $item->delete();
                    $this->redirect(Yii::$app->request->referrer);
                    break;
                default :
                    return $this->render('my-list', compact('data', 'thead', 'columns', 'link_edit', 'link_view', 'type', 'id'));
            }
        }
        else {
            return $this->render('my-list', compact('data', 'thead', 'columns', 'link_edit', 'link_view', 'type', 'id'));
        }
    }

    public function actionAccount()
    {
        $model = User::findOne(Yii::$app->user->identity->id);

        $sex = Directory::GetSex();
        $category = Directory::GetServiceCategory();
        $section = ArrayHelper::map(SectionService::find()->select(['id', 'name'])->asArray()->all(), 'id', 'name');
        $organization_form = Directory::GetOrganizationForm();
        $region = Directory::GetRegion();
        $day_list = Directory::GetListDay();
        $month_list = Directory::GetListMonth();
        $year_list = Directory::GetListYear();
        $city = Directory::GetCity();
        $notice = Directory::GetNotice();
        $activity_data = unserialize($model->activity_data);
        $personal_data = unserialize($model->personal_data);

        $userNotice = Notice::find()->select('notice')->where(['user_id' => Yii::$app->user->identity->id])->asArray()->all();

        $model->notice = ArrayHelper::getColumn($userNotice, 'notice');

        //$message = Message::find()->select('user_id_from, text, publish, attachment')->where(['user_id_to' => $id])->all();

        $model->sex = $personal_data['sex'];
        $model->organization_form = $activity_data['organization_form'];
        $model->day = $personal_data['day'];
        $model->month = $personal_data['month'];
        $model->year = $personal_data['year'];
        $model->name = $personal_data['name'];
        $model->surname = $personal_data['surname'];
        $model->street = $personal_data['street'];
        if ($model->load(Yii::$app->request->post())) { //Если пришли данные
            $model->foto = UploadedFile::getInstance($model, 'foto');
            $age = User::getAge($model->year, $model->month, $model->day);
            //$model->foto = $model->thumbnail ? TransliteratorHelper::process($model->thumbnail->name, '', 'en') : $model->foto;
            if ($model->notice) {
                if (ArrayHelper::getColumn($userNotice, 'notice') !== $model->notice) {
                    Notice::deleteAll(['user_id' => $model->id]);
                    User::InsertNotice($model->notice, $model->id);
                }
            }
            $activity_data = [
                'UNN' => $model->UNN,
                'legal_address' => $model->legal_address,
                'activity' => $model->activity,
                'organization_form' => $model->organization_form,
            ];

            $personal_data = [
                'actual_address' => $model->actual_address,
                'name' => $model->name,
                'surname' => $model->surname,
                'age' => $age,
                'sex' => $model->sex,
                'url_social_network' => $model->url_social_network,
                'category' => $model->category,
                'region' => $model->region,
                'street' => $model->street,
                'day' => $model->day,
                'month' => $model->month,
                'year' => $model->year,
                'thumbnail' => $model->foto ? TransliteratorHelper::process($model->foto->name, '', 'en') : $personal_data['thumbnail'],
            ];

            if ($model->thumbnail) {
                array_push($personal_data, array('thumbnail' => TransliteratorHelper::process($model->foto->name, '', 'en')));
            }

            $model->activity_data = serialize($activity_data);
            $model->personal_data = serialize($personal_data);
            $model->nicename = $model->surname . ' ' . $model->name;

            $model->save();
            if ($model->foto) {
                $model->upload();
            }
        }

        return $this->render('account', compact('model', 'category', 'sex',
            'organization_form', 'region', 'day_list', 'month_list', 'year_list', 'activity_data', 'personal_data', 'city', 'message', 'notice', 'section'));
    }

    public function actionUserInfo($user_id)
    {

        $user = User::findOne($user_id);
        $rating = User::GetRatingAVG($user_id); //Средний рейтинг
        $count = Deal::find()->where(['contractor_id' => $user_id])->count();//Количество выполненны работ
        $reviews = User::GetReview($user_id);
        $personal_data = unserialize($user['personal_data']);
        $age = User::getAge($personal_data['year'], $personal_data['month'], $personal_data['day']);
        $typesOfWork = User::GetTypesOfWork($user_id);
        $this->view->title = $user->nicename;
        return $this->render('user-info', compact('user', 'rating', 'count', 'reviews', 'personal_data', 'age', 'typesOfWork'));
    }

    public function actionSendMessage($user_from, $user_to)
    {

        $model = new Message();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'attachment');
            if ($model->file) {
                $model->attachment = TransliteratorHelper::process($model->file->name, '', 'en');
            }
            $model->publish = date('Y-m-d H:i:s');
            $model->user_id_from = $user_from;
            $model->user_id_to = $user_to;
            $model->save();

            if ($model->file) {
                $model->upload();
            }
        }

        return $this->render('send-message', compact('model'));
    }

    public function actionMessageList ($user_id){

        $mesages = Message::find()->where(['user_id_to' => $user_id])->all();
        print_r (Message::hasMessage($user_id));
        return $this->render('message-list', compact('mesages'));
    }
}