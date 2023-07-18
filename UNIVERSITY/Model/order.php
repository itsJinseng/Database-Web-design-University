<?php


class Order 
{
    public $orderNum;
    public $theRecipes = [];
    private $customers;  
    
    
    
    function addTheRecipes($theRecipeInput)
    {
        $theRecipes[] = $theRecipeInput;
        
    }
    

}



?>