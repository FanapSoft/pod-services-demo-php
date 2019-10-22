<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

# ================================================ Neshan SERVICES ====================================================
# required classes
use Pod\Neshan\Service\NeshanService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

#در صورتی که میخواهید از ApiToken برای استفاده از سرویس های نشان استفاده کنید مقدارش را در این قسمت وارد کنید.
const API_TOKEN = '{PUT API TOKEN}';

# در صورتی که میخواهید از AccessToken برای استفاده از سرویس های نشان استفاده کنید در اینجا میتوانید اکسس توکن را وارد کنید
#pay attention that access token will be expired each 15 minutes refresh this token with SSOService->refreshAccessToken
const ACCESS_TOKEN = '{PUT ACCESS TOKEN}';

# default tokenIssuer is 1 if you want to change it to zero set here
const TOKEN_ISSUER = 1; # 0 or 1 default is 1

#  instantiates a NeshanService
$NeshanService = new NeshanService();
# ================================================ search ===============================================
function search()
{
    echo '======================================== search =================================' .PHP_EOL;
    global $NeshanService;

    $param =
        [
            ## ========================== *Required Parameters  ==========================
            "scApiKey"             => '{Put search Api Key}',
            "token"               => '{Put Api_Token | AccessToken }',      # Api_Token | AccessToken
            "term"                 => '{Put location name}',
            "lat"                  => '{Put Latitude}',
            "lng"                  => '{Put Longitude}',
        ## ======================== Optional Parameters  =============================
#          "tokenIssuer"           => TOKEN_ISSUER, # default is 1
#          "scVoucherHash"          => '{Put voucherHash}',

    ];
    try {
        $result = $NeshanService->search($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
# ================================================ reverseGeo ===============================================
function reverseGeo()
{
    echo '======================================== reverseGeo =================================' .PHP_EOL;
    global $NeshanService;

    $param =
        [
            ## ========================== *Required Parameters  ==========================
            "scApiKey"             => '{Put search Api Key}',
            "token"               => '{Put Api_Token | AccessToken }',      # Api_Token | AccessToken
            "lat"                  => '{Put Latitude}',
            "lng"                  => '{Put Longitude}',
        ## ======================== Optional Parameters  =============================
#          "tokenIssuer"           => TOKEN_ISSUER, # default is 1
#          "scVoucherHash"          => '{Put voucherHash}',
    ];
    try {
        $result = $NeshanService->reverseGeo($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================================ direction ===============================================
function direction()
{
    echo '======================================== direction =================================' .PHP_EOL;
    global $NeshanService;

    $param =
        [
            ## ========================== *Required Parameters  ==========================
            "scApiKey"           => '{Put search Api Key}',
            "token"               => '{Put Api_Token | AccessToken }',      # Api_Token | AccessToken
            "origin"               =>
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ],
            "destination"           =>
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ],
       ## ======================== Optional Parameters  =============================
            'waypoints'=>[
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ],
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ], // ...
            ],
            'avoidTrafficZone'=>  '{true/false}',
            'avoidOddEvenZone'=>  '{true/false}',
            'alternative'=> '{true/false}',
           'tokenIssuer'           => '{Put 1 or 0}',
           'scVoucherHash'      =>  '{Put voucherHash}',
    ];
    try {
        $result = $NeshanService->direction($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//direction();
//die();
# ================================================ noTrafficDirection ===============================================
function noTrafficDirection()
{
    echo '======================================== noTrafficDirection =================================' .PHP_EOL;
    global $NeshanService;

    $param =
        [
            ## ========================== *Required Parameters  ==========================
            "scApiKey"           => '{Put search Api Key}',
            "token"               => '{Put Api_Token | AccessToken }',      # Api_Token | AccessToken
            "origin"               =>
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ],
            "destination"           =>
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ],
            ## ======================== Optional Parameters  =============================
            'waypoints'=>[
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ],
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ], // ...
            ],
            'avoidTrafficZone'=>  '{true/false}',
            'avoidOddEvenZone'=>  '{true/false}',
            'alternative'=> '{true/false}',
            'tokenIssuer'           => '{Put 1 or 0}',
            'scVoucherHash'      =>  '{Put voucherHash}',
        ];
    try {
        $result = $NeshanService->noTrafficDirection($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================================ distanceMatrix ===============================================
function distanceMatrix()
{
    echo '======================================== distanceMatrix =================================' .PHP_EOL;
    global $NeshanService;

    $param =
        [
            ## ========================== *Required Parameters  ==========================
            "scApiKey"           => '{Put search Api Key}',
            "token"               => '{Put Api_Token | AccessToken }',      # Api_Token | AccessToken
            "origins"                =>
                [
                    [
                        "lat"                  => '{Put Latitude}',
                        "lng"                  => '{Put Longitude}',
                    ],
                    [
                        "lat"                  => '{Put Latitude}',
                        "lng"                  => '{Put Longitude}',
                    ],// ...
                ],
            "destinations"           =>
                [
                    [
                        "lat"                  => '{Put Latitude}',
                        "lng"                  => '{Put Longitude}',
                    ], //...
                ],
            ## ======================== Optional Parameters  =============================
            'tokenIssuer'           => '{Put 1 or 0}',
            'scVoucherHash'      =>  '{Put voucherHash}',

    ];
    try {
        $result = $NeshanService->distanceMatrix($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================================ noTrafficDistanceMatrix ===============================================
function noTrafficDistanceMatrix()
{
    echo '======================================== noTrafficDistanceMatrix =================================' .PHP_EOL;
    global $NeshanService;

    $param =
        [
            ## ========================== *Required Parameters  ==========================
            "scApiKey"           => '{Put search Api Key}',
            "token"               => '{Put Api_Token | AccessToken }',      # Api_Token | AccessToken
            "origins"                =>
                [
                    [
                        "lat"                  => '{Put Latitude}',
                        "lng"                  => '{Put Longitude}',
                    ],
                    [
                        "lat"                  => '{Put Latitude}',
                        "lng"                  => '{Put Longitude}',
                    ],// ...
                ],
            "destinations"           =>
                [
                    [
                        "lat"                  => '{Put Latitude}',
                        "lng"                  => '{Put Longitude}',
                    ], //...
                ],
            ## ======================== Optional Parameters  =============================
            'tokenIssuer'           => '{Put 1 or 0}',
            'scVoucherHash'      =>  '{Put voucherHash}',

        ];

    try {
        $result = $NeshanService->noTrafficDistanceMatrix($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================================ mapMatching ===============================================
function mapMatching()
{
    echo '======================================== mapMatching =================================' .PHP_EOL;
    global $NeshanService;

    $param =
        [
            ## ========================== *Required Parameters  ==========================
            "scApiKey"           => '{Put search Api Key}',
            "token"               => '{Put Api_Token | AccessToken }',      # Api_Token | AccessToken
            'path'  => [
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
               ],
                [
                    "lat"                  => '{Put Latitude}',
                    "lng"                  => '{Put Longitude}',
                ],// ....
            ],
      ## ======================== Optional Parameters  =============================
            'tokenIssuer'           => '{Put 1 or 0}',
            'scVoucherHash'      =>  '{Put voucherHash}',
    ];
    try {
        $result = $NeshanService->mapMatching($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

mapMatching();
die();
