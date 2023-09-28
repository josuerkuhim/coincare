<?php

class CategoryModel
{
    private $id_typecategory;
    private $name_typecategory;

    private $description_category;
    private $id_category;

    public function __construct($name_typecategory, $id_typecategory, $description_category, $id_category)
    {
        $this->id_typecategory = $id_typecategory;
        $this->name_typecategory = $name_typecategory;
        $this->description_category = $description_category;
        $this->id_category = $id_category;
    }

    public function getType_category()
    {
        return $this->id_typecategory;
    }

    public function setType_category($id_typecategory)
    {
        $this->id_typecategory = $id_typecategory;

        return $this;
    }

    public function getname_typecategory()
    {
        return $this->name_typecategory;
    }

    public function setname_typecategory($name_typecategory)
    {
        $this->name_typecategory = $name_typecategory;

        return $this;
    }

    public function getDescription_category()
    {
        return $this->description_category;
    }

    public function setDescription_category($description_category)
    {
        $this->description_category = $description_category;

        return $this;
    }

    public function getId_category()
    {
        return $this->id_category;
    }

    public function setId_category($id_category)
    {
        $this->id_category = $id_category;

        return $this;
    }

    
}