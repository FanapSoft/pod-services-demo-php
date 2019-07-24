<?php
require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);

// =============================================== SSO SERVICES ========================================================
// =====================================================================================================================

# required classes
use Pod\Sso\Service\SSOService;
use Pod\Base\Service\ClientInfo;


// for most service you need set client id and client secret so you can set these parameters once

    $clientInfo = new ClientInfo();

    $clientInfo->setClientId("put client id here");
    $clientInfo->setClientSecret("put client secret here");

    // for get Access Token and Refresh Access Token you need set redirect uri
    $clientInfo->setRedirectUri("put redirect uri of client here");

    #  instantiates a SSOService
    $SSOService = new SSOService($clientInfo);
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
        }
        catch (Exception $e) {

            print_r([
                'errorCode' => $e->getCode(),
                'message'   => $e->getMessage()
            ]);

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
        }
        catch (Exception $e) {

            print_r([
                'errorCode' => $e->getCode(),
                'message' => $e->getMessage()
            ]);

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
            "token" => "put token",
            "token_type_hint" => "put token type to `refresh-token` or `access-token`",
        ];


        try {
            $result = $SSOService->revokeToken($params);
            print_r($result);
        }
        catch (Exception $e) {

            print_r([
                'errorCode' => $e->getCode(),
                'message' => $e->getMessage()
            ]);

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
            "token" => "put token",
            "token_type_hint" => "put token type to `refresh-token` or `access-token`",
        ];

        try {
            $result = $SSOService->getTokenInfo($params);
            print_r($result);
        }
        catch (Exception $e) {

            print_r([
                'errorCode' => $e->getCode(),
                'message' => $e->getMessage()
            ]);

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
            "api_token"             => 'put api token',
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
        }
        catch (Exception $e) {

            print_r([
                'errorCode' => $e->getCode(),
                'message' => $e->getMessage()
            ]);

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
        }
        catch (Exception $e) {

            print_r([
                'errorCode' => $e->getCode(),
                'message' => $e->getMessage()
            ]);

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
        }
        catch (Exception $e) {

            print_r([
                'errorCode' => $e->getCode(),
                'message' => $e->getMessage()
            ]);

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
        }
        catch (Exception $e) {

            print_r([
                'errorCode' => $e->getCode(),
                'message'   => $e->getMessage()
            ]);

        }
    }

//    getAccessTokenByOTP();
    //    die;


