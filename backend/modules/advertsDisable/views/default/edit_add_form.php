<?
use backend\modules\adverts\models\Adverts;
use common\models\User;

$this->registerJs('
var timerId;
$(document).on(\'input\', \'#adverts-address\',function () {
        var city_id = $("#adverts-city_id").val();
        var city = $("#adverts-city_id").find("option:selected").text();
        var address = $("#adverts-address").val();
        
        if(city_id == 0){
        city = "";
        }
        clearTimeout(timerId);
         timerId = setTimeout(function(){
        $.ajax({
        url:"default/get-cordinates",
        type:"POST",
        data:"address="+city+" "+address+"&city="+city,
        success: function(data){
        data = data.split("|");

        GoogleMap_init(data[0], data[1]);
        
        $("#adverts-lat").val(data[0]);
        $("#adverts-lng").val(data[1]);
        }
        })
        }, 1000)
});  
      
      $(document).on(\'change\', \'#adverts-city_id\',function () {
        var city_id = $("#adverts-city_id").val();
        var city = $("#adverts-city_id").find("option:selected").text();
        var address = $("#adverts-address").val();
        
        if(city_id == 0){
        city = "";
        }
        clearTimeout(timerId);
         timerId = setTimeout(function(){
        $.ajax({
        url:"default/get-cordinates",
        type:"POST",
        data:"address="+city+" "+address,
        success: function(data){
        data = data.split("|");

        GoogleMap_init(data[0], data[1]);
        
        $("#adverts-lat").val(data[0]);
        $("#adverts-lng").val(data[1]);
        }
        })
        }, 1000)
});    
  
        // Google map
        
        
                  function GoogleMap_init (lat = $("#adverts-lat").val(), lng = $("#adverts-lng").val()) {
                  
                  if(!lat){
                  lat = 45.339956;
}
                  if(!lng){
                  lng = 34.506382;
}
                     var mapCanvas = document.getElementById(\'map-canvas\');

                     window.Map = new google.maps.Map(mapCanvas, {
                         zoom: 15,
                         center: new google.maps.LatLng(lat, lng, 15)
                     });

                     var baseMarker = new google.maps.Marker({
                         position: new google.maps.LatLng(lat, lng, 17),
                         animation: google.maps.Animation.DROP,
                         map: window.Map,
                         draggable: true
                     });

                     google.maps.event.addListener(baseMarker, \'dragend\', function (a,b,c,d) {

                     var coordinate = baseMarker.getPosition();
                            $("#adverts-lat").val(coordinate.lat);
                            $("#adverts-lng").val(coordinate.lng);

                     });

                 }

                 // Google Maps loading
                 var script = document.createElement(\'script\');
                 script.type = \'text/javascript\';
                 script.async = true;
                 script.src = \'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIPaMVi6Ld82YnqZi6PPF1-fdWo-27thc&language=ru&region=RU&sensor=false&callback=GoogleMap_init\';
                 document.body.appendChild(script);       
        
'
    , yii\web\View::POS_END);
?>


<? $form=\yii\bootstrap\ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "<div class=\"col-md-3\">\n{label}\n</div>\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'form-control-label',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-md-9',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>

<?= $form
    ->field($formModel, 'lat', [
        'options' => [
            'class' => 'col-md-9'
        ]
    ])
    ->hiddenInput()->label(false);
?>
<?= $form
    ->field($formModel, 'lng', [
        'options' => [
            'class' => 'col-md-9'
        ]
    ])
    ->hiddenInput()->label(false);
?>

<?php
    if($formModel->user_id){
        $user_id = $formModel->user_id;
        $user = $formModel->user;
    }else{
        $user_id = Yii::$app->user->id;
        $user = \common\models\User::findOne(Yii::$app->user->id);
    }
?>

<?= $form
    ->field($formModel, 'user_id', [
        'options' => [
        ]
    ])
    ->hiddenInput(['value' => $user_id])->label(false);
?>


