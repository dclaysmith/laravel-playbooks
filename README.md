# Laravel Playbooks Package

This package is intended for developers and is a work in progress. Do not use.

It provides the glue that will allow you to build multi-step workflows (playbooks) that your application will complete in response to a trigger.

It is useful for orchestrating:

- notifications;
- onboarding processes;
- dunning sequences;

## Development

To develop on this package you need to create a sandbox laravel installation (ex. LaravelPackageDev) and then require this package.

### Run Sandbox App Api (LaravelPackageDev)

> php artisan serve --host=localhost --port=8000

#### Run Frontend / Vite HMR (LaravelPackageDev)

cd /
npm run dev

cd /resources/admin
npm run build

#### Install the package in the LaravelPackageDev Project using composer

"repositories": [
{
"type": "path",
"url": "../LaravelPlaybooks"
}
]

#### Open

http://localhost:8000/admin-dev#/templates

You can now work on the admin code in

/Project/packages/LaravelPlaybooks/resources/admin/src

Work in LaravelPlaybooks/Project/packages/LaravelPlaybooks

# Develop on the admin site...

> /LaravelPlaybooks/resources/admin

# Build

> Project/packages/LaravelPlaybooks/.deploy

# License

This package is open-sourced software licensed under the MIT license.
