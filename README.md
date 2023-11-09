# HostHatch VPS API Class

An easy to implement and use PHP class wrapper for the [HostHatch](https://cloud.hosthatch.com/a/3772) VPS API v1.

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

**Note the Host Hatch API is seemingly still in development and not finalized or reliable**

### 0.1 changes

* Initial commits and files

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

#### Setting your API key:

<span id="setting-api-key"></span>
**Option 1**

Line 9 ```HostHatch.php```

```php
const API_KEY = 'XXXX-XXXX-XXXX';
```

**Option 2**

When you call a new class you can initialise with the API key

```php
$hh = new HostHatch('PUT-API-KEY-HERE');
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

Boot server

<span id="boot-server"></span>

int `$server_id`

```php
$hh->bootServer($server_id);
```

returns `array`

---

Shutdown server

<span id="shutdown-server"></span>

int `$server_id`

```php
$hh->shutdownServer($server_id);
```

returns `array`

---

Reboot server

<span id="reboot-server"></span>

int `$server_id`

```php
$hh->rebootServer($server_id);
```

returns `array`

---

Upgrade server

<span id="upgrade-server"></span>

int `$server_id`

array `$parameters`

```php
$parameters = [
  'product' => 'nvme-8gb',
  'upgrade_disk' => false 
];

$hh->upgradeServer($server_id, $parameters);
```

returns `array`

---

Cancel server

<span id="cancel-server"></span>

int `$server_id`

array `$parameters`


```php
$parameters = [
  'reason' => 'No longer need this VPS',
  'immediate' => false
];

$hh->cancelServer($server_id, $parameters);

```

returns `array`

---

Deploy / create a server

<span id="deploy-server"></span>

array `$parameters`

```php
$parameters = [
  'product' => 'nvme-2gb',
  'location' => 'AMS',
  'billing' => 'monthly',
  'image' => 'ubuntu22',
  'hostname' => 'test.com'
];

$hh->deployServer($parameters);
```

returns `array`

---