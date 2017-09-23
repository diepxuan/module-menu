<?php
/**
 * Copyright © 2017 Magento, Inc. All rights reserved.
 */
namespace Diepxuan\Menu\Helper;

class Topmenu
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
     * @param  \Magento\Framework\Data\Tree\Node $menu
     * @return \Magento\Framework\Data\Tree\Node
     */
    public function general(\Magento\Framework\Data\Tree\Node $menu)
    {
        $node = $this->_nodeFactory->create(
            [
                'data'    => $this->getNodeAsArray(),
                'idField' => 'id',
                'tree'    => $menu->getTree(),
            ]
        );
        $menu->addChild($node);
        return $menu;
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
