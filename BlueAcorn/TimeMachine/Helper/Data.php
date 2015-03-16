<?php

namespace BlueAcorn\TimeMachine\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_session;
    protected $_auth;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Backend\Model\Session $session,
        \Magento\Backend\Model\Auth\Session $auth)
    {

        $this->_scopeConfig = $scopeConfig;
        $this->_session = $session;
        $this->_auth = $auth;
    }

    protected function getConfig($path){
        return $this->_scopeConfig->getValue('blueacorn_timemachine/general/'.$path);
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

        $currentSessionId = $this->_session->getSessionId();
        $currentSessionName = $this->_session->getName();

        if ($currentSessionId && $currentSessionName && isset($_COOKIE[$currentSessionName])) {
            $switchSessionId = $_COOKIE[$switchSessionName];
//            //switch to Admin Session
//            $this->_switchSession($switchSessionName, $currentSessionId);
//            //get current admin user session
//            $admin_user = $this->_auth->getUser();
////      $userId = Mage::getModel('admin/session')->getUser()->getId();
//            //switch back to Frontend Session
//            $this->_switchSession($currentSessionName, $currentSessionId);
//            return !is_null($admin_user);
            return true;
        }
        else{
            return false;
        }

    }

    protected function _switchSession($namespace, $id = null) {
        session_write_close();
        $GLOBALS['_SESSION'] = null;
        if ($id) {
            $this->_session->setSessionId($id);
        }
        $this->_session->start($namespace);
    }



}