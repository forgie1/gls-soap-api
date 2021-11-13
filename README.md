# SOAP API for GLS services

## Usage

For Allowed endpoints see: `\GlsSoapApi\GlsClient::ALLOWED_ENDPOINTS`

```php
$client = new \GlsSoapApi\GlsClient('endPoint', 'userName', 'password', 'senderId', 'testMode');

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

If `GlsClient()` is created with `$testMode = true` credentials and country are ignored, request is made to test server and result is logged by &logger.

**Logging:**

Use `GlsClient::setLogger()`.

## Web client

http://online.gls-czech.com/index.php
