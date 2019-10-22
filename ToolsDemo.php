<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

# ================================================ Neshan SERVICES ====================================================
# required classes
use Pod\Tools\Tools;
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

#  instantiates a Tools
$Tools = new Tools();

# ================================================ pay Bill ===============================================
function payBill()
{
    echo '======================================== pay Bill =================================' .PHP_EOL;
    global $Tools;

    $param =
        [
            ## ======================= *Required Parameters  ==========================
            'token'             => '{Put Api_Token or Access_Token}',      # Api_Token | AccessToken
            'billId'                 => "{Put Bill Id}",
            'paymentId'                  => "{Pur Payment Id}",
            ## ======================== Optional Parameters  ==========================
            'tokenIssuer'           => TOKEN_ISSUER, # default is 1
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $Tools->payBill($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================ payed Bill List ===========================================
function payedBillList()
{
    echo '==================================== payed Bill List =================================' .PHP_EOL;
    global $Tools;

    $param =
        [
            ## ========================== *Required Parameters  ==========================
            "token"               => '{Put Api_Token | AccessToken }',      # Api_Token | AccessToken
            "lat"                  => '{Put Latitude}',
            "lng"                  => '{Put Longitude}',
        ## ======================== Optional Parameters  =============================
#          "tokenIssuer"           => TOKEN_ISSUER, # default is 1
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $Tools->reverseGeo($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
