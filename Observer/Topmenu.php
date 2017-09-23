<?php

namespace Diepxuan\Menu\Observer;

use Magento\Framework\Data\Tree\Node;

class Topmenu implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Magento\Framework\Data\Tree\NodeFactory
     */
    protected $_nodeFactory;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $_request;

    /**
     * @param \Magento\Framework\Data\Tree\NodeFactory $nodeFactory
     * @param \Magento\Framework\App\Request\Http      $request
     */
    public function __construct(
        \Magento\Framework\Data\Tree\NodeFactory $nodeFactory,
        \Magento\Framework\App\Request\Http      $request
    ) {
        $this->_nodeFactory = $nodeFactory;
        $this->_request     = $request;
    }

    /**
     * @param  \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Framework\Data\Tree\Node $menu */
        $menu = $observer->getMenu();
        $node = $this->_nodeFactory->create(
            [
                'data'    => $this->getNodeAsArray(),
                'idField' => 'id',
                'tree'    => $menu->getTree(),
            ]
        );
        $menu->addChild($node);
        return $this;
    }

    /**
     * @return Array
     */
    protected function getNodeAsArray()
    {
        return [
            'name'       => __('Home'),
            'id'         => 'home',
            'url'        => '/',
            'has_active' => true,
            'is_active'  => $this->isHomepage(),
        ];
    }

    /**
     * @return boolean
     */
    protected function isHomepage()
    {

        if ($this->_request->getFullActionName() == 'cms_index_index') {
            return true;
        }
        return false;
    }
}
