# templated-tracy-bar-panel
A simple implementation of Tracy\IBarPanel that allows you to create custom panels by composition of two templates (for tab and panel respectively) and a data provider which feeds the templates with specific data.

The advantage of using this generic implementation of IBarPanel instead of implementing the interface directly are:
1. You abstract your implementation from a specific templating engine. Once you find a better/faster templating engine you can switch to it by just reimplementing the templates and not the way the data for them are gathered.
2. You allow your panels to change their look without having to modify them. You just pass different templates to them.

## Requirements

* PHP 5.6 or PHP 7.0
* [slepic/php-template](https://github.com/slepic/php-template) ([packagist](https://packagist.org/packages/slepic/php-template))

## Installation

Install with composer

```composer require slepic/templated-tracy-bar-panel```

## Usage

When implementing a IBarPanel for Tracy, instead of implementing the interface directly, create just a factory class, which will do something like this:

```
class Factory
{
  /**
   * @param ...$dependencies Dependencies specific to your panel.
   * @return IBarPanel
   */
  public function create(...$dependencies)
  {
    return new TemplatedBarPanel(
      new MyTemplateDataProvider(...$dependencies),
      new OutputBufferTemplate(__DIR__ . '/tab.phtml'),
      new OutputBufferTemplate(__DIR__ . '/panel.phtml')
    );
  }
}
```

You need to implement the TemplateDataProviderInterface to provide specific data for your templates.

The two templates can be the OutputBufferTemplate provided by the slepic/php-template package.

But if you prefer a higher level template engine, see slepic/php-template-implementation to see if there is an existing binding for your favourite templating engine. 
