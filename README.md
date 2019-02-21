
# BrandedSMS.Pk (for Pakistan Mobile Networks)
Public API for sending SMS via BrandedSMS.Pk Service.

# Installation

```
composer require itechpk/brandedsms
```

# PHP Code 
```php
require_once("./vendor/autoload.php");

use Itechpk\Brandedsms\BrandedSms;


//Configuration
$userId = "USER_ID";
$key = "SECRET_KEY";
$mask = "MASk";

//Sms Data
$mobileNo = "92333xxxxxxx";
$msg = "Your message here.";


//creating object
$sms = new BrandedSms();
//setting configuration
$sms->config($userId , $key , $mask);
//sending sms
$trueOrFalse = $sms->send($mobileNo , $msg);

if($trueOrFalse)
{
	echo "Sms send.";
}
else {
	//$lastCode = null;
    //$lastReply = null;
    //$lastId = null;
    //$lastSts = false;
	echo "Sms failed to send.";
}

```
