<?php

namespace BlueAcorn\TimeMachine\Block;

use Magento\Framework\View\Element\Template;

class TimeMachine extends Template{

    /**
     * @param \BlueAcorn\TimeMachine\Helper\Data $helper
     */

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \BlueAcorn\TimeMachine\Helper\Data $helper)
    {
        parent::__construct($context);
        $this->_helper = $helper;

    }

    protected function _prepareLayout()
    {

        if($this->_helper->getTimeMachineEnabled()){

            #include Blue Acorn Javascript & CSS
            $this->pageConfig->addPageAsset(
                'BlueAcorn_TimeMachine::js/blueacorn_timemachine.js',
                ['attributes' =>
                    [
                        'charset' => 'utf-8',
                        'async' => '',
                        'data-requirecontext' => '_',
                        'data-requiremodule' => 'js/theme'
                    ]
                ],
                'ba-timemachine'
            );
            $this->pageConfig->addPageAsset('BlueAcorn_TimeMachine::css/blueacorn_timemachine.css');


        }
    }


}