<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="margin-bottom-50">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Тип объявления:</strong>
                                <h3><?php echo \backend\modules\categories\models\Category::findOne($formModel->category_id)->title;?></h3>
                                <?= $form
                                    ->field($formModel, 'category_id', [
                                        'options' => [
                                            'class' => 'col-md-9'
                                        ]
                                    ])
                                    ->hiddenInput()->label(false);
                                ?>
                            </div>
                            <?php
                            $object_type = \backend\modules\objectTypes\models\ObjectTypes::findOne($formModel->object_type_id);
                            ?>
                            <div class="col-md-6">
                                <strong>Тип Объекта:</strong>
                                <h3><?php echo $object_type->title;?></h3>
                                <?= $form
                                    ->field($formModel, 'object_type_id', [
                                        'options' => [
                                            'class' => 'col-md-9'
                                        ]
                                    ])
                                    ->hiddenInput()->label(false);
                                ?>

                            </div>
                        </div>
                <br /><br />
                <h4>Статус</h4>
                <br />
                <div class="row">
                    <div class="col-md-3">Активна / Деактивирована</div>
                    <div class="col-md-9">
                        <?= $form
                            ->field($formModel, 'status', ['options' => ['style' => 'display:none;']])
                            ->hiddenInput(['value' => 0])->label(false)
                        ?>
                        <?= $form
                            ->field($formModel, 'status',['template' => "{input}\n{hint}\n{error}",'horizontalCssClasses' => [
                                'wrapper' => 'top-minus','offset'=>''
                            ]])->checkbox()->label("");
                        ?>
                    </div>
                </div>

                <?php if(User::findOne(Yii::$app->user->id)->role != 11){?>

                    <div class="row">
                        <div class="col-md-3">Эксклюзивный статус</div>
                        <div class="col-md-9">
                            <?= $form
                                ->field($formModel, 'exclusive', ['options' => ['style' => 'display:none;']])
                                ->hiddenInput(['value' => 0])->label(false)
                            ?>
                            <?= $form
                                ->field($formModel, 'exclusive',['template' => "{input}\n{hint}\n{error}",'horizontalCssClasses' => [
                                    'wrapper' => 'top-minus','offset'=>''
                                ]])->checkbox()->label("");
                            ?>
                        </div>
                    </div>
                <?php }?>

                <div class="row">
                    <div class="col-md-3">Зарезервировано</div>
                    <div class="col-md-9">
                        <?= $form
                            ->field($formModel, 'reserve', ['options' => ['style' => 'display:none;']])
                            ->hiddenInput(['value' => 0])->label(false)
                        ?>
                        <?= $form
                            ->field($formModel, 'reserve',['template' => "{input}\n{hint}\n{error}",'horizontalCssClasses' => [
                                'wrapper' => 'top-minus','offset'=>''
                            ]])->checkbox()->label("");
                        ?>
                    </div>
                </div>
                <div class="row">
                    <?php if(User::findOne(Yii::$app->user->id)->role != 11){?>
                        <?= $form
                            ->field($formModel, 'user_id', [
                                'options' => [
                                ]
                            ])
                            ->dropDownList(
                                \backend\modules\agents\models\Agents::getAgentsArray()
                            )
                            ->label("Изменить автора объявления");
                        ?>
                   <?php }?>

                </div>
                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Об объекте</h4>
                <br />

                <?=$form
                    ->field($formModel,'title',['options'=>['class'=>'form-group row']])
                    ->textInput(['placeholder'=>'Введите название...'])->label('Название')
                ?>

                <?= $form
                    ->field($formModel, 'city_id',['options'=>['class'=>'form-group row']])
                    ->dropDownList(
                        \yii\helpers\ArrayHelper::merge(
                            ["" => 'Город'],
                            \backend\modules\regions\models\Regions::getList('id', 'title', 'id desc'))
                    )
                    ->label($formModel->getAttributeLabel('city_id'));
                ?>

                <?= $form
                    ->field($formModel, 'address',['options'=>['class'=>'form-group row']])
                    ->textInput()
                ?>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-9" id="map">
                        <div style="width:100%;height: 200px"><div id="map-canvas" style="height: 200px;"></div></div>
                    </div>
                </div>

                <?= $form
                    ->field($formModel, 'href',['options'=>['class'=>'form-group row']])
                    ->textInput(['readonly' => true])
                ?>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Цена и условия сделки</h4>
                <br />

                <?php if($formModel->category_id == 3){?>
                    <?= $form
                        ->field($formModel, 'price',['options'=>['class'=>'form-group row']])
                        ->textInput()->label("Цена в сутки");
                    ?>
                    <?= $form
                        ->field($formModel, 'month_price',['options'=>['class'=>'form-group row']])
                        ->textInput()->label("Цена в месяц");
                    ?>
                <?php }elseif($formModel->category_id == 2){?>
                    <?= $form
                        ->field($formModel, 'price',['options'=>['class'=>'form-group row']])
                        ->textInput()->label("Цена в месяц");
                    ?>
                <?php }else{?>
                    <?= $form
                        ->field($formModel, 'price',['options'=>['class'=>'form-group row']])
                        ->textInput()
                    ?>
                <?php }?>

                <?= $form
                    ->field($formModel, 'price_dollar',['options'=>['class'=>'form-group row']])
                    ->textInput()
                ?>


                <?= $form
                    ->field($formModel, 'price_euro',['options'=>['class'=>'form-group row']])
                    ->textInput()
                ?>

                <?php
                    if($formModel->category_id != 1){

                        echo $form
                            ->field($formModel, 'deposit',['options'=>['class'=>'form-group row']])
                            ->textInput();

                        echo $form
                            ->field($formModel, 'prepayment_id',['options'=>['class'=>'form-group row']])
                            ->dropDownList(\backend\modules\adverts\models\Prepayments::getList('id', 'value', 'id'));
                    }else{
                        echo $form
                        ->field($formModel, 'price_per_meter',['options'=>['class'=>'form-group row']])
                        ->textInput();

   }
                ?>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Описание</h4>
                <br />

                <div class="row">
                    <?=$form
                        ->field($formModel,'description',['horizontalCssClasses' => [
                            'wrapper' => 'col-xs-12','offset'=>''
                        ]])
                        ->widget(\mihaildev\ckeditor\CKEditor::className(), [
                            'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder',\yii\helpers\ArrayHelper::merge(Yii::$app->params['ckeditor'],['height'=>'200'])),
                        ])->label(false);
                    ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Параметры</h4>
                <br />

                <?php if($object_type->parametrs){?>
                    <?php foreach($object_type->parametrs as $key => $value){?>

                        <?php if($value->field_type_id == 1){?>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="control-label form-control-label"><?php echo $value->title?></label>
                                </div>
                                <div class="col-md-9 field-adverts-repairs_id">
                                    <select id="adverts-<?php echo $value->id;?>" class="form-control" name="Adverts[parametrs][<?php echo $value->field_type_id;?>][<?php echo $value->id;?>]">
                                        <option value="">Вариант не выбран</option>
                                        <?php foreach($value->parametrValue as $key =>$paramValue){?>

                                            <option value="<?php echo $paramValue["id"]?>" <?php if($formModel->params[$value->id] == $paramValue["id"]){ echo "selected='selected'";}?>><?php echo $paramValue["value"]?></option>
                                        <?php }?>
                                    </select>

                                    <div class="help-block"></div>
                                </div>
                            </div>
                        <?php }elseif($value->field_type_id == 2){?>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="control-label form-control-label"><?php echo $value->title?></label>
                                </div>
                                <div class="col-md-9 field-adverts-<?php echo $value->id;?>">
                                    <div>
                                        <?php foreach($value->parametrValue as $paramKey =>$paramValue){?>
                                            <label><input type="checkbox" name="Adverts[parametrs][<?php echo $value->field_type_id;?>][<?php echo $value->id;?>][]" <?php if(in_array($paramValue["id"], explode(',', $formModel->params[$value->id]))){ echo "checked='checked'";}?> value="<?php echo $paramValue["id"]?>"> <?php echo $paramValue["value"]?></label>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        <?php }elseif($value->field_type_id == 3){?>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="control-label form-control-label"><?php echo $value->title?></label>
                                </div>
                                <div class="col-md-9 field-adverts-<?php echo $value->id;?>">
                                    <input type="text" id="adverts-<?php echo $value->id;?>" class="form-control" name="Adverts[parametrs][<?php echo $value->field_type_id;?>][<?php echo $value->id;?>]" value="<?php echo $formModel->params[$value->id];?>">
                                </div>
                            </div>
                        <?php }?>

                    <?php }?>
                <?php }?>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Примечание</h4>
                <br />

                <div class="row">
                    <?=$form
                        ->field($formModel,'note',['horizontalCssClasses' => [
                            'wrapper' => 'col-xs-12','offset'=>''
                        ]])
                        ->widget(\mihaildev\ckeditor\CKEditor::className(), [
                            'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder',\yii\helpers\ArrayHelper::merge(Yii::$app->params['ckeditor'],['height'=>'200'])),
                        ])->label(false);
                    ?>
                </div>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Фото</h4>
                <br />

                <?php

                    echo \wbp\imageUploader\ImageUploader::widget([
                        'style' => 'estoreMultiple',
                        'data' => [
                            'size' => '123x123',
                        ],
                        'type' => Adverts::$imageTypes[0],
                        'item_id' => $formModel->id,
                        'limit' => 999
                    ]);

                ?>

                <div class="clearfix"></div>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Видео</h4>
                <br />


                <?php
                    echo \wbp\videoUploader\videoUploader::widget([
                        'style' => 'estoreMultiple',
                        'data' => [
                            'size' => '123x123',
                        ],
                        'type' => Adverts::$videoTypes[0],
                        'item_id' => $formModel->id,
                        'limit' => 1
                    ]);
                ?>

                <div class="clearfix"></div>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <h4>Превью к видео</h4>
                <br />

                <?php

                echo \wbp\imageUploader\ImageUploader::widget([
                    'style' => 'estoreMultiple',
                    'data' => [
                        'size' => '123x123',
                    ],
                    'type' => Adverts::$imageTypes[1],
                    'item_id' => $formModel->id,
                    'limit' => 1
                ]);

                ?>

                <div class="clearfix"></div>

                <div class="form-actions">
                    <div class="form-group row">
                        <div class="col-md-9 col-md-offset-3">
                            <?=\yii\helpers\Html::submitButton('Сохранить',['class'=>'btn width-150 btn-primary'])?>
                            <?=\yii\helpers\Html::resetButton('Отмена',['class'=>'btn btn-default'])?>
                        </div>
                    </div>
                </div>

                <? \yii\bootstrap\ActiveForm::end(); ?>


