<?php
//Include code we're testing
include_once __DIR__ . '/index.php';


/** ** TESTING FRAMEWORK ** */

/**
 * Creates meaningful exceptions for failures
 *
 * @param int $line Line number for fail
 * @param string $result Resulting value
 * @param int $expected Expecting value
 * @throws Exception
 */
function fail(int $line, int $result, int $expected)
{
    throw  new Exception(sprintf('Line: %d Result: %d Expected %d', $line, $result, $expected));
}

/**
 * @param int|float $numberOne First numeric value
 * @param int|float $numberTwo Second numeric value
 * @return bool
 */
function isEquals($numberOne, $numberTwo): bool
{
    return $numberOne === $numberTwo;
}

function isSame($numberOne,$numberTwo) : bool
{
    return $numberOne == $numberTwo;

}

/**
 * Test two number are equal or throw an error
 *
 * @param $result
 * @param $expected
 */
function assertIsEqual($result, $expected): void
{
    if (!isEquals($result, $expected)) {
        $backtrace = debug_backtrace();
        $line=$backtrace[0]['line'];
        fail($line, $result, $expected);
    }
}

function assertIsSame($result, $expected): void
{
    if (!isSame($result, $expected)) {
        $backtrace = debug_backtrace();
        $line=$backtrace[0]['line'];
        fail($line, $result, $expected);
    }
}

/** ** TESTS ** */

//Make sure this testing framework works
if( ! isEquals(1,1 ) || ! isEquals(-5.05, -5.05 ) ){
    fail( __LINE__, 0, 0);
}


//Test we can add positive and negative numbers correctly
$result = singleNumberMathFactory(5, 'sum')->operate(-5);
assertIsEqual($result, 0 );

//Test that we can subtract negative numbers correctly
$result = singleNumberMathFactory(5, 'subtract')->operate(-10);
assertIsEqual($result, 15);

//Test that we can average numbers the alternative way
$result = (new Average())->addNumber(5)->addNumber(10)->getAverageAlt();
assertIsSame($result, 7.5); //Allow a different typing of results

//Test that we can average numbers the primary way
$result = (new Average())->addNumber(20)->addNumber(10)->getAverage();
assertIsSame($result, 15 ); //Allow a different typing of results

//Test that an empty collection's average is 0 and we do not attempt to divide by 0
$result = (new Average())->getAverage();
assertIsSame($result, 0 );

//Print success message, will be blocked by exceptions
var_dump('It worked');