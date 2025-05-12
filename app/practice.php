<?php
abstract class Payment{
    protected $amount;
    protected static $count = 0;

    public function __construct($amount) {
        $this->amount = $amount;
        self::$count++;
    }
     abstract public function process();

     public static function getCount(){
        return self::$count;
     }
}

class CreditCard extends Payment{
    public function process(){
        return "{$this->amount} via credit card";
    }
}

class PayPal extends Payment{
    public function process(){
        return "{$this->amount} via credit Paypal";
    }
}
$v1 = new CreditCard(10);
echo $v1->process();
