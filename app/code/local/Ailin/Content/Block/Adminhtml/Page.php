<?php

class Ailin_Content_Block_Adminhtml_Page extends
Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'ailin_content';
        $this->_controller = 'adminhtml_page';
        $this->_headerText = Mage::helper('ailin_content')->__('Page');
        parent::__construct();
    }
}