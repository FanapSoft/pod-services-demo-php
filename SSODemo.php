<?php
require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);

// =============================================== SSO SERVICES ========================================================
// =====================================================================================================================

const CLIENT_ID = 'YOUR_CLIENT_ID';
const CLIENT_SECRET = 'YOUR_CLIENT_SECRET';
const REDIRECT_URI = 'YOUR_REDIRECT_URI';
const API_TOKEN = 'YOUR_API_TOKEN';

# required classes
use Pod\Base\Service\Exception\PodException;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Sso\Service\SSOService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\ClientInfo;

# set serverType to SandBox or Production
# NOTICE : for SSOService there is no SandBox Server
BaseInfo::initServerType(BaseInfo::PRODUCTION_SERVER);


// for most service you need set client id and client secret so you can set these parameters once

$clientInfo = new ClientInfo();

$clientInfo->setClientId(CLIENT_ID);
$clientInfo->setClientSecret(CLIENT_SECRET);

// for get Access Token and Refresh Access Token you need set redirect uri
$clientInfo->setRedirectUri(REDIRECT_URI);

#  instantiates a SSOService
$SSOService = new SSOService($clientInfo);

// ================================================== get Login Url ====================================================
function getLoginUrl()
{
    echo "======================================= get Login Url ===================================" .PHP_EOL;
    global $SSOService;

    $params = [
//        "client_id" => "" ,   # if it is set in $clientInfo dont need to set again else it is required to set
//        "redirect_uri" => "", # if it is set in $clientInfo dont need to set again else it is required to set
        ## ================================ *Optional Parameters ======================================
//        "scope" => "profile",  #default: profile , separate scopes with "+" or space
//        "response_type" => "code", #  #default: code
//        "prompt" => "",
//        "state" => "",
//        "code_challenge" => "",
//        "code_challenge_method" => "",
    ];

    try {
        $result = $SSOService->getLoginUrl($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

// ================================================== get Access Token =================================================
function getAccessToken()
{
    echo "======================================= get Access Token ===================================" .PHP_EOL;
    global $SSOService;

    $params = [
        "code" => "put code here" # use code that you receive in url
    ];

    try {
        $result = $SSOService->getAccessToken($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//  unComment next line to  get Access Token
//    getAccessToken();
// die;
// =========================================== refresh Access Token ====================================================
function refreshToken()
{
    echo "================================ refresh Access Token =====================================" .PHP_EOL;
    global $SSOService;
    // set refresh token that is received when getting access token
    $params = [
        "refresh_token" => "put refresh token"
    ];

    try {
        $result = $SSOService->refreshAccessToken($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    refreshToken();


// ===================================================== revoke Token ==================================================
function revokeToken()
{
    echo "========================================== revoke Token ==================================" . PHP_EOL;
    global $SSOService;

    # set token and token_type_hint
    $params = [
        "token" => API_TOKEN,
        "token_type_hint" => "put token type to `refresh_token` or `access_token`",
    ];


    try {
        $result = $SSOService->revokeToken($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }

}

//    revokeToken();

// ============================================== get Token Info =======================================================
function TokenInfo()
{
    echo "=================================== get Token Info ========================================" . PHP_EOL;
    global $SSOService;

    # set token and token_type_hint
    $params = [
        "token" => API_TOKEN,
        "token_type_hint" => "put token type to `refresh_token` or `access_token`",
    ];

    try {
        $result = $SSOService->getTokenInfo($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    TokenInfo();

// =============================================  OTP Login  ===========================================================
// =============================================  Handshake  ===========================================================

function handshake() {
    echo "=======================================  Handshake  ======================================" . PHP_EOL;
    global $SSOService;
    $params = [
        ## =========================================== *Required Parameters ============================================
        "api_token"             => API_TOKEN,
        "device_uid"            => 'put device unique id here',         # Device unique id ,maximum 255 character
        ## =========================================== *Optional Parameters ============================================
        "device_name"           => 'put device name here',
        "device_type"           => 'put device type here',
        "device_lat"            => 'put device latitude here',
        "device_lon"            => 'put device longitude here',
        "device_os"             => 'put device os here',
        "device_os_version"     => 'put device os version here',

    ];
    try {
        $result = $SSOService->handshake($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    handshake();
//    die;

// ==============================================  signature Authorize  ================================================

function signatureAuthorize() {
    echo "===================================  signature Authorize  =====================================" . PHP_EOL;
    global $SSOService;

    $privateKey = file_get_contents('put your private key file name');
    $params = [
        ## =========================================== *Required Parameters ============================================
        "privateKey"                => $privateKey,
        "keyId"                     => 'put key id that you receive from handshake here',
//          "algorithm"                 => OPENSSL_ALGO_SHA256,
        "identity"                  => 'put identity [mobile phone number or email address] here',
        "response_type"             => 'code', # code | token | id_token
        ## =========================================== *Optional Parameters ============================================
        "identityType"              => 'put PHONE  identity type [PHONE | EMAIL]',
        "loginAsUserId"             => 'put loginAsUserId',
        "state"                     => 'put state',
        "client_id"                 => 'put client_id',
        "redirect_uri"              => 'put redirect_uri',
        "callback_uri"              => 'put callback_uri',
        "scope"                     => 'put scope',
        "code_challenge"            => 'put code_challenge',
        "code_challenge_method"     => 'put code_challenge_method',
        "referrer"                  => 'put referrer',
        "referrerType"              => 'put referrerType',

    ];
    try {
        $result = $SSOService->signatureAuthorize($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    $result = signatureAuthorize();
//    die;

// =================================================  verify OTP  ======================================================

function verifyOTP($signature) {
    echo "======================================  verify OTP  =========================================" . PHP_EOL;
    global $SSOService;

    $params = [
        ## =========================================== *Required Parameters ============================================
        "keyId"                     => 'put key id that you received from handshake here',
        "signature"                 =>   $signature,
        "otp"                       => 'put otp that is received from user here',
        "identity"                  => 'put identity [phone or email] here',
    ];

    try {
        $result = $SSOService->verifyOTP($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }

}

$signature = "put signature here";
//    verifyOTP($signature);
//    die;

// ============================================== get Access Token By OTP ==============================================
function getAccessTokenByOTP()
{
    echo "=================================== get Access Token By OTP  ===================================" .PHP_EOL;
    global $SSOService;

    $params = [
        "code" => "put code", # use code that you received after verify otp
    ];

    try {
        $result = $SSOService->getAccessTokenByOTP($params);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

