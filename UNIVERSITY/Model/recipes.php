
<?php 
Class Recipes {
    private $productID;
    private $recipeName;
    private $ingredients;
    private $instructions;
    private $boxTypeID;
    private $price;

    private $rating;

    function __get($name){
        return $this->$name;
    }

    function __set($name,$value){
        $this->$name = $value;
    }

    
  
}
?>