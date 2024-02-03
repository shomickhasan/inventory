<?php

namespace App\Repository;

use GuzzleHttp\Psr7\Request;

abstract class Repository
{
    abstract public function model();


    public function store(Request $request){

    }

}
