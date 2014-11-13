<?php

class Ailin_Content_Block_Adminhtml_Page_Edit extends
Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'ailin_content';
        $this->_controller = 'adminhtml_page';
        $this->_mode = 'edit';

        $this->_addButton('save_and_continue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);
        $this->_updateButton('save', 'label', Mage::helper('ailin_content')->__('Save'));

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('form_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'edit_form');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('content_page') && Mage::registry('content_page')->getId())
        {
            return Mage::helper('ailin_content')->__('Edit Content "%s"', $this->htmlEscape(Mage::registry('content_page')->getTitle()));
        } else {
            return Mage::helper('ailin_content')->__('New Content');
        }
    }
}