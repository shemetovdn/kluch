<?php
return [
    'adminEmail' => 'admin@example.com',
    'ckeditor'=>[
//        'contentsCss'=>['/assets/7d97105a/css/style.css','/assets/7d97105a/css/ck_resetter_style.css'],
        'font_names' =>
            'Arial/Arial, Helvetica, sans-serif;'.
            'FiveMinutes/five_minutesregular;'.
            'Verdana/Verdana, Geneva, sans-serif',
        'colorButton_colors'=>'39464b,e61769,fabd2c,000,FFF',
        'preset'=>'full',
        'height'=>'250px',
        'inline'=>false,
    ],
    'listView'=>[
        'summary' => '<div class="dataTables_info">Показанны {begin}-{end} из {totalCount}</div>',
        'itemOptions' => ['tag'=>'tr','class'=>'selectable'],
        'pager'=> [
            'class'=>\yii\widgets\LinkPager::className(),
            'options'=>[
                'class'=>'pagination',
            ],
            'linkOptions'=>[
                'class'=>'page-link',
            ],
            'prevPageCssClass'=>'paginate_button page-item previous',
            'nextPageCssClass'=>'paginate_button page-item next',
            'pageCssClass'=>'paginate_button page-item',
            'nextPageLabel'=>'След.',
            'prevPageLabel'=>'Пред.',
            'disabledListItemSubTagOptions'=>[
                'class'=>'page-link',
            ],
            'registerLinkTags'=>true
        ],
        'itemView' => '_listItem',
    ]
];
