<?
echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'item-advart',
    'options' => [
        'tag' => 'ul',
        'class' => '',
        'id' => '',
    ],
    'layout' => "<ul class='catalog-effect' id='catalog-effect'>{items}</ul>
{summary}
                    <div class=\"catalog-pagination\">
\n{pager}
                    </div>

",
    'itemOptions' => [
        'tag' => 'li',
        'class' => 'catalog-item',
    ],
    'summary' => '<input type="hidden" id="summary" value="{totalCount}">',
    'summaryOptions' => [
        'tag' => 'span',
        'class' => 'my-summary'
    ],

    'pager' => [
        'firstPageLabel' => 'first',
        'lastPageLabel' => 'last',
        'prevPageLabel' => 'previous',
        'nextPageLabel' => 'next',
        'class'=>'\frontend\models\LinkPager',

        // Customzing options for pager container tag
        'options' => [

        ],
        'linkOptions' => [
            'data-pjax' => "false"
        ]
    ],
]);
?>

<?=$this->render('item-map')?>
