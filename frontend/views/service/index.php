<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = 'Все заявки';
$this->params['breadcrumbs'][] = $this->title;
$date_after = '';
/*
$personal = unserialize(User::findOne(Yii::$app->user->id)->personal_data);
$address = str_replace($personal['street'], "+", "");
$city = Yii::$app->request->get('city') ? Yii::$app->request->get('city') : $user['city'];
$country = str_replace(" ", "+", "Беларусь");

$sUri = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address . ',+' . $city . ',+' . $country);
$sContent = file_get_contents($sUri);
$coord = json_decode($sContent);

$d = $coord->results;
foreach ($d as $rez) {
    $lat = $rez->geometry->location->lat;
    $lng = $rez->geometry->location->lng;
}

foreach ($data as $label) {
    $arr[] = [
        'location' => [
            'address' => $label->address,
            'city' => $label->city,
            'country' => 'Беларусь',
        ],
        'htmlContent' => '<h4>' . $label->short_description . '</h4><span class="label-category">' . $label->category . '</span><br><span class="label-date-after">' . date('d.m.y', strtotime($label->date_to_date_after)) . '<span><br><span>Цена: ' . $label->price . '</span><br><span>' . Html::a('Пререйти', ['view', 'id' => $label->id]) . '</span>',
    ];
}*/
?>
<?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('_filter', [
                'model' => $searchModel,
                'city' => $city,
                'category' => $category,
                'minPrice' => $minPrice,
            ]) ?>
        </div>
        <div class="col-md-9 col-item-list">
            <!--<div class="row row-search">
                <div class="col-md-12">
                    <input type="text" class="input-lg form-control" placeholder="Введите текст для поиска...">
                </div>
            </div>-->
            <div class="request-list_map">
                <?php /* echo yii2mod\google\maps\markers\GoogleMaps::widget([
                    'userLocations' => $arr,
                    'googleMapsUrlOptions' => [
                        'key' => 'AIzaSyBmRoDhBBmIB9bpXi4DJsPUJX9mVpe415o',
                        'language' => 'ru',
                        'version' => '3.1.18',
                        'region' => 'ru',
                    ],
                    'googleMapsOptions' => [
                        'mapTypeId' => 'roadmap',
                        'tilt' => 45,
                        'zoom' => 14,
                        'center' => ['lat' => $lat, 'lng' => $lng],
                    ],
                ]);*/
                ?>
            </div>
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_items',
                'layout' => "{pager}\n{items}\n{pager}",
            ]);
            ?>
        </div>
    </div>
<?php Pjax::end(); ?>