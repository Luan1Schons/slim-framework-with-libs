<?php

$app->post('/api/validation/test', 'Api.ValidationTestController:index')->setName('api.validation.test');
$app->post('/api/upload/test', 'Api.UploadTestController:upload')->setName('api.upload.test');
