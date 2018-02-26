<?php


namespace ExampleMath;


abstract  class Divide extends SingleNumberMath {
    /** @inheritdoc */
    public function operate( int $number ) : int
    {
        return $this->number / $number;
    }
}
