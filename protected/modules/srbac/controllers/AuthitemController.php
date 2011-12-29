<?php
/**
 * AuthitemController class file.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * AuthitemController is the main controller for all of the srbac actions
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.controllers
 * @since 1.0.0
 */

class AuthitemController extends SBaseController {

/**
 * @var string specifies the default action to be 'list'.
 */
  public $defaultAction='frontpage';

  /**
   * @var CActiveRecord the currently loaded data model instance.
   */
  private $_model;

  public function init() {
    parent::init();
   
    $this->layout = $this->module->layout;
  }

  /**
   * Checks if the user has the authority role
   * @param String $action The current action
   * @return Boolean true if user has the authority role
   */
  protected function beforeAction($action) {
    if(!$this->module->isInstalled() && $action->id != "install"){
      $this->redirect(array("install"));
      $this->actionInstall();
      return false;
    }

    if($this->module->debug) {
      return true;
    }

    if( Yii::app()->user->checkAccess(Helper::findModule('srbac')->superUser) ||
        !Helper::isAuthorizer()) {
      return true;
    } else {
      parent::beforeAction($action);
    }
  }

  /**
   * Assigns roles to a user
   *
   * @param int $userid The user's id
   * @param String $roles The roles to assign
   * @param String $bizRules Not used yet
   * @param String $data Not used yet
   */
  private function _assignUser($userid,$roles,$bizRules,$data) {
    if($userid) {
      $auth = Yii::app()->authManager;
    /* @var $auth CDbAuthManager */
      foreach ($roles as $role) {
        $auth->assign($role, $userid,$bizRules,$data);
      }
    }
  }
  /**
   * Revokes roles from a user
   * @param int $userid The user's id
   * @param String $roles The roles to revoke
   */
  private function _revokeUser($userid,$roles) {
    if($userid) {
      $auth = Yii::app()->authManager;
    /* @var $auth CDbAuthManager */
      foreach ($roles as $role) {
        if($role == $this->module->superUser) {
          $count = Assignments::model()->count("itemname='".$role."'");
          if($count==1) {
            return false;
          }
        }
        $auth->revoke($role, $userid);
        return true;
      }
    }
  }

  /**
   * Assigns child items to a parent item
   * @param String $parent The parent item
   * @param String $children The child items
   */
  private function _assignChild($parent,$children) {
    if($parent) {
      $auth = Yii::app()->authManager;
    /* @var $auth CDbAuthManager */
      foreach ($children as $child) {
        $auth->addItemChild($parent, $child);
      }
    }
  }
  /**
   * Revokes child items from a parent item
   * @param String $parent The parent item
   * @param String $children The child items
   */
  private function _revokeChild($parent,$children) {
    if($parent) {
      $auth = Yii::app()->authManager;
    /* @var $auth CDbAuthManager */
      foreach ($children as $child) {
        $auth->removeItemChild($parent, $child);
      }
    }
  }

