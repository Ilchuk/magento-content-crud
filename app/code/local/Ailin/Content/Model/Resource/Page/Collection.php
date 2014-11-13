<?php

class Ailin_Content_Model_Resource_Page_Collection extends
Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('ailin_content/page');
    }
}