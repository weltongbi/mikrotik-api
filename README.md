# Mikrotik Api 2018 - 2019 #

==============

[![Latest Stable Version](https://poser.pugx.org/weltongbi/mikrotik-api/v/stable)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![Total Downloads](https://poser.pugx.org/weltongbi/mikrotik-api/downloads)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![Latest Unstable Version](https://poser.pugx.org/weltongbi/mikrotik-api/v/unstable)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![License](https://poser.pugx.org/weltongbi/mikrotik-api/license)](https://packagist.org/packages/weltongbi/mikrotik-api)
[![Build Status](https://travis-ci.org/weltongbi/mikrotik-api.svg?branch=master)](https://travis-ci.org/weltongbi/mikrotik-api)
[![codecov](https://codecov.io/gh/weltongbi/mikrotik-api/branch/master/graph/badge.svg)](https://codecov.io/gh/weltongbi/mikrotik-api)

- [x] V6 support
- [x] Direct Commands
- [x] Autocompletion code for intellisense
- [x] PHPUnit
- [x] Examples
- [ ] Magical methods (20% completed)
- [ ] Full phpUnit (20% completed)
- [ ] Laravel Support
- [ ] Codeigniter Support
- [ ] completed 100%

## Manual: 

#### Requirements

```sh
PHP >= 7.2
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