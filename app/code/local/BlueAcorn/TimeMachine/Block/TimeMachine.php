<?php
/**
 * Created by PhpStorm.
 * User: chrispotter
 * Date: 3/11/15
 * Time: 9:10 PM
 */

class BlueAcorn_TimeMachine_Block_TimeMachine extends Mage_Core_Block_Template
{
  var $_helper;

  protected function _construct(){
    parent::_construct();
    $this->_helper = Mage::helper('blueacorn_timemachine');
  }

  protected function _prepareLayout()
  {
    if($this->_helper->getTimeMachineEnabled()){
      #include Blue Acorn Javascript
      $this->getLayout()->getBlock('head')->addItem('skin_js', 'js/blueacorn/blueacorn_timemachine.js');
      $this->getLayout()->getBlock('head')->addItem('skin_css', 'css/blueacorn/blueacorn_timemachine.css');
      #include JQuery UI
      $this->getLayout()->getBlock('head')->addItem('skin_js', 'js/blueacorn/jquery-ui.min.js');
      $this->getLayout()->getBlock('head')->addItem('skin_css', 'css/blueacorn/jquery-ui.min.css');
    }
  }
}