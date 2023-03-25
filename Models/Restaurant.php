<?php

namespace App\Models;

class Restaurant extends Db
{
    private $id;
    private $restaurantName;
    private $username;
    private $password;

    protected $tableName = 'restaurants';

    public function loadAll()
    {
        $this->test();
        $restaurants = $this->findAll();
        $data = [];
        foreach ($restaurants as $restaurant) {
            $restaurantObj = new self;
            $restaurantObj->id = $restaurant['id'];
            $restaurantObj
                ->setName($restaurant['restaurant_name'])
                ->setUsername($restaurant['username']);
            $data[] = $restaurantObj;
        }
        return $data;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setName($restaurantName)
    {
        $this->restaurantName = $restaurantName;
        return $this;
    }

    public function getName()
    {
        return $this->restaurantName;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    private function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

}