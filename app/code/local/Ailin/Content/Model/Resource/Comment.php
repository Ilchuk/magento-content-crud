<?php

class Ailin_Content_Model_Resource_Comment extends
Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('ailin_content/comment', 'comment_id');
    }
}