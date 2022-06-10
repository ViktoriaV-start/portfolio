<?php

class CheckThree extends Check
{
    public function show($num, $result) {

        if (($num%3) === 0) {
            $this->result = $result . 'Fizz';
        } else {
            $this->result = $result;
            echo $this->result;
        }
        return $this->obj->show($num, $this->result);
    }
}