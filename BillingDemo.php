<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
# ================================================ Billing SERVICES ====================================================
# required classes
use Pod\Billing\Service\BillingService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

const API_TOKEN = '{PUT API TOKEN}';
const TOKEN_ISSUER = 1;


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
    echo '======================================== create Pre Invoice ===================================' .PHP_EOL;
    global $BillingService;

    $param = [
        ## ============================ *Required Parameters  =========================
        'ott'         => 'bbfdcf363bec5774', # private-call-address توکن یک بار مصرف دریافتی از سرور
        'productList'   => [
            [
                # شناسه محصول . در صورتی که بند فاکتور محصول مرتبط ندارد مقدار آن 0 وارد شود
                'productId'         => '{put product id}',
                # مبلغ بند فاکتور. برای استفاده از قیمت محصول وارد شده از مقدار auto استفاده نمایید
                'price'             => '{put product price, type: decimal}',
                #تعداد محصول
                'quantity'          => '{put product price, type: integer}',
                # توضیحات
                'productDescription'=> '{put description}',
            ],
            //اطلاعات محصولات دیگر
        ],
        'guildCode'                 => '{put guild code}', # *			کد صنف فاکتور
        'redirectUri'               => '{put redirect uri}',
        'userId'               => '{put customer user id}',  # the id of customer
        ## =========================== Optional Parameters  ===========================
        # 'billNumber'=> '{put bill numer}',
        # 'redirectUri' => '{put redrect uri}',
        #'callUrl'=>  '{put call uri}',
        # 'preferredTaxRate' => 'vat; default 0.09',
        # 'verificationNeeded' => '{true/false}',
        # 'currencyCode'=> '{put currency code}',
        #  'description' => '{put description}',
        # 'deadline' => 'yyyy/mm/dd',
        'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
        'scApiKey'           => '{Put service call Api Key}',
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

# ================================================== issue Invoice =====================================================
function issueInvoice()
{
    echo '========================================= issueInvoice ========================================' .PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            'productList'   	=> [
                [
                    # شناسه محصول . در صورتی که بند فاکتور محصول مرتبط ندارد مقدار آن 0 وارد شود
                    'productId'         => '{put product id}',
                    # مبلغ بند فاکتور. برای استفاده از قیمت محصول وارد شده از مقدار auto استفاده نمایید
                    'price'             => '{put product price, type: decimal}',
                    #تعداد محصول
                    'quantity'          => '{put product price, type: integer}',
                    # توضیحات
                    'productDescription'=> '{put description}',
                ],
                // اطلاعات محصولات دیگر
            ],
            'guildCode'			=> '{put guild code}', # *Required
            'ott' 				=> '{put ott}',
            ## =========================== Optional Parameters  ===========================
            'redirectURL' 		=> '{put redirect uri}',
            'userId' 			=> '{put user id}',
            'billNumber' 		=> '{put bill number}',
            'description' 		=> '{put description}',
            'deadline' 			=> 'yyyy/mm/dd',
            'currencyCode' 		=> '{put currency code like IRR}',  # default : IRR
            'addressId' 		=> '{put address id of customer}',
            'voucherHash' 		=> [],
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
            'preferredTaxRate' 	=> '{put tax, default 0.09}',
            'verificationNeeded'=> '{true/false}',
            'verifyAfterTimeout'=> '{true/false}',
            'preview' 			=> '{true/false}',
            'safe'				=> '{true/false}',
            'postVoucherEnabled'=> '{true/false}',
            'hasEvent'			=> '{true/false}',
            'eventTitle'		=> '{put event title}',
            'eventTimeZone'		=> '{put event time zone}',
            'eventDescription'	=> '{put event description}',
            "metadata"			=> '{put json format like {"name":"test"}}',
            'eventMetadata'		=> [],
            'eventReminders'	=> [],
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

# ================================================== verify Invoice ====================================================
function verifyInvoice()
{
    echo '====================================== verify Invoice  ========================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===========================
            'id'                => '{invoice id}',
            'billNumber'        => 'billNumber',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',

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

# ================================================== pay Invoice =======================================================
function payInvoice()
{
    echo '======================================== pay Invoice =========================================' . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'invoiceId'     => '{put invoice id}',             # شناسه فاکتور
            ## =========================== Optional Parameters  ===========================
            'redirectUri'   => '{put redirect uri}',
            'callUri'       => '{put call uri}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ========================================== get Pay Invoice By Wallet Link ============================================
function getPayInvoiceByWalletLink()
{
    echo '============================== get Pay Invoice By Wallet Link ================================' . PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            'invoiceId'     => '{put invoice id}',            # شناسه فاکتور
            ## =========================================  Optional Parameters ==========================================
            'redirectUri'   => '{put redirect uri}',
            'callUri'       => '{put call uri}',          # The function that will be called at the end of payment
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ======================================= get Pay Invoice By Unique Number Link ========================================
function getPayInvoiceByUniqueNumberLink()
{
    echo '=========================== get Pay Invoice By Unique Number Link ============================' . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'uniqueNumber'  => '{put unique number of invoice}',
            ## =========================================  Optional Parameters ==========================================
            'redirectUri'   => '{put redirect uri}',
            'callUri'       => '{put call uri}',          # The function that will be called at the end of payment
            'gateway'       => 'PEP'
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

# ================================================== close Invoice =====================================================
function closeInvoice()
{
    echo '===================================== close Invoice  ========================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'id' => '{put invoice id}', # شناسه فاکتور
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ================================================== BILLING INVOICE ===================================================
# ======================================================================================================================

# ================================================= get Invoice List ===================================================
function getInvoiceList()
{
    echo '========================================== get Invoice List ==================================' . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters one of  =========================
            'offset' => '{put offset}', # در صورتی که این فیلد وارد شود فیلدهای lastId و firstId نباید وارد شوند و نتیجه نزولی مرتب می شود
            'firstId' => 'put first id', # در صورتی که این فیلد وارد شود فیلدهای lastId و offset نباید وارد شوند و نتیجه صعودی مرتب می شود.
            'lastId' => 'put last id', # در صورتی که این فیلد وارد شود فیلدهای firstId و offset نباید وارد شوند و نتیجه نزولی مرتب می شود.
            ## =========================== Optional Parameters  ===========================
            'size' => '{put size}',
            'guildCode' => 'put guild code', # کد صنف
            'id' => 'put invoice id',   # invoice id
            'billNumber' => 'put bill number', # شماره قبض که به تنهایی با آن می توان جستجو نمود
            'uniqueNumber' => 'put unique number', # شماره کد شده ی قبض که به تنهایی با آن می توان جستجو نمود
            'trackerId' => 'put tracker id',
            'fromDate' => 'yyyy/mm/dd hh:mi:ss',          # تاریخ شمسی صدور فاکتور yyyy/mm/dd hh:mi:ss
            'toDate' => 'yyyy/mm/dd hh:mi:ss',            # تاریخ شمسی صدور فاکتور yyyy/mm/dd hh:mi:ss
            'isCanceled' => 'true/false',
            'isPayed' => 'true',
            'isClosed' => 'true/false',
            'isWaiting' => 'true/false',
            'referenceNumber' => 'put reference number',                             # شماره ارجاع
            'userId' => 'put user id',                                        # شناسه کاربری مشتری
            'issuerId' => 'put issuer id',                        # شناسه کاربری صادر کننده فاکتور
            'query' => 'put search query',                                      # عبارت برای جستجو
            'productIdList' => [],  # لیست شماره محصولات
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ========================================  get Invoice List By Metadata  ==============================================

function getInvoiceListByMetadata() {
    echo '==============================  get Invoice List By Metadata  ================================' . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## =========================== Optional Parameters  ===========================
            'metaQuery' =>  ['key'=>'value'],
            'offset' => '{put offset}',
            'size' => '{put size}',
            'isPayed' => 'true/false',      # true/false
            'isCanceled' => 'true/false',   # true/false
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# =============================================== reduce Invoice =======================================================
function reduceInvoice()
{
    echo '=================================== reduce Invoice  ===========================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'id' => '{put invoice id}', # شناسه فاکتور
            'invoiceItemList' => [
                [
                    'invoiceItemId' => '{put invoice id of item 1}',    # شناسه بند فاکتور
                    'price' => '{put price of item 1}', # مبلغ بند فاکتور
                    'quantity' => '{put quantity of item 1}',  # لیست تعداد محصول در هر بند فاکتور
                    'itemDescription' => 'reduce invoice', # لیست توضیحات بند فاکتور
                ],
                [
                    'invoiceItemId' => '{put invoice id of item 2}',    # شناسه بند فاکتور
                    'price' => '{put price of item 2}', # مبلغ بند فاکتور
                    'quantity' => '{put quantity of item 2}',  # لیست تعداد محصول در هر بند فاکتور
                    'itemDescription' => 'reduce invoice', # لیست توضیحات بند فاکتور
                ],
            ],

            ## =========================== Optional Parameters  ===========================
            'preferredTaxRate' => '{put tax, default 0.09}', # نرخ مالیات برای این خرید که برای تمام آیتم های فاکتور اعمال می شود. اگر مقداری ارسال نشود مقدار مالیات بر ارزش افزوده پیش فرض محاسبه می شود
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ================================================== cancel Invoice ====================================================
function cancelInvoice()
{
    echo '===================================== cancel Invoice  =========================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'id' => '{put invoice id}', # شناسه فاکتور
            ## =========================== Optional Parameters  ===========================
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ============================================== verify And Close Invoice ==============================================
function verifyAndCloseInvoice()
{
    echo '================================== verify And Close Invoice ===================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'id' => '{put invoice id}', # شناسه فاکتور
            ## =========================== Optional Parameters  ===========================
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ===========================================  get Invoice List As File  ===============================================

function getInvoiceListAsFile() {
    echo '==================================  get Invoice List As File  ====================================' . PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'guildCode' => '{put guild code}', # کد صنف
            'lastNRows' => '{put last n rows}', # n ردیف آخر فاکتور
            ## =========================== Optional Parameters  ===========================
            'id' => '{put invoice id}',
            'billNumber' => '{put bill number}', # شماره قبض که به تنهایی با آن می توان جستجو نمود
            'uniqueNumber' => '{put unique number}', # شماره کد شده ی قبض که به تنهایی با آن می توان جستجو نمود
            'trackerId' => '{put tracker id}',
            'fromDate' => 'yyyy/mm/dd hh:mi:ss',          # تاریخ شمسی صدور فاکتور yyyy/mm/dd hh:mi:ss
            'toDate' => 'yyyy/mm/dd hh:mi:ss',            # تاریخ شمسی صدور فاکتور yyyy/mm/dd hh:mi:ss
            'isCanceled' => '{true/false}',
            'isPayed' => '{true/false}',
            'isClosed' => '{true/false}',
            'isWaiting' => '{true/false}',
            'referenceNumber' => '{put reference number}',               # شماره ارجاع
            'userId' => '{put user id}',                          # شناسه کاربری مشتری
            'query' => '{put query}',                               # عبارت برای جستجو
            'productIdList' => [],  # لیست شماره محصولات
            'callbackUrl' => '{put call back url}',    # آدرس فراخوانی پس از اتمام تولید گزارش
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ================================================= get Export List ====================================================
function getExportList()
{
    echo '===================================== get Export List =========================================' .PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            'offset' => '{put offset}',
            'size' => '{put size}',   # اندازه خروجی
            'id' => '{put request id}',  # شناسه درخواست
            ## =========================== Optional Parameters  ===========================
            'statusCode' => '{put status code}', # کد وضعیت
            'serviceUrl' => '{put server url}',           # آدرس سرویس
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ================================================= PAYMENT BILLING ====================================================
# ======================================================================================================================

# ============================================== get Invoice Payment Link ==============================================
function getInvoicePaymentLink()
{
    echo '================================== get Invoice Payment Link ===================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'invoiceId'     => '{put invoice id}',
            ## ============================  Optional Parameters ==========================
            'redirectUri'   => '{put redirect uri}',
            'callbackUri'   => '{put callback uri}',
            'gateway'       => 'PEP',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ============================================  send Invoice Payment SMS  ==============================================

function sendInvoicePaymentSMS() {
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            'invoiceId'          => '{put invoice id}' , # شناسه فاکتور
            ## =========================== Optional Parameters  ===========================
            'wallet'             => '{put wallet code}',
            'callbackUri'        => '{put call back uri}',
            'redirectUri'        => '{put redirect uri}',
            'delegationId'       => '{put delegation id}',
            'forceDelegation'    => '{put force delegation}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ================================================ pay Invoice By Invoice ==============================================
function payInvoiceByInvoice()
{
    echo '================================== pay Invoice By Invoice ====================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'creditorInvoiceId' => 'Put creditor Invoice Id',
            'debtorInvoiceId' => 'Put debtor Invoice Id',
            ## =========================== Optional Parameters  ===========================
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ============================================== pay Invoice In Future =================================================
function payInvoiceInFuture()
{
    echo '=================================== pay Invoice In Future  ===================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'ott' => '' , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.
            'invoiceId' => '{put invoice id}',                     # شناسه فاکتور
            'date' => 'yyyy/mm/dd',# تاریخ شمسی سررسید
            ## =========================== Optional Parameters  ===========================
            # یکی و فقط یکی از فیلدهای زیر را باید پر کنید
            'guildCode' => 'put guild code', # کد صنف
            'wallet' => 'PODLAND_WALLET',  # کد کیف پول
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ============================================== pay Invoice By Credit =================================================
function payInvoiceByCredit()
{
    echo '=================================== pay Invoice By Credit  ===================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'ott' => '{Put ott}' , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.
            'invoiceId' => '{Put invoice id}', # شناسه فاکتور
            'wallet' => 'PODLAND_WALLET',  # کد کیف پول
            ## =========================== Optional Parameters  ===========================
            'delegatorId' => ['{Put delegator Ids}'],
            'delegationHash' => ['{Put delegation hash for each delegator id}'],
            'forceDelegation' => '{Put true/false}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->payInvoiceByCredit($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

payInvoiceByCredit();
die;

# ============================================  pay Any Invoice By Credit ===============================================
function payAnyInvoiceByCredit()
{
    echo '=================================== pay Any Invoice By Credit ===============================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'ott' => '{Put ott}' , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.
            'invoiceId' => '{Put invoice id}', # شناسه فاکتور
            'wallet' => 'PODLAND_WALLET',  # کد کیف پول
            ## =========================== Optional Parameters  ===========================
            'delegatorId' => ['{Put delegator Ids}'],
            'delegationHash' => ['{Put delegation hash for each delegator id}'],
            'forceDelegation' => '{Put true/false}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->payAnyInvoiceByCredit($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
# =========================================== request Wallet Settlement  ===============================================
function requestWalletSettlement()
{
    echo '=============================== request Wallet Settlement  ====================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'ott'         => '{Put ott here}' , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            'amount'        => '{put amount}', # مبلغ برداشت
            ## =========================== Optional Parameters  ===========================
            'wallet'        => '{put wallet code}',          # کد کیف پول PODLAND_WALLET
            'firstName'     => '{put first name}',  # نام صاحب حسابی که تسویه به آن واریز می گردد
            'lastName'      => '{put last name}',  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            'sheba'         => '{put sheba}',  # شماره شبا حسابی که تسویه به آن واریز می گردد
            'currencyCode'  => '{put currency code}',  # کد ارز پیش فرض IRR
            'uniqueId'      => '{put unique id}',          # شناسه یکتا
            'description'   => '{put description}',          # شرح دلخواه
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ============================================= request Guild Settlement  ==============================================
function requestGuildSettlement()
{
    echo '================================= request Guild Settlement  ===================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'ott'         => '{put ott}' , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            'amount'        => '{put amount}',                      # مبلغ برداشت
            'guildCode'     => '{put guild code}',                # کد صنف
            ## =========================== Optional Parameters  ===========================
            'wallet'        => '{put wallet code}',           # کد کیف پول
            'firstName'     => '{put first name}',  # نام صاحب حسابی که تسویه به آن واریز می گردد
            'lastName'      => '{put last name}',  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            'sheba'         => '{put sheba}',  # شماره شبا حسابی که تسویه به آن واریز می گردد
            'currencyCode'  => '{put currency code}',  # کد ارز پیش فرض IRR
            'uniqueId'      => '{put unique id}',             # شناسه یکتا
            'description'   => '{put description}',           # شرح دلخواه
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ============================================= request Guild Settlement  ==============================================
function requestSettlementByTool()
{
    echo '================================= request Guild Settlement  ===================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'ott'         => '{put ott}' , # one time token - این توکن را در سرویس قبلی دریافت کرده اید.برای دریافت مجدد می توانید سرویس /nzh/ott/ را صدا کنید
            'amount'        => '{put amount}',                       # مبلغ برداشت
            'guildCode'     => '{put guild code}',                    # کد صنف
            'toolId'        => '{put tool id}',           # شماره ابزاری که تسویه به آن واریز می گردد
            'toolCode'      => '{put tool code}',# نوع ابزار برای تسویه کارت به کارت،پایا،ساتنا
            # [SETTLEMENT_TOOL_SATNA | SETTLEMENT_TOOL_PAYA | SETTLEMENT_TOOL_CARD]
            ## =========================== Optional Parameters  ===========================
            'firstName'     => '{put first name}',  # نام صاحب حسابی که تسویه به آن واریز می گردد
            'lastName'      => '{put last name}',  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            'currencyCode'  => '{put currency code}',       # کد ارز پیش فرض IRR
            'uniqueId'      => '{put unique id}',          # شناسه یکتا
            'description'   => '{put description}',          # شرح دلخواه
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ================================================= list Settlements ===================================================
function listSettlements()
{
    echo '===================================== list Settlements ========================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'offset'        => '{put offset}',      # مبلغ برداشت
            'size'          => '{put size}',        # اندازه خروجی
            ## =========================== Optional Parameters  ===========================
            'statusCode'    => '',  # کد وضعیت درخواست SETTLEMENT_REQUESTED، SETTLEMENT_SENT ، SETTLEMENT_DONE
            'currencyCode'  => '',  # کد ارز پیش فرض IRR
            'fromAmount'    => '',  # حد پایین مبلغ درخواست شده
            'toAmount'      => '',  # حد بالای مبلغ درخواست شده
            'fromDate'      => '',  # حد پایین تاریخ درخواست شمسی yyyy/mm/dd
            'toDate'        => '',  # حد بالای تاریخ درخواست شمسی yyyy/mm/dd
            'uniqueId'      => '',          # شناسه یکتا
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ================================================ add Auto Settlement  ================================================
function addAutoSettlement()
{
    echo '==================================== add Auto Settlement  =====================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'guildCode'     => '{put guild code}',              # کد صنف
            ## =========================== Optional Parameters  ===========================
            'firstName'     => '',  # نام صاحب حسابی که تسویه به آن واریز می گردد
            'lastName'      => '',  # نام خانوادگی صاحب حسابی که تسویه به آن واریز می گردد
            'currencyCode'  => '',  # کد ارز پیش فرض IRR
            'instant'       => 'true/false',  # در صورت true بودن تسویه حساب خودکار فوری و در صورت false بودن تسویه حساب خودکار فعال می شود .
            'sheba'         => '',          # شماره شبا حسابی که تسویه به آن واریز می گردد
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# =============================================== remove Auto Settlement  ==============================================
function removeAutoSettlement()
{
    echo '=================================== remove Auto Settlement  ===================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'guildCode'     => '{put guild code}',              # کد صنف
            ## =========================== Optional Parameters  ===========================
            'currencyCode'  => '{like USD or IRR}',  # کد ارز پیش فرض IRR
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ============================================= issue Multi Invoice ====================================================
function issueMultiInvoice()
{
    echo '===================================== issue Multi Invoice ====================================' .PHP_EOL;
    global $BillingService;
    # ***** NOTE : the share of dealer + the share of shareholder = the price to be payed by customer  **** #
    $param =
        [
            ## ============================ *Required Parameters  =========================
            'ott' => 'put ott' ,                      # one time token - این توکن را در سرویس قبلی دریافت کرده اید.
            # آرایه حاوی اطلاعات فاکتورها
            'data' =>                       ## commented rows are optional parameters ##
                [
                    // 'redirectURL' => 'put redirect url',
                    // 'userId' => 11111,               # userId of customer
                    // 'currencyCode' => 'like EUR or IRR',
                    // 'voucherHashs' => [],            # array of vouchers  اگر وجود ندارد این پارامتر ارسال نشود
                    // 'preferredTaxRate' => '{put tax, default 0.09}' ,     # tax to be added between 0 and 1 default is 0.09
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
                                        'productId' => '{put product id or 0}',   # the id of product or 0 if no product
                                        'price' => '{put price}',     # the share of dealer
                                        'quantity' => '{put quantity}',    # count
                                        'description' => 'put description'
                                    ],
                                ],
                        ],
                    'subInvoices' =>
                        [
                            [
                                'businessId' => '{put business id}',       # the id of shareholder business
                                'guildCode' => 'put guild code',
                                // 'billNumber' => 'put bill number',       # business unique bill number
                                // 'metadata' => 'extra data in form of json',
                                'description' => 'put description',
                                'invoiceItemVOs' =>
                                    [
                                        [
                                            'productId' => '{put product id or 0}',
                                            'price' => '{put price}',         # the share of shareholder
                                            'quantity' => '{put quantity}',
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
                                'productId' => '{put product id or 0}',       # the id of product or 0 if no product,
                                'price' => '{put price}',         # the price to be payed by customer
                                'quantity' => '{put quantity}',       # count
                                'description' => 'put description'
                            ]
                        ]
                ],

            ## =========================== Optional Parameters  ===============================
            'delegatorId'       => [],            # شناسه تفویض کنندگان، ترتیب اولویت را مشخص می کند
            'delegationHash'    => [],            # کد تفویض برای اشاره به یک تفویض مشخص
            'forceDelegation'   => false,              # پرداخت فقط از طریق تفویض
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ============================================= reduce Multi Invoice ===================================================
function reduceMultiInvoice()
{
    echo '===================================== reduce Multi Invoice ====================================' .PHP_EOL;
    global $BillingService;
    $param =
        [
            ## ============================ *Required Parameters  =========================
            # ***** NOTE : the share of dealer + the share of shareholder = the price to be payed by customer  **** #
            'data' =>
                [
                    'preferredTaxRate' => '{put tax, default 0.09}',            # tax to be added between 0 and 1 default is 0.09
                    'mainInvoice' =>                             # فاکتور به نام خود معامله گر
                        [
                            'id' => '{put invoice id}',                # id of main invoice to be edited
                            'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم معامله گر
                                [
                                    [
                                        'id' => '{put invoice item id}',                 # the id of item in invoice
                                        'price' => '{put price}',                 # the share of dealer
                                        'quantity' => '{put quantity}',                # count
                                        'description' => 'put description of item'
                                    ]
                                ]
                        ],
                    'subInvoices' =>            # فاکتورهای مربوط به سهم سایر کسب و کارهای ذینفع
                        [
                            [
                                'id' => '{put id of sub invoice}',
                                'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم ذینفعان
                                    [
                                        [
                                            'id' => '{put invoice item id}',         # the id of item in invoice
                                            'price' => '{put price}',         # the share of shareholder
                                            'quantity' => '{put quantity}',        # count
                                            'description' => 'put description of item'
                                        ]
                                    ]
                            ]
                        ],
                    'customerInvoiceItemVOs' =>         # بندهایی که به مشتری نمایش داده می شوند
                        [
                            [
                                'id' => '{put invoice item id}',         # the id of item in invoice
                                'price' => '{put price}',         # he price to be payed by customer
                                'quantity' => '{put quantity}',       # count
                                'description' => 'put description of item'
                            ]

                        ],
                ],
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ====================================== reduce Multi Invoice And Cash Out =============================================
function reduceMultiInvoiceAndCashOut()
{
    echo '============================== reduce Multi Invoice And Cash Out ==============================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            # ***** NOTE : the share of dealer + the share of shareholder = the price to be payed by customer  **** #
            'data' =>
                [
                    'preferredTaxRate' => '{put tax, default 0.09}',            # tax to be added between 0 and 1 default is 0.09
                    'mainInvoice' =>                             # فاکتور به نام خود معامله گر
                        [
                            'id' => '{put id of main invoice}',                # id of main invoice to be edited
                            'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم معامله گر
                                [
                                    [
                                        'id' => '{put invoice item id}',                 # the id of item in invoice
                                        'price' => '{put price}',                 # the share of dealer
                                        'quantity' => '{put quantity}',                # count
                                        'description' => 'put description of item'
                                    ]
                                ]
                        ],
                    'subInvoices' =>            # فاکتورهای مربوط به سهم سایر کسب و کارهای ذینفع
                        [
                            [
                                'id' => '{put id of sub invoice}',
                                'reduceInvoiceItemVOs' =>       # بندهای فاکتور مربوط به سهم ذینفعان
                                    [
                                        [
                                            'id' => '{put invoice item id}',         # the id of item in invoice
                                            'price' => '{put price}',         # the share of shareholder
                                            'quantity' => '{put quantity}',        # count
                                            'description' => 'put description of item'
                                        ]
                                    ]
                            ]
                        ],
                    'customerInvoiceItemVOs' =>         # بندهایی که به مشتری نمایش داده می شوند
                        [
                            [
                                'id' => '{put invoice item id}',         # the id of item in invoice
                                'price' => '{put price}',         # he price to be payed by customer
                                'quantity' => '{put quantity}',       # count
                                'description' => 'put description of item'
                            ]

                        ],
                ],
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
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

# ================================================== VOUCHER  APIS =====================================================
# ===================================== define Credit Voucher ===============================================
function defineCreditVoucher()
{
    echo '============================= define Credit Voucher =================================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'guildCode'     => '{Put guild code}',
            'expireDate'    => '{Put expire date yyyy/mm/dd}',
            'vouchers'      => [
                [
                    'count'         => '{Put count of voucher}',
                    'amount'        => '{Put price}',
                    'name'          => '{Put name of voucher}',
                    'description'   => '{Put description}',
                    ## ============= Optional Parameters  ==============
                    'hash'          => '{Put voucher hash}'
                ],
                [
                    'count'         => '{Put count of voucher}',
                    'amount'        => '{Put price}',
                    'name'          => '{Put name of voucher}',
                    'description'   => '{Put description}',
                    ## ============= Optional Parameters  ==============
                    'hash'          => '{Put voucher hash}'
                ]
            ],
            ## =========================== Optional Parameters  ===========================
            'limitedConsumerId' => '{Put user id}',
            'currencyCode'      => '{Put currency code}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $BillingService->defineCreditVoucher($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================ define Discount Amount Voucher ===================================
function defineDiscountAmountVoucher()
{
    echo '========================== define Discount Amount Voucher =======================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'guildCode'     => 'INFORMATION_TECHNOLOGY_GUILD',
            'expireDate'   => '{Put expire date yyyy/mm/dd}',
            'vouchers'      => [
                [
                    'count'         => '{Put count of voucher}',
                    'amount'        => '{Put price}',
                    'name'          => '{Put name of voucher}',
                    'description'   => '{Put description}',
                    ## ============= Optional Parameters  ==============
                    'hash'          => '{Put voucher hash}'
                ],
                [
                    'count'         => '{Put count of voucher}',
                    'amount'        => '{Put price}',
                    'name'          => '{Put name of voucher}',
                    'description'   => '{Put description}',
                    ## ============= Optional Parameters  ==============
                    'hash'          => '{Put voucher hash}'
                ]
            ],
            ## =========================== Optional Parameters  ===========================
            'productId'         => ['{Put product ids}'],
            'dealerBusinessId'  => ['{Put dealer business ids}'],
            'limitedConsumerId' => '{Put user id}',
            'currencyCode'      => '{Put currency code}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
    ];
    try {
        $result = $BillingService->defineDiscountAmountVoucher($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================ define Discount Percentage Voucher ===================================
function defineDiscountPercentageVoucher()
{
    echo '========================== define Discount Percentage Voucher =======================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'guildCode'     => 'INFORMATION_TECHNOLOGY_GUILD',
            'expireDate'    => '1398/12/29',
            'type'          => '{Put type enum(1, 2, 4, 8, 16)}',
            'vouchers'      => [
                [
                    'count'         => '{Put count of voucher}',
                    'discountPercentage' => '{Put discount percentage}',
                    'name'          => '{Put name of voucher}',
                    'description'   => '{Put description}',
                    ## ============= Optional Parameters  ==============
                    'hash'          => '{Put voucher hash}',
                    'amount'        => '{Put maximum price}',
                ],
                [
                    'count'         => '{Put count of voucher}',
                    'discountPercentage' => '{Put discount percentage}',
                    'name'          => '{Put name of voucher}',
                    'description'   => '{Put description}',
                    ## ============= Optional Parameters  ==============
                    'hash'          => '{Put voucher hash}',
                    'amount'        => '{Put maximum price}',
                ],
            ],
            ## =========================== Optional Parameters  ===========================
            'productId'         => ['{Put product ids}'],
            'dealerBusinessId'  => ['{Put dealer business ids}'],
            'limitedConsumerId' => '{Put user id}',
            'currencyCode'      => '{Put currency code}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->defineDiscountPercentageVoucher($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================ Apply Voucher ===================================
function applyVoucher()
{
    echo '========================== Apply Voucher =======================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'invoiceId'     => '{Put invoice id}',
            'voucherHash'   => ['{Put voucher hash}'],
            'ott'         => '{Put ott}',
            ## =========================== Optional Parameters  ===========================
            'preview'       => '{Put true/false}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->applyVoucher($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================ Get Voucher List ===================================
function getVoucherList()
{
    echo '========================== Get Voucher List =======================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            'offset'                    => '{Put offset}',
        ## =========================== Optional Parameters  ===========================
            'size'                      => '{Put output size}',
            'productId'                 => ['Put product ids'],
            'guildCode'                 => ['Put GUILD CODES'],
            'hash'                      => '{Put voucher hash}',
            'consumerId'                => '{Put user id}',
            'type'                      => '{Put voucher type}',
            'currencyCode'              => '{Put currency code}',
            'amountFrom'                => '{Put amount from}',
            'amountTo'                  => '{Put amount to}',
            'discountPercentageFrom'    => '{Put discount percentage from}',
            'discountPercentageTo'      => '{Put discount percentage to}',
            'expireDateFrom'            => '{Put expire date from (yyyy/mm/dd)}',
            'expireDateTo'              => '{Put expire date to (yyyy/mm/dd)}',
            'consumDateFrom'            => '{Put consume date from (yyyy/mm/dd)}',
            'consumDateTo'              => '{Put consume date to (yyyy/mm/dd)}',
            'usedAmountFrom'            => '{Put used amount from',
            'usedAmountTo'              => '{Put used amount to',
            'active'                    => '{true/false}',
            'used'                      => '{true/false}',
            'scVoucherHash'             => ['{Put Service Call Voucher Hash}'],
        ];
    try {
        $result = $BillingService->getVoucherList($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================= Deactivate Voucher =========================================
function deactivateVoucher()
{
    echo '========================== Deactivate Voucher =======================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'id'     => '{Put voucher id}',
            ## ## =========================== Optional Parameters  ========================
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',

        ];
    try {
        $result = $BillingService->deactivateVoucher($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================= Activate Voucher =========================================
function activateVoucher()
{
    echo '========================== Activate Voucher =======================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'id'     => '{Put voucher id}',
            ## =========================== Optional Parameters  ===========================
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->activateVoucher($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================= Define Direct Withdraw =================================
function defineDirectWithdraw($privateKey)
{
    echo '======================= Define Direct Withdraw ===================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'username'      => '{Put username}',
            'privateKey'    => 'Put private key',
            'depositNumber' => '{put Deposit number}',
            'onDemand'      => '{Put tru/false}',
            'minAmount'     => '{Put minimum amount}',
            'maxAmount'     => '{Put maximum amount}',
            'wallet'        => 'PODLAND_WALLET',
            ## =========================== Optional Parameters  ===========================
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->defineDirectWithdraw($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================= Direct Withdraw List ==================================
function directWithdrawList()
{
    echo '======================== Direct Withdraw List ==================' .PHP_EOL;
    global $BillingService;

    $param =
        [
        ## ============================ *Required Parameters  =========================
            'offset'        => '{Put offset}',
        ## =========================== Optional Parameters  ===========================
            'wallet'        => 'PODLAND_WALLET',
            'size'          => '{Put output size}',
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->directWithdrawList($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================= Update Direct Withdraw ==============================
function updateDirectWithdraw($privateKey)
{
    echo '======================== Update Direct Withdraw ====================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'id'            => '{Put direct withdraw id}',
            'username'      => '{Put username}',
            'privateKey'    => 'Put private key',
            'depositNumber' => '{put Deposit number}',
            'onDemand'      => '{Put tru/false}',
            'minAmount'     => '{Put minimum amount}',
            'maxAmount'     => '{Put maximum amount}',
            'wallet'        => 'PODLAND_WALLET',
            ## =========================== Optional Parameters  ===========================
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->updateDirectWithdraw($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ================================= Revoke Direct Withdraw ===============================
function revokeDirectWithdraw()
{
    echo '======================== Revoke Direct Withdraw ===================' .PHP_EOL;
    global $BillingService;

    $param =
        [
            ## ============================ *Required Parameters  =========================
            'id'     => '{Put Direct Withdraw id}',
            ## =========================== Optional Parameters  ===========================
            'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
            'scApiKey'           => '{Put service call Api Key}',
        ];
    try {
        $result = $BillingService->revokeDirectWithdraw($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}



