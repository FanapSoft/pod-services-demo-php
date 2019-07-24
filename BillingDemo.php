<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

# ================================================ Billing SERVICES ====================================================

# required classes
use Pod\Billing\Service\BillingService;
use Pod\Base\Service\BaseInfo;


$baseInfo = new BaseInfo();
# set serverType to SandBox or Production
$baseInfo->setServerType("{Production | Sandbox}");
$baseInfo->setToken("{put Api Token here}");
$baseInfo->setTokenIssuer(1);

#  instantiates a BillingService
$BillingService = new BillingService($baseInfo);

# ================================================== Billing BUY =======================================================
# ======================================================================================================================

# ===================================================== get OTT ========================================================
function getOtt($apiName = 'getOtt')
{
    echo "============================================= get OTT ==========================================" .PHP_EOL;
    global $BillingService;
    try {
        $result = $BillingService->getOtt($apiName);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );
    }
}

# ================================================= create Pre Invoice =================================================
function createPreInvoice()
{
    echo "======================================== create Pre Invoice ===================================" .PHP_EOL;
    global $BillingService;

    $param = [
        ## =========================================== *Required Parameters ============================================
        "ott"         => "{put ott here}", # private-call-address توکن یک بار مصرف دریافتی از سرور
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
        ],
        "guildCode"                 => "{put guild code}", # *			کد صنف فاکتور
        "redirectUri"               => "{put redirect uri}",
        "userId"               => 1111,  # the id of customer
        ## ======================================== Optional Parameters ================================================
        # "userId" => "{put customer user id}"	, #	شناسه کاربر مربوط به مشتری
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
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

    }
}
#  unComment next line to  create Pre Invoice
    createPreInvoice();
    die;

# ================================================== issue Invoice =====================================================
function issueInvoice()
{
    echo "========================================= issueInvoice ========================================" .PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ========================================= *Required Parameters ==========================================
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
            ],
            # کد صنف فاکتور
            "guildCode"			=> "put guild code", # *Required

            ## ========================================= Optional Parameters ===========================================
            # توکن یک بار مصرف اگر وارد نشود در متد issueInvoice از api دریافت می شود
            "ott" 				=> "{put ott}",
            # آدرس فراخوانی صادر کننده فاکتور
            "redirectURL" 		=> "p{ut redirect uri}",
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
            "preferredTaxRate" 	=> 0.09,
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
            "metadata"			=> 'put json format like {"name":"test"}',
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
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================  Optional Parameters  ==========================================
            "id" => "{invoice id}",
            "billNumber" => "billNumber",
        ];
    try {
        $result = $BillingService->verifyInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ======================================== *Required Parameters ===========================================
            "invoiceId"     => 11111,             # شناسه فاکتور
            ## ========================================  Optional Parameters ===========================================
            "redirectUri"   => "{put redirect uri}",
            "callUri"       => "{put call uri}",
        ];


    try {
        $result = $BillingService->payInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

    }
}
//
//    payInvoice();
//    die;
#

