<?php
/**
 * Helper class file.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * Helper is a class providing static methods that are used across srbac.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.components
 * @since 1.0.0
 */
class Helper {

/**
 * Return the roles assigned to a user or all the roles if no userid is provided
 * @param string $userid The id of the user
 * @return array An array of roles(AuthItems) assigned to the user
 */
  public static function getUserAssignedRoles($userid) {
    $assigned = new CDbCriteria();
    $assigned->join = 'LEFT JOIN '.Assignments::model()->tableName().' a ON name = a.itemname';
    if($userid) {
      $assigned->condition = "type = 2 AND userid= '".$userid."'";
    } else {
      $assigned->condition = "type = 2";
    }
    $assigned->order = "name ASC";
    $assigned =  AuthItem::model()->findAll($assigned);
    return ($assigned === null) ? array(): $assigned;
  }

  /**
   * Gets the roles that are not assigned to the user by getting all the roles and
   * removes those assigned to the user, or all the roles if no user id is provided
   * @param String $userid The user's id
   * @return array An array of roles(AuthItems) not assigned to the user
   */
  public static function getUserNotAssignedRoles($userid) {
    $roles = new CDbCriteria();
    $roles->condition = "type=2";
    $roles->order = "name ASC";
    $final = array();
    if($userid) {
      $na = AuthItem::model()->findAll($roles);
    } else {
      return AuthItem::model()->findAll($roles);
    }
    $as = Helper::getUserAssignedRoles($userid);
    foreach ($na as $n) {
      $exists = false;
      foreach ($as as $a) {
        if($a['name']==$n['name']) {
          $exists = true;
        }
      }
      if(!$exists) {
        $final[] = $n;
      }
    }
    return ($final === null) ? array(): $final;
  }

  /**
   * Return the tasks assigned to a role or all the tasks if no role is provided
   * @param string $name The name of the role
   * @return array An array of tasks(AuthItems) assigned to the role
   */
  public static function getRoleAssignedTasks($name) {
    $tasks = new CDbCriteria();
    if($name) {
      $tasks->condition = "type=1 AND parent ='".$name."'";
      $tasks->join = 'left join '.Yii::app()->authManager->itemChildTable.' on name = child';
    } else {
      $tasks->condition = "type=1";
    }
    $tasks->order = "name ASC";
    $assigned = AuthItem::model()->findAll($tasks);

    return ($assigned === null) ? array(): $assigned;

  }
  /**
   * Return the tasks not assigned to a role by getting all the tasks and
   * removing those assigned to the role, or all the tasks if no role is provided
   * @param string $name The name of the role
   * @return array An array of tasks(AuthItems) not assigned to the role
   */
  public static function getRoleNotAssignedTasks($name) {
    $tasks = new CDbCriteria();
    $tasks->condition = "type=1";
    $tasks->order = "name ASC";
    $final = array();
    if($name) {
      $na = AuthItem::model()->findAll($tasks);
    } else {
      return AuthItem::model()->findAll($tasks);
    }
    $as = Helper::getRoleAssignedTasks($name);
    foreach ($na as $n) {
      $exists = false;
      foreach ($as as $a) {
        if($a['name']==$n['name']) {
          $exists = true;
        }
      }
      if(!$exists) {
        $final[] = $n;
      }
    }
    return ($final === null) ? array(): $final;
  }
  /**
   * Return the operations assigned to a task or all the operations if no task
   * is provided
   * @param string $name The name of the task
   * @return array An array of operations(AuthItems) assigned to the task
   */
  public static function getTaskAssignedOpers($name) {
    $tasks = new CDbCriteria();
    if($name) {
      $tasks->condition = "type=0 AND parent ='".$name."'";
      $tasks->join = 'left join '.Yii::app()->authManager->itemChildTable.' on name = child';
    } else {
      $tasks->condition = "type=0";
    }
    $tasks->order = "name ASC";
    $assigned = AuthItem::model()->findAll($tasks);

    return ($assigned === null) ? array(): $assigned;

  }
  /**
   * Return the operations not assigned to a task by getting all the operations
   * and removing those assigned to the task, or all the operations if no task
   * is provided
   * @param string $name The name of the task
   * @return array An array of operations(AuthItems) not assigned to the task
   */
  public static function getTaskNotAssignedOpers($name) {
    $tasks = new CDbCriteria();
    $tasks->condition = "type=0";
    $final = array();
    if($name) {
      $na = AuthItem::model()->findAll($tasks);
    } else {
      return AuthItem::model()->findAll($tasks);
    }
    $as = Helper::getTaskAssignedOpers($name);
    foreach ($na as $n) {
      $exists = false;
      foreach ($as as $a) {
        if($a['name']==$n['name']) {
          $exists = true;
        }
      }
      if(!$exists) {
        $final[] = $n;
      }
    }
    return ($final === null) ? array(): $final;
  }

  /**
   * Marking words / phrases that are missing translation by adding a red * after
   * the word / phrase
   * @param CMissingTranslationEvent $event
   */
  public static function markWords($event) {
    if(Helper::findModule('srbac')->debug) {
      $event->message .= "<span style='color:red'>*</span>";
    }
  }

  /**
   * Check if authorizer is assigned to a user.
   * Until Authorizer is assigned to a user all users have access to srbac
   * administration. Also all users have access to srbac admin if srbac debug
   * attribute is true
   * @return true if authorizer is assigned to a user
   */
  public static function isAuthorizer() {
    if(Helper::findModule('srbac')->debug) {
      return false;
    }
    $criteria = new CDbCriteria();
    $criteria->condition = "itemname = '".Helper::findModule('srbac')->superUser."'";
    $authorizer = Assignments::model()->find($criteria);
    if($authorizer !== null) {
      return true;
    }
    return false;
  }

