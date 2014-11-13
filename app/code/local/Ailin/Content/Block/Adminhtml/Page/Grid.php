<?php

class Ailin_Content_Block_Adminhtml_Page_Grid extends
Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('page_grid');
        $this->setDefaultSort('page_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
    protected  function _prepareCollection()
    {
        $collection = Mage::getModel('ailin_content/page')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('page_id', array(
            'header' => Mage::helper('ailin_content')->__('ID'),
            'align'  => 'right',
            'width'  => '50px',
            'index'  => 'page_id',
        ));

        $this->addColumn('title', array(
            'header' =>  Mage::helper('ailin_content')->__('Title'),
            'align'  => 'left',
            'index'  => 'title',
        ));

        $this->addColumn('description', array(
            'header' => Mage::helper('ailin_content')->__('Description'),
            'align'  => 'left',
            'index'  => 'description',
        ));

        return parent::_prepareColumns();
    }

    public  function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}