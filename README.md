# CountryProvider
Provides a Country object by Name, locale, or ISO3166 code

## Installation

Use the package manager [composer](https://getcomposer.org/) to install CountryProvider.

```bash
comoser require linelab-studio/country-provider
```

## Usage

```php
<?php
include '../vendor/autoload.php';

$countryProvider = new \LabStudio\GeoPolitic\CountryProvider();

$country = $countryProvider->get('POL');

echo '<pre>';
var_dump($country);
echo '</pre>';
```

## Contributing


## License
[Apache License 2.0](https://choosealicense.com/licenses/apache-2.0/)