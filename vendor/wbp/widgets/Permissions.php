<?php

namespace wbp\widgets;

use backend\models\Menu;
use backend\models\Modules;
use backend\modules\stores\models\Stores;
use common\models\WbpActiveRecord;
use wbp\helpers\Mb_Ucfirst;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;


/**
 * Uploadify Widget
 *
 */
class Permissions extends Widget {

    public $permissions,$modules,$stores,$formModel,$formModelName,$titles;
    protected $id;
    /**
     * Initializes the widget.
     */
    public function init() {
        $this->id=uniqid('permissions_');

        $this->permissions=\backend\models\Permissions::getList('id','title','id');


        $showedMenus = [];
        $showedMenus_ = Menu::getList('id','module_id',null,['status' => WbpActiveRecord::STATUS_ACTIVE]);
        if(count($showedMenus_) > 0)$showedMenus = implode(",",$showedMenus_);

        $this->modules=Modules::find()->where(['status' => WbpActiveRecord::STATUS_ACTIVE])->andWhere('id IN('.$showedMenus.')');
        $this->stores=$this->getStoresList();//Stores::getList('id','title','id');

        $reflection=new \ReflectionClass($this->formModel);
        $formShortName=$reflection->getShortName();
        $this->formModelName=$formShortName;

        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run() {
        $this->registerScripts();
        echo $this->renderWidget();
    }

    protected function getStoresList(){
        return [1=>'BOS'];
        return Stores::getList('id','title','id');
    }

    private function drawStoreTable($st_id){
        foreach($this->modules->all() as $num=>$module){
            $permissionsExist=false;
            $bodyRow='';
            $bodyRow.='
                    <tr>
                        <td>'.Yii::t('admin',$module->title).'</td>
                ';
            foreach($this->permissions as $id=>$title){
                $bodyRow.='<td width="7%" class="center">';
                if($module->permissionExist($id)){
                    $permissionsExist=true;
                    $bodyRow.="<label class='checkbox' style='margin:0;'>";
                    $bodyRow.=Html::hiddenInput($this->formModelName.'[permissions]['.$st_id.']['.$module->id.']['.$id.']',0);
                    $checked=$this->formModel->permissions[$st_id][$module->id][$id];
                    if(!$this->formModel->id) $checked=true;
                    $bodyRow.=Html::checkbox(
                        $this->formModelName.'[permissions]['.$st_id.']['.$module->id.']['.$id.']',
                        $checked,
                        [
                            "value"=>1,
                            "class"=>"permissions",
                            "data-store"=>$st_id,
                            "data-module"=>$module->id,
                            "data-permission"=>$id
                        ]);
                    $bodyRow.="</label>";
                }
                $bodyRow.='</td>';
            }
            $bodyRow.='
                        <td width="7%" class="center">';
                            $bodyRow.="<label class='checkbox' style='margin:0;'>";
                            $bodyRow.=Html::hiddenInput($this->formModelName.'[permissions]['.$st_id.']['.$module->id.'][all]',0);
                            $bodyRow.=Html::checkbox(
                                $this->formModelName.'[permissions]['.$st_id.']['.$module->id.'][all]',
                                false,
                                [
                                    "value"=>1,
                                    "class"=>"permissions",
                                    "data-store"=>$st_id,
                                    "data-module"=>$module->id,
                                    "data-permission"=>"all"
                                ]);
                            $bodyRow.="</label>";
            $bodyRow.='    </td>
                    </tr>
                ';
            if($permissionsExist) $body.=$bodyRow;
        }

        $hidden='style="display:none;"';
        if($st_id=='all') $hidden='';
        $tables.=<<<TBL
                <table class="table table-condensed uniformjs stores store_{$st_id}" {$hidden}>
                    <thead>
                        <tr>
                            <th>Модули</th>
                            {$this->titles}
                            <th class="center">Все</th>

                        </tr>
                    </thead>

                    <tbody>
                        {$body}

                    </tbody>

                </table>
TBL;
        return $tables;
    }


    /**
     * render file input tag
     * @return string
     */
    private function renderWidget() {
        $this->titles='';
        foreach($this->permissions as $id=>$title){
            $this->titles.='<th class="center">'.Mb_Ucfirst::mb_ucfirst(Yii::t('admin',mb_strtolower(trim($title)))).'</th>';
        }

        $storeSelector='
                <div class="col-md-7">
                    <div class="row">
        ';
        if(count($this->getStoresList())>1){

            $storeSelector.='
                            <div class="col-md-2">
                                <h5 style="line-height:35px;">Store</h5>
                            </div>
                            <div class="col-md-7">

                                <select class="form-control" id="storeSelector_'.$this->id.'">
                                    <option value="all">All</option>
            ';
            foreach($this->getStoresList() as $key=>$value)
                $storeSelector.='<option value="'.$key.'">'.$value.'</option>';
            $storeSelector.='
                                 </select>
                            </div>

            ';
        }
        $storeSelector.='
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row" style="padding: 15px 0;">
                        <div class="col-md-7"></div>
                        <div class="col-md-5">
                            <span class="btn btn-block btn-warning selectAllButton">'. Yii::t("admin", "Check All") .'</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="separator bottom"></div>
        ';

        foreach($this->stores as $st_id=>$store){
            $tables.=$this->drawStoreTable($st_id);

        }
        $tables.=$this->drawStoreTable('all');


        $permissions = Yii::t('admin', 'Permissions');
        $result=<<<EOF
            <div class="widget widget-six" id="{$this->id}">
                <div class="widget-header">
                    <h3>{$permissions}</h3>
                </div>

                <div class="widget-body" style="padding: 0 15px;">
                    {$storeSelector}

                    {$tables}

                    <div class="clearfix"></div>
                    <div class="separator bottom"></div>
        
                    <div class="form-actions">
                        <div class="form-group row">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn width-150 btn-primary">Сохранить</button>                            
                                <button type="reset" class="btn btn-default">Отмена</button>                        
                            </div>
                        </div>
                    </div>

                </div>
            </div>
EOF;

        return $result;
    }

    /**
     * register script
     */
    private function registerScripts() {
        $script = <<<EOF
            $("#storeSelector_{$this->id}").change(function(){
                $("#{$this->id} .stores").hide();
                $("#{$this->id} .stores.store_"+$(this).val()).show();
            });
            $("#{$this->id} .selectAllButton").click(function(){
                $("#{$this->id} .permissions").prop("checked",true).parent().attr("class","checked");
            });

            $("#{$this->id} .permissions").change(function(){
                var storeAdder="[data-store="+$(this).data("store")+"]";
                var permissionAdder="[data-permission="+$(this).data("permission")+"]";
                if($(this).data("store")=="all"){
                    storeAdder="";
                }
                if($(this).data("permission")=="all"){
                    permissionAdder="";
                }

                if($(this).prop("checked")){
                    $("#{$this->id} .permissions"+storeAdder+permissionAdder+"[data-module="+$(this).data("module")+"]").prop("checked",true).parent().attr("class","checked");
                }else{
                    $("#{$this->id} .permissions"+storeAdder+permissionAdder+"[data-module="+$(this).data("module")+"]").prop("checked",false).parent().attr("class","");
                }

                if(!permissionAdder){
                    return;
                }

                var module=$(this).data("module");
                $("#{$this->id} .permissions[data-module="+$(this).data("module")+"]").each(function(){
                    var allSelected=true;
                    $("#{$this->id} .permissions"+"[data-store="+$(this).data("store")+"]"+"[data-module="+module+"]").each(function(){
                        if($(this).data("permission")=="all") return;
                        if(!$(this).prop("checked")){
                            allSelected=false;
                        }
                    });
                    //storeAdder="[data-store="+$(this).data("store")+"]";
                    if(allSelected){
                        $("#{$this->id} .permissions[data-permission=all]"+"[data-store="+$(this).data("store")+"]"+"[data-module="+module+"]").prop("checked",true).parent().attr("class","checked");
                    }else{
                        $("#{$this->id} .permissions[data-permission=all]"+"[data-store="+$(this).data("store")+"]"+"[data-module="+module+"]").prop("checked",false).parent().attr("class","");
                    }
                });
                if(storeAdder!='') buildAllStoresPage{$this->id}();
            });

            function checkAllSelected{$this->id}(){
                $("#{$this->id} .permissions").each(function(){
                    var module=$(this).data("module");
                    $("#{$this->id} .permissions[data-module="+$(this).data("module")+"]").each(function(){
                        var allSelected=true;
                        $("#{$this->id} .permissions"+"[data-store="+$(this).data("store")+"]"+"[data-module="+module+"]").each(function(){
                            if($(this).data("permission")=="all") return;
                            if(!$(this).prop("checked")){
                                allSelected=false;
                            }
                        });
                        //storeAdder="[data-store="+$(this).data("store")+"]";
                        if(allSelected){
                            $("#{$this->id} .permissions[data-permission=all]"+"[data-store="+$(this).data("store")+"]"+"[data-module="+module+"]").prop("checked",true).parent().attr("class","checked");
                        }else{
                            $("#{$this->id} .permissions[data-permission=all]"+"[data-store="+$(this).data("store")+"]"+"[data-module="+module+"]").prop("checked",false).parent().attr("class","");
                        }
                    });
                });
            }

            function buildAllStoresPage{$this->id}(){
                $("#{$this->id} .permissions[data-store=all]").each(function(){
                    var allSelected=true;
                    var allUnSelected=true;

                    $("#{$this->id} .permissions[data-permission="+$(this).data("permission")+"][data-module="+$(this).data("module")+"]").each(function(){
                        if($(this).data("store")=="all") return;
                        if(!$(this).prop("checked")){
                            allSelected=false;
                        }
                        if($(this).prop("checked")){
                            allUnSelected=false;
                        }
                    });
//                    alert(allSelected+' '+allUnSelected);
                    if(allSelected){
                        $("#{$this->id} .permissions[data-permission="+$(this).data("permission")+"][data-store=all][data-module="+$(this).data("module")+"]").prop("checked",true).parent().attr("class","checked");
                    }else if(!allSelected && !allUnSelected){
                        $("#{$this->id} .permissions[data-permission="+$(this).data("permission")+"][data-store=all][data-module="+$(this).data("module")+"]").prop("checked",false).parent().attr("class","halfchecked");
                    }else{
                        $("#{$this->id} .permissions[data-permission="+$(this).data("permission")+"][data-store=all][data-module="+$(this).data("module")+"]").prop("checked",false).parent().attr("class","");
                    }
                });
            }

            $("#{$this->id} .stores.store_all").show();
            checkAllSelected{$this->id}();
            buildAllStoresPage{$this->id}();
EOF;
        $this->view->registerJs($script, View::POS_READY);
    }

}
