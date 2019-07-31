<?php

namespace App\Responder;
use App\Interfaces\OutputInterface;

class JsonStringOutput implements OutputInterface
{
    public $jsonOutpun;

    public function load($arrayOfData)
    {
        $this->jsonOutpun = $arrayOfData;

        return $this;
    }   

    public function format() {
        return json_encode($this->jsonOutpun);
    }
}