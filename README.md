# Geniem WP Project Bells & Whistles

This WordPress mu-plugin is a collection of fixes and configurations for Geniem WordPress projects. A mu-plugin ensures that all functionalities get executed at an early stage of the WordPress bootstrap process and execution order can be controlled by using WordPress actions and filters.

## Installation

The boilerplate plugin works as a WordPress mu-plugin but requires the [Bedrocks' mu-plugin autoloader](https://roots.io/bedrock/docs/mu-plugins-autoloader/). Install the plugin with Composer:

```
$ composer require devgeniem/wp-geniem-project-bells-and-whistles
```

## Features

- Composer setup for WordPress plugins
- PSR-4 autoloading for namespace ***\Geniem\Project*** in the ***src/*** directory.

### Feature classes

#### DisableAdminEmailVerification

Disables the periodical admin email verification that was introduced in WordPress version 5.3.

### Disabling a feature class

To disable a feature defined in a specific class, add its class name without the namespace into the following constant in your WordPress configuration file (e.g. wp-config.php):

```
define( 'GENIEM_DISABLE_BELLS_AND_WHISTLES', [
    'Example',
]);
```

## Contributions

This plugin is intended to contain various fixes and WP bootstrapping features that should be added, updated or removed as needed.

### Adding a feature

1. Add a class for the feature into the ***src/*** directory following the PSR-4 namespace convention.
2. Add the function' class name into the ***$classes*** array in ***plugin.php***. The class is instantiated automatically.
3. Test the feature well
4. Update the changelog and create a pull request

### Encapsulation

Encapsulate your features well meaning fixes and configurations for a specific WordPress feature or plugin are done in one class. This keeps the repository clean and easy to maintain.
