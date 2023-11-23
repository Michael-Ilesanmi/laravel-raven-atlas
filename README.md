# Raven Atlas Package

> Implement Raven Atlas easily with Laravel

The current features have been implemented

- [Installation](#installation)
- [Credits](#credits)
- [Contributing](#contributing)
- [Features](#features)
- [License](#license)

## Getting Started 

### Installation 

```
composer require localdev/laravel-raven-atlas
```

After installation, to register the service provider, open ```config/app.php``` and add the following to the ```providers``` key.

```
'providers' => [
    /*
     * Package Service Providers...
     */
    ...
    Localdev\RavenAtlas\RavenAtlasServiceProvider::class,
    ...
]
```

Also add this to the ```aliases```

```
'aliases' => [
    ...
    'RavenAtlas' => Localdev\RavenAtlas\Facades\RavenAtlas::class,
    ...
]
```

Publish the configuration file using this command:

```
php artisan vendor:publish --provider="Localdev\RavenAtlas\RavenAtlasServiceProvider"
```

Open your .env file and add your public key and secret key. Get your keys from [here](https://atlas.getravenbank.com/user/settings)

```
RAVEN_PUBLIC_KEY='RVPUB-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-xxxxxxxxxxxxx'
RAVEN_SECRET_KEY='RVSEC-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-xxxxxxxxxxxxx'
RAVEN_BASE_URL='https://integrations.getravenbank.com/v1/'
RAVEN_WEBHOOK_SECRET='xxxxxxxxx'
```

## Credits

- [Michael Ilesanmi (localdev))](https://github.com/Michael-Ilesanmi)

## Contributing
Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities. I will appreciate that a lot. Also please add your name to the credits.

Kindly [follow me on twitter](https://twitter.com/__localdev)!

## Features

The current features have been implemented

- [Virtual Accounts Collections](#collections)
- [Virtual Cards](#virtual-cards)
- [Bank Transfer](#bank-transfer)
- [Bill Payments](#bills)
- [Transactions](#transactions)
- [Verifications](#verifications)
- [Webhooks](#webhooks)


### Collections

#### 1. Generate Collection Account

```
$payload = [
    'first_name'=>'John',
    'last_name'=>'Doe',
    'phone'=>'08012345678',
    'email'=>'johndoe@mail.xyz',
    'amount'=>'2000'
];
$response = RavenAtlas::collections()->initiate($payload);
```

### Virtual Cards

#### 1. Generate a virtual card
```
$payload = [
    'bvn'=> '1234567890',
    'nin'=> '12345678901',
    'phone'=> '080123456789',
    'email'=> 'johndoe@mail.xyz',
    'currency'=> 'usd',
    'amount'=> '20',
    'image'=> 'string'
]; 

$response = RavenAtlas::cards()->generate($payload);
```
#### 2. Fund Virtual Card
```
$payload = [
    'card_id'=>'62f22f80fc9b4e40441831e9',
    'amount'=>'2000'
];
$response = RavenAtlas::cards()->fund($payload);
```

#### 3. Get Single Virtual Card
```
$card_id = '62f22f80fc9b4e40441831e9'
$response = RavenAtlas::cards()->getCard($card_id);
```

#### 4. Get All Virtual Cards
```
$response = RavenAtlas::cards()->getCards();
```

#### 5. Retrieve all the transactions made with a card
```
$card_id = '62f22f80fc9b4e40441831e9';
$transactions = RavenAtlas::cards()->transactions($card_id);
```

#### 6. Freeze a Virtual Card
```
$payload = [
    'card_id'=>'62f22f80fc9b4e40441831e9'
];
$response = RavenAtlas::cards()->freeze($payload);
```

#### 7. Unfreeze a Virtual Card
```
$payload = [
    'card_id'=>'62f22f80fc9b4e40441831e9'
];
$response = RavenAtlas::cards()->unfreeze($payload);
```
#### 8. Withdraw from Card into Raven Atlas Account
```
$payload = [
    'card_id'=>'62f22f80fc9b4e40441831e9',
    'amount'=>'2000'
];
$response = RavenAtlas::cards()->withdraw($payload);
```

#### 9. Enable email notifications for card
```
$response = RavenAtlas::cards()->alert();
```

#### 10. Retrieve fees and conversion rate for cards
```
$response = RavenAtlas::cards()->fees();
```


### Bank Transfer

#### 1. Retrieve Bank List
```
$response = RavenAtlas::transfers()->banks();
```

#### 2. Make a new transfer
```
$payload = [
    'amount'=> '2000',
    'bank'=>'Access Bank',
    'bank_code'=>'044',
    'currency'=>'NGN',
    'account_number'=>'1234567890',
    'account_name'=>'John Doe',
    'narration'=>'Transfer to John Doe account',
    'reference'=>'rv_1234567890987654321'
];
$response = RavenAtlas::transfers()->initiate($payload);
```

#### 3. Lookup an account number
```
$payload = [
    'bank'=>'035',
    'account_number'=>'7790913943'
];
$response = RavenAtlas::transfers()->findAccount($payload);
``` 

#### 4. Retrieve a single transfer transaction
```
$trx_ref = '202206041843ACJHBAJ';
$response =  RavenAtlas::transfers()->getTransfer($trx_ref);
```
### Transactions

#### 1. Retrieve all Transactions
```
$response =  RavenAtlas::transactions()->all();
```

### Bills 

#### 1. Retrieve mobile data plans

```
$response = RavenAtlas::bills()->dataPlans();
```

#### 2. Purchase Data Plan

```
$payload = [
    'code'=>'glo100',
    'phone_number'=>'09052137639',
    'provider_code'=>'1',
    'merchant_reference'=>'123456'
];
$response = RavenAtlas::bills()->purchaseData($payload);
```
#### 3. Retrieve All Data Records
```
$response = RavenAtlas::bills()->dataRecords();
```

### Verifications

#### 1. BVN
```
$payload = [
    'bvn'=>'22278595765'
];
$response = RavenAtlas::verifications()->bvn($payload);
```

#### 2. NIN
```
$payload = [
    'nin'=>'87223631145'
];
$response = RavenAtlas::verifications()->nin($payload);
```

#### 3. PVC
```
$payload = [
    'vin'=>'90F5B23A8C532428586'
];
$response = RavenAtlas::verifications()->pvc($payload);
```

#### 4. International Passport
```
$payload = [
    'passport_number'=>'B54386879',
    'first_name'=>'JOHN',
    'last_name'=>'DOE',
    'date_of_birth'=>'1997-08-06',
    'phone_number'=>'075456612902' 
];
$response = RavenAtlas::verifications()->passport($payload);
```

#### 5. Driver's License
```
$payload = [
    'license_number'=>'RUM47482AA01',
    'full_name'=>'JOHN DOE',
    'date_of_birth'=>'1995-08-06',
    'phone_number'=>'075456612902' 
];
$response = RavenAtlas::verifications()->passport($payload);
```

#### 6. Image match with BVN or NIN
```
$payload = [
    'image'=>'@file',
    'type'=>'bvn',
    'token'=>'22278595765',
];
$response = RavenAtlas::verifications()->imageMatch($payload);
```

### Webhooks

Go to ```app/Http/Middleware/VerifyCsrfToken.php``` and add the web route handling your webhook to the ```$except``` array
```
protected $except = [
    '/webhook/raven',
];
```

Setup a function in your controller to handle the webhook.
```
public function webhook(Request $request)
  {
    // This verifies the webhook
    $verify = RavenAtlas::verifyWebhook();
    if ($verify == true) {
        // do something with the webhook payload
        ...
        return response()->json("OK", 200);
    }
    return response()->json("Error", 400);
  }
```




## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

> This project is still a work in progress.