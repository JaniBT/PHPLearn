<?php 
    class Product {
        private $name;
        private $price;

        public function __construct($name, $price)
        {
            $this -> name = $name;
            $this -> price = $price;
        }

        public function setName($name)
        {
            $this -> name = $name;
        }

        public function giveDiscount()
        {
            $this -> price = $this -> price * 0.9;
        }

        public function getDescription()
        {
            return "The product's name is: {$this -> name}.<br> It's price: {$this -> price}.<br>";
        }
    }

    $product1 = new Product("iPhone 12", 196600);
    $product1->giveDiscount();
    $product1->setName("iPhone 12 (discounted)");
    
    echo "<pre>";
    echo "{$product1->getDescription()}";

    $product2 = new Product("Xiaomi 14 Ultra Pro Max", 289000);
    $product2->giveDiscount();
    $product2->giveDiscount();
    $product2->giveDiscount();
    $product2->giveDiscount();
    $product2->giveDiscount();
    echo "{$product2->getDescription()}";
?>