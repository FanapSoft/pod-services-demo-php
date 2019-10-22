<?php
require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

# ============================================== Product SERVICES =================================================
# required classes
use Pod\Product\Service\ProductService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

$baseInfo = new BaseInfo();
$baseInfo->setToken(API_TOKEN);
$baseInfo->setTokenIssuer(TOKEN_ISSUER);

#  instantiates a ProductService
$ProductService = new ProductService($baseInfo);


# ================================================ add Product ===========================================
function addProduct()
{
    echo '======================================== add Product =================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
            ## ============================ *Required Parameters  =============================
            'name'                  => 'Put product name',
            'canComment'            => 'true/false',
            'canLike'               => 'true/false',
            'enable'                => 'true/false',
            'availableCount'        => 'Put available count',
            'price'                 => 'Put price',
            'discount'              => 'Put discount',
            ## =========================== Optional Parameters  ================================
#            'apiToken'              => 'Put ApiToken',
#            'guildCode'             => 'Put guild code',
#            'parentProductId'       => 'Put parent product id',
#            'description'           => 'Put product description',
#            'uniqueId'              => 'Put unique id',
#            'metaData'              => 'Put json string like : {"test":"true"}',
#            'businessId'            => 'Put business id',
#            'unlimited'             => 'true/false',     # default : false
#            'allowUserInvoice'      =>  'true/false',    # default : false
#            'allowUserPrice'        =>  'true/false',    # default : false
#            'currencyCode'          => 'Put currency code',
#            'attTemplateCode'       => 'Put attribute template code',
#            'attributes'            =>
#            [
#                [
#                    'attCode'       => 'Put attribute code',
#                    'attValue'      => 'Put attribute value',
#                    'attGroup'      =>  'true/false',
#                ],
#                [
#                    'attCode'       => 'Put attribute code',
#                    'attValue'      => 'Put attribute value',
#                    'attGroup'      =>  'true/false',
#                ]
#
#            ],
#            'lat'                   => 'Put Latitude',
#            'lng'                   => 'Put Longitude',
#            'tags'                  => 'Put tags separated with comma',
#            'content'               => 'Put content',
#            'previewImage'          => 'Put image address',
#            'tagTrees'              => 'Put tag trees name separated with comma',
#            'tagTreeCategoryName'   => 'Put tag tree category name',
#            'preferredTaxRate'      => 'Put tax rate default is 0.09',
#            'quantityPrecision'     => 'Put decimal digits of quantity',
#            'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#            'scApiKey'           => 'Put service call Api Key',
    ];
    try {
        $result = $ProductService->addProduct($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================== add Sub Product =========================================
function addSubProduct()
{
    echo '======================================== add Sub Product =================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
            ## ============================ *Required Parameters  =============================
            'name'                  => 'Put product name',
            # ‌یکی از دو فیلد unlimited و availableCount اجباری است
            'unlimited'             => 'true/false',     # default : false
            'availableCount'        => 'Put available count',
            'price'                 => 'Put price',
            'discount'              => 'Put discount',
            'groupId'               => 'Put group id',
            ## =========================== Optional Parameters  ================================
#            'apiToken'              => 'Put ApiToken',
#            'guildCode'             => 'Put guild code',
#            'parentProductId'       => 'Put parent product id',
#            'description'           => 'Put product description',
#            'uniqueId'              => 'Put unique id',
#            'metaData'              => 'Put json string like : {"test":"true"}',
#            'businessId'            => 'Put business id',
#            'allowUserInvoice'      => 'true/false',    # default : false
#            'allowUserPrice'        => 'true/false',    # default : false
#            'currencyCode'          => 'Put currency code',
#            'attributes'            =>
#            [
#                [
#                    'attCode'       => 'Put attribute code',
#                    'attValue'      => 'Put attribute value',
#                    'attGroup'      =>  'true/false',
#                ],
#                [
#                    'attCode'       => 'Put attribute code',
#                    'attValue'      => 'Put attribute value',
#                    'attGroup'      =>  'true/false',
#                ]
#            ],
#            'tags'                  => 'Put tags separated with comma',
#            'content'               => 'Put content',
#            'previewImage'          => 'Put image address',
#            'tagTrees'              => 'Put tag trees name separated with comma',
#            'tagTreeCategoryName'   => 'Put tag tree category name',
#            'preferredTaxRate'      => 'Put tax rate default is 0.09',
#            'quantityPrecision'     => 'Put decimal digits of quantity',
#            'scVoucherHash'        => ['Put Service Call Voucher Hashes'],
#            'scApiKey'             => 'Put service call Api Key',
    ];
    try {
        $result = $ProductService->addSubProduct($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================ add Products ==============================================
function addProducts()
{
    echo '==================================== add Products =================================' .PHP_EOL;
    global $ProductService;

    $param = [
        ## ============================ *Required Parameters  =============================
        'data' => [
            [
            'name'                  => 'Put product name',
            'canComment'            => 'true/false',
            'canLike'               => 'true/false',
            'enable'                => 'true/false',
            'availableCount'        => 'Put available count',
            'price'                 => 'Put price',
            'discount'              => 'Put discount',
        ## ============ Optional Parameters  ============
#            'guildCode'             => 'Put guild code',
#            'parentProductId'       => 'Put parent product id',
#            'description'           => 'Put product description',
#            'uniqueId'              => 'Put unique id',
#            'metaData'              => 'Put json string like : {"test":"true"}',
#            'businessId'            => 'Put business id',
#            'unlimited'             => 'true/false',     # default : false
#            'allowUserInvoice'      =>  'true/false',    # default : false
#            'allowUserPrice'        =>  'true/false',    # default : false
#            'currencyCode'          => 'Put currency code',
#            'attTemplateCode'       => 'Put attribute template code',
#            'attributes'            =>
#                [
#                    [
#                        'attCode'       => 'Put attribute code',
#                        'attValue'      => 'Put attribute value',
#                        'attGroup'      =>  'true/false',
#                    ],
#                    [
#                        'attCode'       => 'Put attribute code',
#                        'attValue'      => 'Put attribute value',
#                        'attGroup'      =>  'true/false',
#                    ]
#                ],
#            'groupId'               => 'Put group id',
#            'lat'                   => 'Put Latitude',
#            'lng'                   => 'Put Longitude',
#            'tags'                  => 'Put tags separated with comma',
#            'content'               => 'Put content',
#            'previewImage'          => 'Put image address',
#            'tagTrees'              => 'Put tag trees name separated with comma',
#            'tagTreeCategoryName'   => 'Put tag tree category name',
#            'preferredTaxRate'      => 'Put tax rate default is 0.09',
#            'quantityPrecision'     => 'Put decimal digits of quantity',

            ], [
                # اطلاعات محصول بعدی ...
            ],
      ## =========================== Optional Parameters  ===============================
#            'apiToken'              => 'Put ApiToken',
#            'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#            'scApiKey'           => 'Put service call Api Key',

        ]
    ];
    try {
        $result = $ProductService->addProducts($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# =============================================== update Product =============================================
function updateProduct()
{
    echo '===================================== update Product ================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
            ## ============================ *Required Parameters  =============================
            'entityId'              => 'Put entity Id of product',
            'name'                  => 'Put product name',
            'description'           => 'Put product description',
            'canComment'            => 'true/false',
            'canLike'               => 'true/false',
            'enable'                => 'true/false',
            'price'                 => 'Put product price',
            'discount'              => 'Put discount',
            'changePreview'         => 'true/false',
#            'availableCount'        => 200,  # تعداد موجود از محصول درصورت بدون محدودیت نبودن اجباری است
            'unlimited'             => 'true/false', # بدون محدودیت بودن محصول true/false
        ## =========================== Optional Parameters  ================================
#            'apiToken'              => 'Put ApiToken',
#            'guildCode'             => 'FOOD_GUILD',
#            'version'               => 4,
#            'uniqueId'              => 'Put unique id',
#            'metaData'              => 'Put Metadata(json string)',
#            'businessId'            => 'Put business id',
#            'allowUserInvoice'      => 'true/false',
#            'allowUserPrice'        => 'true/false',
        # توجه: درصورتی که محصول قالب نداشته باشد قابل اضافه شدن است
# در غیر این صورت قابل تغییر نمی باشد فقط مقادیر مشخصه های آن قالب را می توان تغییر داد
#            'attTemplateCode'       => 'Put attribute template code',
#            'attributes'            =>
#                [
#                    [
#                        'attCode'       => 'Put attribute code',
#                        'attValue'      => 'Put attribute value',
#                        'attGroup'      =>  'true/false',
#                    ],
#                    [
#                        'attCode'       => 'Put attribute code',
#                        'attValue'      => 'Put attribute value',
#                        'attGroup'      =>  'true/false',
#                    ]
#                ],
#            'categories'            => ['cat1', 'cat2', ...],
#            'groupId'               => 'Put group id',
#            'lat'                   => 'Put Latitude',
#            'lng'                   => 'Put Longitude',
#            'tags'                  => 'Put tags separated with comma',
#            'content'               => 'Put content',
#            'previewImage'          => 'Put image address',
#            'tagTrees'              => 'Put tag trees name separated with comma',
#            'tagTreeCategoryName'   => 'Put tag tree category name',
#            'preferredTaxRate'      => 'Put tax rate default is 0.09',
#            'quantityPrecision'     => 'Put decimal digits of quantity',
#            'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#            'scApiKey'           => 'Put service call Api Key',
    ];
    try {
        $result = $ProductService->updateProduct($param);
        print_r($result);
    }
    catch (ValidationException $e) {
#        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================ update Products ====================================================
function updateProducts()
{
    echo '================================== update Products ======================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
            'data' =>
                [        [
                    ## ============================ *Required Parameters  =============================
                    'entityId'              => 'Put entity Id of product',
                    'name'                  => 'Put product name',
                    'description'           => 'Put product description',
                    'canComment'            => 'true/false',
                    'canLike'               => 'true/false',
                    'enable'                => 'true/false',
                    'price'                 => 'Put product price',
                    'discount'              => 'Put discount',
                    'changePreview'         => 'true/false',
#            'availableCount'        => 200,  # تعداد موجود از محصول درصورت بدون محدودیت نبودن اجباری است
                    'unlimited'             => 'true/false', # بدون محدودیت بودن محصول true/false
                    ## =========================== Optional Parameters  ================================
#            'apiToken'              => 'Put ApiToken',
#            'guildCode'             => 'FOOD_GUILD',
#            'version'               => 4,
#            'uniqueId'              => 'Put unique id',
#            'metaData'              => 'Put Metadata(json string)',
#            'businessId'            => 'Put business id',
#            'allowUserInvoice'      => 'true/false',
#            'allowUserPrice'        => 'true/false',
                    # توجه: درصورتی که محصول قالب نداشته باشد قابل اضافه شدن است
# در غیر این صورت قابل تغییر نمی باشد فقط مقادیر مشخصه های آن قالب را می توان تغییر داد
#            'attTemplateCode'       => 'Put attribute template code',
#            'attributes'            =>
#                [
#                    [
#                        'attCode'       => 'Put attribute code',
#                        'attValue'      => 'Put attribute value',
#                        'attGroup'      =>  'true/false',
#                    ],
#                    [
#                        'attCode'       => 'Put attribute code',
#                        'attValue'      => 'Put attribute value',
#                        'attGroup'      =>  'true/false',
#                    ]
#                ],
#            'categories'            => ['cat1', 'cat2', ...],
#            'groupId'               => 'Put group id',
#            'lat'                   => 'Put Latitude',
#            'lng'                   => 'Put Longitude',
#            'tags'                  => 'Put tags separated with comma',
#            'content'               => 'Put content',
#            'previewImage'          => 'Put image address',
#            'tagTrees'              => 'Put tag trees name separated with comma',
#            'tagTreeCategoryName'   => 'Put tag tree category name',
#            'preferredTaxRate'      => 'Put tax rate default is 0.09',
#            'quantityPrecision'     => 'Put decimal digits of quantity',
#            'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#            'scApiKey'           => 'Put service call Api Key',
                ], # ... اطلاعات محصول بعدی
            ],
            ## =========================== Optional Parameters  ===============================
            'apiToken'              => 'Put ApiToken',
            'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
            'scApiKey'           => 'Put service call Api Key',
        ];
    try {
        $result = $ProductService->updateProducts($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================= get product List ================================================
function getProductList()
{
    echo '===================================== get product List ===================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
        ## ============================ *Required Parameters  =============================
            # یکی از این چهار فیلد اجباری است
            'offset'                => 'Put offset',
            'firstId'               => 'Put first id',
            'lastId'                => 'Put last id',
            'id'                    => ['{Put product entity ids}'],
        ## ============================= Optional Parameters  ==============================
#            "token"                 => "{Put AccessToken | ApiToken}", # for this service you can use AccessToken
#            'size'                  => 50,
#            'businessId'            => 'Put business id',
#            'uniqueId'              => 'Put product unique id',
#            'categoryCode'          => [{Put product category codes}],
#            'guildCode'             => [{Put guild codes}],
#            'currencyCode'          => 'Put currency code',
#            'firstId'               => 'Put first id',
#            'lastId'                => 'Put last id',
#            'attributeTemplateCode' => 'Put attribute template code',
#            'attributes'            => [
#                [
#                    'attributeCode'   => 'Put attribute code',
#                    'attributeValue'  => 'Put attribute value',
#                ],
#             ],
#            'orderByLike'           => 'put asc/desc',
#            'orderByPrice'          => 'put asc/desc',
#            'tags'                  => [Put tags1, Put tags2, ..],
#            'tagTrees'              => [Put tags tree1, Put tags tree2, ..],
#            'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#            'scApiKey'           => 'Put service call Api Key',
    ];
    try {
        $result = $ProductService->getProductList($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ============================================ business ProductList ====================================================
function getBusinessProductList()
{
    echo '=================================== business ProductList ===================================' .PHP_EOL;
    global $ProductService;

    $param =
        [## ============================ *Required Parameters  =============================
            # یکی از این چهار فیلد اجباری است
            'offset'                => 'Put offset',
#            'firstId'               => 'Put first id',
#            'lastId'                => 'Put last id',
#            'id'                    => [{Put product entity ids}],
        ## ============================= Optional Parameters  ==============================
#            'apiToken'              => 'Put ApiToken',
#            'size'                  => 'Put output size',
#            'businessId'            => 'Put business id',
#            'uniqueId'              => 'Put product unique id',
#            'categoryCode'          => [{Put product category codes}],
#            'guildCode'             => [{Put guild codes}],
#            'currencyCode'          => 'Put currency code',
#            'attributeTemplateCode' => 'Put attribute template code',
#            'attributes'            => [
#                [
#                    'attributeCode'   => 'Put attribute code',
#                    'attributeValue'  => 'Put attribute value',
#                ],
#             ],
#            'orderBySale'           => 'put asc/desc',
#            'orderByLike'           => 'put asc/desc',
#            'orderByPrice'          => 'put asc/desc',
#            'tags'                  => ['Put tags1', 'Put tags2', ..],
#            'tagTrees'              => ['Put tags tree1', 'Put tags tree2', ..],
#            'scope'                 => 'Put scope',
#            'attributeSearchQuery'  => 'Put search query',
#            'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#            'scApiKey'           => 'Put service call Api Key',
    ];
    try {
        $result = $ProductService->getBusinessProductList($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ======================================== attribute Template List ===================================================
function getAttributeTemplateList()
{
    echo '===================================== attribute Template List ===================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
        ## ============================ *Required Parameters  =============================
            # یکی از این سه فیلد اجباری است
            'offset'                => 'Put offset',
            'firstId'               => 'Put first id',
            'lastId'                => 'Put last id',
        ## =========================== Optional Parameters  ================================
#            "token"                 => "{Put AccessToken | ApiToken}", # for this service you can use AccessToken
#            'size'                  => 'Put output size',
#            'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#            'scApiKey'           => 'Put service call Api Key',
    ];
    try {
        $result = $ProductService->getAttributeTemplateList($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ======================================== search Product ===================================================
function searchProduct()
{
    echo '===================================== search Product ===================================' .PHP_EOL;
    global $ProductService;

    $param =
        [## ============================ *Required Parameters  =============================
            # یکی از این چهار فیلد اجباری است
            'offset'                => 'Put offset',
#            'firstId'               => 'Put first id',
#            'lastId'                => 'Put last id',
#            'id'                    => [Put product entity ids],
        ## ============================= Optional Parameters  ==============================
#            "token"                 => "{Put AccessToken | ApiToken}", # for this service you can use AccessToken     
#            'query'                 => 'Put search query',
#            'size'                  => 'Put output size',
#            'businessId'            => 'Put business id',
#            'uniqueId'              => 'Put product unique id',
#            'categoryCode'          => [{Put product category codes}],
#            'guildCode'             => [{Put guild codes}],
#            'currencyCode'          => 'Put currency code',
#            'attributeTemplateCode' => 'Put attribute template code',
#            'attributes'            => [
#                [
#                    'attributeCode'   => 'Put attribute code',
#                    'attributeValue'  => 'Put attribute value',
#                ],
#             ],
#            'orderBySale'           => 'put asc/desc',
#            'orderByLike'           => 'put asc/desc',
#            'orderByPrice'          => 'put asc/desc',
#            'tags'                  => ['Put tags1', 'Put tags2', ..],
#            'tagTrees'              => ['Put tags tree1', 'Put tags tree2', ..],
#           'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#           'scApiKey'           => 'Put service call Api Key',
    ];
    try {
        $result = $ProductService->searchProduct($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}

# ======================================== search Sub Product ===================================================
function searchSubProduct()
{
    echo "===================================== search Sub Product ===================================" .PHP_EOL;
    global $ProductService;

    $param =
        [## ============================ *Required Parameters  =============================
            "productGroupId"                => ['Put product group ids'],
        ## ============================= Optional Parameters  ==============================
#            "token"             => "{Put AccessToken}", # for this service we can use AccessToken
#            "query"                   => "Put search query",
#            'attributes'            => [
#                [
#                    'attributeCode'   => 'Put attribute code',
#                    'attributeValue'  => 'Put attribute value',
#                ],
#             ],
#          "orderByAttributeCode"           => "put asc | desc",
#          "orderByDirection"          => "put asc | desc",
#          "tags"                  => ["put tag1", ...],
#          "tagTrees"              => ["put tag tree 1", ...],
#          'scVoucherHash'     => ['Put Service Call Voucher Hashes'],
#          'scApiKey'           => 'Put service call Api Key',
    ];
    try {
        $result = $ProductService->searchSubProduct($param);
        print_r($result);
    }
    catch (ValidationException $e) {
        print_r($e->getResult());
        print_r($e->getErrorsAsArray());
    } catch (PodException $e) {
        print_r($e->getResult());
    }
}
