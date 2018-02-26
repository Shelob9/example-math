<?php


namespace ExampleMath;


/**
 * Class Subtract
 *
 * Subtracts numbers from bass number
 */
abstract class Subtract extends SingleNumberMath  {

    /** @inheritdoc */
    public function operate( int $number ) : int
    {
        return $this->number - $number;
    }

}