# ========================================== get Pay Invoice By Wallet Link ============================================
function getPayInvoiceByWalletLink()
{
    echo "============================== get Pay Invoice By Wallet Link ================================" . PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ========================================= *Required Parameters ==========================================
            "invoiceId"     => 22222,            # شناسه فاکتور
            ## =========================================  Optional Parameters ==========================================
            "redirectUri"   => "{put redirect uri}",
            "callUri"       => "{put call uri}",          # The function that will be called at the end of payment
        ];


    echo ($BillingService->getPayInvoiceByWalletLink($param)).PHP_EOL;

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
            ## ========================================= *Required Parameters ==========================================
            "uniqueNumber"  => "put unique number of invoice",
            ## =========================================  Optional Parameters ==========================================
            "redirectUri"   => "put redirect uri",
            "callUri"       => "put call uri",          # The function that will be called at the end of payment
            "gateway"       => "PEP",
        ];

    echo ($BillingService->getPayInvoiceByUniqueNumberLink($param)).PHP_EOL;

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
            ## ========================================= *Required Parameters ===========================================
            "id" => 33333, # شناسه فاکتور
        ];
    try {
        $result = $BillingService->closeInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ======================================== *Required Parameters ===========================================
            "guildCode" => "put guild code", # کد صنف
            "offset" => 0, # در صورتی که این فیلد وارد شود فیلدهای lastId و firstId نباید وارد شوند و نتیجه نزولی مرتب می شود
            "size" => 10,
            ## ========================================  Optional Parameters ===========================================
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
            "firstId" => "put first id", # در صورتی که این فیلد وارد شود فیلدهای lastId و offset نباید وارد شوند و نتیجه صعودی مرتب می شود.
            "lastId" => "put last id", # در صورتی که این فیلد وارد شود فیلدهای firstId و offset نباید وارد شوند و نتیجه نزولی مرتب می شود.
            "productIdList" => [],  # لیست شماره محصولات
    ];

    try {
        $result = $BillingService->getInvoiceList($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= Optional Parameters  ==========================================
//              "metaQuery" =>  '{"name":"elham"}',
                "metaQuery" =>  ["key"=>"value"],
                "offset" => 0,
                "size" => 10,
                "isPayed" => "true/false",      # true/false
                "isCanceled" => "true/false",   # true/false
    ];

    try {
        $result = $BillingService->getInvoiceListByMetadata($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "id" => 11111, # شناسه فاکتور
            "invoiceItemList" => [
                [
                    "invoiceItemId" => 22222,    # شناسه بند فاکتور
                    "price" => 10, # مبلغ بند فاکتور
                    "quantity" => 1,  # لیست تعداد محصول در هر بند فاکتور
                    "itemDescription" => "reduce invoice", # لیست توضیحات بند فاکتور
                ],
                [
                    "invoiceItemId" => 33333,    # شناسه بند فاکتور
                    "price" => 100, # مبلغ بند فاکتور
                    "quantity" => 1,  # لیست تعداد محصول در هر بند فاکتور
                    "itemDescription" => "reduce invoice", # لیست توضیحات بند فاکتور
                ]
            ],

            ## ========================================= Optional Parameters  ==========================================
            "preferredTaxRate" => 0.09, # نرخ مالیات برای این خرید که برای تمام آیتم های فاکتور اعمال می شود. اگر مقداری ارسال نشود مقدار مالیات بر ارزش افزوده پیش فرض محاسبه می شود
        ];
    try {
        $result = $BillingService->reduceInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );
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
            ## ========================================= *Required Parameters ==========================================
            "id" => 11111, # شناسه فاکتور
        ];
    try {
        $result = $BillingService->cancelInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "id" => 11111 # شناسه فاکتور
            ## ========================================= Optional Parameters  ==========================================
        ];
    try {
        $result = $BillingService->verifyAndCloseInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ======================================== *Required Parameters ========================================
            "guildCode" => "put guild code", # کد صنف
            "lastNRows" => 10, # n ردیف آخر فاکتور
            ## ========================================  Optional Parameters ========================================
            "id" => "invoice id",
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
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ======================================== *Required Parameters ===========================================
            "offset" => 0,
            "size" => 10,   # اندازه خروجی
            "id" => 1494,  # شناسه درخواست
            ## ========================================  Optional Parameters ===========================================
            "statusCode" => "put status code", # کد وضعیت
            "serviceUrl" => "put server url",           # آدرس سرویس
        ];
    try {
        $result = $BillingService->getExportList($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ======================================== *Required Parameters ===========================================
            "invoiceId"     => 11111,                       # شناسه فاکتور
            ## =========================================  Optional Parameters ==========================================
            "redirectUri"   => "put redirect uri",
            "callbackUri"   => "put callback uri",      # The function that will be called at the end of payment
            "gateway"       => "PEP",
        ];
    try {
        $result = $BillingService->getInvoicePaymentLink($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

    }
}

//getInvoicePaymentLink();
//die;


# ============================================  send Invoice Payment SMS  ==============================================

function sendInvoicePaymentSMS() {
    global $BillingService;
    $param =
        [
            ## ============================== *Required Parameters =============================
            "invoiceId"          => 1111 , # شناسه فاکتور
            ## ============================== Optional Parameters  ==============================
            "wallet"             => "{put wallet code}",          # کد کیف پول PODLAND_WALLET
            "callbackUri"        => "{put call back uri}",         # آدرس جهت فراخوانی پس از پرداخت
            "redirectUri"        => "{put redirect uri}",          # آدرس جهت انتقال کاربر پس از پرداخت
            "delegationId"       => "{put delegation id}",        # شناسه اعتبار
            "forceDelegation"    => "{put force delegation}",   # پرداخت فقط از طریق اعتبار
        ];
    try {
        $result = $BillingService->sendInvoicePaymentSMS($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
            ## ========================================= *Required Parameters ==========================================
            "creditorInvoiceId" => "", # شناسه فاکتور بستانکار
            "debtorInvoiceId" => "", # شناسه فاکتور بدهکار
            ## ========================================= Optional Parameters  ==========================================
        ];
    try {
        $result = $BillingService->payInvoiceByInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "_ott_" => "" , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.
            "invoiceId" => 11111,                     # شناسه فاکتور
            "date" => "yyyy/mm/dd",# تاریخ شمسی سررسید
            ## ========================================= Optional Parameters  ==========================================
            # یکی و فقط یکی از فیلدهای زیر را باید پر کنید
            "guildCode" => "put guild code", # کد صنف
            "wallet" => "PODLAND_WALLET",  # کد کیف پول
        ];
    try {
        $result = $BillingService->payInvoiceInFuture($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "_ott_"         => "{Put ott here}" , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            "amount"        => 10000, # مبلغ برداشت
            ## ========================================= Optional Parameters  ==========================================
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
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "_ott_"         => "put ott" , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            "amount"        => 1000,                      # مبلغ برداشت
            "guildCode"     => "put guild code",                # کد صنف
            ## ========================================= Optional Parameters  ==========================================
            "wallet"        => "put wallet code",           # کد کیف پول
            "firstName"     => "put first name",  # نام صاحب حسابی که تسویه به آن واریز می گردد
            "lastName"      => "put last name",  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            "sheba"         => "put sheba",  # شماره شبا حسابی که تسویه به آن واریز می گردد
            "currencyCode"  => "put currency code",  # کد ارز پیش فرض IRR
            "uniqueId"      => "put unique id",             # شناسه یکتا
            "description"   => "put description",           # شرح دلخواه
        ];
    try {
        $result = $BillingService->requestGuildSettlement($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "_ott_"         => "put ott" , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            "amount"        => 10000,                       # مبلغ برداشت
            "guildCode"     => "put guild code",                    # کد صنف
            "toolId"        => "put tool id",           # شماره ابزاری که تسویه به آن واریز می گردد
            "toolCode"      => "put tool code",# نوع ابزار برای تسویه کارت به کارت،پایا،ساتنا
            # [SETTLEMENT_TOOL_SATNA | SETTLEMENT_TOOL_PAYA | SETTLEMENT_TOOL_CARD]
            ## ========================================= Optional Parameters  ==========================================
            "firstName"     => "put first name",  # نام صاحب حسابی که تسویه به آن واریز می گردد
            "lastName"      => "put last name",  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            "currencyCode"  => "put currency code",       # کد ارز پیش فرض IRR
            "uniqueId"      => "put unique id",          # شناسه یکتا
            "description"   => "put description",          # شرح دلخواه
        ];
    try {
        $result = $BillingService->requestSettlementByTool($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "offset"        => 0,      # مبلغ برداشت
            "size"          => 10,        # اندازه خروجی
            ## ========================================= Optional Parameters  ==========================================
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
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "guildCode"     => "put guild code",              # کد صنف
            ## ========================================= Optional Parameters  ==========================================
            "firstName"     => "",  # نام صاحب حسابی که تسویه به آن واریز می گردد
            "lastName"      => "",  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            "currencyCode"  => "",  # کد ارز پیش فرض IRR
            "instant"       => "true/false",  # در صورت true بودن تسویه حساب خودکار فوری و در صورت false بودن تسویه حساب خودکار فعال می شود .
            "sheba"         => "",          # شماره شبا حسابی که تسویه به آن واریز می گردد
        ];
    try {
        $result = $BillingService->addAutoSettlement($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
            ## ========================================= *Required Parameters ==========================================
            "guildCode"     => "put guild code",              # کد صنف
            ## ========================================= Optional Parameters  ==========================================
            "currencyCode"  => "like USD or IRR",  # کد ارز پیش فرض IRR
        ];
    try {
        $result = $BillingService->removeAutoSettlement($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
        ## ========================================== *Required Parameters =============================================
            "dealerBizId"     => 1111,              # شناسه کسب و کار واسط
        ## ========================================== Optional Parameters  =============================================
            "allProductAllow"  => true,             # دسترسی به همه محصولات
        ];
    try {
        $result = $BillingService->addDealer($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
        ## ========================================== Optional Parameters  =============================================
            'dealerBizId'   => 1111,            # The id of business to be a dealer
            'enable'        => true,            # [true/false]
            'size'          => 10,              # pagination size, default: 50
            'offset'        => 0,               # pagination offset, default: 0
        ];
    try {
        $result = $BillingService->dealerList($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
        ## ========================================= *Required Parameters ==============================================
            "dealerBizId"     => 1111,  # The id of dealer business *that is a number*
        ];
    try {
        $result = $BillingService->enableDealer($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
        ## ========================================= *Required Parameters ==========================================
            "dealerBizId"     => 1111,  # The id of dealer business that is a number
        ];
    try {
        $result = $BillingService->disableDealer($param);
        print_r($result);
    }
    catch (CustomException $e) {

        print_r(
            $e->GetResult()
        );

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
        ## ========================================= Optional Parameters  ==============================================
            'dealingBusinessId' => 1111,            # The id of dealing business
            'enable'            => true,            # [true/false]
            'size'              => 10,              # pagination size, default: 50
            'offset'            => 0,               # pagination offset, default: 0
        ];
    try {
        $result = $BillingService->businessDealingList($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
        ## ========================================= *Required Parameters ==============================================
            "_ott_" => "put ott" ,                      # one time token - این توکن را در سرویس قبلی دریافت کرده اید.
            # آرایه حاوی اطلاعات فاکتورها
            "data" =>                       ## commented rows are optional parameters ##
                [
                    // 'redirectURL' => 'put redirect url',
                    // 'userId' => 11111,               # userId of customer
                    // 'currencyCode' => 'like EUR or IRR',
                    // 'voucherHashs' => [],            # array of vouchers  اگر وجود ندارد این پارامتر ارسال نشود
                    // 'preferredTaxRate' => 0.09 ,     # tax to be added between 0 and 1 default is 0.09
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
                                        'productId' => 0,   # the id of product or 0 if no product
                                        'price' => 100,     # the share of dealer
                                        'quantity' => 1,    # count
                                        'description' => 'put description'
                                    ],
                                ],
                        ],
                    'subInvoices' =>
                        [
                            [
                                'businessId' => 111,       # the id of shareholder business
                                'guildCode' => 'put guild code',
                                // 'billNumber' => 'put bill number',       # business unique bill number
                                // 'metadata' => 'extra data in form of json',
                                'description' => 'put description',
                                'invoiceItemVOs' =>
                                    [
                                        [
                                            'productId' => 0,
                                            'price' => 100,         # the share of shareholder
                                            'quantity' => 10,
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
                                'productId' => 0,       # the id of product or 0 if no product,
                                'price' => 100,         # the price to be payed by customer
                                'quantity' => 11,       # count
                                'description' => 'put description'
                            ]
                        ]
                ],

        ## ========================================= Optional Parameters  ==============================================
            'delegatorId'       => [],            # شناسه تفویض کنندگان، ترتیب اولویت را مشخص می کند
            'delegationHash'    => [],            # کد تفویض برای اشاره به یک تفویض مشخص
            'forceDelegation'   => false,              # پرداخت فقط از طریق تفویض
        ];
    try {
        $result = $BillingService->issueMultiInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
        ## ========================================= *Required Parameters ==============================================
        # ***** NOTE : the share of dealer + the share of shareholder = the price to be payed by customer  **** #
            'data' =>
                [
                    'preferredTaxRate' => 0.09,            # tax to be added between 0 and 1 default is 0.09
                    'mainInvoice' =>                             # فاکتور به نام خود معامله گر
                        [
                            'id' => 3620964,                # id of main invoice to be edited
                            'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم معامله گر
                                [
                                    [
                                        'id' => 111111,                 # the id of item in invoice
                                        'price' => 100,                 # the share of dealer
                                        'quantity' => 1,                # count
                                        'description' => 'put description of item'
                                    ]
                                ]
                        ],
                    'subInvoices' =>            # فاکتورهای مربوط به سهم سایر کسب و کارهای ذینفع
                        [
                            [
                                'id' => 222222,
                                'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم ذینفعان
                                    [
                                        [
                                            'id' => 333333,         # the id of item in invoice
                                            'price' => 100,         # the share of shareholder
                                            'quantity' => 9,        # count
                                            'description' => 'put description of item'
                                        ]
                                    ]
                            ]
                        ],
                    'customerInvoiceItemVOs' =>         # بندهایی که به مشتری نمایش داده می شوند
                        [
                            [
                                'id' => 444444,         # the id of item in invoice
                                'price' => 100,         # he price to be payed by customer
                                'quantity' => 10,       # count
                                'description' => 'put description of item'
                            ]

                        ],
                ]
        ];

    try {
        $result = $BillingService->reduceMultiInvoice($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
        ## ========================================= *Required Parameters ==============================================
        # ***** NOTE : the share of dealer + the share of shareholder = the price to be payed by customer  **** #
            'data' =>
            [
                'preferredTaxRate' => 0.09,            # tax to be added between 0 and 1 default is 0.09
                'mainInvoice' =>                             # فاکتور به نام خود معامله گر
                    [
                        'id' => 3620964,                # id of main invoice to be edited
                        'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم معامله گر
                            [
                                [
                                    'id' => 111111,                 # the id of item in invoice
                                    'price' => 100,                 # the share of dealer
                                    'quantity' => 1,                # count
                                    'description' => 'put description of item'
                                ]
                            ]
                    ],
                'subInvoices' =>            # فاکتورهای مربوط به سهم سایر کسب و کارهای ذینفع
                    [
                        [
                            'id' => 222222,
                            'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم ذینفعان
                                [
                                    [
                                        'id' => 333333,         # the id of item in invoice
                                        'price' => 100,         # the share of shareholder
                                        'quantity' => 9,        # count
                                        'description' => 'put description of item'
                                    ]
                                ]
                        ]
                    ],
                'customerInvoiceItemVOs' =>         # بندهایی که به مشتری نمایش داده می شوند
                    [
                        [
                            'id' => 444444,         # the id of item in invoice
                            'price' => 100,         # he price to be payed by customer
                            'quantity' => 10,       # count
                            'description' => 'put description of item'
                        ]

                    ],
            ]
        ];
    try {
        $result = $BillingService->reduceMultiInvoiceAndCashOut($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
        ## ========================================= Optional Parameters  ==============================================
            'productId'         => 11111,            # شناسه محصول
            'dealerBizId'       => 22222,            # شناسه کسب و کار واسط


        ];
    try {
        $result = $BillingService->addDealerProductPermission($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
        ## ========================================= Optional Parameters  ==============================================
//            'productId'     => 11111,                     # شناسه محصول
//            'dealerBizId'   => 22222,                     # شناسه کسب و کار واسط
//            'enable'        => "true/false",              # فعال بودن واسط
//            'offset'        => 0,                         # شناسه کسب و کار واسط
//            'size'          => 10,                        # اندازه خروجی


    ];
    try {
        $result = $BillingService->dealerProductPermissionList($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
        ## ========================================= Optional Parameters  ==============================================
//            'productId'     => 19474,                     # شناسه محصول
//            'dealingBusinessId'   => 3605,                # شناسه کسب و کار واسط
//            'enable'        => "true/false",              # فعال بودن واسط
//            'offset'        => 0,                         # شناسه کسب و کار واسط
//            'size'          => 10,                        # اندازه خروجی


    ];
    try {
        $result = $BillingService->dealingProductPermissionList($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
        ## ======================================== *Required Parameters  ==============================================
            'productId'     => 11111,               # شناسه محصول
            'dealerBizId'   => 22222,                # شناسه کسب و کار واسط


        ];
    try {
        $result = $BillingService->disableDealerProductPermission($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
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
            ## ======================================== *Required Parameters  ==============================================
            'productId'     => 11111,            # شناسه محصول
            'dealerBizId'   => 22222,                # شناسه کسب و کار واسط


        ];
    try {
        $result = $BillingService->enableDealerProductPermission($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

//enableDealerProductPermission();
//die();
