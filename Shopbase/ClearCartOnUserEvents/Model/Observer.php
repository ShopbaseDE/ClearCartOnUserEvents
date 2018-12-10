<?php
/**
 * Class Shopbase_ClearCartOnUserEvents_Model_Observer
 * Copyright (c) 2018 Shopbase
 *
 * @author Hendrik Legge <adming@themepoint.de>
 * @version 1.0.0
 */

class Shopbase_ClearCartOnUserEvents_Model_Observer extends Mage_Core_Model_Abstract {

    /**
     * Shopbase_ClearCartOnUserEvents_Model_Observer constructor.
     */
    public function __construct() {}

    /**
     * Executed when authentication action 'login' is called.
     *
     * @param $observer
     */
    public function onLogin($observer) {
        foreach(Mage::getSingleton('checkout/session')->getQuote()->getItemsCollection() as $item) {
            Mage::getSingleton('checkout/cart')->removeItem($item->getId())->save();
        }
    }

    /**
     * Executed when authentication action 'logout' is called.
     *
     * @param $observer
     */
    public function onLogout($observer){
        Mage::getSingleton('checkout/cart')->truncate();
        Mage::getSingleton('checkout/cart')->save();
    }
}
