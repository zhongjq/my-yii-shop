<?php
/**
 * Install.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The install view.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.install
 * @since 1.0.0
 */
?>
<?php $error = false; $disabled = array(); ?>
<h3><?php echo Helper::translate('srbac','Install Srbac')?></h3>
<div class="srbac">
  <?php echo CHtml::beginForm(); ?>
  <div>
    <?php $this->renderPartial(Yii::app()->findLocalizedFile('install/installText'))?>
  </div>
  <div>
    <?php echo Helper::translate('srbac','Your Database, AuthManager and srbac settings:'); ?>
    <table class="srbacDataGrid" width="'100%">
      <?php if(Yii::app()->authManager instanceof CDbAuthManager) { ?>
        <?php try { ?>
      <tr>
        <th colspan="2"><?php echo Helper::translate('srbac','Database');?></th>
      <tr>
        <td><?php echo Helper::translate('srbac','Driver');?></td>
        <td><?php echo Yii::app()->getDb()->getDriverName()?></td>
      </tr>
      <tr>
        <td><?php echo Helper::translate('srbac','Connection');?></td>
        <td><?php echo Yii::app()->getDb()->connectionString?></td>
      </tr>
        <?php  } catch(CException $e) { ?>
      <tr><td colspan="2">
          <div class="error">
                <?php echo Helper::translate('srbac','Database is not Configured');?>
          </div>
        </td></tr>
          <?php $error =true; ?>
        <?php  }?>


        <?php try { ?>
      <tr>
        <th colspan="2"><?php echo Helper::translate('srbac','AuthManager');?></th>
      <tr>
        <td><?php echo Helper::translate('srbac','Item Table');?></td>
        <td><?php echo Yii::app()->authManager->itemTable?></td>
      </tr>
      <tr>
        <td><?php echo Helper::translate('srbac','Assignment Table');?></td>
        <td><?php echo Yii::app()->authManager->assignmentTable?></td>
      </tr>
      <tr>
        <td><?php echo Helper::translate('srbac','Item child table');?></td>
        <td><?php echo Yii::app()->authManager->itemChildTable?></td>
      </tr>
        <?php  } catch(CException $e) { ?>
      <tr>
        <td colspan="2">
          <div class="error">
                <?php echo Helper::translate('srbac','AuthManager is not Configured');?>
          </div>
        </td></tr>
          <?php $error =true; ?>
        <?php  }?>
      <?php  }?>
      <?php try { ?>
      <tr>
        <th colspan="2"><?php echo Helper::translate('srbac','srbac');?></th>
      </tr>
        <?php foreach (Helper::findModule("srbac") as $key=>$value) { ?>
      <tr>
        <td><?php echo $key ?></td>
        <td><?php echo (!is_array($value)) ? $value : CVarDumper::dump($value, 1, true); ?></td>
      </tr>
        <?php } ?>
      <?php  } catch(CException $e ) { ?>
      <tr>
        <td colspan="2">
          <div class="error">
              <?php echo Helper::translate('srbac','srbac is not Configured');?>
          </div>
        </td></tr>
        <?php $error =true;?>
      <?php  }?>
      <tr>
        <th colspan="2">Yii</th>
      </tr>
      <tr>
        <td>
          <?php echo Helper::translate("srbac", "Yii version")." :"; ?>
        </td>
        <?php if(Helper::checkYiiVersion(Helper::findModule("srbac")->getSupportedYiiVersion())) {?>
        <td><?php echo Yii::getVersion()?></td>
        <?php } else {?>
        <td style="color:red;font-weight:bold"><?php echo Yii::getVersion().
              "  <br /> ".
              Helper::translate("srbac","Wrong Yii version, lower required version is")." ".Helper::findModule("srbac")->getSupportedYiiVersion(); ?></td>
          <?php
          $error =true;
        } ?>
      </tr>
    </table>
  </div>
  <div>
    <?php if($error) { ?>
    <div>
        <?php echo Helper::translate('srbac','There is an error in your configuration') ?>
        <?php $disabled = array('disabled'=>true)?>
    </div>
    <?php } ?>
    <?php echo CHtml::hiddenField("action", "Install"); ?>
    <?php echo CHtml::checkBox("demo", true, $disabled);
    echo Helper::translate('srbac','Create demo authItems?')
    ?><br />
    <?php echo CHtml::submitButton(Helper::translate('srbac','Install'),$disabled); ?>
  </div>

  <?php echo CHtml::endForm(); ?>
</div>
