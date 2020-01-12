<?php namespace Addgod\Evaluator\Traits;

use Addgod\Evaluator\Exceptions\MissingKeyException;
use Illuminate\Support\Fluent;

trait ExpressionCheckerTrait
{
    /**
     * Available expressions
     *
     * @var array
     */
    protected $expressions = [];

    /**
     * Reserved keys for an expression
     *
     * @var array
     */
    protected $reservedKeys = ['target', 'action'];

    /**
     * Vaildate if expression contains the reserve keys
     *
     * @param array $expression
     *
     * @return boolean
     * @throws  \Addgod\Evaluator\Exceptions\MissingKeyException
     */
    protected function verifyExpression(Fluent $expression)
    {
        foreach ($this->reservedKeys as $key) {
            if (is_null($expression->get($key))) {
                throw new MissingKeyException("Expression is missing {$key}");
            }
        }

        return true;
    }
}
