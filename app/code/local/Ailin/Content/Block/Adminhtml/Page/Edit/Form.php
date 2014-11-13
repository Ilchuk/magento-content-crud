<?php

class Ailin_Content_Block_Adminhtml_Page_Edit_Form extends
Mage_Adminhtml_Block_Widget_Form
{
    protected  function _prepareForm()
    {
        if(Mage::registry('content_page')){
            $data = Mage::registry('content_page')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'  => 'post',
            'enctype' => 'multupart/form-data',
         ));

        $form->setUseContainer(true);
        $this->setForm($form);
        $fieldset = $form->addFieldset('page_form', array(
            'legend' => Mage::helper('ailin_content')->__('Content Information')
        ));
        $fieldset->addField('title', 'text', array(
            'label'    => Mage::helper('ailin_content')->__('Title'),
            'class'    => 'required-entry',
            'required' => true,
            'name'     =>'title',
        ));
        $fieldset->addField('description','text', array(
            'label'    => Mage::helper('ailin_content')->__('Description'),
            'class'    => 'required-entry',
            'required' => true,
            'name'     => 'description',
        ));

        $form->setValues($data);
        return parent::_prepareForm();
    }
}