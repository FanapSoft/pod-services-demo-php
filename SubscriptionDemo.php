<?php
require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

# ============================================== Subscription SERVICES =================================================
# required classes
use Pod\Subscription\Service\SubscriptionService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

const API_TOKEN = '{PUT API TOKEN}';
const TOKEN_ISSUER = 1;

$baseInfo = new BaseInfo();
$baseInfo->setToken(API_TOKEN);
$baseInfo->setTokenIssuer(TOKEN_ISSUER);

#  instantiates a SubscriptionService
$SubscriptionService = new SubscriptionService($baseInfo);


# ================================================ add Subscription Plan ===============================================

function addSubscriptionPlan()
{
    global $SubscriptionService;
    $param =
        [
        ## ============================ *Required Parameters  ==================================
            'name'             => '{put plan name}',               # نام دلخواه برای طرح
            'price'            => '{put plan price}',                 # قیمت طرح
            'periodTypeCode'   => '{put period type code}',        # بازه زمانی طرح - ماهانه روزانه یا سالانه
            'periodTypeCount'  => '{put period type count}',       # تعداد مورد نظر از بازه زمانی
            'type'             => 'put plan type',                  # نوع طرح که یا مسدودی و یا نقدی میباشد
            'guildCode'        => 'put guild code',                 # کد صنف مورد نظر
             # کد محصول ثبت شده برای این طرح *توجه مقدار entityId محصول باید فرستاده شود*
            'productId'        => '{put product id}',
        ## ============================ Optional Parameters  ==================================
#            'usageCountLimit'      => {put usage count limit},            # محدودیت میزان دفعات قابل استفاده
#            'usageAmountLimit'     => {put usage amount limit},          # محدودیت میزان مبلغ قابل استفاده
#            'permittedGuildCode'   => [{put permitted guild codes}],    # لیست کد صنف های مجاز جهت استفاده
#            'permittedBusinessId'  =>[{put permitted business ids}],    # شناسه کسب و کارهای مجاز جهت استفاده
#            'permittedProductId'   =>[{{put permitted product ids}}],    # لیست شناسه محصولات مجاز جهت استفاده
//          'currencyCode'        => '',        # like IRR
//          'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
//          'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $SubscriptionService->addSubscriptionPlan($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//addSubscriptionPlan();
//die();

# ============================================== subscription Plan List ================================================
function subscriptionPlanList()
{
    global $SubscriptionService;
    $param =
        [
        ## ============================ *Required Parameters  =========================
            'offset' => '{put page number}',                          # حد پایین خروجی
            'size' => '{put output size}',                             # اندازه خروجی
        ## =========================== Optional Parameters  ===========================
            'id' => '{put plan id}',                                  # شناسه طرح
#          'periodTypeCode' =>'put period type code',      # بازه زمانی طرح - ماهانه روزانه یا سالانه
#          'fromPrice' =>{put minimum price},                    # حد پایین قیمت
#          'toPrice' =>{put maximum price},                       # حد بالای قیمت
#          'periodTypeCountFrom' => {put minimum count of period},    # کف تعداد مورد نظر از بازه زمانی
#          'periodTypeCountTo' => {put maximum count of period},      # سقف تعداد مورد نظر از بازه زمانی
#          'typeCode'=> 'put plan type',    # نوع طرح که یا مسدودی و یا نقدی میباشد
#          'enable'=> '{true/false}',          # فعال یا غیر فعال بودن طرح
#          'permittedGuildCode'=> [{put permitted Guild Codes}],      # لیست کد صنف های مجاز جهت استفاده
#          'permittedBusinessId'=>[{put permitted Business Ids}],      # شناسه کسب و کارهای مجاز جهت استفاده
#          'permittedProductId'=>[{put permitted Product Ids}],        # لیست شناسه محصولات مجاز جهت استفاده
#          'currencyCode' => '',              # کد ارز  IRR
#          'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
#          'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $SubscriptionService->subscriptionPlanList($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//subscriptionPlanList();
//die();


# =============================================== update Subscription Plan =============================================
function updateSubscriptionPlan()
{
    global $SubscriptionService;
    $param =
        [
        ## ================================= Required Parameters  ===============================
            'id'                => '{plan id}',                         # شناسه طرح
        ## ================================ Optional Parameters  ================================
            'periodTypeCode'    => '{put perido type code}',          #کد نوع بازه زمانی (روزانه، ماهانه، سالانه)
            'periodTypeCount'   => '{put period type count}',           #تعداد مورد نظر از بازه زمانی
            'usageCountLimit'   => '{put usage count limit}',           #محدودیت تعداد دفعات استفاده
            'usageAmountLimit'  => '{put usage amount limit}',       #محدودیت میزان مبلغ قابل استفاده
            'name'              =>  'plan name',                  # نام طرح
            'price'             => '{put price}',                     # قیمت
            'enable'            => '{true/false}',                #فعال/غیرفعال بودن طرح
#          'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
#          'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $SubscriptionService->updateSubscriptionPlan($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//updateSubscriptionPlan();
//die();

# ============================================ request Subscription ====================================================
function requestSubscription()
{
    global $SubscriptionService;
    $param =
        [
        ## ============================== Required Parameters  ==============================
            'subscriptionPlanId' => '{put subscription plan id}',         # شناسه طرح
            'userId'             => '{put user id}',                    # شناسه کاربر
        ## ============================== Optional Parameters  ===============================
#          'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
#          'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $SubscriptionService->requestSubscription($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

requestSubscription();
die();


# ================================================ confirm Subscription ================================================
function confirmSubscription()
{
    global $SubscriptionService;
    $param =
        [
        ## ========================= Required Parameters  ==================================
            'subscriptionId' => '{put subscription id}', #  شناسه درخواست جهت تایید
            'code'            => '{put code}',             # کد پیامک شده
        ## ========================= Optional Parameters  ===================================
#          'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
#          'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $SubscriptionService->confirmSubscription($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
#confirmSubscription();
#die();


# ============================================== subscription List =====================================================
function subscriptionList()
{
    global $SubscriptionService;
    $param =
        [
        ## ============================ Required Parameters  ====================================
            'offset' => '{put offset}',
            'size'   => '{put size}',
            'subscriptionPlanId' => '{put subscription plan id}',
        ## ============================ Optional Parameters  ====================================
#          'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
#          'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $SubscriptionService->subscriptionList($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

#subscriptionList();
#die();

# ============================================= consume Subscription ===================================================
function consumeSubscription()
{
    global $SubscriptionService;
    $param =
        [
        ## ============================ Required Parameters  =================================
            'id'    => '{put plan id}',            # plan id
        ## ============================ Optional Parameters  ==================================
//          'usedAmount' => {used amount},
#          'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
#          'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $SubscriptionService->consumeSubscription($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
#consumeSubscription();
#die();
