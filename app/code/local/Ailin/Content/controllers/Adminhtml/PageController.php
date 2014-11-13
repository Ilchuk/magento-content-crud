<?php

class Ailin_Content_Adminhtml_PageController extends
Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Content'))->_title($this->__('Page Content'));
        $this->loadLayout();
        $this->_setActiveMenu('ailin_content/page');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('ailin_content/page');
        if($id){
            $model->load((int)$id);
            if($model->getId()){
                $data = Mage::getSingleton('adminhtml/session')->setFormData(true);
                if($data){
                    $model->setData($data)->setId($id);
                }
            } else{
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ailin_content')->__('Content does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('content_page', $model);

        $this->_title($this->__('Page Content'))->_title($this->__('Edit Content'));
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function saveAction()
    {
        if($data = $this->getRequest()->getPost()){
            $model = Mage::getModel('ailin_content/page');
            $id = $this->getRequest()->getParam('id');

            foreach ($data as $key => $value)
            {
                if(is_array($value))
                {
                    $data[$key] = implode(',',$this->getRequest()->getParam($key));
                }
            }
            if($id){
                $model->load($id);
            }
            $model->setData($data);
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try{
                if($id){
                    $model->setId($id);
                }
                $model->save();
                if(!$model->getId()){
                    Mage::throwException(Mage::helper('ailin_content')->__('Error saving Content'));
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('ailin_content')->__('Content Saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                //save or save and continue
                if($this->getRequest()->getParam('back')){
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else{
                    $this->_redirect('*/*/');
                }
            }catch(Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                if($model && $model->getId()){
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                }else{
                    $this->_redirect('*/*/');
                }
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ailin_content')->__('No data found to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if($id =$this->getRequest()->getParam('id')){
            try{
                $model = Mage::getModel('ailin_content/page');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('ailin_content')->__('All items are Deleted'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Unable to find content'));
        $this->_redirect('*/*/');
    }

}