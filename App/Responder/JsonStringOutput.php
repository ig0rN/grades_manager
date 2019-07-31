<?php

namespace App\Responder;
use App\Interfaces\OutputInterface;

class JsonStringOutput implements OutputInterface
{

    public function load($arrayOfData)
    {
        return json_encode($arrayOfData);
    }   

}