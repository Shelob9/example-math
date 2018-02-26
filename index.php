<?php
include_once __DIR__ . '/vendor/autoload.php';

/**
 * Factory for objects implementing the OperatesOnNumber interface.
 *
 * @param int $number Base number to operate on.
 * @param string $type Type of operation sum|subtract
 * @return \ExampleMath\OperatesOnNumber
 * @throws \Exception
 */
function singleNumberMathFactory( int $number, string $type ): \ExampleMath\OperatesOnNumber
{

    $type = ucfirst(strtolower($type));
    $implements = class_implements("\\ExampleMath\\$type");
    if( is_array($implements)&&array_key_exists( \ExampleMath\OperatesOnNumber::class, $implements ) ){
        switch ( $type ){
            case 'Sum':
                return new class($number) extends \ExampleMath\Sum {};
                break;
            case  'Subtract':
                return new class($number) extends \ExampleMath\Subtract {};
                break;
            case 'Divide' :
                return new class($number) extends \ExampleMath\Divide {};
            default :
                throw new Exception( sprintf( '%s is not a valid type for %s', $type, __FUNCTION__ ) );
                break;
        }
    }

    throw new Exception( sprintf( '%s is not a class that implements OperatesOnNumber. It can not be used with %s. Type: %s', gettype( $type ), __FUNCTION__, $type ) );

}











