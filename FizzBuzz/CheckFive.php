<?php

class CheckFive extends Check
{
    public function show($num, $result) {

        if (($num%5) === 0) {
            $this->result = $result . 'Buzz';
        } else {
            $this->result = $result;
        }
         return $this->obj->show($num, $this->result);
    }
}