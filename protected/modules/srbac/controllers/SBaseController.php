<?php
/**
 * SBaseController class file.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * SBaseController must be extended by all of the applications controllers
 * if the auto srbac should be used.
 * You can import it in your main config file as<br />
 * 'import'=>array(<br />
 * 'application.modules.srbac.controllers.SBaseController',<br />
 * ),
 *
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.controllers
 * @since 1.0.2
 */
class SBaseController extends CController {
	public $defaultAction='frontpage';

/**
 * Checks if srbac access is granted for the current user
 * @param String $action . The current action
 * @return boolean true if access is granted else false
 */
  protected function beforeAction($action) {

  //srbac access
    $mod = $this->module !== null ? $this->module->id : "";
    $access =  $mod.ucfirst($this->id).ucfirst($this->action->id);

	if($this->action->id == 'captcha')
	{
		return true;
	}


    //Always allow access if $access is in the allowedAccess array
    if(in_array($access, $this->allowedAccess())) {
      return true;
    }

    //Allow access if srbac is not installed yet
    if(!Yii::app()->getModule('srbac')->isInstalled()) {
      return true;
    }

    // Check for srbac access
    if(!Yii::app()->user->checkAccess($access) || Yii::app()->user->isGuest) {
    // You may change this messages
      $error["code"] = "403";
      $error["title"] = "You are not authorized for this action";
      $error["message"] = "Error while trying to access " .$mod."/".$this->id."/".$this->action->id."." ;
      //You may change the view for unauthorized access
      if(Yii::app()->request->isAjaxRequest) {
        $this->renderPartial(Yii::app()->getModule('srbac')->notAuthorizedView,array("error"=>$error));
      } else {
        $this->render(Yii::app()->getModule('srbac')->notAuthorizedView,array("error"=>$error));
      }
      return false;
    } else {
      return true;
    }
  }

  /**
   * The auth items that access is always  allowed. Configured in srbac module's
   * configuration
   * @return The always allowed auth items
   */
  protected function allowedAccess() {
    return Yii::app()->getModule('srbac')->alwaysAllowed;
  }
}
?>
