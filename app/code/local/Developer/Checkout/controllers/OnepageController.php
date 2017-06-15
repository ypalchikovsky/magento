<?php
/**
 * OnepageController.php
 * 
 * @package      CoH / AGoldE
 * @subpackage   Developer
 * @copyright    Gorilla Group (www.gorillagroup.com)
 * @author       ypalchikovsky@gorillagroup.com
 * @date         2017-06-15
 */
require_once('Mage/Checkout/controllers/OnepageController.php');

class Developer_Checkout_OnepageController extends Mage_Checkout_OnepageController
{
    /**
     * Order success action for fixed order_id
     * @NOTE: NOT FOR PROD ENVS
     */
    public function testSuccessAction()
    {
        $orderId = $this->getRequest()->getParam('order_id');
        $order = Mage::getModel('sales/order')->load($orderId);

        if (!$order->getId()) {
            $this->_redirect('checkout/cart');
            return;
        }

        $session = $this->getOnepage()
            ->getCheckout()
            ->setLastOrderId($orderId)
            ->setLastQuoteId($order->getQuoteId())
            ->setLastSuccessQuoteId($order->getQuoteId());

        $this->_forward('success');
    }

}