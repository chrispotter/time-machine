<?php
/**
 * Created by PhpStorm.
 * User: chrispotter
 * Date: 3/11/15
 * Time: 8:54 PM
 */ 
class BlueAcorn_TimeMachine_Helper_Data extends Mage_Core_Helper_Abstract {

  protected function getConfig($path){
    return Mage::getStoreConfig('blueacorn_timemachine/general/'.$path);
  }

  public function getTimeMachineEnabled(){
    //todo check for enabled module
    //todo check for allowed user
    return $this->getConfig('enabled') && $this->getAdminSession();
  }

  protected function allowedUser($username){
    //TODO access database for blueacorn_timemachine/general/allowed_users and in_array $username
  }

  protected function getAdminSession()
  {
    /*
    This basically gets details of admin who is logged in on the backend! cool no ?
    */
    $switchSessionName = 'adminhtml';
    $currentSessionId = Mage::getSingleton('core/session')->getSessionId();
    $currentSessionName = Mage::getSingleton('core/session')->getSessionName();
    if ($currentSessionId && $currentSessionName && isset($_COOKIE[$currentSessionName])) {
      $switchSessionId = $_COOKIE[$switchSessionName];
      //switch to Admin Session
      $this->_switchSession($switchSessionName, $switchSessionId);
      //get current admin user session
      $admin_user = Mage::getModel('admin/session')->getUser();
//      $userId = Mage::getModel('admin/session')->getUser()->getId();
      //switch back to Frontend Session
      $this->_switchSession($currentSessionName, $currentSessionId);
      return !is_null($admin_user);
    }
    else{
      return false;
    }
  }

  protected function _switchSession($namespace, $id = null) {
    session_write_close();
    $GLOBALS['_SESSION'] = null;
    $session = Mage::getSingleton('core/session');
    if ($id) {
      $session->setSessionId($id);
    }
    $session->start($namespace);
  }

}