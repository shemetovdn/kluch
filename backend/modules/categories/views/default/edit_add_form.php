<?

$form = \yii\widgets\ActiveForm::begin(['options' => ['id' => 'editForm']]); ?>


<div class="widget">
    <div class="widget-head">
        <h4 class="heading glyphicons circle_info"><i></i>Basic info</h4>
    </div>

    <div class="widget-body">

        <div class="row">

            <!-- Column -->
            <div class="col-md-3">
                <strong>Item <?= $formModel->getAttributeLabel('title') ?></strong>
            </div>
            <!-- // Column END -->

            <?= $form
                ->field($formModel, 'title', [
                    'options' => [
                        'class' => 'col-md-9'
                    ]
                ])
                ->textInput()
            ?>

            <div class="col-md-3">
                <strong><?= $formModel->getAttributeLabel('href') ?></strong>
            </div>

            <?= $form
                ->field($formModel, 'href', [
                    'options' => [
                        'class' => 'col-md-9'
                    ]
                ])
                ->textInput(['readonly' => true])
            ?>

            <div class="separator bottom"></div>
        </div>

        <div class="row separator bottom">

            <!-- Column -->
            <div class="col-md-3">
                <strong><?= $formModel->getAttributeLabel('status') ?></strong>
                <p class="muted">Active / Inactive product</p>
            </div>
            <!-- // Column END -->
            <?= $form
                ->field($formModel, 'status', [
                    'options' => [
                        'style' => 'display:none;',
                    ]
                ])
                ->hiddenInput(['value' => 0])
                ->label(false)
            ?>
            <?= $form
                ->field($formModel, 'status', [
                    'options' => [
                        'class' => 'col-md-9'
                    ]
                ])
                ->checkbox([
                    'label' => '',
                    'labelOptions' => [
                        'class' => "make-switch",
                        "data-on" => "success",
                        "data-off" => "danger"
                    ]
                ])->label("");
            ?>

            <div class="col-md-12">

                <div class="buttons pull-right">
                    <?= \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>

            </div>

            <div class="separator bottom"></div>

        </div>

    </div>
</div>

<div class="separator bottom"></div>

<? \yii\widgets\ActiveForm::end(); ?>
