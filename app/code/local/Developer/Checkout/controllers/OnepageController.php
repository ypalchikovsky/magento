<?php
/**
 * OnepageController.php
 *
 * @package      Developer
 * @subpackage   Checkout
 * @copyright    n/a
 * @author       ypalchikovsky@gmail.com
 * @date         2017-06-15
 */
require_once Mage::getModuleDir('controllers', 'Mage_Checkout') . DS . 'OnepageController.php';

class Developer_Checkout_OnepageController extends Mage_Checkout_OnepageController
{
    /**
     * Order success action for fixed order_id
     * @NOTE: NOT FOR PROD ENVS
     */
    public function testSuccessAction()
    {
        $order = Mage::getModel('sales/order')->loadByIncrementId($this->getRequest()->getParam('order'));

        if (!$order->getId()) {
            $this->_redirect('checkout/cart');
            return;
        }

        $session = $this->getOnepage()
            ->getCheckout()
            ->setLastOrderId($order->getId())
            ->setLastQuoteId($order->getQuoteId())
            ->setLastSuccessQuoteId($order->getQuoteId());

        $this->_forward('success');
    }

}