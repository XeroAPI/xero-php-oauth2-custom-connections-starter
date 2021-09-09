<?php

ini_set('display_errors', 'On');
require __DIR__ . '/vendor/autoload.php';
require_once('storage.php');

// Storage Class uses sessions for storing access token (demo only)
// you'll need to extend to your Database for a scalable solution
$storage = new StorageClass();

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId' => $_ENV['CLIENT_ID'],
    'clientSecret' => $_ENV['CLIENT_SECRET'],
    'urlAuthorize' => 'https://login.xero.com/identity/connect/authorize',
    'urlAccessToken' => 'https://identity.xero.com/connect/token',
    'urlResourceOwnerDetails' => 'https://identity.xero.com/resources'
]);

// This returns the authorizeUrl with necessary parameters applied (e.g. state).
$accessToken = $provider->getAccessToken('client_credentials');

$storage->setToken(
    $accessToken->getToken(),
    $accessToken->getExpires(),
    null,
    $accessToken->getRefreshToken(),
    null
);

header('Location: ' . './authorizedResource.php');
exit();
