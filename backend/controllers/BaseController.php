<?php
namespace backend\controllers;

use backend\filters\AccessHistoryControl;
use backend\models\Countries;
use backend\models\LoginForm;
use backend\models\UserLog;
use backend\modules\adverts\models\SearchModel;
use frontend\models\Category;
use wbp\file\File;
use wbp\images\models\Image;
use wbp\video\Video;
use Yii;
use yii\base\Exception;
use yii\base\UserException;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class BaseController extends Controller
{

    const BEFORE_ADD = 'beforeAdd';
    const BEFORE_EDIT = 'beforeAdd';
    const BEFORE_ADD_EDIT = 'beforeAddEdit';

    public $FormModel = '';
    public $ModelName = '';
    public $editView = 'edit';
    public $addView = 'add';
    public $formView = 'edit_add_form';
    public $successAddMessage = 'The item successfully added';
    public $successEditMessage = 'Information was saved';
    public $errorMessage = 'Error is occured';

    public $searchModel;

    public $values;

    public $menuItems;

    public function init()
    {
        $this->on(self::BEFORE_ADD, [$this, 'beforeAdd']);
        $this->on(self::BEFORE_EDIT, [$this, 'beforeEdit']);
        $this->on(self::BEFORE_ADD_EDIT, [$this, 'beforeAddEdit']);

        $this->searchModel=new SearchModel();
        $this->searchModel->load(Yii::$app->request->get());

        return parent::init();
    }

    public function redirectToAvailableModule(){
        $items=\backend\models\Menu::getMenuItems();
        foreach ($items as $item){
            return $this->redirect($item['url']);
        }
    }


    public function beforeAdd()
    {
    }

    public function beforeEdit()
    {
    }

    public function beforeAddEdit()
    {
    }

    public function sortEnable()
    {
        $modelName = $this->ModelName;
        $modelName = $modelName::className();
        $columns = $modelName::getTableSchema()->columns;
        if (isset($columns['sort'])) return true;
        return false;
    }

    public function actionAdd()
    {
        $this->trigger(self::BEFORE_ADD);
        $this->trigger(self::BEFORE_ADD_EDIT);

        $modelName = $this->ModelName;

        $formModelName = $this->FormModel;

        $formModel = new $formModelName(['scenario' => 'add']);

        //$model=new $modelName;
        if ($formModel->load(Yii::$app->request->post())) {
            $saved = $formModel->save();
            if ($saved) {
                $this->addToLog(UserLog::ADDED, $formModel->id);
                Yii::$app->getSession()->setFlash('success', $this->successAddMessage);
                return $this->redirect(['edit', 'id' => $formModel->id]);
            } else {
                Yii::$app->getSession()->setFlash('error', $this->errorMessage);
            }
        }
        $form = $this->renderPartial('edit_add_form', ['formModel' => $formModel, 'values' => $this->values]);

        return $this->render($this->addView, ['form' => $form]);
    }

    public function actionEdit($id)
    {
        $this->trigger(self::BEFORE_EDIT);
        $this->trigger(self::BEFORE_ADD_EDIT);

        $modelName = $this->ModelName;

        $model = $modelName::findOne(['id' => (int)$id]);

        $formModelName = $this->FormModel;

        $formModel = new $formModelName(['scenario' => 'edit']);

        $formModel->loadModel($model->id);

        if ($formModel->load(Yii::$app->request->post())) {
            $saved = $formModel->save();
            if ($saved) {
                $this->addToLog(UserLog::SAVED, $formModel->id);
                Yii::$app->getSession()->setFlash('success', $this->successEditMessage);
            } else {
                Yii::$app->getSession()->setFlash('error', $this->errorMessage);
            }
        }

        $form = $this->renderPartial($this->formView, ['formModel' => $formModel, 'model' => $model, 'values' => $this->values]);

        return $this->render($this->editView, ['model' => $model, 'form' => $form]);

    }

    public function actionSort()
    {
        $modelName = $this->ModelName;
        $elements = Yii::$app->request->post('elements');
        $modelName::sort($elements);
        $this->addToLog(UserLog::SORTED, $elements);
    }

    public function actionSortImage()
    {
        $modelName = Image::className();
        $elements = Yii::$app->request->post('elements');
        $modelName::sort($elements);
        $this->addToLog(UserLog::SORTED, $elements);
    }

    public function actionRemove($id)
    {
        $modelName = $this->ModelName;
        $model = $modelName::findOne(['id' => (int)$id]);
        if ($model) {
            $this->addToLog(UserLog::REMOVED, $model->id);
            $model->delete();
        }

        if (!Yii::$app->request->isPost) $this->redirect('index');
    }

    public function actionGetRegions($id, $state_selected, $state_id)
    {
        $country = Countries::findOne(['id' => $id]);
        if (!$country) Yii::$app->end();
        $this->layout = '/empty';
        return $this->render('@app/views/site/regionsScript', [
            'regions' => $country->regions,
            'selectName' => $state_id,
            'stateSelected' => $state_selected
        ]);
    }

    public function beforeAction($action)
    {

        $this->menuItems = \backend\models\Menu::getMenuItems();

        return parent::beforeAction($action);
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessHistoryControl::className(),
//                'denyCallback' => function($rule, $action){ $this->actionForbidden();},
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'forbidden'],
                        'allow' => true,
                    ],
                    [
//                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
            'getImage' => [
                'class' => \wbp\uploadifive\GetAction::className(),
            ],
            'getVideo' => [
                'class' => \wbp\uploadifive\GetVideoAction::className(),
            ],
            'getFile' => [
                'class' => \wbp\uploadifive\GetFileAction::className(),
            ],
            
            
            'deleteImage' => [
                'class' => \wbp\uploadifive\DeleteAction::className(),
            ],
            'deleteVideo' => [
                'class' => \wbp\uploadifive\DeleteVideoAction::className(),
            ],
            'deleteFile' => [
                'class' => \wbp\uploadifive\DeleteFileAction::className(),
            ],
            'uploadImage' => [
                'class' => \wbp\uploadifive\UploadAction::className(),
                'uploadBasePath' => '@serverDocumentRoot/images/tmp', //file system path
//                'uploadBaseUrl' => \common\helpers\Url::getWebUrlFrontend('upload'), //web path
                'csrf' => false,
                'format' => '{yyyy}-{mm}-{dd}-{time}-{rand:6}', //save format
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 10 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function ($actionObject) {
                },
                'afterValidate' => function ($actionObject) {
                },
                'beforeSave' => function ($actionObject) {
                },
                'afterSave' => function ($filename, $fullFilename, $actionObject) {

                    //$filename; // image/yyyymmddtimerand.jpg
                    //$fullFilename; // /var/www/htdocs/image/yyyymmddtimerand.jpg
                    //$actionObject; // \wbp\uploadifive\UploadAction instance

                    $dir = Yii::getAlias(Yii::$app->getModule('im')->imagesStorePath);


//                    $itemId=Yii::$app->getRequest()->post('item_id');
                    $type = Yii::$app->getRequest()->post('type');
                    $unique_id = Yii::$app->getRequest()->post('uniqueId');
                    $ext = pathinfo($fullFilename, PATHINFO_EXTENSION);


                    $image = new Image();
                    $image->type = $type;
                    $image->unique_id = $unique_id;
                    $image->ext = $ext;
                    $image->status = Image::STATUS_ACTIVE;
                    $image->deleted = Image::NON_DELETED;
                    $image->name = $actionObject->getUpladedFileName();
                    file_put_contents(Yii::getAlias('@serverDocumentRoot/images/') . '/1', $dir . '/' . $image->id . '.' . $image->ext);

                    $image->save();
                    var_dump($image->item_id);

                    rename($fullFilename, $dir . '/' . $image->id . '.' . $image->ext);

                },
            ],
            'uploadVideo' => [
                'class' => \wbp\uploadifive\UploadAction::className(),
                'uploadBasePath' => '@serverDocumentRoot/video/tmp', //file system path
                'csrf' => false,
                'format' => '{yyyy}-{mm}-{dd}-{time}-{rand:6}', //save format
                'validateOptions' => [
                    'extensions' => ['mp4', 'flv', 'ogg'],
                    'maxSize' => 600 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function ($actionObject) {
                },
                'afterValidate' => function ($actionObject) {
                },
                'beforeSave' => function ($actionObject) {
                },

                'afterSave' => function ($filename, $fullFilename, $actionObject) {

                    $dir = Yii::getAlias(Yii::$app->getModule('video')->videoStorePath);
                    $type = Yii::$app->getRequest()->post('type');
                    $unique_id = Yii::$app->getRequest()->post('uniqueId');
                    $ext = pathinfo($fullFilename, PATHINFO_EXTENSION);


                    $video = new Video();
                    $video->type = $type;
                    $video->unique_id = $unique_id;
                    $video->ext = $ext;
                    $video->status = Image::STATUS_ACTIVE;
                    $video->deleted = Image::NON_DELETED;
                    $video->name = $actionObject->getUpladedFileName();
//                    file_put_contents(Yii::getAlias('@serverDocumentRoot/video/').'/1',$dir.'/'.$image->id.'.'.$image->ext);

                    $video->save();

                    rename($fullFilename, $dir . '/' . $video->id . '.' . $video->ext);

                },
            ],
            'uploadFile' => [
                'class' => \wbp\uploadifive\UploadAction::className(),
                'uploadBasePath' => '@serverDocumentRoot/files/tmp', //file system path
                'csrf' => false,
                'format' => '{yyyy}-{mm}-{dd}-{time}-{rand:6}', //save format
                'validateOptions' => [
//                    'extensions' => ['*'],
                    'maxSize' => 600 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function ($actionObject) {
                },
                'afterValidate' => function ($actionObject) {
                },
                'beforeSave' => function ($actionObject) {
                },
                'afterSave' => function ($filename, $fullFilename, $actionObject) {

                    $dir = Yii::getAlias(Yii::$app->getModule('file')->fileStorePath);
                    $type = Yii::$app->getRequest()->post('type');
                    $unique_id = Yii::$app->getRequest()->post('uniqueId');
                    $ext = pathinfo($fullFilename, PATHINFO_EXTENSION);

                    $file = new File();
                    $file->type = $type;
                    $file->unique_id = $unique_id;
                    $file->ext = $ext;
                    $file->status = File::STATUS_ACTIVE;
                    $file->deleted = File::NON_DELETED;
                    $file->name = $actionObject->getUpladedFileName();
//                    file_put_contents(Yii::getAlias('@serverDocumentRoot/files/').'/1',$dir.'/'.$file->id.'.'.$file->ext);

                    $file->save();

                    rename($fullFilename, $dir . '/' . $file->id . '.' . $file->ext);

                },
            ],
        ];
    }

    public function actionLogin()
    {
        $this->layout = 'login';

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionForbidden()
    {
        // TODO: Надо потом посмотреть почему тут возврат через echo, а не через return

        $this->layout = '@app/views/layouts/login';
        echo $this->render('@app/views/site/error', [
            'name' => 'Forbidden',
            'message' => 'You are not allowed to perform this action.',
        ]);
        Yii::$app->end();
    }

    public function actionError()
    {
        $this->layout = 'login';

        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            return '';
        }
        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }

        if ($exception instanceof Exception) {
            $name = Yii::t('admin', $exception->getName());
        } else {
            $name = Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = Yii::t('yii', 'An internal server error occurred.');
        }

        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->render('error', [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }
}
