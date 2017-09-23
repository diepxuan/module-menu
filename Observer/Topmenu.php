<?php
/**
 * Copyright © 2017 Dxvn, Inc. All rights reserved.
 * @author Tran Ngoc Duc <ductn@diepxuan.com>
 */
namespace Diepxuan\Menu\Observer;

use Magento\Framework\Data\Tree\Node;

class Topmenu implements \Magento\Framework\Event\ObserverInterface
{
    protected $_menuHelper;

    /**
     * @param \Diepxuan\Menu\Helper\Topmenu $menuHelper
     */
    public function __construct(
        \Diepxuan\Menu\Helper\Topmenu $menuHelper
    ) {
        $this->_menuHelper = $menuHelper;
    }

    /**
     * @param  \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Framework\Data\Tree\Node $menu */
        $menu = $this->_menuHelper->general($observer->getMenu());
        return $this;
    }
}
