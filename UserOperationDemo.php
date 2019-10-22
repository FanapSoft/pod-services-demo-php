<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ============================================= USER OPERATION SERVICES ===============================================
// =====================================================================================================================
const CLIENT_ID = 'YOUR_CLIENT_ID';
const CLIENT_SECRET = 'YOUR_CLIENT_SECRET';
const REDIRECT_URI = 'YOUR_REDIRECT_URI';
const TOKEN_ISSUER = 1;

# required classes
use Pod\User\Operation\Service\UserOperationService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

$UserOperationService = new UserOperationService();

# ================================================= get User Profile ===================================================

function getUserProfile()
{
    echo '========================================= get User Profile =====================================' . PHP_EOL;
    global $UserOperationService;

    $param =
    [
        ## ============================ *Required Parameters  =========================
        'token'             => '{Put user access token}', # user token
        ## ============================  Optional Parameters  =========================
        'client_id'         => CLIENT_ID,
        'client_secret'     => CLIENT_SECRET,
        '_token_issuer_'    => TOKEN_ISSUER,  # default is 1
        'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'           => '{Put service call Api Key}',
    ];

    try {
        $result = $UserOperationService->getUserProfile($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

#========================================= Edit Profile With Confirmation ==============================================
function EditProfileWithConfirmation()
{
    echo '============================ Edit Profile With Confirmation ==============================' . PHP_EOL;
    global $UserOperationService;

    $param =
    [
        ## ============================ *Required Parameters  =========================
        'token'             => '{Put user access token}', # user token
        'nickName' => '{put nick name}',     # scope: profile  نام مستعار که باید یکتا باشد
        ## ===========================  Optional Parameters  ===========================
        'client_id'   => CLIENT_ID,              # برای بروزرسانی client_metadata این پارامتر اجباری می باشد
        'client_secret' => CLIENT_SECRET,        # برای بروزرسانی client_metadata این پارامتر اجباری می باشد
        'firstName' => '{put first name}',       # scope: profile
        'lastName' => '{put last name}',         # scope: profile
        'email' =>   '{put email}',              # scope: email
        'phoneNumber' => '{put phone number}',   # scope: address
        'cellphoneNumber' => '{put cell phone number}',   # scope: phone
        'nationalCode' => '{put national code}',          # scope: legal
        'gender' =>   '{put gender}',                     # scope: profile MAN_GENDER یا WOMAN_GENDER
        'address' =>   '{put address}',                   # scope: address
        'birthDate' =>  '{put birth date}',               # scope: legal  تاریخ شمسی تولد yyyy/mm/dd
        'country' =>  '{put country}',                    # scope: address
        'state' => '{put state}',                         # scope: address استان محل تولد
        'city' =>   '{put city}',                         # scope: address
        'postalcode' =>  '{put postal code}',             # scope: address
        'sheba' =>  '{put sheba}',                        # scope: legal  شبا که به صورت عددی وارد می شود. (بدون IR)
        'profileImage' =>  '{put profile image}',         # scope: profile     تصویر پروفایل کاربر
        'birthState' => '{put birth state}',              # scope: address
        'client_metadata' => '{put cilent meta data}',    # SSO client_metadata
        'identificationNumber' => '{put identification number}',  # شماره شناسنامه
        'fatherName' => '{put father name}',              # scope: profile نام پدر
        '_token_issuer_'    => TOKEN_ISSUER,  # default is 1
        'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'           => '{Put service call Api Key}',
    ];

    try {
        $result = $UserOperationService->editProfileWithConfirmation($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//======================================== Confirm Edit Profile ==========================================
function confirmEditProfile()
{
    echo '============================ Confirm Edit Profile ==============================' . PHP_EOL;
    global $UserOperationService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'token'                 => '{Put token}',
            'code'                  => '{Put code received by sms}',
            'cellphoneNumber'       => '{Put user phone number}',
            ## ===========================  Optional Parameters  ===========================
            'scVoucherHash'         => ['{Put Service Call Voucher Hash 1}', '{Put Service Call Voucher Hash 2}'],
            'scApiKey'              => '{Put service call Api Key}',
        ];

    try {
        $result = $UserOperationService->confirmEditProfile($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//======================================== Get List Address ==========================================
function getListAddress()
{
    echo '============================ Get List Address ==============================' . PHP_EOL;
    global $UserOperationService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'token'             => '{Put token}',
            'offset'            => '{Put offset}',
            ## ===========================  Optional Parameters  ===========================
            'size'              => '{pUT OUTPUT SIZE}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'          => '{Put service call Api Key}',
        ];

    try {
        $result = $UserOperationService->getListAddress($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }

}


