# SOAP API for GLS services

## Usage

```php
$client = new \GlsSoapApi\GlsClient('userName', 'password', 'senderId', 'countryCode', 'testMode');

$requestData = new \GlsSoapApi\Requests\Entities\RequestData();
$requestData
    ->set ....;

$request = new \GlsSoapApi\Requests\PrintLabelRequest($requestData)

$response = $client->send($request);
```

**Available Requests:**

* PrintLabelRequest
* DeleteLabelsRequest
* ModifyCodRequest

### TestMode

If `GlsClient()` is created with `$testMode = true` credentials and country are ignored, request is made to test server.


