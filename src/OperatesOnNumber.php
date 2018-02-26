<?php


namespace ExampleMath;

/**
 * Interface OperatesOnNumber
 *
 * Ensures that all objects that come from our mathFactory have the method operate.
 */
interface OperatesOnNumber
{

    /**
     * Operate on the object's base number
     *
     * @param int $number New number to operate on base number with
     * @return int Result of operation
     */
    public function operate(int $number) : int;
}
