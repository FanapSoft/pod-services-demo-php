<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);
# ================================================ Billing SERVICES ====================================================
# required classes
use Pod\Billing\Service\BillingService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

const API_TOKEN = '{PUT API TOKEN}';
const TOKEN_ISSUER = 1;

# set serverType to SandBox or Production
BaseInfo::initServerType(BaseInfo::PRODUCTION_SERVER);

$baseInfo = new BaseInfo();
$baseInfo->setToken(API_TOKEN);
$baseInfo->setTokenIssuer(TOKEN_ISSUER);


#  instantiates a BillingService
$BillingService = new BillingService($baseInfo);

# ================================================== Billing BUY =======================================================
# ======================================================================================================================

# ================================================= create Pre Invoice =================================================
function createPreInvoice()
{
    echo "======================================== create Pre Invoice ===================================" .PHP_EOL;
    global $BillingService;

    $param = [
        ## ============================ *Required Parameters  =========================
        "ott"         => "bbfdcf363bec5774", # private-call-address توکن یک بار مصرف دریافتی از سرور
        "productList"   => [
            [
                # شناسه محصول . در صورتی که بند فاکتور محصول مرتبط ندارد مقدار آن 0 وارد شود
                "productId"         => "{put product id}",
                # مبلغ بند فاکتور. برای استفاده از قیمت محصول وارد شده از مقدار auto استفاده نمایید
                "price"             => "{put product price, type: decimal}",
                #تعداد محصول
                "quantity"          => "{put product price, type: integer}",
                # توضیحات
                "productDescription"=> "{put description}",
            ],
            //اطلاعات محصولات دیگر
        ],
        "guildCode"                 => "{put guild code}", # *			کد صنف فاکتور
        "redirectUri"               => "{put redirect uri}",
        "userId"               => "{put customer user id}",  # the id of customer
        ## =========================== Optional Parameters  ===========================
        # "billNumber"=> "{put bill numer}", #                              شماره قبض منحصر به فرد کسب و کار
        # "redirectUri" => "{put redrect uri}",
        #"callUrl"=>  "{put call uri}", #در صورت پرداخت موفق این آدرس صدا خواهد شد#
        # "preferredTaxRate" => "vat; default 0.09", # نرخ مالیات برای این خرید که برای تمام آیتم های فاکتور اعمال می شود.
        # "verificationNeeded" => "{true/false}",         # پرداخت دومرحله ای true/false
        # "currencyCode"=> "{put currency code}", #   کد ارز
        #  "description" => "{put description}", # توضیحات فاکتور
        # "deadline" => "yyyy/mm/dd",             # تاریخ سررسید شمسی yyyy/mm/dd
    ];

    try {
        $result = $BillingService->createPreInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
#  unComment next line to  create Pre Invoice
//createPreInvoice();
//die;

# ================================================== issue Invoice =====================================================
function issueInvoice()
{
    echo "========================================= issueInvoice ========================================" .PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            "productList"   	=> [
                [
                    # شناسه محصول . در صورتی که بند فاکتور محصول مرتبط ندارد مقدار آن 0 وارد شود
                    "productId"         => "{put product id}",
                    # مبلغ بند فاکتور. برای استفاده از قیمت محصول وارد شده از مقدار auto استفاده نمایید
                    "price"             => "{put product price, type: decimal}",
                    #تعداد محصول
                    "quantity"          => "{put product price, type: integer}",
                    # توضیحات
                    "productDescription"=> "{put description}",
                ],
                // اطلاعات محصولات دیگر
            ],
            # کد صنف فاکتور
            "guildCode"			=> "{put guild code}", # *Required
            # توکن یک بار مصرف اگر وارد نشود در متد issueInvoice از api دریافت می شود
            "ott" 				=> "{put ott}",
            ## =========================== Optional Parameters  ===========================
            # آدرس فراخوانی صادر کننده فاکتور
            "redirectURL" 		=> "{put redirect uri}",
            # شناسه کاربر مربوط به مشتری برای بدست آورن این شناسه می توانید پروفایل کاربر را دریافت نمایید.
            "userId" 			=> "{put user id}",
            # شماره قبض
            "billNumber" 		=> "{put bill number}",
            # توضیحات فاکتور
            "description" 		=> "{put description}",
            # تاریخ سررسید شمسی yyyy/mm/dd
            "deadline" 			=> "yyyy/mm/dd",
            # کد ارز
            "currencyCode" 		=> "{put currency code like IRR}",  # default : IRR
            # شناسه یکی از آدرس های موجود کاربر
            "addressId" 		=> "{put address id of customer}",
            # لیست کد بن تخفیف
            "voucherHash" 		=> [],
            # نرخ مالیات برای این خرید که برای تمام آیتم های فاکتور اعمال می شود.
            #اگر مقداری ارسال نشود مقدار مالیات بر ارزش افزوده پیش فرض محاسبه می شود
            "preferredTaxRate" 	=> "{put tax, default 0.09}",
            # پرداخت دومرحله ای true/false
            "verificationNeeded"=> "{true/false}",
            # تایید خودکار فاکتور در پرداخت دومرحله ای true/false
            "verifyAfterTimeout"=> "{true/false}",
            # پیش نمایش فاکتور (در سیستم ثبت نمی گردد) true/false
            "preview" 			=> "{true/false}",
            # پرداخت فاکتور به روش امن
            "safe"				=> "{true/false}",
            # امکان اضافه کردن ووچر بعد از صدور فاکتور
            "postVoucherEnabled"=> "{true/false}",
            # آیا فاکتور رویداد دارد
            "hasEvent"			=> "{true/false}",
            # عنوان رویداد
            "eventTitle"		=> "{put event title}",
            # منطقه زمانی رویداد
            "eventTimeZone"		=> "{put event time zone}",
            # توضیحات رویداد
            "eventDescription"	=> "{put event description}",
            # متادیتا برای فاکتور
            "metadata"			=> '{put json format like {"name":"test"}}',
            #  اطلاعات جانبی رویداد format = json
            # example 1 : {bussinessName=’test’, bussinessURL=’www.test.com’, bussinessIcon=’null’,
            # actionList=[{command=’GET https://www.googleapis.com/calendar/v3/calendars/calendarId/events?privateExtendedProperty=petsAllowed%3Dyes
            # &sharedExtendedProperty=createdBy%3DmyApp’, commandType={code=’1’, value=’GET’}}], metaData={"petsAllowed":"yes"}}
            "eventMetadata"		=> [],
            # یادآورهای رویداد format = json
            # example 1 : {"id":0,"numOfDaysBefore":3,"alarmTime":1511789309821,"alarmType":"Email"}"
            # example 2 : {"id":0,"minute":15,"alarmType":"Notification"}
            "eventReminders"	=> [],
        ];

    try {
        $result = $BillingService->issueInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    issueInvoice();
//    die();

# ================================================== verify Invoice ====================================================
function verifyInvoice()
{
    echo "====================================== verify Invoice  ========================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===========================
            "id" => "{invoice id}",
            "billNumber" => "billNumber",
        ];
    try {
        $result = $BillingService->verifyInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//    verifyInvoice();
//    die;

# ================================================== pay Invoice =======================================================
function payInvoice()
{
    echo "======================================== pay Invoice =========================================" . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "invoiceId"     => "{put invoice id}",             # شناسه فاکتور
            ## =========================== Optional Parameters  ===========================
            "redirectUri"   => "{put redirect uri}",
            "callUri"       => "{put call uri}",
        ];


    try {
        $result = $BillingService->payInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//
//payInvoice();
//die;
#

# ========================================== get Pay Invoice By Wallet Link ============================================
function getPayInvoiceByWalletLink()
{
    echo "============================== get Pay Invoice By Wallet Link ================================" . PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            "invoiceId"     => "{put invoice id}",            # شناسه فاکتور
            ## =========================================  Optional Parameters ==========================================
            "redirectUri"   => "{put redirect uri}",
            "callUri"       => "{put call uri}",          # The function that will be called at the end of payment
        ];

    try {
        echo ($BillingService->getPayInvoiceByWalletLink($param)) . PHP_EOL;
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }

}

//    getPayInvoiceByWalletLink();
//    die;

# ======================================= get Pay Invoice By Unique Number Link ========================================
function getPayInvoiceByUniqueNumberLink()
{
    echo "=========================== get Pay Invoice By Unique Number Link ============================" . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "uniqueNumber"  => "{put unique number of invoice}",
            ## =========================================  Optional Parameters ==========================================
            "redirectUri"   => "{put redirect uri}",
            "callUri"       => "{put call uri}",          # The function that will be called at the end of payment
            "gateway"       => "PEP",
        ];

    try{
        echo ($BillingService->getPayInvoiceByUniqueNumberLink($param)).PHP_EOL;
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }

}

//    getPayInvoiceByUniqueNumberLink();
//    die;

# ================================================== close Invoice =====================================================
function closeInvoice()
{
    echo "===================================== close Invoice  ========================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "id" => "{put invoice id}", # شناسه فاکتور
        ];
    try {
        $result = $BillingService->closeInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    closeInvoice();
//    die;

# ================================================== BILLING INVOICE ===================================================
# ======================================================================================================================

# ================================================= get Invoice List ===================================================
function getInvoiceList()
{
    echo "========================================== get Invoice List ==================================" . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters one of  =========================
            "offset" => "{put offset}", # در صورتی که این فیلد وارد شود فیلدهای lastId و firstId نباید وارد شوند و نتیجه نزولی مرتب می شود
            "firstId" => "put first id", # در صورتی که این فیلد وارد شود فیلدهای lastId و offset نباید وارد شوند و نتیجه صعودی مرتب می شود.
            "lastId" => "put last id", # در صورتی که این فیلد وارد شود فیلدهای firstId و offset نباید وارد شوند و نتیجه نزولی مرتب می شود.
            ## =========================== Optional Parameters  ===========================
            "size" => "{put size}",
            "guildCode" => "put guild code", # کد صنف
            "id" => "put invoice id",   # invoice id
            "billNumber" => "put bill number", # شماره قبض که به تنهایی با آن می توان جستجو نمود
            "uniqueNumber" => "put unique number", # شماره کد شده ی قبض که به تنهایی با آن می توان جستجو نمود
            "trackerId" => "put tracker id",
            "fromDate" => "yyyy/mm/dd hh:mi:ss",          # تاریخ شمسی صدور فاکتور yyyy/mm/dd hh:mi:ss
            "toDate" => "yyyy/mm/dd hh:mi:ss",            # تاریخ شمسی صدور فاکتور yyyy/mm/dd hh:mi:ss
            "isCanceled" => 'true/false',
            "isPayed" => 'true',
            "isClosed" => "true/false",
            "isWaiting" => "true/false",
            "referenceNumber" => "put reference number",                             # شماره ارجاع
            "userId" => "put user id",                                        # شناسه کاربری مشتری
            "issuerId" => "put issuer id",                        # شناسه کاربری صادر کننده فاکتور
            "query" => "put search query",                                      # عبارت برای جستجو
            "productIdList" => [],  # لیست شماره محصولات
        ];

    try {
        $result = $BillingService->getInvoiceList($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//    getInvoiceList();
//    die;

# ========================================  get Invoice List By Metadata  ==============================================

function getInvoiceListByMetadata() {
    echo "==============================  get Invoice List By Metadata  ================================" . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===========================
            "metaQuery" =>  ["key"=>"value"],
            "offset" => "{put offset}",
            "size" => "{put size}",
            "isPayed" => "true/false",      # true/false
            "isCanceled" => "true/false",   # true/false
        ];

    try {
        $result = $BillingService->getInvoiceListByMetadata($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    getInvoiceListByMetadata();
//    die;

# =============================================== reduce Invoice =======================================================
function reduceInvoice()
{
    echo "=================================== reduce Invoice  ===========================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "id" => "{put invoice id}", # شناسه فاکتور
            "invoiceItemList" => [
                [
                    "invoiceItemId" => "{put invoice id of item 1}",    # شناسه بند فاکتور
                    "price" => "{put price of item 1}", # مبلغ بند فاکتور
                    "quantity" => "{put quantity of item 1}",  # لیست تعداد محصول در هر بند فاکتور
                    "itemDescription" => "reduce invoice", # لیست توضیحات بند فاکتور
                ],
                [
                    "invoiceItemId" => "{put invoice id of item 2}",    # شناسه بند فاکتور
                    "price" => "{put price of item 2}", # مبلغ بند فاکتور
                    "quantity" => "{put quantity of item 2}",  # لیست تعداد محصول در هر بند فاکتور
                    "itemDescription" => "reduce invoice", # لیست توضیحات بند فاکتور
                ],
            ],

            ## =========================== Optional Parameters  ===========================
            "preferredTaxRate" => "{put tax, default 0.09}", # نرخ مالیات برای این خرید که برای تمام آیتم های فاکتور اعمال می شود. اگر مقداری ارسال نشود مقدار مالیات بر ارزش افزوده پیش فرض محاسبه می شود
        ];
    try {
        $result = $BillingService->reduceInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    reduceInvoice();
//    die;

# ================================================== cancel Invoice ====================================================
function cancelInvoice()
{
    echo "===================================== cancel Invoice  =========================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "id" => "{put invoice id}", # شناسه فاکتور
        ];
    try {
        $result = $BillingService->cancelInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    cancelInvoice();
//    die;

# ============================================== verify And Close Invoice ==============================================
function verifyAndCloseInvoice()
{
    echo "================================== verify And Close Invoice ===================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "id" => "{put invoice id}" # شناسه فاکتور
            ## =========================== Optional Parameters  ===========================
        ];
    try {
        $result = $BillingService->verifyAndCloseInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    verifyAndCloseInvoice();
//    die;

# ===========================================  get Invoice List As File  ===============================================

function getInvoiceListAsFile() {
    echo "==================================  get Invoice List As File  ====================================" . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "guildCode" => "{put guild code}", # کد صنف
            "lastNRows" => "{put last n rows}", # n ردیف آخر فاکتور
            ## =========================== Optional Parameters  ===========================
            "id" => "{put invoice id}",
            "billNumber" => "{put bill number}", # شماره قبض که به تنهایی با آن می توان جستجو نمود
            "uniqueNumber" => "{put unique number}", # شماره کد شده ی قبض که به تنهایی با آن می توان جستجو نمود
            "trackerId" => "{put tracker id}",
            "fromDate" => "yyyy/mm/dd hh:mi:ss",          # تاریخ شمسی صدور فاکتور yyyy/mm/dd hh:mi:ss
            "toDate" => "yyyy/mm/dd hh:mi:ss",            # تاریخ شمسی صدور فاکتور yyyy/mm/dd hh:mi:ss
            "isCanceled" => "{true/false}",
            "isPayed" => "{true/false}",
            "isClosed" => "{true/false}",
            "isWaiting" => "{true/false}",
            "referenceNumber" => "{put reference number}",               # شماره ارجاع
            "userId" => "{put user id}",                          # شناسه کاربری مشتری
            "query" => "{put query}",                               # عبارت برای جستجو
            "productIdList" => [],  # لیست شماره محصولات
            "callbackUrl" => "{put call back url}",    # آدرس فراخوانی پس از اتمام تولید گزارش
        ];
    try {
        $result = $BillingService->getInvoiceListAsFile($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    getInvoiceListAsFile();
//    die;

# ================================================= get Export List ====================================================
function getExportList()
{
    echo "===================================== get Export List =========================================" .PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            "offset" => "{put offset}",
            "size" => "{put size}",   # اندازه خروجی
            "id" => "{put request id}",  # شناسه درخواست
            ## =========================== Optional Parameters  ===========================
            "statusCode" => "{put status code}", # کد وضعیت
            "serviceUrl" => "{put server url}",           # آدرس سرویس
        ];
    try {
        $result = $BillingService->getExportList($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    getExportList();
//    die;

# ================================================= PAYMENT BILLING ====================================================
# ======================================================================================================================

# ============================================== get Invoice Payment Link ==============================================
function getInvoicePaymentLink()
{
    echo "================================== get Invoice Payment Link ===================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "invoiceId"     => "{put invoice id}",                       # شناسه فاکتور
            ## =========================================  Optional Parameters ==========================================
            "redirectUri"   => "{put redirect uri}",
            "callbackUri"   => "{put callback uri}",      # The function that will be called at the end of payment
            "gateway"       => "PEP",
        ];
    try {
        $result = $BillingService->getInvoicePaymentLink($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//getInvoicePaymentLink();
//die;


# ============================================  send Invoice Payment SMS  ==============================================

function sendInvoicePaymentSMS() {
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            "invoiceId"          => "{put invoice id}" , # شناسه فاکتور
            ## =========================== Optional Parameters  ===========================
            "wallet"             => "{put wallet code}",          # کد کیف پول PODLAND_WALLET
            "callbackUri"        => "{put call back uri}",         # آدرس جهت فراخوانی پس از پرداخت
            "redirectUri"        => "{put redirect uri}",          # آدرس جهت انتقال کاربر پس از پرداخت
            "delegationId"       => "{put delegation id}",        # شناسه اعتبار
            "forceDelegation"    => "{put force delegation}",   # پرداخت فقط از طریق اعتبار
        ];
    try {
        $result = $BillingService->sendInvoicePaymentSMS($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//    sendInvoicePaymentSMS();
//    die;


# ================================================ pay Invoice By Invoice ==============================================
function payInvoiceByInvoice()
{
    echo "================================== pay Invoice By Invoice ====================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "creditorInvoiceId" => "", # شناسه فاکتور بستانکار
            "debtorInvoiceId" => "", # شناسه فاکتور بدهکار
            ## =========================== Optional Parameters  ===========================
        ];
    try {
        $result = $BillingService->payInvoiceByInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

#    payInvoiceByInvoice();
#    die;


# ============================================== pay Invoice In Future =================================================
function payInvoiceInFuture()
{
    echo "=================================== pay Invoice In Future  ===================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "_ott_" => "" , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.
            "invoiceId" => "{put invoice id}",                     # شناسه فاکتور
            "date" => "yyyy/mm/dd",# تاریخ شمسی سررسید
            ## =========================== Optional Parameters  ===========================
            # یکی و فقط یکی از فیلدهای زیر را باید پر کنید
            "guildCode" => "put guild code", # کد صنف
            "wallet" => "PODLAND_WALLET",  # کد کیف پول
        ];
    try {
        $result = $BillingService->payInvoiceInFuture($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    payInvoiceInFuture();
//    die;

# =========================================== request Wallet Settlement  ===============================================
function requestWalletSettlement()
{
    echo "=============================== request Wallet Settlement  ====================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "_ott_"         => "{Put ott here}" , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            "amount"        => "{put amount}", # مبلغ برداشت
            ## =========================== Optional Parameters  ===========================
            "wallet"        => "{put wallet code}",          # کد کیف پول PODLAND_WALLET
            "firstName"     => "{put first name}",  # نام صاحب حسابی که تسویه به آن واریز می گردد
            "lastName"      => "{put last name}",  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            "sheba"         => "{put sheba}",  # شماره شبا حسابی که تسویه به آن واریز می گردد
            "currencyCode"  => "{put currency code}",  # کد ارز پیش فرض IRR
            "uniqueId"      => "{put unique id}",          # شناسه یکتا
            "description"   => "{put description}",          # شرح دلخواه
        ];
    try {
        $result = $BillingService->requestWalletSettlement($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    requestWalletSettlement();
//    die;

# ============================================= request Guild Settlement  ==============================================
function requestGuildSettlement()
{
    echo "================================= request Guild Settlement  ===================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "_ott_"         => "{put ott}" , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            "amount"        => "{put amount}",                      # مبلغ برداشت
            "guildCode"     => "{put guild code}",                # کد صنف
            ## =========================== Optional Parameters  ===========================
            "wallet"        => "{put wallet code}",           # کد کیف پول
            "firstName"     => "{put first name}",  # نام صاحب حسابی که تسویه به آن واریز می گردد
            "lastName"      => "{put last name}",  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            "sheba"         => "{put sheba}",  # شماره شبا حسابی که تسویه به آن واریز می گردد
            "currencyCode"  => "{put currency code}",  # کد ارز پیش فرض IRR
            "uniqueId"      => "{put unique id}",             # شناسه یکتا
            "description"   => "{put description}",           # شرح دلخواه
        ];
    try {
        $result = $BillingService->requestGuildSettlement($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    requestGuildSettlement();
//    die;

# ============================================= request Guild Settlement  ==============================================
function requestSettlementByTool()
{
    echo "================================= request Guild Settlement  ===================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "_ott_"         => "{put ott}" , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            "amount"        => "{put amount}",                       # مبلغ برداشت
            "guildCode"     => "{put guild code}",                    # کد صنف
            "toolId"        => "{put tool id}",           # شماره ابزاری که تسویه به آن واریز می گردد
            "toolCode"      => "{put tool code}",# نوع ابزار برای تسویه کارت به کارت،پایا،ساتنا
            # [SETTLEMENT_TOOL_SATNA | SETTLEMENT_TOOL_PAYA | SETTLEMENT_TOOL_CARD]
            ## =========================== Optional Parameters  ===========================
            "firstName"     => "{put first name}",  # نام صاحب حسابی که تسویه به آن واریز می گردد
            "lastName"      => "{put last name}",  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            "currencyCode"  => "{put currency code}",       # کد ارز پیش فرض IRR
            "uniqueId"      => "{put unique id}",          # شناسه یکتا
            "description"   => "{put description}",          # شرح دلخواه
        ];
    try {
        $result = $BillingService->requestSettlementByTool($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//    requestSettlementByTool();
//    die;

# ================================================= list Settlements ===================================================
function listSettlements()
{
    echo "===================================== list Settlements ========================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "offset"        => "{put offset}",      # مبلغ برداشت
            "size"          => "{put size}",        # اندازه خروجی
            ## =========================== Optional Parameters  ===========================
            "statusCode"    => "",  # کد وضعیت درخواست SETTLEMENT_REQUESTED، SETTLEMENT_SENT ، SETTLEMENT_DONE
            "currencyCode"  => "",  # کد ارز پیش فرض IRR
            "fromAmount"    => "",  # حد پایین مبلغ درخواست شده
            "toAmount"      => "",  # حد بالای مبلغ درخواست شده
            "fromDate"      => "",  # حد پایین تاریخ درخواست شمسی yyyy/mm/dd
            "toDate"        => "",  # حد بالای تاریخ درخواست شمسی yyyy/mm/dd
            "uniqueId"      => "",          # شناسه یکتا
        ];
    try {
        $result = $BillingService->listSettlements($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//listSettlements();
//die;

# ================================================ add Auto Settlement  ================================================
function addAutoSettlement()
{
    echo "==================================== add Auto Settlement  =====================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "guildCode"     => "{put guild code}",              # کد صنف
            ## =========================== Optional Parameters  ===========================
            "firstName"     => "",  # نام صاحب حسابی که تسویه به آن واریز می گردد
            "lastName"      => "",  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            "currencyCode"  => "",  # کد ارز پیش فرض IRR
            "instant"       => "true/false",  # در صورت true بودن تسویه حساب خودکار فوری و در صورت false بودن تسویه حساب خودکار فعال می شود .
            "sheba"         => "",          # شماره شبا حسابی که تسویه به آن واریز می گردد
        ];
    try {
        $result = $BillingService->addAutoSettlement($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//
//    addAutoSettlement();
//    die;

# =============================================== remove Auto Settlement  ==============================================
function removeAutoSettlement()
{
    echo "=================================== remove Auto Settlement  ===================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "guildCode"     => "{put guild code}",              # کد صنف
            ## =========================== Optional Parameters  ===========================
            "currencyCode"  => "{like USD or IRR}",  # کد ارز پیش فرض IRR
        ];
    try {
        $result = $BillingService->removeAutoSettlement($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//removeAutoSettlement();
//die;

# ==================================================== add Dealer  =====================================================
function addDealer()
{
    echo "============================================ add Dealer  ======================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "dealerBizId"     => "{put dealer business id}",              # شناسه کسب و کار واسط
            ## =========================== Optional Parameters  ===========================
            "allProductAllow"  => true,             # دسترسی به همه محصولات
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

//addDealer();
//die();

# ==================================================== dealer List  ====================================================
function dealerList()
{
    echo "============================================ dealer List  ======================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===========================
            'dealerBizId'   => "{put dealer business id}",            # The id of business to be a dealer
            'enable'        => true,            # [true/false]
            'size'          => "{put size}",              # pagination size, default: 50
            'offset'        => "{put offset}",               # pagination offset, default: 0
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

//dealerList();
//die();

# =================================================== enable Dealer  ===================================================
function enableDealer()
{
    echo "=========================================== enable Dealer  ====================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "dealerBizId"     => "{put dealer business id}",  # The id of dealer business *that is a number*
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

//enableDealer();
//die();

# =================================================== disable Dealer  ==================================================
function disableDealer()
{
    echo "=========================================== disable Dealer   ====================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            "dealerBizId"     => "{put business id}",  # The id of dealer business that is a number
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

//disableDealer();
//die();

# ============================================= business Dealing List ==================================================
function businessDealingList()
{
    echo "===================================== business Dealing List ====================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===============================
            'dealingBusinessId' => "{put dealer business id}",            # The id of dealing business
            'enable'            => true,            # [true/false]
            'size'              => "{put size}",              # pagination size, default: 50
            'offset'            => "{put offset}",               # pagination offset, default: 0
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

//businessDealingList();
//die();

# ============================================= issue Multi Invoice ====================================================
function issueMultiInvoice()
{
    echo "===================================== issue Multi Invoice ====================================" .PHP_EOL;
    global $BillingService;
    # ***** NOTE : the share of dealer + the share of shareholder = the price to be payed by customer  **** #
    $param =
        [
            ## ============================ *Required Parameters  =========================
            "_ott_" => "put ott" ,                      # one time token - این توکن را در سرویس قبلی دریافت کرده اید.
            # آرایه حاوی اطلاعات فاکتورها
            "data" =>                       ## commented rows are optional parameters ##
                [
                    // 'redirectURL' => 'put redirect url',
                    // 'userId' => 11111,               # userId of customer
                    // 'currencyCode' => 'like EUR or IRR',
                    // 'voucherHashs' => [],            # array of vouchers  اگر وجود ندارد این پارامتر ارسال نشود
                    // 'preferredTaxRate' => "{put tax, default 0.09}" ,     # tax to be added between 0 and 1 default is 0.09
                    // 'verificationNeeded' => 'true/false',
                    // 'preview' => '',
                    'mainInvoice'=>
                        [
                            // 'billNumber' => 'put bill number',       # business unique bill number
                            'guildCode' => 'put guild code',
                            // 'metadata' => 'extra data in form of json',
                            // 'description' => 'put description',
                            'invoiceItemVOs' =>
                                [
                                    [
                                        'productId' => "{put product id or 0}",   # the id of product or 0 if no product
                                        'price' => "{put price}",     # the share of dealer
                                        'quantity' => "{put quantity}",    # count
                                        'description' => 'put description'
                                    ],
                                ],
                        ],
                    'subInvoices' =>
                        [
                            [
                                'businessId' => "{put business id}",       # the id of shareholder business
                                'guildCode' => 'put guild code',
                                // 'billNumber' => 'put bill number',       # business unique bill number
                                // 'metadata' => 'extra data in form of json',
                                'description' => 'put description',
                                'invoiceItemVOs' =>
                                    [
                                        [
                                            'productId' => "{put product id or 0}",
                                            'price' => "{put price}",         # the share of shareholder
                                            'quantity' => "{put quantity}",
                                            'description' => 'put description'
                                        ],
                                    ],
                            ]
                        ],
                    // customerDescription => 'put customer description',
                    // customerMetadata => 'extra data for customer in form of json',
                    'customerInvoiceItemVOs' =>
                        [
                            [
                                'productId' => "{put product id or 0}",       # the id of product or 0 if no product,
                                'price' => "{put price}",         # the price to be payed by customer
                                'quantity' => "{put quantity}",       # count
                                'description' => 'put description'
                            ]
                        ]
                ],

            ## =========================== Optional Parameters  ===============================
            'delegatorId'       => [],            # شناسه تفویض کنندگان، ترتیب اولویت را مشخص می کند
            'delegationHash'    => [],            # کد تفویض برای اشاره به یک تفویض مشخص
            'forceDelegation'   => false,              # پرداخت فقط از طریق تفویض
        ];
    try {
        $result = $BillingService->issueMultiInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//issueMultiInvoice();
//die();

# ============================================= reduce Multi Invoice ===================================================
function reduceMultiInvoice()
{
    echo "===================================== reduce Multi Invoice ====================================" .PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            # ***** NOTE : the share of dealer + the share of shareholder = the price to be payed by customer  **** #
            'data' =>
                [
                    'preferredTaxRate' => "{put tax, default 0.09}",            # tax to be added between 0 and 1 default is 0.09
                    'mainInvoice' =>                             # فاکتور به نام خود معامله گر
                        [
                            'id' => "{put invoice id}",                # id of main invoice to be edited
                            'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم معامله گر
                                [
                                    [
                                        'id' => "{put invoice item id}",                 # the id of item in invoice
                                        'price' => "{put price}",                 # the share of dealer
                                        'quantity' => "{put quantity}",                # count
                                        'description' => 'put description of item'
                                    ]
                                ]
                        ],
                    'subInvoices' =>            # فاکتورهای مربوط به سهم سایر کسب و کارهای ذینفع
                        [
                            [
                                'id' => "{put id of sub invoice}",
                                'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم ذینفعان
                                    [
                                        [
                                            'id' => "{put invoice item id}",         # the id of item in invoice
                                            'price' => "{put price}",         # the share of shareholder
                                            'quantity' => "{put quantity}",        # count
                                            'description' => 'put description of item'
                                        ]
                                    ]
                            ]
                        ],
                    'customerInvoiceItemVOs' =>         # بندهایی که به مشتری نمایش داده می شوند
                        [
                            [
                                'id' => "{put invoice item id}",         # the id of item in invoice
                                'price' => "{put price}",         # he price to be payed by customer
                                'quantity' => "{put quantity}",       # count
                                'description' => 'put description of item'
                            ]

                        ],
                ]
        ];

    try {
        $result = $BillingService->reduceMultiInvoice($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//reduceMultiInvoice();
//die();

# ====================================== reduce Multi Invoice And Cash Out =============================================
function reduceMultiInvoiceAndCashOut()
{
    echo "============================== reduce Multi Invoice And Cash Out ==============================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            # ***** NOTE : the share of dealer + the share of shareholder = the price to be payed by customer  **** #
            'data' =>
                [
                    'preferredTaxRate' => "{put tax, default 0.09}",            # tax to be added between 0 and 1 default is 0.09
                    'mainInvoice' =>                             # فاکتور به نام خود معامله گر
                        [
                            'id' => "{put id of main invoice}",                # id of main invoice to be edited
                            'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم معامله گر
                                [
                                    [
                                        'id' => "{put invoice item id}",                 # the id of item in invoice
                                        'price' => "{put price}",                 # the share of dealer
                                        'quantity' => "{put quantity}",                # count
                                        'description' => 'put description of item'
                                    ]
                                ]
                        ],
                    'subInvoices' =>            # فاکتورهای مربوط به سهم سایر کسب و کارهای ذینفع
                        [
                            [
                                'id' => "{put id of sub invoice}",
                                'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم ذینفعان
                                    [
                                        [
                                            'id' => "{put invoice item id}",         # the id of item in invoice
                                            'price' => "{put price}",         # the share of shareholder
                                            'quantity' => "{put quantity}",        # count
                                            'description' => 'put description of item'
                                        ]
                                    ]
                            ]
                        ],
                    'customerInvoiceItemVOs' =>         # بندهایی که به مشتری نمایش داده می شوند
                        [
                            [
                                'id' => "{put invoice item id}",         # the id of item in invoice
                                'price' => "{put price}",         # he price to be payed by customer
                                'quantity' => "{put quantity}",       # count
                                'description' => 'put description of item'
                            ]

                        ],
                ]
        ];
    try {
        $result = $BillingService->reduceMultiInvoiceAndCashOut($param);
        print_r($result);
    } catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

//reduceMultiInvoiceAndCashOut();
//die();


# ========================================= add Dealer Product Permission ==============================================
function addDealerProductPermission()
{
    echo "================================= add Dealer Product Permission ================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===============================
            'productId'         => "{put product id}",            # شناسه محصول
            'dealerBizId'       => "{put dealer business id}",            # شناسه کسب و کار واسط
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

//addDealerProductPermission();
//die();

# ====================================== dealer Product Permission List ================================================
function dealerProductPermissionList()
{
    echo "============================== dealer Product Permission List ==================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===============================
            'productId'     => "{put product id}",                     # شناسه محصول
            'dealerBizId'   => "{put dealer business id}",                     # شناسه کسب و کار واسط
            'enable'        => "true/false",              # فعال بودن واسط
            'offset'        => "{put offset}",                         # شناسه کسب و کار واسط
            'size'          => "{put size}",                        # اندازه خروجی


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

//dealerProductPermissionList();
//die();


# ====================================== dealing Product Permission List ===============================================
function dealingProductPermissionList()
{
    echo "============================== dealing Product Permission List ==================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ==========================
            'productId'     => "{put product id}",                     # شناسه محصول
            'dealingBusinessId'   => "{put dealer business id}",                # شناسه کسب و کار واسط
            'enable'        => "true/false",              # فعال بودن واسط
            'offset'        => "{put offset}",                         # شناسه کسب و کار واسط
            'size'          => "{put size}",                        # اندازه خروجی
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

//dealingProductPermissionList();
//die();


# ===================================== disable dealer Product Permission ==============================================
function disableDealerProductPermission()
{
    echo "============================= disable dealer Product Permission =================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'productId'     => "{put product id}",               # شناسه محصول
            'dealerBizId'   => "{put dealer business id}",                # شناسه کسب و کار واسط
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

//disableDealerProductPermission();
//die();

# ===================================== enable dealer Product Permission ===============================================
function enableDealerProductPermission()
{
    echo "============================= enable dealer Product Permission =================================" .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'productId'     => "{put product id}",            # شناسه محصول
            'dealerBizId'   => "{put dealer business id}",                # شناسه کسب و کار واسط


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

//enableDealerProductPermission();
//die();
