php-config-class
================

PHP Config Class

## Installation

### Composer

    Via [composer](http://getcomposer.org/)
    $ composer require wangoviridans/config
    (https://packagist.org/packages/wangoviridans/config)
    {
        "require": {
            "wangoviridans/config": ">= 0.0.1"
        }
    }

    Or just clone and put somewhere inside your project folder.
    $ cd myapp/vendor
    $ git clone git://github.com/wangoviridans/php-config-class.git

## Usage

### Quick Start and Examples

    <?php
    require 'Config/Config.php';
    //or require_once 'vendor/autoload.php' if you are using composer
    $config = new Config(array(
        'some.option' => 'SOME OPTION',
        'someoption => 'ANOTHER SOME OPTION
    ));

    $config->setOption('some.option2', 'SOME OPTION 2');
    $config->setOptions(array(
        'some.option3' => 'SOME OPTION 3',
        'some.option4' => 'SOME OPTION 4'
    ));

    var_dump(
        $config->hasOption('some.option'),
        $config->hasOption('some.option2'),
        $config->hasOption('bad.option'),
        $config->hasOptions(array(
            'some.option3',
            'some.option4'
        ));
        $config->hasOptions(array(
            'some.option3',
            'bad.option'
        ));
        $config->hasOptions(array(
            'some.option3',
            'bad.option',
            'some.option4
        ), true);

        $config->getOption('some.option'),
        $config->getOption('some.option2'),
        $config->getOption('bad.option', 'DEFAULT BAD OPTION VALUE')
    );

    $config->unsetOption('some.option');
    var_dump($this->hasOption('some.option'));

    $config->unsetOptions(array(
        'some.option3',
        'some.option4'
    ));

    var_dump($config->hasOptions(array(
        'some.option3',
        'bad.option',
        'some.option4
    ), true);