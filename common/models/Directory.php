<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 18.08.2017
 * Time: 18:13
 */

namespace common\models;


use yii\helpers\ArrayHelper;

class Directory
{
    public static function Show($arr = array())
    {
        return '<pre>'.print_r($arr).'</pre>';
    }

    public static function GetWorkCategory()
    {
        $category = CategoryWork::find()->select(['id','name'])->asArray()->all();
        array_multisort($category);

        return ArrayHelper::map($category, 'id', 'name');
    }

    public static function GetSex()
    {
        $sex = [
            'Мужской' => 'Мужской',
            'Женский' => 'Женский'
        ];

        return $sex;
    }

    public static function GetEducation()
    {
        $education = [
            'Среднее' => 'Среднее',
            'Среднее срециальное' => 'Среднее срециальное',
            'Неоконченное высшее' => 'Неоконченное высшее',
            'Высшее' => 'Высшее',
        ];

        return $education;
    }

    public static function GetCompanyType()
    {
        $company_type = [
            'ООО' => 'ООО',
            'ОДО' => 'ОДО',
            'ЗАО' => 'ЗАО',
            'ОАО' => 'ОАО',
            'ИП' => 'ИП',
            'УП' => 'УП',
            'Иностр. п.' => 'Иностр. п.',
            'Совместн. п.' => 'Совместн. п.',
            'Обществ. объед.' => 'Обществ. объед.',
            'Фонд' => 'Фонд',
            'АО' => 'АО',
            'ПАО' => 'ПАО',
            'Другое' => 'Другое',
        ];

        return $company_type;
    }

    public static function GetCity()
    {
        $city = City::find()->select('name')->all();

        return ArrayHelper::getColumn($city, 'name');
    }

    public static function GetWorkPost (){
        $post = [
            'Системный администратор',
            'Бухгалтер',
        ];

        return $post;
    }


    public static function GetProductCondition(){
        $condition = [
            'Новое' => 'Новое',
            'Поддержаное' => 'Поддержаное'
        ];

        return $condition;
    }

    public static function GetDelivery(){

        $delivery = Delivery::find()->all();
        return ArrayHelper::map($delivery, 'id', 'name');
    }

    public static function GetProductCategory(){
        $category = CategoryProduct::find()->select(['id', 'name'])->asArray()->all();
        array_multisort($category);

        return ArrayHelper::map($category, 'id', 'name');
    }

    public static function GetServiceCategory(){

        $sections = SectionService::find()->select(['id', 'name'])->where(['disabled' => 0])->asArray()->all();
        $list = array();

        foreach ($sections as $section) {
            $category = CategoryService::find()->select(['id', 'name'])->where(['section_id' => $section['id'], 'disabled' => 0])->asArray()->all();
                $list[$section['name']] = ArrayHelper::map($category, 'id', 'name');
        }
        return $list;
    }

    public static function GetOrganizationForm(){
        $form = [
            'Физичекое лицо' => 'Физичекое лицо',
            'Юридическое лицо' => 'Юридическое лицо',
        ];

        return $form;
    }

    public static function GetRegion(){
        $region = [
            'Брестская' => 'Брестская',
            'Витебская' => 'Витебская',
            'Гомельская' => 'Гомельская',
            'Гродненская' => 'Гродненская',
            'Минская' => 'Минская',
            'Могилевская' => 'Могилевская',
        ];
        return $region;
    }

    public static function GetListDay(){
        for ($i = 1; $i<32; $i++) {
            $list[] = array($i => $i);
        }

        foreach ($list as $item) {
            foreach ($item as $day) {
                $days[] = $day;
            }
        }
        return $days;
    }
    public static function GetListMonth(){
       $months = [
           '01' => 'Январь',
           '02' => 'Февраль',
           '03' => 'Март',
           '04' => 'Апрель',
           '05' => 'Май',
           '06' => 'Июнь',
           '07' => 'Июль',
           '08' => 'Август',
           '09' => 'Сентябрь',
           '10' => 'Октябрь',
           '11' => 'Ноябрь',
           '12' => 'Декабрь',
       ];
        return $months;
    }
    public static function GetListYear(){

        for ($i = 1950; $i<date('Y'); $i++) {
            $list[] = array($i => $i);
        }

        foreach ($list as $item) {
            foreach ($item as $year) {
                $years[] = $year;
            }
        }
        array_multisort($years, SORT_DESC);
        return array_combine($years, $years);
    }

    public static function GetNotice(){
        $notice = ['Услуги' => 'Услуги','Товары' => 'Товары', 'Вакансии' => 'Вакансии', 'Резюме' => 'Резюме'];
        return $notice;
    }
}