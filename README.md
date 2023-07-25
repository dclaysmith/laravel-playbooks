# Laravel Playbooks Package

This package is intended for developers.

It provides the glue that will allow you to build multi-step workflows (playbooks) that your application will complete in response to a trigger.

It is useful for orchestrating:

-   notifications;
-   onboarding processes;
-   dunning sequences;

## Development

To develop on this package you need to create a sandbox laravel package and then require this package.

### Run Sandbox App Api (LaravelPackageDev)

cd /
php artisan serve --host=localhost --port=8000

#### Run Frontend / Vite HMR (LaravelPackageDev)

cd /
npm run dev

#### Install the package in the LaravelPackageDev Project using composer

"repositories": [
{
"type": "path",
"url": "../LaravelCms"
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

# BoardMinutesHq/v1/

> composer update (get latest changes)
> php artisan vendor:publish --provider="Dclaysmith\LaravelPlaybooks\Providers\LaravelPlaybooksServiceProvider"

> BoardMeetingsHQ/v1/nova-components/LaravelPlaybooksNovaAdminTool/resources/js/pages/Tool.vue

The BoardMeetings http://localhost:8082/nova/laravel-playbooks-nova-admin-tool#/pages/1

#####

composer update;

rm -rf resources/js/vendor/laravel-cms/admin;

php artisan vendor:publish --provider="Dclaysmith\LaravelPlaybooks\Providers\LaravelPlaybooksServiceProvider"

./deploy

# laravel-sequences

Create email sequences

id bigint increment
contact_id string
sequence_id string
sequence_instance_id string
sequence_step_id string
status
action_type string (corresponds to actions below)
action_attributes jsonb (conditions)
created_at
updated_at

Config
Mail Directory (use default Laravel location)

Use Notifiables

Actions (publishable)

-   start
-   wait
-   email
-   sms
-   webhook
-   event (laravel event)
-   end

Triggers
The definition of a trigger. Includes:

-   QueryBuilder / Eloquent Builder defining the contacts in the sequence
    () => {
    return \App\Models\Documents::join('users', 'users.id', '=', 'documents.user_id')->select(['users.id AS user_id', 'users.email', 'documents.id AS document_id', 'documents.name']);
    }
-   Identifier / A method that accepts the definition of the sequence and the results of the builder
    ($definition, $item) => {
    return implode('-', [
    'documents',
    $item->document_id,
    $item->user_id
    ]);
    }
-   IsCustomer (onboarding)
-   LowHealth

Artisan / Jobs
php artisan laravel-sequences:run
php artisan laravel-sequences:trigger
php artisan laravel-sequences:run-triggers
php artisan laravel-sequences:add-action
php artisan laravel-sequences:run-actions

Definition

```
{
  "sequence_id": "user provided must be unique and not change or weird things happen",
  "contact_table": "defaults to users",
  "contact_unique_identifier": "defaults to id",
  "allow_multiple": boolean,
  "allow_multiple_wait_days": integer,
  "trigger": "TriggerName.php",
  "trigger_exit_action": "Continue|Cancel",
  "trigger_buffer_minutes": "1 day",
  "steps": [
    {
      "sequence_step_id": "unique, do not change",
      "preconditions": [
        {
         "joins": [{"table":"","alias":"", "on": []}],
         "where": []
        }
      ],
      "meta" => "MetaName.php",
      "actions": {
       "pass": [{
          "type": "WAIT",
          "attributes": {
            "count": 7,
            "period": "days"
          }
        }],
       "fail": [],
      }
    }
  ],
  "messages": {
   "unique_id": {
    "subject": "",
    "body": "",
    "from": "",
    "cc": [],
    "bcc": [],
   }
  }
 }
}
```
