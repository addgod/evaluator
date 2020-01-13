<?php namespace Addgod\Evaluator;

use Illuminate\Support\Manager;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class EvaluatorManager extends Manager
{
    /**
     * Retrieve the default driver
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']->get('addgod/evaluator::driver', 'memory');
    }

    /**
     * Set the default driver
     *
     * @param string $name
     *
     * @return  void
     */
    public function setDefaultDriver($name)
    {
        $this->app['config']->set('addgod/evaluator::driver', $name);
    }

    /**
     * Create memory adapter driver
     *
     * @return \Addgod\Evaluator\Evaluator
     */
    public function createMemoryDriver()
    {
        $adapter = (new Adapter\Memory($this->container['orchestra.memory']))->load();
        $expression = new ExpressionLanguage;

        return new Evaluator($expression, $adapter);
    }
}
