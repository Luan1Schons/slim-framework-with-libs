<?php

$container->set('settings', [
    'app' => [
        'name' => getenv('APP_NAME'),
        'key' => getenv('APP_KEY'),
        'debug' => getenv('APP_DEBUG'),
    ],
    'domain' => getenv('APP_URL'),
    'db' => [
        'driver' => getenv('DB_DRIVER'),
        'host' => getenv('DB_HOST'),
        'port' => getenv('DB_PORT'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'charset' => getenv('DB_CHARSET'),
        'collation' => getenv('DB_COLLATION'),
        'prefix' => getenv('DB_PREFIX')
    ],
    'mail' => [
        'driver' => getenv('MAIL_DRIVER'),
        'host' => getenv('MAIL_HOST'),
        'port' => getenv('MAIL_PORT'),
        'username' => getenv('MAIL_USERNAME'),
        'password' => getenv('MAIL_PASSWORD'),
        'encryption' => getenv('MAIL_ENCRYPTION'),
        'auth' => getenv('MAIL_AUTH') == true ? 'login' : 'plain',
    ],
    'storage' => [
        'driver' => getenv('STORAGE_DRIVER'),
        'aws' => [
            'key' => getenv('AWS_S3_KEY'),
            'secret' => getenv('AWS_S3_SECRET'),
            'region' => getenv('AWS_S3_REGION'),
            'version' => getenv('AWS_S3_VERSION'),
            'bucket' => getenv('AWS_S3_BUCKET'),
        ],
        'google' => [
            'project_id' => getenv('GOOGLE_PROJECT_ID'),
            'bucket' => getenv('GOOGLE_BUCKET'),
        ],
        'azure' => [
            'account_name' => getenv('AZURE_ACCOUNT_NAME'),
            'account_key' => getenv('AZURE_ACCOUNT_KEY'),
            'container_name' => getenv('AZURE_CONTAINER_NAME'),
        ],
        'digitalocean' => [
            'key' => getenv('DIGITAL_OCEAN_KEY'),
            'secret' => getenv('DIGITAL_OCEAN_SECRET'),
            'region' => getenv('DIGITAL_OCEAN_REGION'),
            'version' => getenv('DIGITAL_OCEAN_VERSION'),
            'endpoint' => getenv('DIGITAL_OCEAN_ENDPOINT')
        ],
        'dropbox' => [
            'token' => getenv('DROPBOX_TOKEN')
        ],
        'ftp' => [
            'host' => getenv('FTP_HOST'),
            'username' => getenv('FTP_USER'),
            'password' => getenv('FTP_PASS'),
            'port' => is_null(getenv('FTP_PORT')) ? getenv('FTP_PORT') : 21,
            'root' => is_null(getenv('FTP_ROOT')) ? getenv('FTP_ROOT') : '/',
            'ssl' => is_null(getenv('FTP_SSL')) ? getenv('FTP_SSL') : true,
            'timeout' => is_null(getenv('FTP_TIMEOUT')) ? getenv('FTP_TIMEOUT') : 30,
            'passive' => true,
            'ignorePassiveAddress' => false,
        ],
    ],
]);
