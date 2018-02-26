<?php


namespace ExampleMath;


/**
 * Class that takes one base number and can do some type of mathematical operation on it.
 */
abstract class SingleNumberMath  implements OperatesOnNumber {

    /** @var int  */
    protected $number;
    public function __construct(int $number)
    {
        $this->number = $number;
    }
}