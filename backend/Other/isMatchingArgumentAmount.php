<?php
/***
 * when used for adding objects to DB add 1 to $n (for the $id field) for when the object isnt yet in the DB
 * @param int $n
 * @param string $class
 * @return bool
 * @throws ReflectionException
 */
function isMatchingArgumentAmount(int $n, string $class)
{
    try {
        $class_reflection = new ReflectionClass($class);
        $constructor = $class_reflection->getConstructor();
        if ($constructor === null)
            return false;
//        gets the number of REQUIRED parameters
        echo "\nconstructor->getNumberOfParameters(): " . $constructor->getNumberOfParameters();
        if ($constructor->getNumberOfParameters() != $n) {
            echo "not good";
            return false;
        }
        return true;
    } catch (ReflectionException $e) {
        throw $e;
    }
}