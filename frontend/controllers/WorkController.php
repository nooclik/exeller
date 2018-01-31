<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 13.08.2017
 * Time: 14:21
 */

namespace frontend\controllers;

use common\models\CategoryWork;
use yii\web\Controller;
use common\models\Resume;
use common\models\Vacancy;
use common\models\Directory;
use common\models\User;
use Yii;
use frontend\models\ResumeSearch;
use yii\helpers\ArrayHelper;
use frontend\models\VacancySearch;


class WorkController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create-resume', 'create-job', 'delete'],
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

    public function actionCreateResume()
    {
        $model = new Resume();
        $education = Directory::GetEducation();
        $sex = Directory::GetSex();
        $category = Directory::GetWorkCategory();
        $city = Directory::GetCity();
        $year = Directory::GetListYear();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $institution = array(
                'place_study' => $model->place_study,
                'faculty' => $model->faculty,
                'speciality' => $model->speciality,
                'year' => $model->year,
            );
            $model->institution = serialize($institution);
            $model->skills = serialize($model->skills);

            $model->save();
        }
        return $this->render('create-resume', compact('model', 'education', 'sex', 'category', 'city', 'year'));
    }

    public function actionCreateJob()
    {
        $model = new Vacancy();
        $company_type = Directory::GetCompanyType();
        $category = Directory::GetWorkCategory();
        $city = Directory::GetCity();
        $post = Directory::GetWorkPost();

        if ($model->load(\Yii::$app->request->post())) {
            $model->status = Vacancy::STATUS_ACTIVE;
            $model->publish = date('Y-m-d H:i:s');
            $detail = array(
                'type' => $model->type,
                'sait' => $model->sait,
                'description' => $model->full_description,
                'email' => $model->email,
                'phone' => $model->phone,
                'contact_person' => $model->contact_person,
                'charge' => $model->charge,
            );
            $model->user_id = \Yii::$app->user->identity->id;
            $model->description = serialize($detail);
            $model->save();
        }

        return $this->render('create-job', compact('model', 'category', 'company_type', 'city', 'post'));
    }

    public function actionJobList()
    {
        $modelSearch = new VacancySearch();
        $dataProvider = $modelSearch->search(Yii::$app->request->queryParams);

        $category = ArrayHelper::map(
            Vacancy::find()->select('vacancy.category as id ,category_work.name as name')
                ->joinWith('categorys')->distinct()->all(), 'id', 'name'
        );

        $city = ArrayHelper::map(
            Vacancy::find()->select('city')->all(), 'city', 'city'
        );
        $minPrice = Vacancy::find()->min('price');
        $post = ArrayHelper::map(
            Vacancy::find()->select('name')->all(), 'name', 'name'
        );

        return $this->render('job-list', compact('modelSearch', 'dataProvider', 'category', 'city', 'minPrice', 'post'));
    }

    public function actionViewJob()
    {
        $data = Vacancy::findOne(\Yii::$app->request->get('id'));
        $detail = unserialize($data->description);

        switch (\Yii::$app->request->get('action')) {
            case 'close' :
                $data->status = Vacancy::STATUS_CLOSE;
                $data->update();
                $this->redirect(\Yii::$app->request->referrer);
                break;
            case 'activate':
                $data->status = Vacancy::STATUS_ACTIVE;
                $data->update();
                $this->redirect(\Yii::$app->request->referrer);
                break;
            default :
                return $this->render('view-job', compact('data', 'detail'));
        }
    }

    public function actionViewResume()
    {
        $data = Resume::findOne(\Yii::$app->request->get('id'));
        $user = User::findOne($data->user_id);
        $skills = unserialize($data->skills);

        $thumbnail = unserialize($user->personal_data)['thumbnail'];

        if ($data->institution) $institution = unserialize($data->institution);
        $category = CategoryWork::findOne($data->category)->name;
        switch (\Yii::$app->request->get('action')) {
            case 'close' :
                $data->status = Resume::STATUS_CLOSE;
                $data->update();
                $this->redirect(\Yii::$app->request->referrer);
                break;
            case 'activate':
                $data->status = Resume::STATUS_ACTIVE;
                $data->update();
                $this->redirect(\Yii::$app->request->referrer);
                break;
            default :
                return $this->render('view-resume', compact('data', 'user', 'institution', 'skills', 'thumbnail', 'category'));
        }
    }

    public function actionResumeList()
    {
        $searchModel = new ResumeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $category = ArrayHelper::map(
            Resume::find()->select('resume.category as id, category_work.name as name')
                ->joinWith('categorys')->distinct()->all(), 'id', 'name'
        );
        $city = ArrayHelper::map(
            Resume::find()->select('city')->all(), 'city', 'city'
        );

        $education = Directory::GetEducation();
        $sex = Directory::GetSex();
        $minAge = Resume::find()->min('age');
        $maxAge = Resume::find()->max('age');
        $minExperience = Resume::find()->min('experience');
        $maxExperience = Resume::find()->max('experience');
        /*
        $category_all = Resume::find()->select('category')->orderBy('category')->all();
        $categorys = (array_unique(ArrayHelper::getColumn($category_all, 'category')));

        $city_all = Resume::find()->select('city')->orderBy('city')->all();
        $citys = (array_unique(ArrayHelper::getColumn($city_all, 'city')));

        $education_all = Resume::find()->select('education')->orderBy('education')->asArray()->all();
        $educations = (array_unique(ArrayHelper::getColumn($education_all, 'education')));

        if (\Yii::$app->request->get('category')) {
            $data = Resume::find()->orderBy(['publish' => SORT_DESC])->where(['category' => \Yii::$app->request->get('category')])->all();
        } elseif (\Yii::$app->request->get('city')) {
            $data = Resume::find()->orderBy(['publish' => SORT_DESC])->where(['city' => \Yii::$app->request->get('city')])->all();
        } elseif (\Yii::$app->request->get('education')) {
            $data = Resume::find()->orderBy(['publish' => SORT_DESC])->where(['education' => \Yii::$app->request->get('education')])->all();
        } else {
            $data = Resume::find()->orderBy(['publish' => SORT_DESC])->all();
        }

        return $this->render('resume-list', compact('data', 'categorys', 'citys', 'educations'));
        */

        return $this->render('resume-list', compact('searchModel', 'dataProvider', 'category', 'city',
            'education', 'sex', 'minAge', 'minExperience'));
    }

    public function actionEditResume()
    {
        $category = Directory::GetWorkCategory();
        $city = Directory::GetCity();
        $education = Directory::GetEducation();
        $sex = Directory::GetSex();
        $year = Directory::GetListYear();


        $model = Resume::findOne(\Yii::$app->request->get('id'));
        $model->skills = unserialize($model->skills);
        $institut = unserialize($model->institution);
        $model->place_study = $institut['place_study'];
        $model->faculty = $institut['faculty'];
        $model->speciality = $institut['speciality'];
        $model->year = $institut['year'];

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $institution = array(
                'place_study' => $model->place_study,
                'faculty' => $model->faculty,
                'speciality' => $model->speciality,
                'year' => $model->year,
            );
            $model->institution = serialize($institution);
            $model->skills = serialize($model->skills);

            $model->save();
        }

        return $this->render('edit-resume', compact('model', 'category', 'sex', 'city', 'education', 'year'));
    }

    public function actionEditJob()
    {

        $model = Vacancy::findOne(\Yii::$app->request->get('id'));
        $company_type = Directory::GetCompanyType();
        $category = Directory::GetWorkCategory();
        $city = Directory::GetCity();
        $post = Directory::GetWorkPost();

        if ($model->load(\Yii::$app->request->post())) {
            $detail = array(
                'type' => $model->type,
                'sait' => $model->sait,
                'description' => $model->full_description,
                'email' => $model->email,
                'phone' => $model->phone,
                'contact_person' => $model->contact_person,
                'charge' => $model->charge,
            );
            $model->description = serialize($detail);
            $model->save();
        }

        return $this->render('edit-job', compact('model', 'category', 'company_type', 'city', 'post'));
    }
}