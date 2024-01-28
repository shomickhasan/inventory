<?php

namespace App\Repository;

abstract class Repository
{
    abstract public function model();


    public function createdata(array $data){
        return $this->model()::insert($data);
    }

}
