[![Build Status](https://travis-ci.org/slepic/templated-tracy-bar-panel.svg?branch=master)](https://travis-ci.org/slepic/templated-tracy-bar-panel)
[![Style Status](https://styleci.io/repos/183887116/shield)](https://styleci.io/repos/183887116)

# templated-tracy-bar-panel
A simple implementation of [```Tracy\IBarPanel```](https://github.com/nette/tracy/blob/master/src/Tracy/Bar/IBarPanel.php) that allows you to create custom panels by composition of two templates (for tab and panel respectively) and a data provider which feeds the templates with specific data.

The advantage of using [```TemplatedBarPanel```](https://github.com/slepic/templated-tracy-bar-panel/blob/master/src/TemplatedBarPanel.php) instead of implementing the IBarPanel interface directly are:
1. Implement just the [```TemplateDataProviderInterface```](https://github.com/slepic/templated-tracy-bar-panel/blob/master/src/TemplateDataProviderInterface.php) and use your favourite templating engine for tab and panel templates.
2. You abstract your implementation from a specific templating engine. Once you find a better/faster templating engine you can switch to it by just reimplementing the templates and not the way the data for them are gathered.
3. You allow your panels to change their look without having to modify them. You just pass different templates to them.

## Requirements

* PHP 5.6 or PHP 7.0
* [slepic/php-template](https://github.com/slepic/php-template) ([packagist](https://packagist.org/packages/slepic/php-template))

## Installation

Install with composer

```composer require slepic/templated-tracy-bar-panel```

## Usage

When implementing a [```IBarPanel```](https://github.com/nette/tracy/blob/master/src/Tracy/Bar/IBarPanel.php) for Tracy, instead of implementing the interface directly, create just a factory class, which will instantiate the [```TemplatedBarPanel```](https://github.com/slepic/templated-tracy-bar-panel/blob/master/src/TemplatedBarPanel.php) like this:

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

You need to implement the [```TemplateDataProviderInterface```](https://github.com/slepic/templated-tracy-bar-panel/blob/master/src/TemplateDataProviderInterface.php) to provide specific data for your templates.

The two templates can be the [```OutputBufferTemplate```](https://github.com/slepic/php-template/blob/master/src/OutputBufferTemplate.php) provided by the [slepic/php-template](https://packagist.org/packages/slepic/php-template) package.

But if you prefer a higher level template engine, see [slepic/php-template-implementation](https://packagist.org/providers/slepic/php-template-implementation) to see if there is an existing binding for your favourite templating engine.

## Changelog

### 0.2.0

* Update dependency slepic/php-template to v0.2.
* Changed return type of ```TemplateDataProviderInterface::getTabData()``` and ```TemplateDataProviderInterface::getPanelData()``` to array.
* Changed travis setup to only run tests in oldest and newest php versions supported by this package (that is 5.6 and 7.3).
