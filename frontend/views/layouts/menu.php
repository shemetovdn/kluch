<?php
use backend\modules\management\models\Management;
use yii\widgets\Menu;
use backend\modules\services\models\Services;
?>


<?= Menu::widget([
//    'items' => \frontend\helpers\CategoryMenu::getItems(),

    'items'=>[
        ['label'=>'Продажа недвижимости',
            'items'=>\backend\modules\objectTypes\models\ObjectTypes::getMenuItemsBuyCategory(),
            'template' => '<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><div class="menu-title"><p>{label}</p></div><span class="caret"></span></a>',

            'options'=>[
                'class'=>'dropdown',
            ]],
        ['label'=>'Аренда',
            'items'=>
                \backend\modules\objectTypes\models\ObjectTypes::getMenuItemsBuyLease(),
            'template' => '<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><div class="menu-title"><p>{label}</p></div><span class="caret"></span></a>',
            'options'=>[
                'class'=>'dropdown',
            ]],
        ['label'=>'Услуги',
            'items'=> Services::getMenuItemsForHeader(),
            'template' => '<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><div class="menu-title"><p>{label}</p></div><span class="caret"></span></a>',
            'options'=>[
                'class'=>'dropdown',
            ]],
        ['label'=>'Управление недвижимостью','url'=>Management::getUrlOnFirst(),
            'template' => '<a href="{url}"><div class="menu-title"><p>{label}</p></div></a>',

        ],
        ['label'=>'Партнёры','url'=>['site/partners'],
                    'template' => '<a href="{url}"><div class="menu-title"><p>{label}</p></div></a>',

        ],
        ['label'=>'Контакты','url'=>['site/contact'],
//            'template' => '<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><div class="menu-title"><p>{label}</p></div></a>',
            'template' => '<a href="{url}"><div class="menu-title"><p>{label}</p></div></a>',
        ],

    ],
    'submenuTemplate' => "\n<ul class='dropdown-menu'>\n{items}\n</ul>\n",
    'options'=>[
        'class'=>'nav',
    ],
    'linkTemplate' => '<a href="{url}"><span data-hover="{label}">{label}</span></a>',
]); ?>
