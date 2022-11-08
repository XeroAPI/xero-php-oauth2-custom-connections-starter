<?php
  ini_set('display_errors', 'On');
  require __DIR__ . '/vendor/autoload.php';
  require_once('storage.php');

  // Use this class to deserialize error caught
  use XeroAPI\XeroPHP\AccountingObjectSerializer;

  // Storage Classe uses sessions for storing token > extend to your DB of choice
  $storage = new StorageClass();
  $xeroTenantId = "";

  if ($storage->getHasExpired()) {
    $provider = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => $_ENV['CLIENT_ID'],
      'clientSecret'            => $_ENV['CLIENT_SECRET'],
      'redirectUri'             => $_ENV['REDIRECT_URI'],
      'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
      'urlAccessToken'          => 'https://identity.xero.com/connect/token',
      'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
    ]);

    $newAccessToken = $provider->getAccessToken('refresh_token', [
      'refresh_token' => $storage->getRefreshToken()
    ]);

    // Save my token, expiration and refresh token
    $storage->setToken(
      $newAccessToken->getToken(),
      $newAccessToken->getExpires(),
      $xeroTenantId,
      $newAccessToken->getRefreshToken(),
      $newAccessToken->getValues()["id_token"]
    );
  }

  $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( (string)$storage->getSession()['token'] );
  $apiInstance = new XeroAPI\XeroPHP\Api\AppStoreApi(
    new GuzzleHttp\Client(),
    $config
  );
  
  $subscriptionId = $_ENV['SUBSCRIPTION_ID'];
  $message = "no API calls";
  if (isset($_GET['action'])) {
    if ($_GET["action"] == 1) {
      try {
        $apiResponse = $apiInstance->getSubscription($subscriptionId);
        $message = $apiResponse;
      } catch (Exception $e) {
        echo 'Exception when calling AppStoreApi->getSubscription: ', $e->getMessage(), PHP_EOL;
      }
    }
  }
?>
<html>
  <body>
    <ul>
      <li><a href="authorizedResource.php?action=1">Get Subscription</a></li>
    </ul>
    <div>
    <?php
      echo($message );
    ?>
    </div>
  </body>
</html>