  /**
   * The assignment action
   * First checks if the user is authorized to perform this action
   * Then initializes the needed variables for the assign view.
   * If there's a post back it performs the assign action
   */
  public function actionAssign() {

    $userid = isset($_POST[Helper::findModule('srbac')->userclass][$this->module->userid]) ?
        $_POST[Helper::findModule('srbac')->userclass][$this->module->userid] :
        "";

    //Init values
    $model = AuthItem::model();
    $data['userAssignedRoles'] = array();
    $data['userNotAssignedRoles'] = array();
    $data['roleAssignedTasks'] = array();
    $data['roleNotAssignedTasks'] = array();
    $data['taskAssignedOpers'] = array();
    $data['taskNotAssignedOpers'] = array();
    $data["assign"] = array("disabled"=>true);
    $data["revoke"] = array("disabled"=>true);
    $this->_setMessage("");

    $auth = Yii::app()->authManager;
     /* @var $auth CDbAuthManager */
    $authItemAssignName = isset($_POST['AuthItem']['assign']['name']) ?
        $_POST['AuthItem']['assign']['name'] : "";
    // ver 1.1
    $version = Yii::getVersion();

	if($version > '1.1')
    $authItemAssignName = isset($_POST['AuthItem']['name']['assign']) ?
        $_POST['AuthItem']['name']['assign'] : "";


    $assBizRule = isset($_POST['Assignments']['bizrule']) ?
        $_POST['Assignments']['bizrule'] : "";
    $assData = isset($_POST['Assignments']['data']) ?
        $_POST['Assignments']['data'] : "";


    $authItemRevokeName = isset($_POST['AuthItem']['revoke']['name']) ?
        $_POST['AuthItem']['revoke']['name'] : "";
    // ver 1.1
    if($version > '1.1')
    $authItemRevokeName = isset($_POST['AuthItem']['name']['revoke']) ?
        $_POST['AuthItem']['name']['revoke'] : "";

    $authItemName = isset($_POST['AuthItem']['name']) ? $_POST['AuthItem']['name'] : "";

    $assItemName = isset($_POST['Assignments']['itemname']) ? $_POST['Assignments']['itemname'] : "";

    $assignRoles = Yii::app()->request->getParam('assignRoles',0);
    $revokeRoles = Yii::app()->request->getParam('revokeRoles',0);
    $assignTasks = isset($_GET['assignTasks']) ? $_GET['assignTasks'] : 0;
    $revokeTasks = isset($_GET['revokeTasks']) ? $_GET['revokeTasks'] : 0;
    $assignOpers = isset($_GET['assignOpers']) ? $_GET['assignOpers'] : 0;
    $revokeOpers = isset($_GET['revokeOpers']) ? $_GET['revokeOpers'] : 0;


    if($assignRoles && is_array($authItemAssignName)) {

      $this->_assignUser($userid,$authItemAssignName,$assBizRule,$assData);
      $this->_setMessage(Helper::translate('srbac','Role(s) Assigned'));
    } else if($revokeRoles && is_array($authItemRevokeName)) {
        $revoke = $this->_revokeUser($userid,$authItemRevokeName);
        if($revoke) {
          $this->_setMessage(Helper::translate('srbac','Role(s) Revoked'));
        } else {
          $this->_setMessage(Helper::translate('srbac','Can\'t revoke this role'));

        }
      } else if($assignTasks && is_array($authItemAssignName)) {
          $this->_assignChild($authItemName,$authItemAssignName);
          $this->_setMessage(Helper::translate('srbac','Task(s) Assigned'));
        } else if($revokeTasks && is_array($authItemRevokeName)) {
            $this->_revokeChild($authItemName,$authItemRevokeName);
            $this->_setMessage(Helper::translate('srbac','Task(s) Revoked'));
          }else if($assignOpers && is_array($authItemAssignName)) {
              $this->_assignChild($assItemName,$authItemAssignName);
              $this->_setMessage(Helper::translate('srbac','Operation(s) Assigned'));
            } else if($revokeOpers && is_array($authItemRevokeName)) {
                $this->_revokeChild($assItemName,$authItemRevokeName);
                $this->_setMessage( Helper::translate('srbac','Operation(s) Revoked'));
              }
    //If not ajax show the assign page
    if(!Yii::app()->request->isAjaxRequest) {
      $this->render('assign',array(
          'model'=>$model,
          'message'=>$this->_getMessage(),
          'userid'=>$userid,
          'data'=>$data
      ));
    } else {
    // assign to user show the user tab
      if($userid != "") {
        $this->_getTheRoles();
      }
      else if($assignTasks != 0 || $revokeTasks != 0) {
          $this->_getTheTasks();
        }
        else if($assignOpers != 0 || $revokeOpers != 0) {
            $this->_getTheOpers();
          }
    }
  }

  /**
   * Used by Ajax to get the roles of a user when he is selected in the Assign
   * roles to user tab
   */
  public function actionGetRoles() {
    $this->_setMessage("");
    $this->_getTheRoles();
  }

