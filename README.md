# <div align="center">Laravel PAMI</div>
<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![GitHub Issues](https://img.shields.io/github/issues/JetstreamAfrica/The-Documentation-Compendium.svg)](https://github.com/JetstreamAfrica/raven/issues)
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/JetstreamAfrica/The-Documentation-Compendium.svg)](https://github.com/JetstreamAfrica/raven/pulls)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

</div>

---

<p align="center"> Laravel PAMI Package
    <br> 
</p>

## 📝 Table of Contents

- [About](#about)
- [Getting Started](#getting_started)
- [Components](#components)
- [Usage](#usage)
- [Built Using](#built_using)
- [Authors](#authors)

## 🧐 About <a name = "about"></a>
Laravel PAMI is a Laravel package which is a wrapper around the PAMI package by Marcel Pociot.

## 🏁 Getting Started <a name = "getting_started"></a>

### Prerequisites
Before setting up this project on your local machine, you need to meet the following requirements:

1. PHP v8.2.4
2. Composer v2.5.5

NB: versions may vary

### Set Up
To set up the project:

- Clone the repository using the command:
    ```bash
    git clone https://github.com/gashey/laravel-pami.git
    ```

- Install dependencies using the command:
    ```bash
    composer install
    ```

- And, run tests using the command:
    ```bash
    composer test
    ```

## 🎈 Usage <a name="usage"></a>
This package is not available on Packagist. Hence, to use this package in your laravel project:
1. Add the following sections to your project's `composer.json` file:

    ```json
    {
      "require": {
        "gashey/laravel-pami": "dev-master"
      }
    }
    ```
    ```json
    {
      "repositories": [
        {
          "type": "git",
          "url": "https://github.com/gashey/laravel-pami.git",
        }
      ]
    }
    ```

2. The above section points to  a private repository, hence you would need to provide composer with a personal access
   token from GitHub to successfully pull the contents of the repo.
   For local development, it is recommended that you create
   a gitignored `auth.json` file with the following content, in the root of your project:

    ```json
    {
      "github-oauth": {
        "github.com": "token"
      }
    }
    ```

3. Then, proceed to run the following command to resolve the dependency:
    ```bash
    composer update
    ```

4. For remote access, you can set up an environment secret with name `COMPOSER_AUTH`, which will contain the JSON formatted
   content of the `auth.json` file:
    ```bash
    COMPOSER_AUTH='{"github-oauth":{"github.com":"token"}}'
    ```

5. After successfully adding this package to your project, you will need to publish the config file where you can
   set up your credentials for Sinay APIs access. The following command will allow you do that:
    ```bash
    php artisan vendor:publish laravel-pami-config
    ```

6. The config file `laravel-pami.php`, will be published to your config directory `./config`. Customize
   it to suit your needs.

7. Create your event handlers. They must implement the IPamiEventMessageHandler interface. See an example below:
   ```php
    use PAMI\Message\Event\EventMessage;

    class ExampleEventMessageHandler implements IPamiEventMessageHandler
    {
        public function execute(EventMessage $event): void
        {
             dump($event->getName());
        }
    }
    ```
   
8. Wire up your event handlers in the "subscriptions" array of the config. See an example below:
   ```php
   'subscriptions' => [
        'ExtensionStatus' => [
            \Mobiverse\LaravelPami\ExampleEventMessageHandler::class,
        ]
    ]
   ```

9. The event handlers are dispatched as Laravel Jobs hence you must enable processing of jobs in the queue. You can specify the queue to use in the config file.
   ```php
   'queue_name' => env('LARAVEL_PAMI_QUEUE_NAME', 'default'),
   ```

## ⛏️ Built Using <a name = "built_using"></a>
- [PHP](https://www.php.net/) - Language
- [PAMI](https://github.com/gashey/PAMI.git) Library

## ✍️ Authors <a name = "authors"></a>
- [@gashey](https://github.com/gashey) - Initial work