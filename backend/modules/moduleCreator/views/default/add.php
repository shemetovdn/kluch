<?

$this->title='Add New Module';

$this->params['breadcrumbs'][] = ['label' => 'Modules', 'url' => ['/moduleCreator/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="heading-buttons">
    <h3><?=$this->title?><span> | Modules</span></h3>

    <div class="clearfix"></div>
</div>

<div class="separator bottom"></div>

<div class="innerLR">

    <?=$form?>

</div>
