#Mikrotik Api 2018#

[![Latest Stable Version](https://poser.pugx.org/weltongbi/mikrotik-api/v/stable)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![Total Downloads](https://poser.pugx.org/weltongbi/mikrotik-api/downloads)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![Latest Unstable Version](https://poser.pugx.org/weltongbi/mikrotik-api/v/unstable)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![License](https://poser.pugx.org/weltongbi/mikrotik-api/license)](https://packagist.org/packages/weltongbi/mikrotik-api)

Manual: 

#### Require

```sh
PHP >= 5.4.9
extension=php_sockets
```
#### Installation:

**-** Require the package via Composer
```bash
composer require weltongbi/mikrotik-api
```

##### Laravel 5.5+

**1.** Laravel 5.5+ will autodiscover the package, for older versions add the
following service provider
```php
Rebing\GraphQL\GraphQLServiceProvider::class,
```

and alias
```php
'MkApi' => 'Rebing\GraphQL\Support\Facades\GraphQL',
```

in your `config/app.php` file.

**2.** Publish the configuration file
```bash
$ php artisan vendor:publish --provider="Rebing\GraphQL\GraphQLServiceProvider"
```

**3.** Review the configuration file
```
config/graphql.php