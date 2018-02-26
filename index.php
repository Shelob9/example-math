<?php

//autoloader
//@see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'ExampleMath\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/src/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});





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











