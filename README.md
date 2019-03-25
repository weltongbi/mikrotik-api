#Mikrotik Api 2018 - 2019#
==============

[![Latest Stable Version](https://poser.pugx.org/weltongbi/mikrotik-api/v/stable)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![Total Downloads](https://poser.pugx.org/weltongbi/mikrotik-api/downloads)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![Latest Unstable Version](https://poser.pugx.org/weltongbi/mikrotik-api/v/unstable)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![License](https://poser.pugx.org/weltongbi/mikrotik-api/license)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![Build Status](https://travis-ci.org/weltongbi/mikrotik-api.svg?branch=master)](https://travis-ci.org/weltongbi/mikrotik-api)

## Manual: 

#### Requirements

```sh
PHP >= 7.1
extension=php_sockets
```
#### Installation:

**-** Require the package via Composer
```bash
composer require weltongbi/mikrotik-api
```

## PHPUnit:

#### Requeriments

```bash
mikrotik Os.
```

**-** Configure env variable for test in **phpunit.xml**

```xml
<env name="MikrotikHost" value="192.168.100.25"/>
<env name="MikrotikUser" value="admin"/>
<env name="MikrotikPassword" value=""/>
```

**-** Run Tests

```shell
.\vendor\bin\phpunit
```