<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);
# ============================================= Notification SERVICES ==================================================

# required classes
use Pod\Notification\Service\NotificationService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

# set serverType to SandBox or Production
BaseInfo::initServerType(BaseInfo::PRODUCTION_SERVER);

$baseInfo = new BaseInfo();
$baseInfo->setToken("{put token}");

#  instantiates a BillingService
$NotificationService = new NotificationService($baseInfo);

# ================================================= Notification =======================================================
# ======================================================================================================================

# ==================================================== send SMS ========================================================
function sendSMS()
{
    echo "============================================= send SMS ==========================================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ===================================
        "content" => [
            ## ======== Required Parameters ==============
            "content" => "Hello World!",
            "mobileNumbers" => ["mobileNumber1", "mobileNumber2"], # sms receptors
            ## ======== Optional Parameters  =============
//            "scheduler" => "", # send message in particular date time yyyy-MM-dd HH:mm
        ],
        ## ============================ Optional Parameters  ==================================
//        "serviceName" => ""
    ];
    try {
        $result = $NotificationService->sendSMS($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
# =================================================== get SMS Status ===================================================
function getSMSStatus()
{
    echo "=========================================== get SMS Status ========================================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "messageId" => '{put message id}'
    ];
    try {
        $result = $NotificationService->getSMSStatus($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//getSMSStatus();
# =============================================== send Validation SMS ==================================================
function sendValidationSMS()
{
    echo "======================================= send Validation SMS ======================================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "content" => [
            ## ======== Required Parameters ==============
            "receptor" => "{mobile number}",
            "token" => "{variable in message}",
            "template" => "{testTemplate}"  # message template
            ## ======== Optional Parameters  =============
//        "token2" => "{}"
//        "token3" => "{}"
//        "type" => "{}"
        ]
    ];
    try {
        $result = $NotificationService->sendValidationSMS($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
# ============================================ get Validation SMS Status ===============================================
function getValidationSMSStatus()
{
    echo "==================================== get Validation SMS Status ===================================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "messageId" => '{put message id}'
    ];
    try {
        $result = $NotificationService->getValidationSMSStatus($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//getValidationSMSStatus();

function sendEmail()
{
    echo "====================================== send Email ===================================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "content" => [
            ## ======== Required Parameters ==============
            "to" => ["e.keshtgar@gmail.com"],
            ## ======== Optional Parameters  =============
            "subject" => "تست ارسال ایمیل فناپ",
            "content" => "test email without html format",
            "replyAddress" => "el.keshtgar@gmail.com",
            "cc" => "el.keshtgar@gmail.com",
//            "bcc" => "el.keshtgar@gmail.com",
//            "fileHashes" => "",
//            "scheduler" => "1398/06/03 11:29"
        ],
        # ============================ Optional Parameters  ==================================
//        "sreviceName" => ""
    ];
    try {
        $result = $NotificationService->sendEmail($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//sendEmail();

function getEmailList()
{
    echo "====================================== get Email List ===================================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Optional Parameters  ==================================
//        "offset" => 0,
//        "size" => "",
//        "orderBy" => "",
//        "order" => "",
        "filter" => "message,subject",
        "filterValue" => "dude",
    ];
    try {
        $result = $NotificationService->getEmailList($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//getEmailList();


function getEmailInfo()
{
    echo "====================================== get Email Info ===================================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Optional Parameters  ==================================
        "messageId" => "{put message id of email}",
    ];
    try {
        $result = $NotificationService->getEmailInfo($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
getEmailInfo();

function pushNotificationByPeerId()
{
    echo "================================= push Notification By Peer Id ===================================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "content" => [
            ## ======== Required Parameters ==============
            "receivers" => ["3838142"],
            ## ======== Optional Parameters  =============
            "title" => "test push notification",
            "text" => "test",
            "extra" => "test",
//            "scheduler" => "1398/06/03 12:59",
        ]
    ];
    try {
        $result = $NotificationService->pushNotificationByPeerId($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//pushNotificationByPeerId();

function pushNotificationByAppId()
{
    echo "=============================== push Notification By Application Id ==============================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "content" => [
            ## ======== Required Parameters ==============
            "appId" => "podnotification",
            ## ======== Optional Parameters  =============
            "title" => "test push notification",
            "text" => "test",
//            "scheduler" => "1398/06/03 12:59",
        ]
    ];
    try {
        $result = $NotificationService->pushNotificationByAppId($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//pushNotificationByAppId();

function pushNotificationStatusAll()
{
    echo "=============================== push Notification Status All ==============================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "messageId" => "d42108da-58b3-445c-a780-59c0bfae5256"
    ];
    try {
        $result = $NotificationService->pushNotificationStatusAll($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//pushNotificationStatusAll();

function pushNotificationStatusReceived()
{
    echo "=============================== push Notification Status Received ==============================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "messageId" => "d42108da-58b3-445c-a780-59c0bfae5256"
    ];
    try {
        $result = $NotificationService->pushNotificationStatusReceived($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
//pushNotificationStatusReceived();

function pushNotificationStatusSeen()
{
    echo "=============================== push Notification Status Seen ==============================" .PHP_EOL;
    global $NotificationService;
    $params = [
        ## ============================ Required Parameters  ==================================
        "messageId" => "d42108da-58b3-445c-a780-59c0bfae5256"
    ];
    try {
        $result = $NotificationService->pushNotificationStatusSeen($params);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
pushNotificationStatusSeen();