  /**
   * If action is "install" checks for previous installations and if there's
   * one asks for ovewrite. If action is "ovewrite" or there's not a previous
   * installation performs the installation and returns the status of the
   * installation
   * @param String action
   * @param int demo
   * @return int status (0:Success, 1:Ovewrite, 2: Error)
   */
  public static function install($action,$demo) {
    $db = Yii::app()->db;
    /* @var $db CDbConnection */
    $auth = Yii::app()->authManager;
    /* @var $auth CDbAuthManager */
    $itemTable = $auth->itemTable;
    if($action == "Install") {
      if(Helper::findModule("srbac")->isInstalled()) {
        return 1; // Already installed
      } else {
        return  Helper::_install($demo);
      }
    } else {
      return Helper::_install($demo);
    }

  }

  /**
   * Performs the installation and returns the status
   * @param int demo
   * @return int status (0:Success, 1:Ovewrite, 2: Error)
   */
  private static function _install($demo) {
    $db = Yii::app()->db;
    /* @var $db CDbConnection */
    $auth = Yii::app()->authManager;
    /* @var $auth CDbAuthManager */
    $transaction  = $db->beginTransaction();
    $itemTable = $auth->itemTable;
    $assignmentTable = $auth->assignmentTable;
    $itemChildTable = $auth->itemChildTable;
    try {
    // Drop tables
      $db->createCommand("drop table if exists ".$assignmentTable.";")->execute();
      $db->createCommand("drop table if exists ".$itemChildTable.";")->execute();
      $db->createCommand("drop table if exists ".$itemTable.";")->execute();

      //create tables
      $sql = "create table ".$itemTable." (name varchar(64) not null,
                                     type integer not null,
                                     description text,
                                     bizrule text,
                                     data text,
                                     primary key (name));";
      $db->createCommand($sql)->execute();
      $sql ="create table ".$itemChildTable." (parent varchar(64) not null,
                                              child varchar(64) not null,
                                              primary key (parent,child),
                                              foreign key (parent) references ".$itemTable." (name) on delete cascade on update cascade,
                                              foreign key (child) references ".$itemTable." (name) on delete cascade on update cascade
                                              );";
      $db->createCommand($sql)->execute();
      $sql = "create table ".$assignmentTable."(itemname varchar(64) not null,
                                                userid varchar(64) not null,
                                                bizrule text,
                                                data text,
                                                primary key (itemname,userid),
                                                foreign key (itemname) references ".$itemTable." (name) on delete cascade on update cascade
                                              );";
      $db->createCommand($sql)->execute();
      //Insert Authorizer
      $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('".Helper::findModule('srbac')->superUser."',2)";
      $db->createCommand($sql)->execute();
      if($demo == 1) {
      //Insert Demo Data
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('Administrator',2)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('User',2)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('Post Manager',1)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('User Manager',1)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('Delete Post',0)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('Create Post',0)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('Edit Post',0)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('View Post',0)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('Delete User',0)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('Create User',0)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('Edit User',0)";
        $db->createCommand($sql)->execute();
        $sql = "INSERT INTO ".$itemTable." (name, type) VALUES ('View User',0)";
        $db->createCommand($sql)->execute();
      }
      $transaction->commit();
    } catch(CDbException $ex) {
      $transaction->rollback();
      return 2; //Error
    }
    return 0; //Success
  }

  /**
   * Find a module searching in application modules and if it's not found there
   * looks in modules' modules
   * @param String $moduleID The model to find
   * @return The module, if it's found else null
   */
  public static function findModule($moduleID) {
    if(Yii::app()->getModule($moduleID)) {
      return Yii::app()->getModule($moduleID);
    }
    $modules = Yii::app()->getModules();
    foreach ($modules as $mod=>$conf) {
      if(Yii::app()->getModule($mod)) {
        return Helper::findInModule(Yii::app()->getModule($mod), $moduleID);
      }
    }
    return null;
  }

  /**
   * Search for a child module
   * @param String $parent The parent module
   * @param String $moduleID The module to find
   * @return The module, if it's not found returns null
   */
  private static function findInModule($parent, $moduleID) {
    if ($parent->getModule($moduleID)) {
      return $parent->getModule($moduleID);
    } else {
      $modules = $parent->getModules();
      foreach ($modules as $mod => $conf) {
        return $this->findInModule($parent->getModule($mod), $moduleID);
      }
    }
    return null;
  }

  /**
   * Translates texts based on Yii version
   * @param String $source The messages source
   * @param String $text The text to transalte
   * @return String The translated text
   */
  public static function translate($source, $text) {
    $version =  explode(".", Yii::getVersion());
    if(!Helper::checkYiiVersion("1.0.10")) {
      return Yii::app()->getModule("srbac")->tr->translate($source,$text,$lang);
    } else {
      return Yii::t('srbacModule.'.$source,$text);
    }
  }

  /**
   * Checks if a given version is supported by the current running Yii version
   * @param String $checkVersion
   * @return boolean True if the given version is supportedby the running Yii
   * version
   */
  public static function checkYiiVersion($checkVersion) {
  //remove dev builds
    $yiiVersionNoBuilds =  explode("-", Yii::getVersion());
    
    $checkVersion = explode(".",$checkVersion);
    $yiiVersion =  explode(".", $yiiVersionNoBuilds[0]);

    if(
        $yiiVersion[0] >= $checkVersion[0] &&
        $yiiVersion[1] >= $checkVersion[1] &&
        $yiiVersion[2] >= $checkVersion[2]) {
      return true;
    } else {
      return false;
    }
  }
}
?>
