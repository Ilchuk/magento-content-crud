<?php

class Ailin_Content_Model_Resource_Page extends
Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('ailin_content/page', 'page_id');
    }
}