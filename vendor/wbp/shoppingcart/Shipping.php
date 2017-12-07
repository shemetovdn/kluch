<?php

namespace wbp\shoppingcart;

use common\models\Config;

class Shipping extends DiscountBehavior
{
    /**
     * @param CostCalculationEvent $event
     */
    public function onCostCalculation($event)
    {
        if($this->owner->getSubTotal()<Config::getParameter('free_shipping')){
            $event->shippingValue = \common\models\Config::getParameter('shipping_value');
        }else{
            $event->shippingValue = 0;
        }
        // Some discount logic, for example
    }
}