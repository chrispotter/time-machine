<?php
/**
 * Created by PhpStorm.
 * User: chrispotter
 * Date: 3/11/15
 * Time: 8:59 PM
 */ 
class BlueAcorn_TimeMachine_Model_Core_Locale extends Mage_Core_Model_Locale {

  /**
   * Get store timestamp
   * Timstamp will be builded with store timezone settings
   *
   * @param   mixed $store
   * @return  int
   */
  public function storeTimeStamp($store=null)
  {
    $_helper = Mage::helper('blueacorn_timemachine');

    $timezone = Mage::app()->getStore($store)->getConfig(self::XML_PATH_DEFAULT_TIMEZONE);
    $currentTimezone = @date_default_timezone_get();
    @date_default_timezone_set($timezone);
    if($_helper->getTimeMachineEnabled()){
      $cookie = Mage::getModel('core/cookie')->get('blueacorn_timemachine');
      if($cookie){
        $date = date_create($cookie)->format('Y-m-d H:i:s');
      }else{
        $date = date('Y-m-d H:i:s');
      }
    }else{
      $date = date('Y-m-d H:i:s');
    }
    @date_default_timezone_set($currentTimezone);
    return strtotime($date);
  }

}