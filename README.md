# HostHatch VPS API Class

An easy to implement and use PHP class for the [hosthatch](https://cloud.hosthatch.com/a/3772) VPS API.

[![Generic badge](https://img.shields.io/badge/version-0.1-blue.svg)]()
[![Generic badge](https://img.shields.io/badge/PHP-8.2-purple.svg)]()

## Table of contents

- [Features](#features)
- [Installing & usage](#installing)
    - [Setting API key](#setting-api-key)
- [Products](#products)
  - [List all products](#list-products)
- [Servers](#servers)
    - [Get servers](#list-servers)
    - [Get server](#list-server)
    - [Get server status](#list-server-status)
    - [Deploy a server](#deploy-server)
    - [Boot server](#boot-server)
    - [Shutdown server](#shutdown-server)
    - [Reboot server](#reboot-server)
    - [Upgrade server](#upgrade-server)
    - [Cancel server](#cancel-server)

### 0.1 changes

### Requirements

* PHP 8.2

<span id="installing"></span>

## Usage

Install with composer:

```
composer require corbpie/hosthatch-api
```

Use like:

```php
require __DIR__ . '/vendor/autoload.php';

use Corbpie\HostHatchAPI\HostHatch;

$hh = new HostHatch();

```

#### Setting API key:
<span id="setting-api-key"></span>
**Option 1**

Line 9 ```HostHatch.php```

```php
const API_KEY = 'XXXX-XXXX-XXXX';
```

**Option 2**

With ```setApiKey()``` (needs setting with each calling of class)

```php
$hh->setApiKey('XXXX-XXXX-XXXX');
```


---

List available Host Hatch servers to deploy
<span id="products"></span>
<span id="list-products"></span>

```php
$hh->getProducts();
```

returns `array`

---

Get your current servers
<span id="servers"></span>
<span id="list-servers"></span>

```php
$hh->getServers();
```

returns `array`

---

Get server

<span id="list-server"></span>

int `$server_id`

```php
$hh->getServer($server_id);
```

returns `array`

---

Get server status

<span id="list-server-status"></span>

int `$server_id`

```php
$hh->getServerStatus($server_id);
```

returns `array`

---