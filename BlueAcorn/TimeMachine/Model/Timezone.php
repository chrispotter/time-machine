<?php

namespace BlueAcorn\TimeMachine\Model;

class Timezone
{

    public function __construct(
        \BlueAcorn\TimeMachine\Helper\Data $helper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->_helper = $helper;
        $this->_scopeConfig = $scopeConfig;
    }


    public function storeTimeStamp($store = null)
    {

        $timezone = \Magento\Core\Helper\Data::XML_PATH_DEFAULT_TIMEZONE;
        $currentTimezone = @date_default_timezone_get();
        @date_default_timezone_set($timezone);
        if ($this->_helper->getTimeMachineEnabled()) {
            $cookie = Mage::getModel('core/cookie')->get('blueacorn_timemachine');
            if ($cookie) {
                $date = date_create($cookie)->format('Y-m-d H:i:s');
            } else {
                $date = date('Y-m-d H:i:s');
            }
        } else {
            $date = date('Y-m-d H:i:s');
        }
        @date_default_timezone_set($currentTimezone);
        return strtotime($date);
    }



}
