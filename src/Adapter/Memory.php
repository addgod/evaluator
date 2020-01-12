<?php namespace Addgod\Evaluator\Adapter;

use Addgod\Evaluator\Contracts\AdapterInterface;
use Addgod\Evaluator\Exceptions\MissingExpressionException;
use Addgod\Evaluator\Traits\ExpressionCheckerTrait;
use Illuminate\Support\Arr as A;
use Illuminate\Support\Fluent;

class Memory implements AdapterInterface
{
    use ExpressionCheckerTrait;

    /**
     * Orchestra Memory component
     *
     * @var \Orchestra\Memory\MemoryManager
     */
    protected $memory;

    /**
     * Construct new memory adapter
     *
     * @param \Orchestra\Memory\MemoryManager $memory
     */
    public function __construct($memory)
    {
        $this->memory = $memory;
    }

    /**
     * {@inheritdoc}
     */
    public function load()
    {
        $this->expressions = $this->memory->get('addgod_evaluator', []);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reload()
    {
        $this->memory->put('addgod_evaluator', $this->expressions());
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $expression)
    {
        if (!is_array($expression)) {
            $this->storeExpression($key, $expression);
        } else {
            $expression = new Fluent($expression);

            if ($this->verifyExpression($expression)) {
                $this->storeExpression($key, $expression);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $expression = A::get($this->expressions, $key, null);

        if (is_null($expression)) {
            throw new MissingExpressionException("Expression {{$key}} is not defined");
        }

        return $expression;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        A::forget($this->expressions, $key);

        $this->reload();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function expressions()
    {
        return $this->expressions;
    }

    /**
     * Save the expression
     *
     * @param string $key
     * @param mixed $expression
     *
     * @return void
     */
    protected function storeExpression($key, $expression)
    {
        if (A::has($this->expressions, $key)) {
            $this->expressions = A::set($this->expressions, $key, $expression);
        } else {
            $this->expressions = A::add($this->expressions, $key, $expression);
        }

        $this->reload();
    }
}
