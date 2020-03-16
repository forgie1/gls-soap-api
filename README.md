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

If `GlsClient()` is created with `$testMode = GlsClient::TEST_MODE_TEST_REQUEST` credentials and country are ignored, request is made to test server and result is logged by tracy.

**Available test modes:**

* test request: \GlsSoapApi\GlsClient::TEST_MODE_TEST_REQUEST -- this also turns on the debug
* debug:  \GlsSoapApi\GlsClient::TEST_MODE_DEBUG -- use this to debug production requests


