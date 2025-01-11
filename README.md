# Converter in the Boatrace Venture Project

[![Build Status](https://github.com/BoatraceVentureProject/Converter/workflows/tests/badge.svg)](https://github.com/BoatraceVentureProject/Converter/actions?query=workflow%3Atests)
[![codecov](https://codecov.io/gh/BoatraceVentureProject/Converter/graph/badge.svg?token=A7YKSPM2TW)](https://codecov.io/gh/BoatraceVentureProject/Converter)
[![Latest Stable Version](https://poser.pugx.org/bvp/converter/v/stable)](https://packagist.org/packages/bvp/converter)
[![Latest Unstable Version](https://poser.pugx.org/bvp/converter/v/unstable)](https://packagist.org/packages/bvp/converter)
[![License](https://poser.pugx.org/bvp/converter/license)](https://packagist.org/packages/bvp/converter)

## Installation
```bash
composer require bvp/converter
```

## Usage
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Boatrace\Venture\Project\Converter;

var_dump(Converter::techniqueIdByName('逃げ')); // int(1)
var_dump(Converter::techniqueIdByName('差し')); // int(2)
var_dump(Converter::techniqueIdByName('まくり')); // int(3)
var_dump(Converter::techniqueIdByName('まくり差し')); // int(4)
var_dump(Converter::techniqueIdByName('抜き')); // int(5)
var_dump(Converter::techniqueIdByName('恵まれ')); // int(6)

var_dump(Converter::techniqueNameById(1)); // string(6) "逃げ"
var_dump(Converter::techniqueNameById(2)); // string(6) "差し"
var_dump(Converter::techniqueNameById(3)); // string(9) "まくり"
var_dump(Converter::techniqueNameById(4)); // string(15) "まくり差し"
var_dump(Converter::techniqueNameById(5)); // string(6) "抜き"
var_dump(Converter::techniqueNameById(6)); // string(9) "恵まれ"
```

## License
Converter in the Boatrace Venture Project is open source software licensed under the [MIT license](LICENSE).
