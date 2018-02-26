<?php


namespace ExampleMath;


/**
 * Class Sum
 *
 * Adds numbers to a base number
 */
abstract class Sum extends SingleNumberMath {

    /** @inheritdoc */
    public function operate( int $number ) : int
    {
        return $this->number + $number;
    }

}