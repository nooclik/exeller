<?php
$user = \common\models\User::findOne(Yii::$app->user->id);
$personal = unserialize($user['personal_data']);
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if ($personal['thumbnail']) : ?>
                    <img src="<?= '/frontend/web/uploads/thumbnail/'.$personal['thumbnail'] ?>" class="img-circle" alt="User Image"/>
                <?php endif; ?>
            </div>
            <div class="pull-left info">
                <p><?= $user->nicename ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
     /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Панель', 'icon' => 'dashboard ', 'url' => Yii::$app->homeUrl],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Услуги',
                        'icon' => 'briefcase',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Заявки', 'icon' => 'tasks', 'url' => ['request/index']],
                            ['label' => 'Рубрики', 'icon' => 'folder-o', 'url' => ['section-service/index']],
                            ['label' => 'Категории', 'icon' => 'folder-open', 'url' => ['category-service/index']],
                        ]
                    ],
                    [
                        'label' => 'Товары',
                        'icon' => 'shopping-cart',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Заявки', 'icon' => 'tasks', 'url' => ['product/index']],
                            ['label' => 'Категории', 'icon' => 'folder-open', 'url' => ['category-product/index']],
                        ]
                    ],
                    [
                        'label' => 'Работа',
                        'icon' => 'handshake-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Вакансии', 'icon' => 'user-o', 'url' => ['vacancy/index']],
                            ['label' => 'Резюме', 'icon' => 'file-text-o', 'url' => ['resume/index']],
                            ['label' => 'Категории', 'icon' => 'folder-open', 'url' => ['category-work/index']],
                        ]
                    ],
                    [
                        'label' => 'Справочники',
                        'icon' => 'archive',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Доставка', 'icon' => 'truck', 'url' => ['delivery/index']],
                            ['label' => 'Способы оплаты', 'icon' => 'cc-visa', 'url' => ['payment/index']],
                            ['label' => 'Города', 'icon' => 'building-o', 'url' => ['city/index']],
                        ]
                    ],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'users',
                        'url' => ['user/index'],
                    ],
                    [
                        'label' => 'Жалобы',
                        'icon' => 'comment-o',
                        'url' => '#',
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
