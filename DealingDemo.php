<?php
/**
 * Created by PhpStorm.
 * User: ReZa ZaRe <rz.zare@gmail.com>
 * Date: 2019/08/03
 * Time: 12:26 PM
 */
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

# ================================================ Dealing SERVICES ====================================================
# required classes
use Pod\Dealing\Service\DealingService;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;


const API_TOKEN = '{PUT API TOKEN}';
const ACCESS_TOKEN = '{PUT ACCESS TOKEN}'; # access token will be expired each 15 minutes refresh this token with SSOService->refreshAccessToken
const TOKEN_ISSUER = '{PUT TOKEN ISSUER}'; # 0 | 1

$baseInfo = new BaseInfo();
$baseInfo->setToken(API_TOKEN);


#  instantiates a DealingService
$DealingService = new DealingService($baseInfo);

# ==================================================== add Dealer  =====================================================
function addDealer()
{
    echo '============================================ add Dealer  ======================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
        ## ============================ *Required Parameters  =========================
            'dealerBizId'       => '{put dealer business id}',              # شناسه کسب و کار واسط
        ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'allProductAllow'   => true,             # دسترسی به همه محصولات
            'scVoucherHash'     => ["{Put Service Call Voucher Hash 1}", "{Put Service Call Voucher Hash 2}"], # service call voucher
        ];
    try {
        $result = $BillingService->addDealer($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ==================================================== dealer List  ====================================================
function dealerList()
{
    echo '============================================ dealer List  ======================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
        ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'dealerBizId'   => '{put dealer business id}',            # The id of business to be a dealer
            'enable'        => true,            # [true/false]
            'size'          => '{put size}',              # pagination size, default: 50
            'offset'        => '{put offset}',               # pagination offset, default: 0
            'scVoucherHash' => ["{Put Service Call Voucher Hash 1}", "{Put Service Call Voucher Hash 2}"], # service call voucher
        ];
    try {
        $result = $BillingService->dealerList($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# =================================================== enable Dealer  ===================================================
function enableDealer()
{
    echo '=========================================== enable Dealer  ====================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
        ## ============================ *Required Parameters  =========================
            'dealerBizId'     => '{put dealer business id}',  # The id of dealer business *that is a number*
        ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',

        ];
    try {
        $result = $BillingService->enableDealer($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# =================================================== disable Dealer  ==================================================
function disableDealer()
{
    echo '=========================================== disable Dealer   ====================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
        ## ============================ *Required Parameters  =========================
            'dealerBizId'     => '{put business id}',  # The id of dealer business that is a number
        ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->disableDealer($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================= business Dealing List ==================================================
function businessDealingList()
{
    echo '===================================== business Dealing List ====================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
        ## =========================== Optional Parameters  ===============================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'dealingBusinessId' => '{put dealer business id}',            # The id of dealing business
            'enable'            => true,            # [true/false]
            'size'              => '{put size}',              # pagination size, default: 50
            'offset'            => '{put offset}',               # pagination offset, default: 0
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->businessDealingList($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================================ add User And Business ===============================================
function addUserAndBusiness()
{
    echo "======================================== add User And Business =================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
        ## ============================ *Required Parameters  =========================
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
        ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
#             "tokenIssuer"       => TOKEN_ISSUER,
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
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->addUserAndBusiness($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================ list User Created Business ==============================================
function listUserCreatedBusiness()
{
    echo "==================================== list User Created Business =================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
            ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
#            "tokenIssuer"        => TOKEN_ISSUER
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
#            "tags"                  => ['TAG1', 'TAG2'],            # لیست تگ
#            "tagTrees"              => ['TREE1', 'TREE2'],              # لیست درخت تگ
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->listUserCreatedBusiness($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}


# ==================================================== update Business =================================================
function updateBusiness()
{
    echo "============================================ update Business =================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "bizId"                 => '{put business id}',                      # شناسه کسب و کار
            "businessName"          => 'BUSINESS NAME',             # نام کسب و کار
            "guildCode"             => ['GUILD_CODE'],              # لیست کد اصناف
            "country"               => 'COUNTRY',                            # کشور
            "state"                 => 'STATE',                             # استان
            "city"                  => 'CITY',                                # شهر
            "address"               => 'ADDRESS',                            # آدرس
            "description"           => 'DESCRIPTION',                     # توضیحات
            ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
#            "tokenIssuer"         => TOKEN_ISSUER
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
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->updateBusiness($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# =================================== get Api Token For Created Business ===============================================
function getApiTokenForCreatedBusiness()
{
    echo "=========================== get Api Token For Created Business =================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'businessId'            => '{put business id}',            # id of business
            ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
#            "tokenIssuer"        => TOKEN_ISSUER
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->getApiTokenForCreatedBusiness($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================================ rate Business =======================================================
function rateBusiness()
{
    echo "======================================== rate Business ===================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'businessId'    => '{put business id}',            # id of business
            'rate'          => '{put rate, between 0 and 10}',              # [user rate between 0 and 10]
            ## =========================== Optional Parameters  ===========================
            # اگر token ارسال نشود از apiToken ی که در کلاس baseInfo ست شده استفاده می شود.
            "token"       => 'Access_Token| Api_Token',  # Access_Token | ApiToken
#            "tokenIssuer"        => TOKEN_ISSUER      # default is 1
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->rateBusiness($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================== comment Business ======================================================
function commentBusiness()
{
    echo "====================================== comment Business ===================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
        ## ============================ *Required Parameters  =========================
            'businessId'    => '{put business id}',
            'text'          => "COMMENT",
        ## =========================== Optional Parameters  ===========================
            # اگر token ارسال نشود از apiToken ی که در کلاس baseInfo ست شده استفاده می شود.
            "token"       => 'Access_Token| Api_Token',  # Access_Token | ApiToken  #
            "tokenIssuer"        => TOKEN_ISSUER,          # default is 1
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->commentBusiness($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================= business Favorite ======================================================
function businessFavorite()
{
    echo "====================================== business Favorite ===================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
        ## ============================ *Required Parameters  =========================
            'businessId'            => '{put business id}',                # id of business
            'disfavorite'           => "true/false",        # or true
        ## =========================== Optional Parameters  ===========================
            # توجه: اگر token ارسال نشود از apiToken ی که در کلاس baseInfo ست شده استفاده می شود.
            "token"                 => 'Access_Token| Api_Token',  # Access_Token | ApiToken  #
#            "tokenIssuer"          => TOKEN_ISSUER      # default is 1
            'scVoucherHash'         => ["{Put Service Call Voucher Hash 1}", "{Put Service Call Voucher Hash 2}"], # service call voucher
    ];
    try {
        $result = $DealingService->businessFavorite($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================= user BusinessInfos =====================================================
function userBusinessInfos()
{
    echo "===================================== user BusinessInfos ===================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
        ## ============================ *Required Parameters  =========================
            "id"        => ["id of business"],                  # id of business
        ## =========================== Optional Parameters  ===========================
            # توجه: اگر token ارسال نشود از apiToken ی که در کلاس baseInfo ست شده استفاده می شود.
            "token"       => 'Access_Token| Api_Token',  # Access_Token | ApiToken
#            "tokenIssuer"        => TOKEN_ISSUER          # default is 1
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->userBusinessInfos($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================= comment Business List ==================================================
function commentBusinessList()
{
    echo "===================================== comment Business List ================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'businessId'        => "BUSINESS ID",               # id of business
            'offset'            => '{put offset}',                           # [user rate between 0 and 10]
            ## =========================== Optional Parameters  ===========================
            # توجه: اگر token ارسال نشود از apiToken ی که در کلاس baseInfo ست شده استفاده می شود.
            "token"       => 'Access_Token| Api_Token',  # Access_Token | ApiToken
            # "tokenIssuer"   => TOKEN_ISSUER              # default is 1
            # "size": 10,
            # "firstId": ID,
            # "lastId" : ID,
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $DealingService->commentBusinessList($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# =============================================== confirm Comment ======================================================
function confirmComment()
{
    echo "======================================= confirm Comment ===================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'commentId'         => '{put comment id}',            # id of comment
            ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
#            "_token_issuer_"    => TOKEN_ISSUER              # default is 1
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->confirmComment($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
# =============================================== unConfirm Comment =======================================
function unConfirmComment()
{
    echo "======================================= unConfirm Comment ===================================" .PHP_EOL;
    global $DealingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'commentId'         => '{put comment id}',            # id of comment
            ## =========================== Optional Parameters  ===========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
#            "_token_issuer_"    => TOKEN_ISSUER              # default is 1
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $DealingService->confirmComment($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ========================================= add Dealer Product Permission ==============================================
function addDealerProductPermission()
{
    echo '================================= add Dealer Product Permission ================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===============================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'productId'         => '{put product id}',            # شناسه محصول
            'dealerBizId'       => '{put dealer business id}',            # شناسه کسب و کار واسط
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->addDealerProductPermission($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ====================================== dealer Product Permission List ================================================
function dealerProductPermissionList()
{
    echo '============================== dealer Product Permission List ==================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===============================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'productId'     => '{put product id}',                     # شناسه محصول
            'dealerBizId'   => '{put dealer business id}',                     # شناسه کسب و کار واسط
            'enable'        => 'true/false',              # فعال بودن واسط
            'offset'        => '{put offset}',                         # شناسه کسب و کار واسط
            'size'          => '{put size}',                        # اندازه خروجی
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',

        ];
    try {
        $result = $BillingService->dealerProductPermissionList($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ====================================== dealing Product Permission List ===============================================
function dealingProductPermissionList()
{
    echo '============================== dealing Product Permission List ==================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ==========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'productId'     => '{put product id}',                     # شناسه محصول
            'dealingBusinessId'   => '{put dealer business id}',                # شناسه کسب و کار واسط
            'enable'        => 'true/false',              # فعال بودن واسط
            'offset'        => '{put offset}',                         # شناسه کسب و کار واسط
            'size'          => '{put size}',                        # اندازه خروجی
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->dealingProductPermissionList($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ===================================== disable dealer Product Permission ==============================================
function disableDealerProductPermission()
{
    echo '============================= disable dealer Product Permission =================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'apiToken'          => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'productId'     => '{put product id}',               # شناسه محصول
            'dealerBizId'   => '{put dealer business id}',                # شناسه کسب و کار واسط
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->disableDealerProductPermission($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ===================================== enable dealer Product Permission ===============================================
function enableDealerProductPermission()
{
    echo '============================= enable dealer Product Permission =================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'apiToken'      => '{Put API TOKEN}', # امکان تغییر apiToken در اینجا وجود دارد
            'productId'     => '{put product id}',            # شناسه محصول
            'dealerBizId'   => '{put dealer business id}',                # شناسه کسب و کار واسط
            'scVoucherHash' => ["{Put Service Call Voucher Hash 1}", "{Put Service Call Voucher Hash 2}"], # service call voucher
        ];
    try {
        $result = $BillingService->enableDealerProductPermission($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

