<?php
/**
 * Created by PhpStorm.
 * User: ЗС
 * Date: 09.06.2017
 * Time: 14:09
 */

namespace frontend\models;


use yii\helpers\Html;

class LinkPager extends \yii\widgets\LinkPager
{

    /**
     * Renders the page buttons.
     * @return string the rendering result
     */
    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
        }


        return Html::tag('ul', implode("\n", $buttons), $this->options);
    }


}