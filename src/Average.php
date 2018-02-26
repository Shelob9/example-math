<?php


namespace ExampleMath;


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