  /**
   * Gets the assigned and not assigned roles of the selected user
   */
  private function _getTheRoles() {
    $model = new AuthItem();
    $userid = $_POST[Helper::findModule('srbac')->userclass][$this->module->userid];
    $data['userAssignedRoles'] = Helper::getUserAssignedRoles($userid);
    $data['userNotAssignedRoles'] = Helper::getUserNotAssignedRoles($userid);
    if($data['userAssignedRoles'] == array()) {
      $data['revoke'] = array("name"=>"revokeUser","disabled"=>true);
    } else {
      $data['revoke'] = array("name"=>"revokeUser");
    }
    if($data['userNotAssignedRoles'] == array()) {
      $data['assign'] = array("name"=>"assignUser","disabled"=>true);
    } else {
      $data['assign'] = array("name"=>"assignUser");
    }
    $this->renderPartial('tabViews/userAjax',
        array('model'=>$model,'userid'=>$userid,'data'=>$data,'message'=>$this->_getMessage()),
        false,true);
  }

  /**
   * Used by Ajax to get the tasks of a role when it is selected in the Assign
   * tasks to roles tab
   */
  public function actionGetTasks() {
    $this->_setMessage("");
    $this->_getTheTasks();
  }
  /**
   * Gets the assigned and not assigned tasks of the selected user
   */
  private function _getTheTasks() {
    $model = new AuthItem();
    $name = $_POST["AuthItem"]["name"];
    $data['roleAssignedTasks']  = Helper::getRoleAssignedTasks($name);
    $data['roleNotAssignedTasks'] = Helper::getRoleNotAssignedTasks($name);
    if($data['roleAssignedTasks'] == array()) {
      $data['revoke'] = array("name"=>"revokeTask","disabled"=>true);
    } else {
      $data['revoke'] = array("name"=>"revokeTask");
    }
    if($data['roleNotAssignedTasks'] == array()) {
      $data['assign'] = array("name"=>"assignTasks","disabled"=>true);
    } else {
      $data['assign'] = array("name"=>"assignTasks");
    }
    $this->renderPartial('tabViews/roleAjax',
        array('model'=>$model,'name'=>$name,'data'=>$data,'message'=>$this->_getMessage()),false,true);

  }

  /**
   * Used by Ajax to get the operations of a task when he is selected in the Assign
   * operations to tasks tab
   */
  public function actionGetOpers() {
    $this->_setMessage("");
    $this->_getTheOpers();
  }
  /**
   * Gets the assigned and not assigned operations of the selected user
   */
  private function _getTheOpers() {
    $model = new AuthItem();
    $name = $_POST["Assignments"]["itemname"];
    $data['taskAssignedOpers']  = Helper::getTaskAssignedOpers($name);
    $data['taskNotAssignedOpers'] = Helper::getTaskNotAssignedOpers($name);
    if($data['taskAssignedOpers'] == array()) {
      $data['revoke'] = array("name"=>"revokeOpers","disabled"=>true);
    } else {
      $data['revoke'] = array("name"=>"revokeOpers");
    }
    if($data['taskNotAssignedOpers'] == array()) {
      $data['assign'] = array("name"=>"assignOpers","disabled"=>true);
    } else {
      $data['assign'] = array("name"=>"assignOpers");
    }
    $this->renderPartial('tabViews/taskAjax',
        array('model'=>$model,'name'=>$name,'data'=>$data,'message'=>$this->_getMessage()),false,true);

  }

