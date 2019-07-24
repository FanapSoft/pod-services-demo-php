<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

# ================================================ Dealing SERVICES ====================================================
# required classes
use Pod\Dealing\Service\DealingService;

# set serverType to SandBox or Production
$serverType = "Production";
#  instantiates a DealingService
$dealingService = new DealingService($serverType);

# ================================================ add User And Business ===============================================
function addUserAndBusiness()
{
    echo "======================================== add User And Business =================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => 'Api_Token',      # Api_Token
            "username"              => 'USER NAME',
            "businessName"          => 'BUSINESS NAME',
            "email"                 => 'EMAIL',
            "guildCode"             => ['GUILD_CODE'],
            "country"               => 'COUNTRY',
            "state"                 => 'STATE',
            "city"                  => 'CITY',
            "address"               => 'ADDRESS',
            "description"           => 'DESCRIPTION',
            "agentFirstName"        => 'AGENT FIRST NAME',
            "agentLastName"         => 'AGENT LAST NAME',
            "agentCellphoneNumber"  => 'AGENT PHONE NUMBER',
        ## ========================================= Optional Parameters  ==============================================
#             "_token_issuer_"       => 1,
#             "firstName"            => 'FIRST NAME',
#             "lastName"             => 'LAST NAME',
#             "sheba"                => 'SHEBA WITHOUT IR',
#             "nationalCode"         => 'CODE',
#             "economicCode"         => 'CODE',
#             "registrationNumber"   => 'REGISTER NUMBER',
#             "cellphone"            => '09120000000',
#             "phone"                => '051322222222',
#             "fax"                  => 'FAX',
#             "postalCode"           => '9185175673',
#             "newsReader"           => 'true/false',
#             "logoImage"            => 'LOGO',
#             "coverImage"           => 'COVER',
#             "tags"                 => 'TAG1,TAG2',
#             "tagTrees"             => 'TREE1,TREE2',
#             "tagTreeCategoryName"  => 'CATEGORY',
#             "link"                 => 'LINK',
#             "lat"                  => 0,
#             "lng"                  => 0,
#             "agentNationalCode"    => 'CODE',

    ];
    try {
        $result = $dealingService->addUserAndBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

# ============================================ list User Created Business ==============================================
function listUserCreatedBusiness()
{
    echo "==================================== list User Created Business =================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => 'Api_Token',  # Api_Token
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"        => 1,
#            "bizId"                 => 'BUSINESS ID',
#            "username"              => 'USER NAME',
#            "businessName"          => 'BUSINESS NAME',
#            "email"                 => 'EMAIL',
#            "guildCode"             => ['GUILD_CODE'],   # لیست کد صنف کسب و کار
#            "country"               => 'COUNTRY',
#            "state"                 => 'STATE',
#            "city"                  => 'CITY',
#            "active"                => true | false,
#            "offset"                => OFFSET,
#            "size"                  => SIZE,
#            "ssoId"                 => 'SSO ID',             # شناسه sso کاربر
#            "query"                 => 'QUERY',            # مورد جستجو روی بیزینس های موجود
#            "sheba"                 => 'SHEBA WITHOUT IR',
#            "nationalCode"          => 'CODE',
#            "economicCode"          => 'CODE',
#            "cellphone"             => '09120000000',
#            "tags"                  => 'TAG1,TAG2',            # لیست تگ
#            "tagTrees"              => 'TREE1,TREE2',              # لیست درخت تگ

    ];
    try {
        $result = $dealingService->listUserCreatedBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}


# ==================================================== update Business =================================================
function updateBusiness()
{
    echo "============================================ update Business =================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => 'Api_Token',                 # Api_Token
            "bizId"                 => 1111,                      # شناسه کسب و کار
            "businessName"          => 'BUSINESS NAME',             # نام کسب و کار
            "guildCode"             => ['GUILD_CODE'],              # لیست کد اصناف
            "country"               => 'COUNTRY',                            # کشور
            "state"                 => 'STATE',                             # استان
            "city"                  => 'CITY',                                # شهر
            "address"               => 'ADDRESS',                            # آدرس
            "description"           => 'DESCRIPTION',                     # توضیحات
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"         => 1,
#            "email"                  => 'EMAIL',
#            "companyName"            => 'COMPANY NAME',            # نام شرکت
#            "shopName"               => 'SHOP NAME',               # نام فروشگاه
#            "shopNameEn"             => 'Shopping Center',         # نام انگلیسی فروشگاه
#            "dateEstablishing"       => 'yyyy/mm/dd',              # تاریخ شمسی تاسیس yyyy/mm/dd
#            "website"                => 'WEBSITE',                 # وبسایت
#            "sheba"                  => 'SHEBA',                   # شبا که به صورت عددی وارد می شود. (بدون IR)
#            "firstName"              => 'FIRST NAME',              # نام شخص نماینده کسب و کار
#            "lastName"               => 'LAST NAME',               # نام خانوادگی شخص نماینده کسب و کار
#            "nationalCode"           => 'CODE',                    # شناسه ملی کسب و کار
#            "economicCode"           => 'CODE',                    # کد اقتصادی کسب و کار
#            "registrationNumber"     => 'REGISTER NUMBER',         # شماره ثبت کسب و کار
#            "cellphone"              => '09120000000',             # شماره موبایل نماینده کسب و کار
#            "phone"                  => '02122222222',
#            "fax"                    => 'FAX',
#            "postalCode"             => 'POSTAL CODE',
#            "newsReader"             => 'true/false',
#            "changeLogo"             => 'LOGO',                    # در صورتی که بخواهید تصویر لوگو را تغییر دهید true وارد کنید
#            "changeCover"            => 'COVER',                   # در صورتی که بخواهید تصویر کاور را تغییر دهید true وارد کنید
#            "logoImage"              => 'LOGO',                    # logo image url
#            "coverImage"             => 'COVER',                   # cover image url
#            "tags"                   => 'TAG1,TAG2',               # تگ های آیتم که با , از هم جدا شده اند
#            "tagTrees"               => 'TREE1,TREE2',
#            "tagTreeCategoryName"    => 'CATEGORY',                # دسته درخت تگ
#            "link"                   => 'LINK',                    # لینک دسترسی به کسب و کار از طریق sso
#            "lat"                    => 0,
#            "lng"                    => 0,
#            "agentFirstName"         => 'FIRST NAME'               # نام نماینده
#            "agentLastName"          => 'LAST NAME'                # نام خانوادگی نماینده
#            "agentCellphoneNumber"   => 'MOBILE'                   # شماره تلفن نماینده
#            "agentNationalCode"      => 'CODE'                     # کد ملی نماینده
#            "changeAgent"            => true | false               # در صورتی که بخواهید نماینده را تغییر دهید true وارد نمایید


    ];
    try {
        $result = $dealingService->updateBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

# =================================== get Api Token For Created Business ===============================================
function getApiTokenForCreatedBusiness()
{
    echo "=========================== get Api Token For Created Business =================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => 'Api_Token',  # Api_Token
            'businessId'            => 1111,            # id of business
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"        => 1,

        ];
    try {
        $result = $dealingService->getApiTokenForCreatedBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

# ================================================ rate Business =======================================================
function rateBusiness()
{
    echo "======================================== rate Business ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"       => 'Access_Token',  # Access_Token
            'businessId'    => 1111,            # id of business
            'rate'          => 10,              # [user rate between 0 and 10]
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"        => 1,      # default is 1

        ];
    try {
        $result = $dealingService->rateBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

# ============================================== comment Business ======================================================
function commentBusiness()
{
    echo "====================================== comment Business ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"       => 'Access_Token',  # Access_Token
            'businessId'    => 1111,            # id of business
            'text'          => "COMMENT",       # [user rate between 0 and 10]
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"        => 1,          # default is 1

        ];
    try {
        $result = $dealingService->commentBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

# ============================================= business Favorite ======================================================
function businessFavorite()
{
    echo "====================================== business Favorite ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => 'Access_Token',      # Access_Token
            'businessId'            => 1111,                # id of business
            'disfavorite'           => "true/false",        # or true
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"        => 1,      # default is 1

        ];
    try {
        $result = $dealingService->businessFavorite($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

# ============================================= user BusinessInfos =====================================================
function userBusinessInfos()
{
    echo "===================================== user BusinessInfos ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"   => 'Access_Token | Api_Token',          # [ACCESS_TOKEN] یا [ACCESS_TOKEN]
            "id"        => ["id of business"],                  # id of business
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"        => 1,          # default is 1

        ];
    try {
        $result = $dealingService->userBusinessInfos($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

# ============================================= comment Business List ==================================================
function commentBusinessList()
{
    echo "===================================== comment Business List ================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"           => 'Access_Token | Api_Token',  # [API_TOKEN] یا [ACCESS_TOKEN]
            'businessId'        => "BUSINESS ID",               # id of business
            'offset'            => 0,                           # [user rate between 0 and 10]
        ## ========================================= Optional Parameters  ==============================================
            # "_token_issuer_"   => 1,              # default is 1
            # "size": 10,
            # "firstId": ID,
            # "lastId" : ID,


        ];
    try {
        $result = $dealingService->commentBusinessList($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

# =============================================== confirm Comment ======================================================
function confirmComment()
{
    echo "======================================= confirm Comment ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"           => 'Api_Token',     # Api_Token
            'commentId'         => 1111,            # id of comment
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"    => 1,              # default is 1

        ];
    try {
        $result = $dealingService->confirmComment($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

