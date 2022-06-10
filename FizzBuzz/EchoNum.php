<?php

class EchoNum implements INum
{
    public $result = '<br>';

    public function show($num, $result) {
        if ($result) {
            $this->result = $this->result . $result;
        } else {
            $this->result = $this->result . $num;
        }
        return $this->result;
    }
}