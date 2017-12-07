<?php

namespace wbp\shoppingcart;

use yii\base\Component;
use yii\base\Event;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\web\Session;


/**
 * Class ShoppingCart
 * @property CartPositionInterface[] $positions
 * @property int $count Total count of positions in the cart
 * @property int $cost Total cost of positions in the cart
 * @property bool $isEmpty Returns true if cart is empty
 * @property string $hash Returns hash (md5) of the current cart, that is uniq to the current combination
 * of positions, quantities and costs
 * @property string $serialized Get/set serialized content of the cart
 * @package \yz\shoppingcart
 */
class ShoppingCart extends Component
{
    /** Triggered on position put */
    const EVENT_POSITION_PUT = 'putPosition';
    /** Triggered on position update */
    const EVENT_POSITION_UPDATE = 'updatePosition';
    /** Triggered on after position remove */
    const EVENT_BEFORE_POSITION_REMOVE = 'removePosition';
    /** Triggered on any cart change: add, update, delete position */
    const EVENT_CART_CHANGE = 'cartChange';
    /** Triggered on after cart cost calculation */
    const EVENT_COST_CALCULATION = 'costCalculation';

    /**
     * If true (default) cart will be automatically stored in and loaded from session.
     * If false - you should do this manually with saveToSession and loadFromSession methods
     * @var bool
     */
    public $storeInSession = true;
    /**
     * Session component
     * @var string|Session
     */
    public $session = 'session';
    /**
     * Shopping cart ID to support multiple carts
     * @var string
     */
    public $cartId = __CLASS__;

    public $hidden;

    /**
     * @var CartPositionInterface[]
     */
    protected $_positions = [];
    protected $_positionsLunches = [];

    public function init()
    {
        if ($this->storeInSession)
            $this->loadFromSession();
    }

    public function setHidden($hidden){
        $this->session[$this->cartId.'_hidden'] = $hidden;
    }

    /**
     * Loads cart from session
     */
    public function loadFromSession()
    {
        $this->session = Instance::ensure($this->session, Session::className());
        if (isset($this->session[$this->cartId])){
            $this->setSerialized($this->session[$this->cartId],$this->session[$this->cartId.'_lunch']);
            $this->hidden = $this->session[$this->cartId.'_hidden'];
        }
    }

    /**
     * Saves cart to the session
     */
    public function saveToSession()
    {
        $this->session = Instance::ensure($this->session, Session::className());
        $this->session[$this->cartId] = $this->getSerialized();
        $this->session[$this->cartId.'_lunch'] = $this->getSerializedLunch();
    }

    /**
     * Sets cart from serialized string
     * @param string $serialized
     */
    public function setSerialized($serialized,$serializedLunches)
    {
        $this->_positions = unserialize($serialized);
        $this->_positionsLunches = unserialize($serializedLunches);
    }

