<?
use yii\widgets\Pjax;

?>

    <?if($marking['separator_top']){?><hr class="separator bottom"><?}?>
    <div class="row">

        <!-- Column -->
        <div class="<?=$marking['greed_left_block']?>">
            <strong>In other languages</strong>
        </div>
        <!-- // Column END -->
        <div class="<?=$marking['greed_right_block']?>">
            <?Pjax::begin(['id' => $containerId]);?>
            <?
            foreach($select as $item){
            ?>
                <?=$item?>
            <?
            }
            ?>
            <?Pjax::end()?>
        </div>

        <div class="separator bottom"></div>

    </div>

    <?if($marking['separator_bottom']){?><hr class="separator bottom"><?}?>

<?
$this->registerJs(
    '
        var field = $(\'#'.$fieldName.'\');

        var '.$containerId.'Reload = function(){
            $.pjax({
                container: "#'.$containerId.'",
                data: {"lang_id":field.val()}
            });
        };

        field.on("change", function() {
            '.$containerId.'Reload();
        });
    '
);

if(!$lang_id){
    $this->registerJs(
    '
        $("document").ready(function(){
            '.$containerId.'Reload();
        });
    ');
}
?>