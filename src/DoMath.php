<?php


namespace ExampleMath;


class DoMath
{

    /**
     * Holds single instance of math object
     *
     * @TODO Don't do this, it adds global state, we need a container
     *
     * @var MathFactory
     */
    private static $mathFactory;

    /**
     * Add two numbers
     *
     * @param int $numberOne
     * @param int $numberTwo
     * @return int
     */
    public static function sum( int $numberOne, int $numberTwo ) : int
    {
        return static::getMathFactory()->singleNumberFactory( $numberOne, 'sum' )->operate( $numberTwo );
    }

    /**
     * Subtract number one from number two
     *
     * @param int $numberOne
     * @param int $numberTwo
     * @return int
     */
    public static function subtract( int $numberOne, int $numberTwo ) : int
    {
        return static::getMathFactory()->singleNumberFactory( $numberOne, 'subtract' )->operate( $numberTwo );
    }

    /**
     * Average a collection of numbers
     *
     * @param array $numbers
     * @return float
     */
    public static function average( array  $numbers )
    {
        $avg = static::getMathFactory()->averageFactory();
        foreach ( $numbers as $number ){
            $avg->addNumber( $number );
        }

        return $avg->getAverage();
    }

    /**
     * Access the correct instance of MathFactory
     *
     * @return MathFactory
     */
    private static function getMathFactory() : MathFactory
    {
        if( ! static::$mathFactory ){
            //@TODO get from container
            static::$mathFactory = new MathFactory();
        }

        return static::$mathFactory;
    }
}