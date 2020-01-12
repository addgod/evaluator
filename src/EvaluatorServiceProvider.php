<?php namespace Addgod\Evaluator;

use Illuminate\Foundation\AliasLoader;
use Orchestra\Support\Providers\ServiceProvider;

class EvaluatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap available services
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath(__DIR__ . '/../resources');

        $this->addConfigComponent('addgod/evaluator', 'addgod/evaluator', $path . '/config');
    }

    /**
     * Register available services
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('addgod.evaluator', function ($app) {
            return new EvaluatorManager($app);
        });

        $this->registerFacade();
    }

    /**
     * Register facade
     *
     * @return void
     */
    protected function registerFacade()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Evaluator', 'Addgod\Evaluator\Facades\Evaluator');
    }
}
