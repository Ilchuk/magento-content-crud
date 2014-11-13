<?php

class Ailin_Content_Adminhtml_CommentController extends
Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Comments'))->_title($this->__('Comments'));
        $this->loadLayout();
        $this->_setActiveMenu('ailin_content/comment');
        $commentBlock = $this->getLayout()->createBlock('ailin_content/adminhtml_comment');
        $this->_addContent($commentBlock);
        $this->renderLayout();
    }
}