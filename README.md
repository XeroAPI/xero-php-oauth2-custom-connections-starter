# xero-php-oauth2-custom-connections-starter
This is a starter app with the code to perform OAuth 2.0 authentication flow for the `client_credentials` grant.

Custom Connections are a Xero [premium option](https://developer.xero.com/documentation/oauth2/custom-connections) for building M2M integrations to a single Xero Organisation.

## Create a Xero App
To obtain your API keys, follow these steps and create a Xero app

* Login or create a [free Xero user account](https://www.xero.com/us/signup/api/)
* Login to [Xero developer center](https://developer.xero.com/app/manage)
* Click "New App" link with the "Custom connection" selection
* Agree to terms and condition and click "Create App".
* Complete the steps for Custom Connections
* Click "Generate a secret" button
* Click the "Save" button. You secret is now hidden.

## Getting Started
To run locally, you'll need a local web server with PHP support.  
* Have Docker Compose installed - https://docs.docker.com/compose/install/
* Update your .env with your app's credentials

```bash
mv .env.sample .env
```

### Running the app
```
composer install
docker-compose up
```
> Visit `http://localhost:8080/`

There are two main files.
- authorization.php
- authorizedResource.php

`authorization.php` configures the Xero client and when you click the button, will exchange your credentials for a 30 minute `access_token` from Xero's servers. 

A 'Custom Connection' enables you to have a background process without any user authantication, like the traditional `authorization_code` grant_type you might be familar with.

You are then redirected to `authorizedResource.php` where you have 4 examples to access authorized API resources which require a valid access token to be set on the client.

## License

This software is published under the [MIT License](http://en.wikipedia.org/wiki/MIT_License).

	Copyright (c) 2020 Xero Limited

	Permission is hereby granted, free of charge, to any person
	obtaining a copy of this software and associated documentation
	files (the "Software"), to deal in the Software without
	restriction, including without limitation the rights to use,
	copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the
	Software is furnished to do so, subject to the following
	conditions:

	The above copyright notice and this permission notice shall be
	included in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
	OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
	HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
	WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
	OTHER DEALINGS IN THE SOFTWARE.
