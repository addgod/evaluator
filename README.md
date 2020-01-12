Evaluator
==============

[![Build Status](https://travis-ci.org/addgod/evaluator.svg?branch=master)](https://travis-ci.org/addgod/evaluator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/addgod/evaluator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/addgod/evaluator/?branch=master)
[![Coverage Status](https://coveralls.io/repos/addgod/evaluator/badge.svg?branch=master)](https://coveralls.io/r/addgod/evaluator?branch=master)
[![Latest Stable Version](https://poser.pugx.org/addgod/evaluator/v/stable.svg)](https://packagist.org/packages/addgod/evaluator)
[![Latest Unstable Version](https://poser.pugx.org/addgod/evaluator/v/unstable.svg)](https://packagist.org/packages/addgod/evaluator)
[![License](https://poser.pugx.org/addgod/evaluator/license.svg)](https://packagist.org/packages/addgod/evaluator)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/6dda2ef1-b8fb-403f-a9c3-f01d1623aa6c/mini.png)](https://insight.sensiolabs.com/projects/6dda2ef1-b8fb-403f-a9c3-f01d1623aa6c)

A Laravel package and Orchestra extension for [symfony/expression-language](http://symfony.com/doc/current/components/expression_language/index.html) component.

## Installation

Simpy update the ```composer.json``` file and run ```composer install```.

```json
"require": {
	"addgod/evaluator": "1.0.*"
}
```

## Quick Installation

```composer require "addgod/evaluator=1.0.*"```

## Setup

If you are using Orchestra Platform, you can simply enable the extension or add the service provider. This will also load the ```Evaluator``` alias automatically.

```php
'providers' => [
	'Addgod\Evaluator\EvaluatorServiceProvider'
];
```

## Adapter

This package provide Orchesta Memory as the default driver.

## How To Use

### Evaluating an expression

```php
$test = [
    'foo' => 10,
    'bar' => 5
];

echo Evaluator::evaluate('foo > bar', $test); //this will return true
```

You can also save the expression rule.

```php
$test = [
    'foo' => 10,
    'bar' => 5
];

Evaluator::expression()->add('test', 'foo > bar');

echo Evaluator::evaluateRule('test', $test); //this will return true
```

For supported expressions, visit the [Symfony Expression Language Component](http://symfony.com/doc/current/components/expression_language/index.html).

### Condition

Let say we want to implement 10% tax to our collection.

```php
$item = [
    'price' => 100
];

$condition = [
    'target' => 'price',
    'action' => '10%',
    'rule' => 'price > 50'
];

Evaluator::expression()->add('tax', $condition);

$calculated = Evaluator::condition('tax', $item);
```

Item with multiplier.

```php
$item = [
	'price' => 50,
	'quantity' => 2
];

$condition = [
    'target' => 'price',
    'action' => '10%',
    'rule' => 'price > 50',
    'multiplier' => 'quantity'
];

Evaluator::expression()->add('tax', $condition);

$calculated = Evaluator::condition('tax', $item);
```
