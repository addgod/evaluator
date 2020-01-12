<?php namespace Addgod\Evaluator\Facades;

use Illuminate\Support\Facades\Facade;

class Evaluator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'addgod.evaluator';
    }
}
