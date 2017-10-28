# LibVoice

> A PHP library for developing custom voice assistant interactions.

## Introduction
This is a major rewrite of the amazon-alexa-php library by [minicodemonkey](https://github.com/MiniCodeMonkey),
[jakubsuchy](https://github.com/jakubsuchy) and [danstreeter](https://github.com/danstreeter). It sticks closer to
[Amazon's Reference for Custom Skills](https://developer.amazon.com/docs/custom-skills/request-and-response-json-reference.html)
while keeping preparation for future updates.

## Requirements
* PHP (at least 5.6.0)
* [composer](https://getcomposer.org/)

## Usage
Require the library in your composer.json:
```php
{
    "require": {
        "internetofvoice/libvoice": "~1.0"
    }
}
```

### Alexa Request
When Amazon's Alexa Skills Kit (ASK) triggers your skill, a POST request will be sent to the URL you configured. You
need to grab some request headers and the raw request body (text representation of a JSON object) as it is signed and
the signature needs to be validated - any modification of the body will make the validation fail.

The following example shows how to get an AlexaRequest object and what information is required to do so.
Example code refers to [Slim Framework](https://www.slimframework.com), but can easily adopted to your setup:
```php
// $request is the HTTP request object, provided by Slim

$alexaRequest = new AlexaRequest(
    $request->getBody()->getContents(), // raw request body
    ["amzn1.ask.skill.xxxx"], // Skill ID from ASK, you may supply multiple IDs if needed
    $request->getHeaderLine('Signaturecertchainurl'), // HTTP Header sent by ASK
    $request->getHeaderLine('Signature'), // HTTP Header sent by ASK
    true, // enable validation of request timestamp
    true // enable validation of request signature
);

```

Please be aware that the last two parameters **need to be `true` in production** as Amazon requires certificate 
validation. For development or unit tests, validation process may exclude timestamp validation (recommended) or 
the whole validation process at all (not recommended).

The resulting AlexaRequest object resembles the JSON structure of Amazons Skills Kit Request Body Syntax - see the
documentation at
https://developer.amazon.com/docs/custom-skills/request-and-response-json-reference.html#request-body-syntax.

For instance, you can determine the type of AlexaRequest like so:
```php
switch($alexaRequest->getRequest()->getType()) {
    case 'LaunchRequest':
        // A welcome message..
    break;

    case 'IntentRequest':
   		// Fulfill the requested intent
    break;

    case 'SessionEndedRequest':
    	// Usually nothing to do here
    break;
}
```

For more references, you may give [VSMS-Core](https://github.com/internetofvoice/vsms-core) (VSMS framework) or
[VSMS-Skeleton](https://github.com/internetofvoice/vsms-skeleton) (VSMS application skeleton) a try. VSMS is short
for "Voice Skill Management System" and uses this library to provide a development framework for voice
assistant interactions.

### Alexa Response
As most AlexaRequests expect a proper response, we could send one like this (again, code example with Slim Framework):
```php
// $response is the HTTP response object, provided by Slim

$alexaResponse = new AlexaResponse;
$alexaResponse
	->respond('Welcome!') // Response message
	->reprompt('How may I help you?') // Reprompt message

return $response->withJson($alexaResponse->render());
```

The AlexaResponse object resembles the JSON structure of Amazons Skills Kit Response Format - see the documentation at
https://developer.amazon.com/docs/custom-skills/request-and-response-json-reference.html#response-format.

AlexaResponse is - not surprisingly - also incorporated by VSMS. [VSMS-Skeleton](https://github.com/internetofvoice/vsms-skeleton)
provides an example skill that may give you a quick start for developing your own skill.

### Concluding words
You are welcome to contribute to this project, and so are your pull requests.

Found a bug or have a feature request? Please open a new issue and let us know.