  /**
   * Shows a particular model.
   */
  public function actionShow() {
    $deleted = Yii::app()->request->getParam('deleted',false);
    $delete = Yii::app()->request->getParam('delete',false);
    $this->renderPartial('manage/show',array('model'=>$this->loadAuthItem(),
        'deleted'=>$deleted,
        'delete'=>$delete));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'show' page.
   */
  public function actionCreate() {
    $model=new AuthItem;
    if(isset($_POST['AuthItem'])) {
      $model->attributes=$_POST['AuthItem'];
      try {
        $model->save();
        Yii::app()->user->setFlash('updateSuccess',
            "'".$model->name."' ".
            Helper::translate('srbac','created successfully'));
        $this->renderPartial('manage/update',array('model'=>$model));
      }catch (CDbException $exc ) {
        Yii::app()->user->setFlash('updateError',
            Helper::translate('srbac','Error while creating')
            .' '.$model->name."<br />".
            Helper::translate('srbac','Possible there\'s already an item with the same name'));
        $this->renderPartial('manage/create',array('model'=>$model));
      }
    } else {
      $this->renderPartial('manage/create',array('model'=>$model));
    }
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'show' page.
   */
  public function actionUpdate() {
    $model=$this->loadAuthItem();
    $message = "";
    if(isset($_POST['AuthItem'])) {
      $model->oldName = isset($_POST["oldName"]) ?  $_POST["oldName"] : $_POST["name"];
      $model->attributes=$_POST['AuthItem'];
      if($model->save()) {
        Yii::app()->user->setFlash('updateSuccess',
            "'".$model->name."' ".
            Helper::translate('srbac','updated successfully'));
      } else {

      }
    }
    $this->renderPartial('manage/update',array('model'=>$model));

  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'list' page.
   */
  public function actionDelete() {
    if(Yii::app()->request->isAjaxRequest) {

      $this->loadAuthItem()->delete();
      $this->processAdminCommand();

      $criteria=new CDbCriteria;

      $pages=new CPagination(AuthItem::model()->count($criteria));
      $pages->pageSize=$this->module->pageSize;
      $pages->applyLimit($criteria);

      $sort=new CSort('AuthItem');
      $sort->applyOrder($criteria);

      $models=AuthItem::model()->findAll($criteria);

      Yii::app()->user->setFlash('updateName',
          Helper::translate('srbac','Updating list'));
      $this->renderPartial('manage/show',array(
          'models'=>$models,
          'pages'=>$pages,
          'sort'=>$sort,
          'deleted'=>true,
          ),false,true);
    }
    else {
      throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
  }

  /**
   * Show the confirmation view for deleting auth items
   */
  public function actionConfirm() {
    $this->renderPartial('manage/show',
        array('model'=>$this->loadAuthItem(),'delete'=>true,'deleted'=>false),
        false,true);
  }

  /**
   * Lists all models.
   */
  public function actionList() {
  // Get selected type
    $selectedType =
        Yii::app()->request->getParam('selectedType',
        Yii::app()->user->getState("selectedType"));
    Yii::app()->user->setState("selectedType",$selectedType);

    //Get selected name
    $selectedName =
        Yii::app()->request->getParam('name',
        Yii::app()->user->getState("selectedName"));
    Yii::app()->user->setState("selectedName",$selectedName);

    if(!Yii::app()->request->isAjaxRequest) {
      Yii::app()->user->setState("currentPage",Yii::app()->request->getParam('page',0)-1);

    }
    $criteria=new CDbCriteria;
    $criteria->condition = "1";
    if($selectedName != "") {
      $criteria->condition .= " AND name LIKE '%".$selectedName."%'";
    }
    if($selectedType != "") {
      $criteria->condition .= " AND type = ".$selectedType;

    }
    $pages=new CPagination(AuthItem::model()->count($criteria));
    $pages->pageSize=$this->module->pageSize;
    $pages->applyLimit($criteria);
    $pages->route = "manage";
    $pages->setCurrentPage(Yii::app()->user->getState("currentPage"));
    $models=AuthItem::model()->findAll($criteria);
    $this->renderPartial('manage/list',array(
        'models'=>$models,
        'pages'=>$pages,
        ),false,true);
  }


  /**
   * Installs srbac (only in debug mode)
   */
  public function actionInstall() {
    if($this->module->debug) {
      $action = Yii::app()->getRequest()->getParam("action","");
      $demo = Yii::app()->getRequest()->getParam("demo",0);
      if($action) {
        $error = Helper::install($action,$demo);
        if($error == 1) {
          $this->render('install/overwrite', array("demo"=>$demo));
        } else if($error == 0) {
            $this->render('install/success', array("demo"=>$demo));
          } else if($error == 2) {
              $error = Helper::translate("srbac","Error while installing srbac.<br />Please check your database and try again");
              $this->render('install/error', array("demo"=>$demo, "error"=>$error));
            }
      } else {
        $this->render('install/install');
      }
    } else {
      $error = Helper::translate("srbac", "srbac must in debug mode");
      $this->render("install/error",array("error"=>$error));
    }
  }

  /**
   * Displayes the authitem manage page
   */
  public function actionManage() {
    $this->processAdminCommand();
    $page = Yii::app()->getRequest()->getParam("page","");
    if(Yii::app()->request->isAjaxRequest || $page != "") {
      $selectedType = Yii::app()->request->getParam('selectedType',Yii::app()->user->getState("selectedType"));
    } else {
      $selectedType = "";
    }
    Yii::app()->user->setState("selectedType",$selectedType);
    $criteria=new CDbCriteria;
    if($selectedType != "") {
      $criteria->condition = "type = ".$selectedType;

    }

    if(!Yii::app()->request->isAjaxRequest) {
      Yii::app()->user->setState("currentPage",Yii::app()->request->getParam('page',0)-1);

    }


    $pages=new CPagination(AuthItem::model()->count($criteria));
    $pages->route = "manage";
    $pages->pageSize=$this->module->pageSize;
    $pages->applyLimit($criteria);
    $pages->setCurrentPage(Yii::app()->user->getState('currentPage'));

    $sort=new CSort('AuthItem');
    $sort->applyOrder($criteria);

    $models=AuthItem::model()->findAll($criteria);
    $full = Yii::app()->request->getParam("full");
    if(Yii::app()->request->isAjaxRequest && !$full) {
      $this->renderPartial('manage/list',array(
          'models'=>$models,
          'pages'=>$pages,
          'sort'=>$sort,
          'full'=>$full,
          ),false,true);
    }else if(Yii::app()->request->isAjaxRequest && $full) {
        $this->renderPartial('manage/manage',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'full'=>$full
            ),false,true);
      }
      else {
        $this->render('manage/manage',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'full'=>$full,
        ));
      }
  }

  /**
   * Gets the authitems for the CAutocomplete textbox
   */
  public function actionAutocomplete() {
    $criteria = new CDbCriteria();
    $criteria->condition = "name LIKE :name";
    $criteria->params = array(":name"=>"%".Yii::app()->request->getParam('q')."%");
    $items = AuthItem::model()->findAll($criteria);
    foreach ($items as $item) {
      $valuesArray[] = $item->name;
    }
    echo join("\n",$valuesArray);

  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
   */
  public function loadAuthItem($id=null) {
    if($this->_model===null) {
      $r_id = Yii::app()->getRequest()->getParam("id","");
      if($id!==null || $r_id != "")
        $this->_model=AuthItem::model()->findbyPk($id!==null ? $id : $r_id);
      if($this->_model===null)
        throw new CHttpException(404,'The requested page does not exist.');
    }
    return $this->_model;
  }

  /**
   * Executes any command triggered on the admin page.
   */
  protected function processAdminCommand() {
    if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete') {
      $this->loadAuthItem($_POST['id'])->delete();
      // reload the current page to avoid duplicated delete actions
      $this->refresh();
    }
  }

  //TODO These messages should be replaced by flash messages
  /**
   * Sets the message that is displayed to the user
   * @param String $mess  The message to show
   */
  private function _setMessage($mess) {
    Yii::app()->user->setState("message",$mess);
  }
  /**
   *
   * @return String Gets the message that will be displayed to the user
   */
  private function _getMessage() {
    return Yii::app()->user->getState("message");
  }

  /**
   * Displayes the assignments page with no user selected
   */
  public function actionAssignments() {
    $this->render('assignments',array("id"=>0));
  }

  /**
   * Show a user's assignments.The user is passed by $_GET
   */
  public function actionShowAssignments() {
    $userid = isset($_GET["id"]) ? $_GET["id"] :
        $_POST[Helper::findModule('srbac')->userclass][$this->module->userid];
    $user = $this->module->getUserModel()->findByPk($userid);
    $username = $user->{$this->module->username};
    $r = array(0=>array(0=>array()));
    if ($userid > 0) {
      $auth = Yii::app()->authManager;
        /* @var $auth CDbAuthManager */
      $ass = $auth->getAuthItems(2,$userid);
      $r= array();
      foreach ($ass as $i=>$role) {
        $curRole = $role->name;
        $r[$i]=$curRole;
        $children = $auth->getItemChildren($curRole);
        $r[$i]= array();
        foreach ($children as $j=>$task) {
          $curTask = $task->name;
          $r[$i][$j]=$curTask;
          $grandchildren = $auth->getItemChildren($curTask);
          $r[$i][$j]= array();
          foreach ($grandchildren as $k=>$oper) {
            $curOper = $oper->name;
            $r[$i][$j][$k]=$curOper;
          }
        }
      }
      $this->renderPartial('userAssignments', array('data'=>$r,'username'=>$username));
    }
  }

  /**
   * Scans applications controllers and find the actions for autocreating of
   * authItems
   */
  public function actionScan() {
    $actions = array();
    $allowed = array();
    $auth = Yii::app()->authManager;
    $controller = Yii::app()->request->getParam('controller');
    //Check if it's a module controller
    if(substr_count($controller, "/")) {
      $c = split("/", $controller);
      $controller = $c[1];
      $module = $c[0];
      $contPath = Yii::app()->getModule($module)->getControllerPath();
      $control = $contPath.DIRECTORY_SEPARATOR.$controller.".php";
    } else {
      $module = "";
      $contPath = Yii::app()->getControllerPath();
      $control = $contPath.DIRECTORY_SEPARATOR.$controller.".php";
    }

    $task =$module.str_replace("Controller", "", $controller);

    $taskViewingExists = $auth->getAuthItem($task."Viewing")!==null ? true : false;
    $taskAdministratingExists = $auth->getAuthItem($task."Administrating")!==null ? true : false;
    $delete = Yii::app()->request->getParam('delete');

    $h = file($control);
    for ($i = 0 ; $i < count($h) ; $i++) {
      $line = trim($h[$i]);
      if(preg_match("/^(.+)function action*/", $line)) {
        $action = trim(substr($line, strpos($line, "action")));
        $action = str_replace("()", "", trim($action));
        $itemId = $module.str_replace("Controller","",$controller).
            str_replace("action", "", $action);
        if($action !="actions" ) {
          if($auth->getAuthItem($itemId) === null && !$delete) {
            if(!in_array($itemId, $this->allowedAccess())) {
              $actions[$module.$action] = $itemId;
            } else {
              $allowed[] = $itemId;
            }
          } else if($auth->getAuthItem($itemId)!==null && $delete) {
              $actions[$module.$action] = $itemId;
            }
        }
      }
    }
    $this->renderPartial("manage/createItems",
        array("actions"=>$actions,
        "controller"=>$controller,
        "delete"=>$delete,
        "task"=>$task,
        "taskViewingExists"=>$taskViewingExists,
        "taskAdministratingExists"=>$taskAdministratingExists,
        "allowed"=>$allowed),
        false, true);
  }

  /**
   * Deletes autocreated authItems
   */
  public function actionAutoDeleteItems() {
    $controller = str_replace("Controller","",$_POST["controller"]);
    $actions= isset($_POST["actions"])  ?$_POST["actions"]:array();
    $deleteTasks = isset($_POST["createTasks"]) ?$_POST["createTasks"] : 0;
    $tasks = $_POST["tasks"];
    $message = "<div style='font-weight:bold'>".Helper::translate('srbac','Delete operations')."</div>";
    foreach ($actions as $key => $action) {
      $action = trim(str_replace("action", $controller, $action));
      $auth=AuthItem::model()->findByPk($action);
      if($auth!==null) {
        $auth->delete();
        $message .= "<div>".$action." ".Helper::translate('srbac','deleted')."</div>";
      } else {
        $message .= "<div style='color:red;font-weight:bold'>".Helper::translate('srbac',
            'Error while deleting')
            .' '.$action."</div>";
      }
    }

    if($deleteTasks) {
      $message .= "<div style='font-weight:bold'>".Helper::translate('srbac','Delete tasks')."</div>";
      foreach ($tasks as $key => $taskname) {
        $auth=AuthItem::model()->findByPk($taskname);
        if($auth!==null) {
          $auth->delete();
          $message .= "<div>".$taskname." ".Helper::translate('srbac','deleted')."</div>";
        } else {
          $message .= "<div style='color:red;font-weight:bold'>".Helper::translate('srbac',
              'Error while deleting')
              .' '.$taskname."</div>";
        }

      }
    }
    echo $message;

  }

  /**
   * Autocreating of authItems
   */
  public function actionAutoCreateItems() {
    $controller = str_replace("Controller","",$_POST["controller"]);
    $actions= isset($_POST["actions"]) ? $_POST["actions"]:array();
    $message = "";
    $createTasks = isset($_POST["createTasks"]) ? $_POST["createTasks"] : 0;
    $tasks = isset($_POST["tasks"]) ? $_POST["tasks"] : array("");

    if($createTasks == "1") {
      $message = "<div style='font-weight:bold'>".Helper::translate('srbac','Creating tasks')."</div>";
      foreach ($tasks as $key => $taskname) {
        $auth=new AuthItem();
        $auth->name = $taskname;
        $auth->type = 1;
        try {
          if($auth->save()) {
            $message .=  "'".$auth->name."' ".
                Helper::translate('srbac','created successfully')."<br />";
          } else {
            $message .= "<div style='color:red;font-weight:bold'>".Helper::translate('srbac',
                'Error while creating')
                .' '.$auth->name.'<br />'.
                Helper::translate('srbac','Possible there\'s already an item with the same name')."</div><br />";
          }
        } catch (Exception $e) {
          $message .= "<div style='color:red;font-weight:bold'>".Helper::translate('srbac',
              'Error while creating')
              .' '.$auth->name.'<br />'.
              Helper::translate('srbac','Possible there\'s already an item with the same name')."</div><br />";
        }
      }
    }
    $message .= "<div style='font-weight:bold'>".Helper::translate('srbac','Creating operations')."</div>";
    foreach ($actions as $action) {
      $a = trim(str_replace("action", $controller, $action));
      $auth=new AuthItem();
      $auth->name = $a;
      $auth->type = 0;
      try {
        if($auth->save()) {
          $message .=  "'".$auth->name."' ".
              Helper::translate('srbac','created successfully')."<br />";
          if($createTasks == "1") {
            if($this->_isUserOperation($auth->name)) {
              $this->_assignChild($tasks["user"], array($auth->name));
            }
            $this->_assignChild($tasks["admin"], array($auth->name));

          }
        } else {
          $message .= "<div style='color:red;font-weight:bold'>".Helper::translate('srbac',
              'Error while creating')
              .' '.$auth->name.'<br />'.
              Helper::translate('srbac','Possible there\'s already an item with the same name')."</div><br />";
        }
      } catch (Exception $e) {
        $message .= "<div style='color:red;font-weight:bold'>".Helper::translate('srbac',
            'Error while creating')
            .' '.$auth->name.'<br />'.
            Helper::translate('srbac','Possible there\'s already an item with the same name')."</div><br />";
      }
    }
    echo $message;
  }

  /**
   * Gets the controllers and the modules' controllers for the autocreating of
   * authItems
   */
  public function actionAuto() {
    $contPath = Yii::app()->getControllerPath();
    $handle = opendir($contPath);
    while (($file = readdir($handle)) !== false) {
      if (is_file($contPath.DIRECTORY_SEPARATOR.$file)
          && preg_match( "/^(.+)Controller.php$/", basename( $file )) ) {
        $controlers[] = str_replace(".php","",$file);
      }
    }
    //Scan modules
    $modules = Yii::app()->getModules();

    foreach ($modules as $mod_id=>$mod) {
      $moduleControllersPath = Yii::app()->getModule($mod_id)->controllerPath;
      $handle = opendir($moduleControllersPath);
      while (($file = readdir($handle)) !== false) {
        if (is_file($moduleControllersPath.DIRECTORY_SEPARATOR.$file)
            && preg_match( "/^(.+)Controller.php$/", basename( $file )) ) {
          $controlers[] = $mod_id."/".str_replace(".php","",$file);
        }
      }
    }
    $this->renderPartial("manage/wizard", array(
        'controllers'=>$controlers),false,true);
  }

  /**
   *
   * @param <type> $operation
   * @return <type> Checks if an operations should be assigned to using task or not
   */
  function _isUserOperation($operation) {
    foreach ($this->module->userActions as $oper) {
      if(strpos(strtolower($operation), strtolower($oper)) > -1) {
        return true;
      }
    }
    return false;
  }

  /**
   * Displays srbac frontpage
   */
  public function actionFrontPage() {
    $this->render('frontpage', array());
  }

}
