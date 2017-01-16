Lead Client
=======================

Lead Client is a PHP client that makes it easy to send Lead at Servicein/Cloudcare.
This library require an additional info for work, you must define three constants:
 - API_URL
 - API_KEY
 - DEFAULT_CAMPAIGN
 
 The constant value should be asked to the commercial department.

```php
define("API_URL", "**asked to the commercial department**");
define("API_KEY", "**asked to the commercial department**");
define("DEFAULT_CAMPAIGN", "**asked to the commercial department**");

$lead = new Lead();
$lead->setFirstname("Tester")
        ->setLastname("Tester")
        ->setMail("tester@test.com")
        ->setPhone("33333333333")
        ->setCity("Roma")
        ->setProvince("RM")
        ->setSex("M");
try{
    $leadClient = new Client($lead);
    $result = $leadClient->sendLead();
    if($result->isValid()){
        echo "Lead successfully loaded".PHP_EOL;
    }else{
        echo "Error: ".$result->message.PHP_EOL;
    }
} catch (Exception $ex) {
    echo $ex->getMessage().PHP_EOL;
}
```

## Installing Lead Client

The recommended way to install Client is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of Client:

```bash
php composer.phar require servicein/leadclient
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update Client using composer:

 ```bash
composer.phar update
 ```
