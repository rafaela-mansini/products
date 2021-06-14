<?php

class Category
{
    private $id;
    private $name;
    private $description;
    private $countProducts;

    public function __construct($id = null, $name = null, $description = null, $countProducts = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->countProducts = $countProducts;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCountProducts(){
        return $this->countProducts;
    }

    public function setCountProducts($countProducts){
        $this->countProducts = $countProducts;
    }
}