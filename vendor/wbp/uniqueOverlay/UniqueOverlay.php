<?php
/**
 * @link http://www.webpassion.com.ua/
 * @copyright Copyright (c) 2014 Pavel Chernetsky
 */

namespace wbp\uniqueOverlay;

/**
* @author Pavel Chernetsky <pavel.chernetsky@gmail.com>
 */

use Yii;
use yii\base\Widget;

class UniqueOverlay extends Widget{

    public $htmlClass,$url,$isSourceLink;

    public static function body($content=''){

        $result = '
            <!-- UniqueOverlay -->

                <div class="UniqueLightboxOpener"></div>
                <div class="UniqueLightbox">
                    <div id="ajaxOverlayResult">'.$content.'</div>
                    <div id="ajaxOverlayResultHidden" style="display: none;"></div>
                </div>

            <!-- ///////////////////////// -->
        ';

        if($content) $result .= '<script>uniqueOverlayOpen=true;</script>';

        return $result;
    }

    public static function script($historyOnClose=false,$absolutePosition=false){

        return '
            <script>
//                $(function(){
                    historyOnClose=\''.$historyOnClose.'\';
                    absolutePosition='.(int)$absolutePosition.';
                    if(uniqueOverlay){
                        if(uniqueOverlay.isOpened()) {
                            uniqueOverlay.close();
                            setTimeout(function () {
                                changeOverlayBlock();
                                $(\'.UniqueLightboxOpener\').click()
                            }, 300);
                        } else {
                            changeOverlayBlock();
                            $(\'.UniqueLightboxOpener\').click();
                        }
                    }
//                })
            </script>
        ';
    }

    public function run(){

        UniqueOverlayAsset::register($this->getView());

        $class=$this->htmlClass;
        if(is_array($class)) $class=implode(' ',$class);

        $href="href";
        if($this->isSourceLink) $href="data-ajax-source";

        return " class='ajax ".$class."' data-_csrf='".Yii::$app->request->csrfToken."' ".$href."='".Yii::$app->urlManager->createUrl($this->url)."' data-ajax-target='#ajaxOverlayResultHidden' ";
    }

}