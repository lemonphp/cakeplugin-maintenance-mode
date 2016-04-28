Introduction
===
[![Build Status](https://travis-ci.org/lemonphp/cakeplugin-maintenance-mode.svg?branch=master)](https://travis-ci.org/lemonphp/cakeplugin-maintenance-mode)
[![Coverage Status](https://coveralls.io/repos/github/lemonphp/cakeplugin-maintenance-mode/badge.svg?branch=master)](https://coveralls.io/github/lemonphp/cakeplugin-maintenance-mode?branch=master)

A plugin to enable and disable maintenance mode for CakePHP

Main features
---
- [x] Show a page to alert application in maintenance mode
- [x] Allow customize maintenance alert page template
- [x] Enable and disable maintenance mode by shell
- [ ] 100% code coverage

Requirements
---

* php >=5.5.9
* cakephp 3.x

Installation
---
You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require lemonphp/cakeplugin-maintenance-mode
```

Usage
---

### Enable plugin

Add this line to `config/bootstrap.php` file
```
Plugin::load('Lemon/CakePlugin/MaintenanceMode', ['bootstrap' => true]);
```

### Enable maintenance mode

```
$ bin/cake maintenance_mode enable
```

Using option `--force` to enable maintenance mode with default config:

- View class: `\App\View\AppView`
- Templatce: `Pages/maintenance.ctp`
- Layout: `default`
- Time: a hour from now

### Disable maintenance mode

```
$ bin/cake maintenance_mode disable
```

Changelog
---
See all change logs in [CHANGELOG.md][changelog]

Contributing
---
All code contributions must go through a pull request and approved by
a core developer before being merged. This is to ensure proper review of all the code.

Fork the project, create a feature branch, and send a pull request.

To ensure a consistent code base, you should make sure the code follows the [PSR-2][psr2].

If you would like to help take a look at the [list of issues][issues].

License
---
This project is released under the MIT License.
Copyright © 2015-2016 LemonPHP Team.


[changelog]: https://github.com/lemonphp/cakeplugin-maintenance-mode/blob/master/CHANGELOG.md
[psr2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[issues]: https://github.com/lemonphp/cakeplugin-maintenance-mode/issues