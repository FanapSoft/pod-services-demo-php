<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

// ============================================= USER OPERATION SERVICES ===============================================
// =====================================================================================================================
# required classes
use Pod\User\Operation\Service\UserOperationService;
use Pod\Base\Service\BaseInfo;

$baseInfo = new BaseInfo();
# set serverType to SandBox or Production
$baseInfo->setServerType("put server type Sandbox | Production");
$baseInfo->setToken("put Access Token here");  # access token will be expired each 15 minutes refresh this token with SSOService->refreshAccessToken
$baseInfo->setTokenIssuer(1);

$UserOperationService = new UserOperationService($baseInfo);

# ================================================ get User Profile ===================================================

function getUserProfile()
{
    echo "========================================= get User Profile =====================================" . PHP_EOL;
    global $UserOperationService;

    $param =
    [
    ## ==========================================  Optional Parameters  ================================================
#            "client_id" => "",
#            "client_secret" => "",
    ];

    try {
        $result = $UserOperationService->getUserProfile($param);
        print_r($result);
    } catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

    }
}

#    getUserProfile();

#======================================== Edit Profile With Confirmation ==========================================
function EditProfileWithConfirmation()
{
    echo "============================ Edit Profile With Confirmation ==============================" . PHP_EOL;
    global $UserOperationService;

    $param =
    [
        'nickName' => "",                         # scope: profile  نام مستعار که باید یکتا باشد
        ## ==========================================  Optional Parameters  ============================================
#        "client_id"   => "",                     # برای بروزرسانی client_metadata این پارامتر اجباری می باشد
#        "client_secret" => "",                   # برای بروزرسانی client_metadata این پارامتر اجباری می باشد
#        "firstName" => "",                       # scope: profile
#        "lastName" => "",                        # scope: profile
#        "email" =>   "",                         # scope: email
#        "phoneNumber" => "",                     # scope: address
#        "cellphoneNumber" => "",                 # scope: phone
#        "nationalCode" => "",                    # scope: legal
#        "gender" =>   "",                        # scope: profile MAN_GENDER یا WOMAN_GENDER
#        "address" =>   "",                       # scope: address
#        "birthDate" =>  "",                      # scope: legal  تاریخ شمسی تولد yyyy/mm/dd
#        "country" =>  "",                        # scope: address
#        "state" => "",                           # scope: address استان محل تولد
#        "city" =>   "",                          # scope: address
#        "postalcode" =>  "",                     # scope: address
#        "sheba" =>  "",                          # scope: legal  شبا که به صورت عددی وارد می شود. (بدون IR)
#        "profileImage" =>  "",                   # scope: profile     تصویر پروفایل کاربر
#        "birthState" => "",                      # scope: address
#        "client_metadata" => "",                 # SSO client_metadata
#        "identificationNumber" => "",            # شماره شناسنامه
#        "fatherName" => "",
    ];

    try {
        $result = $UserOperationService->editProfileWithConfirmation($param);
        print_r($result);
    } catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

    }

}

#EditProfileWithConfirmation();




