<?php

namespace Diepxuan\Menu\Plugin\Block\Html;

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
     * @param  \Magento\Theme\Block\Html\Topmenu $subject
     * @param  string                            $outermostClass
     * @param  string                            $childrenWrapClass
     * @param  integer                           $limit
     * @return [type]
     */
    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
                                          $outermostClass = '',
                                          $childrenWrapClass = '',
                                          $limit = 0
    ) {
        $node = $this->_nodeFactory->create(
            [
                'data'    => $this->getNodeAsArray(),
                'idField' => 'id',
                'tree'    => $subject->getMenu()->getTree(),
            ]
        );
        $subject->getMenu()->addChild($node);
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
