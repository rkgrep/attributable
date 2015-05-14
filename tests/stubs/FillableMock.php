<?php

class FillableMock {

    use rkgrep\Fillable;

    public function getAttributes()
    {
        return $this->attributes;
    }
}