    /**
     * @param CartPositionInterface $position
     * @param int $quantity
     */
    public function put($position, $quantity = 1)
    {
        if (isset($this->_positions[$position->getId()])) {
            $this->_positions[$position->getId()]->setQuantity(
                $this->_positions[$position->getId()]->getQuantity() + $quantity);
        } else {
            $position->setQuantity($quantity);
            $this->_positions=ArrayHelper::merge(array($position->getId()=>$position),$this->_positions);
            //[$position->getId()] = $position;
        }
        $this->trigger(self::EVENT_POSITION_PUT, new Event([
            'data' => $this->_positions[$position->getId()],
        ]));
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'put', 'position' => $this->_positions[$position->getId()]],
        ]));
        if ($this->storeInSession)
            $this->saveToSession();
    }

    public function putLunch($position, $quantity = 1)
    {
        if (isset($this->_positionsLunches[$position->getId()])) {
            $this->_positionsLunches[$position->getId()]->setQuantity(
                $this->_positionsLunches[$position->getId()]->getQuantity() + $quantity);
        } else {
            $position->setQuantity($quantity);
            $this->_positionsLunches=ArrayHelper::merge(array($position->getId()=>$position),$this->_positionsLunches);
            //$this->_positionsLunches[$position->getId()] = $position;
        }
        $this->trigger(self::EVENT_POSITION_PUT, new Event([
            'data' => $this->_positionsLunches[$position->getId()],
        ]));
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'put', 'position' => $this->_positionsLunches[$position->getId()]],
        ]));
        if ($this->storeInSession)
            $this->saveToSession();
    }

    /**
     * Returns cart positions as serialized items
     * @return string
     */
    public function getSerialized()
    {
        return serialize($this->_positions);
    }
    public function getSerializedLunch()
    {
        return serialize($this->_positionsLunches);
    }
    /**
     * @param CartPositionInterface $position
     * @param int $quantity
     */
    public function update($position, $quantity)
    {
        if ($quantity <= 0) {
            $this->remove($position);
            return;
        }

        if (isset($this->_positions[$position->getId()])) {
            $this->_positions[$position->getId()]->setQuantity($quantity);
        } else {
            $position->setQuantity($quantity);
            $this->_positions[$position->getId()] = $position;
        }
        $this->trigger(self::EVENT_POSITION_UPDATE, new Event([
            'data' => $this->_positions[$position->getId()],
        ]));
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'update', 'position' => $this->_positions[$position->getId()]],
        ]));
        if ($this->storeInSession)
            $this->saveToSession();
    }

    public function updateLunch($position, $quantity)
    {
        if ($quantity <= 0) {
            $this->remove($position);
            return;
        }

        if (isset($this->_positionsLunches[$position->getId()])) {
            $this->_positionsLunches[$position->getId()]->setQuantity($quantity);
        } else {
            $position->setQuantity($quantity);
            $this->_positionsLunches[$position->getId()] = $position;
        }
        $this->trigger(self::EVENT_POSITION_UPDATE, new Event([
            'data' => $this->_positionsLunches[$position->getId()],
        ]));
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'update', 'position' => $this->_positionsLunches[$position->getId()]],
        ]));
        if ($this->storeInSession)
            $this->saveToSession();
    }

    public function updateFor($position_id, $id, $num, $value)
    {
        if (isset($this->_positions[$position_id])) {
            $this->_positions[$position_id]->setForProduct($id,$num,$value);
        }

        $this->trigger(self::EVENT_POSITION_UPDATE, new Event([
            'data' => $this->_positions[$position_id],
        ]));
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'update', 'position' => $this->_positions[$position_id]],
        ]));
        if ($this->storeInSession)
            $this->saveToSession();
    }

    public function filterIngredientPositions(){
        $itemsRemoved=[];
        foreach($this->_positions as $position){
            if($position->getProduct()->product->is_ingredient){
                $count=$this->filterIngredientPosition($position->getId());
                if($count) $this->update($position, $count);
                else{
                    $itemsRemoved[]=$position->getId();
                    $this->remove($position);
                }
            }
        }
        return $itemsRemoved;
    }

    public function filterIngredientPosition($position_id){
        $count=0;

        foreach($this->_positions[$position_id]->forProducts as $p_id=>$products){
            if($this->_positions[$p_id]){
                $i=1;
                $limit=$this->_positions[$p_id]->getQuantity();
                foreach($products as $qty_val=>$nums){
                    if($i>$limit+1) {
                        unset($this->_positions[$position_id]->forProducts[$p_id][$qty_val]);
                    }else{
                        if($nums) $count++;
                    }
                    $i++;
                }
            }else{
                unset($this->_positions[$position_id]->forProducts[$p_id]);
            }
        }

        $this->trigger(self::EVENT_POSITION_UPDATE, new Event([
            'data' => $this->_positions[$position_id],
        ]));
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'update', 'position' => $this->_positions[$position_id]],
        ]));
        if ($this->storeInSession)
            $this->saveToSession();

        return $count;
    }

    /**
     * Removes position from the cart
     * @param CartPositionInterface $position
     */
    public function remove($position)
    {
        $this->trigger(self::EVENT_BEFORE_POSITION_REMOVE, new Event([
            'data' => $this->_positions[$position->getId()],
        ]));
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'remove', 'position' => $this->_positions[$position->getId()]],
        ]));
        unset($this->_positions[$position->getId()]);
        if ($this->storeInSession)
            $this->saveToSession();
    }

    public function removeLunch($position)
    {
        $this->trigger(self::EVENT_BEFORE_POSITION_REMOVE, new Event([
            'data' => $this->_positionsLunches[$position->getId()],
        ]));
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'remove', 'position' => $this->_positionsLunches[$position->getId()]],
        ]));
        unset($this->_positionsLunches[$position->getId()]);
        if ($this->storeInSession)
            $this->saveToSession();
    }

    /**
     * Remove all positions
     */
    public function removeAll()
    {
        $this->_positions = [];
        $this->_positionsLunches = [];
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'removeAll'],
        ]));
        if ($this->storeInSession)
            $this->saveToSession();
    }

    /**
     * Returns position by it's id. Null is returned if position was not found
     * @param string $id
     * @return CartPositionInterface|null
     */
    public function getPositionById($id)
    {
        if ($this->hasPosition($id))
            return $this->_positions[$id];
        else
            return null;
    }

    /**
     * Checks whether cart position exists or not
     * @param string $id
     * @return bool
     */
    public function hasPosition($id)
    {
        return isset($this->_positions[$id]);
    }

    /**
     * @return CartPositionInterface[]
     */
    public function getPositions()
    {
        return $this->_positions;
    }

    public function getPositionsLunches()
    {
        return $this->_positionsLunches;
    }

    /**
     * @param CartPositionInterface[] $positions
     */
    public function setPositions($positions)
    {
        $this->_positions = $positions;
        $this->trigger(self::EVENT_CART_CHANGE, new Event([
            'data' => ['action' => 'positions'],
        ]));
        if ($this->storeInSession)
            $this->saveToSession();
    }

    /**
     * Returns true if cart is empty
     * @return bool
     */
    public function getIsEmpty()
    {
        return count($this->_positions) == 0;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        $count = 0;
        foreach ($this->_positions as $position)
            $count += $position->getQuantity();
        foreach ($this->_positionsLunches as $position)
            $count += $position->getQuantity();
        return $count;
    }

    /**
     * Return full cart cost as a sum of the individual positions costs
     * @param $withDiscount
     * @return int
     */

    public function getSubTotal(){
        $cost = 0;
        foreach ($this->_positions as $position) {
            $cost += $position->getCost($withDiscount);
        }
        foreach ($this->_positionsLunches as $position) {
            $cost += $position->getCost($withDiscount);
        }
        return $cost;
    }

    public function getShippingValue(){
        $costEvent = new CostCalculationEvent([
            'baseCost' => $cost,
        ]);
        $this->trigger(self::EVENT_COST_CALCULATION, $costEvent);

        return $costEvent->shippingValue;
    }

    public function getDiscountValue(){
        $costEvent = new CostCalculationEvent([
            'baseCost' => $cost,
        ]);
        $this->trigger(self::EVENT_COST_CALCULATION, $costEvent);

        return $costEvent->discountValue;
    }

    public function getCost($withDiscount = false, $withShipping = false)
    {
        $cost = $this->getSubTotal();

        if ($withDiscount)
            $cost = max(0, $cost - $this->getDiscountValue());

        if ($withShipping)
            $cost = $cost + $this->getShippingValue();

        return $cost;
    }

    /**
     * Returns hash (md5) of the current cart, that is unique to the current combination
     * of positions, quantities and costs. This helps us fast compare if two carts are the same, or not, also
     * we can detect if cart is changed (comparing hash to the one's saved somewhere)
     * @return string
     */
    public function getHash()
    {
        $data = [];
        foreach ($this->positions as $position) {
            $data[] = [$position->getId(), $position->getQuantity(), $position->getPrice()];
        }
        return md5(serialize($data));
    }


}
