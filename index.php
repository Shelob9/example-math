<?php



/**
 * Interface OperatesOnNumber
 *
 * Ensures that all objects that come from our mathFactory have the method operate.
 */
interface OperatesOnNumber {

    /**
     * Operate on the object's base number
     *
     * @param int $number New number to operate on base number with
     * @return int Result of operation
     */
    public function operate( int $number ) : int;

}

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



/**
 * Factory for objects implementing the OperatesOnNumber interface.
 *
 * @param int $number Base number to operate on.
 * @param string $type Type of operation sum|subtract
 * @return OperatesOnNumber
 * @throws Exception
 */
function singleNumberMathFactory( int $number, string $type ): OperatesOnNumber
{

    $type = ucfirst(strtolower($type));
    if( array_key_exists( 'OperatesOnNumber', class_implements($type) ) ){
        switch ( $type ){
            case 'Sum':
                return new class($number) extends Sum{};
                break;
            case  'Subtract':
                return new class($number) extends Subtract {};
                break;
            case 'Divide' :
                return new class($number) extends Divide {};
            default :
                throw new Exception( sprintf( '%s is not a valid type for %s', $type, __FUNCTION__ ) );
                break;
        }
    }

    throw new Exception( sprintf( '%s is not a class that implements OperatesOnNumber. It can not be used with %s', $type, __FUNCTION__ ) );

}


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

abstract  class Divide extends SingleNumberMath {
    /** @inheritdoc */
    public function operate( int $number ) : int
    {
        return $this->number / $number;
    }
}


/**
 * Class Average
 *
 * Collects numbers and can find their average value
 */
class Average {

    /**
     * @var array
     */
    protected $numbers;

    /**
     * @param int $number
     * @return $this
     */
    public function addNumber( int $number )
    {
        $this->numbers[] = $number;
        return $this;
    }

    /**
     * Get average of collection
     *
     * @return float
     */
    public function getAverage() : float
    {

        if ( is_array( $this->numbers ) &&  count( $this->numbers ) ) {
            $sum = singleNumberMathFactory(0, 'sum');
            foreach ($this->numbers as $number) {
                $sum = (singleNumberMathFactory($sum->operate($number), 'sum'));
            }

            return singleNumberMathFactory($sum->operate(0), 'divide')->operate(count($this->numbers));
        }

        return 0;


    }

    /**
     * Simpler way to get averages
     *
     * @return float
     */
    public function getAverageAlt() :float
    {
        //https://stackoverflow.com/a/33461488/1469799
        $numbers = array_filter($this->numbers);
        return floatval(array_sum($numbers)/count($numbers));

    }
}



