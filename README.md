# Laravel dotenv-vault

<img src="https://raw.githubusercontent.com/motdotla/dotenv/master/dotenv.svg" alt="dotenv-vault" style="float: right;" width="200" />

A Laravel package which extends the proven & trusted foundation of [phpdotenv](https://github.com/vlucas/phpdotenv), with a `.env.vault` file.

The extended standard lets you load encrypted secrets from your `.env.vault` file in production (and other) environments.
Brought to you by the same people that pioneered [dotenv-nodejs](https://github.com/motdotla/dotenv).

* [🌱 Install](#-install)
* [🏗️ Usage (.env)](#-usage)
* [🔧 Custom Config](#-custom-config)
* [🚀 Deploying (.env.vault) 🆕](#-deploying)
* [🌴 Multiple Environments](#-manage-multiple-environments)
* [❓ FAQ](#-faq)

## 🌱 Install

### Composer package
```shell
composer require davidcochrum/dotenv-vault-laravel
```

### DotEnv Vault CLI
Whichever flavor of the CLI which suits your needs: [dotenv.org/docs](https://www.dotenv.org/docs)

Mac (Brew):
```shell
brew install dotenv-org/brew/dotenv-vault
```

Node JS:
```shell
npx dotenv-vault@latest
```

[Or another platform ...](https://www.dotenv.org/docs)

## 🏗️ Usage

Development usage works just like [phpdotenv](https://github.com/vlucas/phpdotenv).

Add your application configuration to your `.env` file in the root of your project:

```shell
# .env
S3_BUCKET="dotenv"
SECRET_KEY="souper_seekret_key"
```

When your application loads, these variables will be available from the `env()` function:

```php
$s3_bucket = env('S3_BUCKET');
echo $s3_bucket;
```

## 🔧 Custom Config

Should you need to customize the path where you store your `.env.vault` or its filename, publish the package
configuration file and update the settings as desired:

```shell
php artisan vendor:publish --tag=dotenv-vault
```

## 🚀 Deploying

Encrypt your environment variables by doing:

```shell
npx dotenv-vault local build
```

This will create an encrypted `.env.vault` file along with a `.env.keys` file containing the encryption keys. Set the `DOTENV_KEY` environment variable by copying and pasting the key value from the `.env.keys` file onto your server or cloud provider. For example in heroku:

```shell
heroku config:set DOTENV_KEY=<key string from .env.keys>
```

Commit your `.env.vault` file safely to code and deploy. Your `.env.vault` fill be decrypted on boot, its environment variables injected, and your app work as expected.

Note that when the `DOTENV_KEY` environment variable is set, environment settings will *always* be loaded from the `.env.vault` file in the project root. For development use, you can leave the `DOTENV_KEY` environment variable unset and fall back on the `dotenv` behaviour of loading from `.env`.

As a convenience, this package supports storing and loading your `DOTENV_KEY` from a `key.env` file.
**DO NOT COMMIT THIS FILE!!** Add it to your `.gitignore` instead.

Example:

```dotenv
# key.env
DOTENV_KEY="dotenv://:key_0000000000000000000000000000000000000000000000000000000000000000@dotenv.local/vault/.env.vault?environment=development"
```

## 🌴 Manage Multiple Environments

You have two options for managing multiple environments - locally managed or vault managed - both use [dotenv-vault](https://github.com/dotenv-org/dotenv-vault).

Locally managed never makes a remote API call. It is completely managed on your machine. Vault managed adds conveniences like backing up your .env file, secure sharing across your team, access permissions, and version history. Choose what works best for you.

#### 💻 Locally Managed

Create a `.env.production` file in the root of your project and put your production values there.

```shell
# .env.production
S3_BUCKET="PRODUCTION_S3BUCKET"
SECRET_KEY="PRODUCTION_SECRETKEYGOESHERE"
```

Rebuild your `.env.vault` file.

```shell
npx dotenv-vault local build
```

View your `.env.keys` file. There is a production `DOTENV_KEY` that pairs with the `DOTENV_VAULT_PRODUCTION` cipher in your `.env.vault` file.

Set the production `DOTENV_KEY` on your server, recommit your `.env.vault` file to code, and deploy. That's it!

Your `.env.vault` will be decrypted on boot, its production environment variables injected, and your app work as expected.

#### 🔐 Vault Managed

Sync your .env file. Run the push command and follow the instructions. [learn more](https://dotenv.org/docs/sync/quickstart)

```
$ npx dotenv-vault push
```

Manage multiple environments with the included UI. [learn more](https://dotenv.org/docs/tutorials/environments)

```
$ npx dotenv-vault open
```

Build your `.env.vault` file with multiple environments.

```
$ npx dotenv-vault build
```

Access your `DOTENV_KEY`.

```
$ npx dotenv-vault keys
```

Set the production `DOTENV_KEY` on your server, recommit your `.env.vault` file to code, and deploy. That's it!

## ❓ FAQ

#### What happens if `DOTENV_KEY` is not set?

Dotenv Vault gracefully falls back to [phpdotenv](https://github.com/vlucas/phpdotenv) when `DOTENV_KEY` is not set. This is the default for development so that you can focus on editing your `.env` file and save the `build` command until you are ready to deploy those environment variables changes.

#### Should I commit my `.env` file?

No. We **strongly** recommend against committing your `.env` file to version control. It should only include environment-specific values such as database passwords or API keys. Your production database should have a different password than your development database.

#### Should I commit my `.env.vault` file?

Yes. It is safe and recommended to do so. It contains your encrypted envs, and your vault identifier.

#### Should I commit my `key.env` file?

No. It contains the key that unlocks your encrypted environment variables. Do not let it leak.

#### Can I share the `DOTENV_KEY`?

No. It is the key that unlocks your encrypted environment variables. Be very careful who you share this key with. Do not let it leak.

## License

MIT
