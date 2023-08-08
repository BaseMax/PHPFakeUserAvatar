<?php
namespace Tests;

use Tests\Support\ApiTester;

class ApiCest
{
    /* login */
    public function loginMissingEmail(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'password' => '123456'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"email is required"}');
    }

    public function loginMissingPassword(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"password is required"}');
    }

    public function loginWrongEmail(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'ali@joubeh.com',
            'password' => '123456'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"email or password is not valid"}');
    }

    public function loginWrongPassword(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com',
            'password' => '000000'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"email or password is not valid"}');
    }

    public function loginOkLogin(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com',
            'password' => '123456'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    /* register */
    public function registerMissingEmail(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/register', [
            'name' => 'amir',
            'password' => '123456'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"email is required"}');
    }

    public function registerMissingPassword(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/register', [
            'name' => 'amir',
            'email' => 'amir@joubeh.com'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"password is required"}');
    }

    public function registerMissingName(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/register', [
            'password' => '123456',
            'email' => 'mohammad@joubeh.com'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('{"message":"name is required"}');
    }

    public function registerExistsEmail(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/register', [
            'name' => 'mohammad',
            'email' => 'mohammad@joubeh.com',
            'password' => '123456'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function registerOkRegister(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/register', [
            'name' => 'amir',
            'email' => 'amir@joubeh.com',
            'password' => '123456'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    /* get api keys */
    public function getApiKeysNoLogin(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGet('/get-keys');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function getApiKeysOk(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com',
            'password' => '123456'
        ]);
        $I->haveHttpHeader('Authorization', 'Bearer '.json_decode($I->grabResponse())->token);
        $I->sendGet('/get-keys');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    /* create api key */
    public function createApiKeyNoLogin(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/create-key');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function createApiKeyOk(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com',
            'password' => '123456'
        ]);
        $I->haveHttpHeader('Authorization', 'Bearer '.json_decode($I->grabResponse())->token);
        $I->sendPost('/create-key');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    /* delete api key */
    public function deleteApiKeyNoLogin(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendDelete('/delete-key/123456');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function deleteApiKeyNotExists(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com',
            'password' => '123456'
        ]);
        $I->haveHttpHeader('Authorization', 'Bearer '.json_decode($I->grabResponse())->token);
        $I->sendDelete('/delete-key/123456');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function deleteApiKeyOk(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com',
            'password' => '123456'
        ]);
        $I->haveHttpHeader('Authorization', 'Bearer '.json_decode($I->grabResponse())->token);
        $I->sendPost('/create-key');
        $I->sendDelete('/delete-key/'.json_decode($I->grabResponse())->api_key);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    /* get fake users */
    public function getFakeUsersNoApiKey(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGet('/get-fake-users');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function getFakeUsersOk(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com',
            'password' => '123456'
        ]);
        $I->haveHttpHeader('Authorization', 'Bearer '.json_decode($I->grabResponse())->token);
        $I->sendPost('/create-key');
        $I->haveHttpHeader('APIKEY', json_decode($I->grabResponse())->api_key);
        $I->sendGet('/get-fake-users');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    /* get random fake user */
    public function getRandomFakeUserNoApiKey(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGet('/get-random-fake-user');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function getRandomFakeUserOk(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/login', [
            'email' => 'mohammad@joubeh.com',
            'password' => '123456'
        ]);
        $I->haveHttpHeader('Authorization', 'Bearer '.json_decode($I->grabResponse())->token);
        $I->sendPost('/create-key');
        $I->haveHttpHeader('APIKEY', json_decode($I->grabResponse())->api_key);
        $I->sendGet('/get-random-fake-user');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    /* not found */
    public function testRouteIsNotFound(ApiTester $I)
    {
        $I->sendGet('/');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
    }
}