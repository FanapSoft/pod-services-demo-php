<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
# ================================================= COMMON SERVICES ====================================================

# required classes
use Pod\Common\Service\CommonService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

const TOKEN_ISSUER = '{Put token_issuer}';
const API_TOKEN = '{Put Api token}';
$baseInfo = new BaseInfo();
$baseInfo->setTokenIssuer(TOKEN_ISSUER);
$baseInfo->setToken(API_TOKEN);


#  instantiates a CommonService
$CommonService = new CommonService($baseInfo);

# ============================================== get Guild List ==================================================
function getGuildList()
{
    echo '=================================== get Guild List =======================================' .PHP_EOL;
    global $CommonService;
    $params = [
        ## ============================ Required Parameters  ==================================
        'offset' => 0,
        ## ============================ Optional Parameters  ==================================
        'token'             => '{Api_Token | Access_Token}',
        'name'              => '{Put Guild Name}',
        'size'              => '{Put output size}',
        'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'         => '{Put service call Api Key}',
    ];

    try {
        $result = $CommonService->getGuildList($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
# ============================================== get Currency List ==================================================
function getCurrencyList()
{
    echo '=================================== get Currency List =======================================' .PHP_EOL;
    global $CommonService;
    $params = [
    ## ============================ Optional Parameters  ==================================
//        'token'               => '{Api_Token | Access_Token}',
//        'scVoucherHash'       => ['{Put Service Call Voucher Hashes}'],
//        'scApiKey'            => '{Put service call Api Key}',
    ];

    try {
        $result = $CommonService->getCurrencyList($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
# ============================================== get Ott =================================================
function getOtt()
{
    echo '=================================== get Ott =======================================' .PHP_EOL;
    global $CommonService;
    $params = [
    ## ============================ Optional Parameters  ==================================
//        'token' => '{Api_Token | Access_Token}',
//        'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
//        'scApiKey'           => '{Put service call Api Key}',
    ];

    try {
        $result = $CommonService->getOtt($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
# ============================================= add Tag Tree Category ==================================================
function addTagTreeCategory()
{
    echo '=================================== add Tag Tree Category =======================================' .PHP_EOL;
    global $CommonService;
    $params = [
        ## ============================ Required Parameters  ==================================
        'name'                => '{Put tag tree category name}',
        ## ============================ Optional Parameters  ==================================
        'apiToken'            => '{Put Api_Token}',
        'desc'                => '{Put description}',
        'scVoucherHash'       => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'            => '{Put service call Api Key}',

    ];
    try {
        $result = $CommonService->addTagTreeCategory($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

// ========================================== get Tag Tree Category List ===============================================
function getTagTreeCategoryList()
{
    echo '=============================== get Tag Tree Category List ================================' .PHP_EOL;
    global $CommonService;
    $params = [
    ## ============================ Required Parameters  ==================================
        'offset' => 0,
    ## ============================ Optional Parameters  ==================================
        'apiToken'      => '{Put Api_Token}',
        'size'          => '{Put output size}',
        'id'            => '{Put tag tree category id}',
        'name'          => '{Put tag tree category name}',
        'query'         => '{Put search word}',
        'scVoucherHash' => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'      => '{Put service call Api Key}',
    ];
    try {
        $result = $CommonService->getTagTreeCategoryList($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

// ============================================ update Tag Tree Category ===============================================
function updateTagTreeCategory()
{
    echo '================================ update Tag Tree Category =================================' .PHP_EOL;
    global $CommonService;
    $params = [
        ## ============================ Required Parameters  ==================================
        'apiToken'          => '{Put Api_Token}',
        'id'                => '{put tag tree category id}',
        ## ============================ Optional Parameters  ==================================
        'enable'            => '{true/false}',
        'name'              => '{Put tag tree category name}',
        'desc'              => '{Put description}',
        'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
         'scApiKey'         => '{Put service call Api Key}',
    ];
    try {
        $result = $CommonService->updateTagTreeCategory($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================= add Tag Tree ==================================================
function addTagTree()
{
    echo '=================================== add Tag Tree =======================================' .PHP_EOL;
    global $CommonService;
    $params = [
        ## ============================ Required Parameters  ==================================
        'apiToken'      => '{Put Api_Token}',
        'name'          => 'Put tag name',
        'categoryId'    => '{Put tag category id}',
        ## ============================ Optional Parameters  ==================================
        'parentId'      => '{Put parent id if tag has parent}',
        'scVoucherHash' => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'      => '{Put service call Api Key}',
    ];
    try {
        $result = $CommonService->addTagTree($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

// ========================================== get Tag Tree List ===============================================
function getTagTreeList()
{
    echo '=============================== get Tag Tree List ================================' .PHP_EOL;
    global $CommonService;
    $params = [
        ## ============================ Required Parameters  ==================================
        'apiToken'      => '{Put Api_Token}',
        'categoryId'    => '{Put tag category id}',
        'levelCount'    => '{Put level count}',
        ## ============================ Optional Parameters  ==================================
        'id'            => '{Put tag tree id}',
        'parentId'      => '{Put parent id if tag has parent}',
        'scVoucherHash' => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'      => '{Put service call Api Key}',
    ];
    try {
        $result = $CommonService->getTagTreeList($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
// ============================================ update Tag Tree ===============================================
function updateTagTree()
{
    echo '================================ update Tag Tree =================================' .PHP_EOL;
    global $CommonService;
    $params = [
        ## ============================ Required Parameters  ==================================
        'id'                => '{Put tag tree id}',
        ## ============================ Optional Parameters  ==================================
        'apiToken'          => '{Put Api_Token}',
        'parentId'          => '{Put parent id if tag has parent}',
        'enable'            => '{true/false}',
        'name'              => 'Put tag tree name',
        'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'          => '{Put service call Api Key}',
    ];
    try {
        $result = $CommonService->updateTagTree($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
