<?php


namespace ExampleMath;

/**
 * Factory for objects implementing the OperatesOnNumber interface.
 *
 * @param int $number Base number to operate on.
 * @param string $type Type of operation sum|subtract
 * @return \ExampleMath\OperatesOnNumber
 * @throws \Exception
 */
class MathFactory implements CreatesMathObject
{

    public function singleNumberFactory( int $number, string $type) : OperatesOnNumber
    {
        return \singleNumberMathFactory(  $number,  $type );
    }

    public function averageFactory() : Average
    {
        return new Average;
    }

}