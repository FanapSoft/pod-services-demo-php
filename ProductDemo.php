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


# set serverType to SandBox or Production
BaseInfo::initServerType(BaseInfo::PRODUCTION_SERVER);
$baseInfo->setTokenIssuer(TOKEN_ISSUER);

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
            'token'                 => '{Put ApiToken}',
            'name'                  => '{Put product name}',
            'canComment'            => '{true/false}',
            'canLike'               => '{true/false}',
            'enable'                => '{true/false}',
            'availableCount'        => '{Put available count}',
            'price'                 => '{Put price}',
            'discount'              => '{Put discount}',
            ## =========================== Optional Parameters  ================================
#            'guildCode'             => '{Put guild code}',
#            'parentProductId'       => '{Put parent product id}',
            'description'           => '{Put product description}',
#            'uniqueId'              => '{Put unique id}',
            'metaData'              => '{Put json string like : {"test":"true"}}',
            'businessId'            => '{Put business id}',
#            'unlimited'             => '{true/false}',     # default : false
#            'allowUserInvoice'      =>  '{true/false}',    # default : false
#            'allowUserPrice'        =>  '{true/false}',    # default : false
#            'currencyCode'          => '{Put currency code}',
            'attTemplateCode'       => '{Put attribute template code}',
            'attributes'            =>
            [
                [
                    'attCode'       => '{Put attribute code}',
                    'attValue'      => '{Put attribute value}',
                    'attGroup'      =>  '{true/false}',
                ],
                [
                    'attCode'       => '{Put attribute code}',
                    'attValue'      => '{Put attribute value}',
                    'attGroup'      =>  '{true/false}',
                ]

            ],
#            'lat'                   => '{Put Latitude}',
#            'lng'                   => '{Put Longitude}',
            'tags'                  => '{Put tags separated with comma}',
#            'content'               => '{Put content}',
#            'previewImage'          => '{Put image address}',
#            'tagTrees'              => '{Put tag trees name separated with comma}',
#            'tagTreeCategoryName'   => '{Put tag tree category name}',
#            'preferredTaxRate'      => '{Put tax rate default is 0.09}',
#            'quantityPrecision'     => '{Put decimal digits of quantity}',

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

#addProduct();
#die();

# ============================================== add Sub Product =========================================
function addSubProduct()
{
    echo '======================================== add Sub Product =================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
            ## ============================ *Required Parameters  =============================
            'token'                 => '{Put ApiToken}',
            'name'                  => '{Put product name}',
            'availableCount'        => '{Put available count}',
            'price'                 => '{Put price}',
            'discount'              => '{Put discount}',
#            'groupId'               => '{Put group id}',
            ## =========================== Optional Parameters  ================================
#            'guildCode'             => '{Put guild code}',
#            'parentProductId'       => '{Put parent product id}',
        'description'           => '{Put product description}',
#            'uniqueId'              => '{Put unique id}',
        'metaData'              => '{Put json string like : {"test":"true"}}',
        'businessId'            => '{Put business id}',
#            'unlimited'             => '{true/false}',     # default : false
#            'allowUserInvoice'      =>  '{true/false}',    # default : false
#            'allowUserPrice'        =>  '{true/false}',    # default : false
#            'currencyCode'          => '{Put currency code}',
        'attributes'            =>
            [
                [
                    'attCode'       => '{Put attribute code}',
                    'attValue'      => '{Put attribute value}',
                    'attGroup'      =>  '{true/false}',
                ],
                [
                    'attCode'       => '{Put attribute code}',
                    'attValue'      => '{Put attribute value}',
                    'attGroup'      =>  '{true/false}',
                ]

            ],
#            'lat'                   => '{Put Latitude}',
#            'lng'                   => '{Put Longitude}',
        'tags'                  => '{Put tags separated with comma}',
#            'content'               => '{Put content}',
#            'previewImage'          => '{Put image address}',
#            'tagTrees'              => '{Put tag trees name separated with comma}',
#            'tagTreeCategoryName'   => '{Put tag tree category name}',
#            'preferredTaxRate'      => '{Put tax rate default is 0.09}',
#            'quantityPrecision'     => '{Put decimal digits of quantity}',

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
#addSubProduct();
#die();
# ============================================ add Products ==============================================
function addProducts()
{
    echo '==================================== add Products =================================' .PHP_EOL;
    global $ProductService;

    $param = [
        ## ============================ *Required Parameters  =============================
        'token'                 => '{Put apiToken}',
        'data' => [
            [
            'name'                  => '{Put product name}',
            'canComment'            => '{true/false}',
            'canLike'               => '{true/false}',
            'enable'                => '{true/false}',
            'availableCount'        => '{Put available count}',
            'price'                 => '{Put price}',
            'discount'              => '{Put discount}',
        ## =========================== Optional Parameters  ===============================
#            'guildCode'             => '{Put guild code}',
#            'parentProductId'       => '{Put parent product id}',
#            'description'           => '{Put product description}',
#            'uniqueId'              => '{Put unique id}',
#            'metaData'              => '{Put json string like : {"test":"true"}}',
#            'businessId'            => '{Put business id}',
#            'unlimited'             => '{true/false}',     # default : false
#            'allowUserInvoice'      =>  '{true/false}',    # default : false
#            'allowUserPrice'        =>  '{true/false}',    # default : false
#            'currencyCode'          => '{Put currency code}',
#            'attTemplateCode'       => '{Put attribute template code}',
#            'attributes'            =>
#                [
#                    [
#                        'attCode'       => '{Put attribute code}',
#                        'attValue'      => '{Put attribute value}',
#                        'attGroup'      =>  '{true/false}',
#                    ],
#                    [
#                        'attCode'       => '{Put attribute code}',
#                        'attValue'      => '{Put attribute value}',
#                        'attGroup'      =>  '{true/false}',
#                    ]
#                ],
#            'groupId'               => '{Put group id}',
#            'lat'                   => '{Put Latitude}',
#            'lng'                   => '{Put Longitude}',
#            'tags'                  => '{Put tags separated with comma}',
#            'content'               => '{Put content}',
#            'previewImage'          => '{Put image address}',
#            'tagTrees'              => '{Put tag trees name separated with comma}',
#            'tagTreeCategoryName'   => '{Put tag tree category name}',
#            'preferredTaxRate'      => '{Put tax rate default is 0.09}',
#            'quantityPrecision'     => '{Put decimal digits of quantity}',

            ], [
                # اطلاعات محصول بعدی ...
            ]
        ]

    ]
    ;
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

#addProducts();
#die();

# =============================================== update Product =============================================
function updateProduct()
{
    echo '===================================== update Product ================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
            ## ============================ *Required Parameters  =============================
            'token'                 => '{Put apiToken}',
            'entityId'              => '{Put entity Id of product}',
            'name'                  => '{Put product name}',
            'description'           => '{Put product description}',
            'canComment'            => '{true/false}',
            'canLike'               => '{true/false}',
            'enable'                => '{true/false}',
            'price'                 => '{Put product price}',
            'discount'              => '{Put discount}',
            'changePreview'         => '{true/false}',
#            'availableCount'        => 200,  # تعداد موجود از محصول درصورت بدون محدودیت نبودن اجباری است
        'unlimited'             => '{true/false}', # بدون محدودیت بودن محصول true/false
        ## =========================== Optional Parameters  ================================
#            'guildCode'             => 'FOOD_GUILD',
        'version'               => 4,
#            'uniqueId'              => '{Put unique id}',
#            'metaData'              => '{Put Metadata(json string)}',
#            'businessId'            => '{Put business id}',
#            'allowUserInvoice'      => '{true/false}',
#            'allowUserPrice'        => '{true/false}',
                    # توجه: درصورتی که محصول قالب نداشته باشد قابل اضافه شدن است
# در غیر این صورت قابل تغییر نمی باشد فقط مقادیر مشخصه های آن قالب را می توان تغییر داد
#            'attTemplateCode'       => '{Put attribute template code}',
#            'attributes'            =>
#                [
#                    [
#                        'attCode'       => '{Put attribute code}',
#                        'attValue'      => '{Put attribute value}',
#                        'attGroup'      =>  '{true/false}',
#                    ],
#                    [
#                        'attCode'       => '{Put attribute code}',
#                        'attValue'      => '{Put attribute value}',
#                        'attGroup'      =>  '{true/false}',
#                    ]
#                ],
#            'categories'            => ['cat1', 'cat2', ...],
#            'groupId'               => '{Put group id}',
#            'lat'                   => '{Put Latitude}',
#            'lng'                   => '{Put Longitude}',
#            'tags'                  => '{Put tags separated with comma}',
#            'content'               => '{Put content}',
#            'previewImage'          => '{Put image address}',
#            'tagTrees'              => '{Put tag trees name separated with comma}',
#            'tagTreeCategoryName'   => '{Put tag tree category name}',
#            'preferredTaxRate'      => '{Put tax rate default is 0.09}',
#            'quantityPrecision'     => '{Put decimal digits of quantity}',
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

#updateProduct();
#die();

# ============================================ update Products ====================================================
function updateProducts()
{
    echo '================================== update Products ======================================' .PHP_EOL;
    global $ProductService;

    $param =
        [
            'token'                 => '4d3d6b85e2e844b0ade83cc2ec5b4c85',
            'data' =>
                [[
                    ## ============================ *Required Parameters  =============================
                    'entityId'              => 31588,
                    'name'                  => 'محصول ویرایش شده',
                    'description'           => 'ویرایش محصول',
                    'canComment'            => false,
                    'canLike'               => false,
                    'enable'                => true,
                    'price'                 => 40000,
                    'discount'              => 10,
                    'changePreview'         => true,
#            'availableCount'        => 200,  # تعداد موجود از محصول درصورت بدون محدودیت نبودن اجباری است
                    'unlimited'             => true, # بدون محدودیت بودن محصول true/false
                    ## =========================== Optional Parameters  ================================
#            'guildCode'             => 'FOOD_GUILD',
#                'version'               => 7,
#            'uniqueId'              => '',
#            'metaData'              => '',
#            'businessId'            => '',
#            'allowUserInvoice'      => '',
#            'allowUserPrice'        => '',
                    'attTemplateCode'       => 'مانتو',
                    'attributes'            =>
                        [
                            [
                                'attCode'       => 'gender',
                                'attValue'      => 'زن',
                                'attGroup'      => false,
                            ],
                            [
                                'attCode'       => 'color',
                                'attValue'      => 'سبز',
                                'attGroup'      => false,
                            ],

                            [
                                'attCode'       => 'size',
                                'attValue'      => 'L',
                                'attGroup'      => true,
                            ],

                        ],
#            'groupId'               => '',
#            'categories'            => [],
#            'lat'                   => '',
#            'lng'                   => '',
#            'tags'                  => '',
#            'content'               => '',
#            'previewImage'          => '',
#            'tagTrees'              => '',
#            'tagTreeCategoryName'   => '',
#            'preferredTaxRate'      => '',
#            'quantityPrecision'     => '',
                ],
                    [
                        ## ============================ *Required Parameters  =============================
                        'entityId'              => 31653,
                        'name'                  => 'محصول ویرایش شده',
                        'description'           => 'ویرایش محصول',
                        'canComment'            => false,
                        'canLike'               => false,
                        'enable'                => true,
                        'price'                 => 40000,
                        'discount'              => 10,
                        'changePreview'         => true,
#            'availableCount'        => 200,  # تعداد موجود از محصول درصورت بدون محدودیت نبودن اجباری است
                        'unlimited'             => true, # بدون محدودیت بودن محصول true/false
                        ## =========================== Optional Parameters  ================================
#            'guildCode'             => 'FOOD_GUILD',
#                'version'               => 6,
#            'uniqueId'              => '',
#            'metaData'              => '',
#            'businessId'            => '',
#            'allowUserInvoice'      => '',
#            'allowUserPrice'        => '',
                        'attTemplateCode'       => 'مانتو',
                        'attributes'            =>
                            [
                                [
                                    'attCode'       => 'gender',
                                    'attValue'      => 'زن',
                                    'attGroup'      => false,
                                ],
                                [
                                    'attCode'       => 'color',
                                    'attValue'      => 'سبز',
                                    'attGroup'      => false,
                                ],

                                [
                                    'attCode'       => 'size',
                                    'attValue'      => 'L',
                                    'attGroup'      => true,
                                ],

                            ],
#            'groupId'               => '',
#            'categories'            => [],
#            'lat'                   => '',
#            'lng'                   => '',
#            'tags'                  => '',
#            'content'               => '',
#            'previewImage'          => '',
#            'tagTrees'              => '',
#            'tagTreeCategoryName'   => '',
#            'preferredTaxRate'      => '',
#            'quantityPrecision'     => '',
                    ]]
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

#updateProducts();
#die();

# ============================================= get product List ================================================
function getProductList()
{
    echo '===================================== get product List ===================================' .PHP_EOL;
    global $ProductService;

    $param =
        [## ============================ *Required Parameters  =============================
            'token'                 => '4d3d6b85e2e844b0ade83cc2ec5b4c85', # ApiToken or AccessToken
            'size'                  => 50,
            'offset'                => 0,
            ## ============================= Optional Parameters  ==============================
#            'id'                    => [31653,31654],
#            'businessId'            => 3612, # خطا میده
#            'uniqueId'              => '',
#            'categoryCode'          => [],
#            'guildCode'             => ['CLOTHING_GUILD', 'FOOD_GUILD'],
#            'currencyCode'          => '',
#            'firstId'               => 24472, # خطا میده
#            'lastId'                => 31650,
#            'attributeTemplateCode' => '',
#            'attributes'            => [
#                [
#                    'attributeCode'   => 'gender',
#                    'attributeValue'  => 'زن',
#                ],
#             ],
#            'orderByLike'           => 'asc', # خطا میده
        'orderByPrice'          => 'asc', # خطا میده
        'tags'                  => ['tag1'],
#            'tagTrees'              => [],
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
#getProductList();
#die();

# ============================================ business ProductList ====================================================
function getBusinessProductList()
{
    echo '=================================== business ProductList ===================================' .PHP_EOL;
    global $ProductService;

    $param =
        [## ============================ *Required Parameters  =============================
            'token'                 => '4d3d6b85e2e844b0ade83cc2ec5b4c85', # ApiToken or AccessToken
#            'size'                  => 50,
        'offset'                => 0,
        ## ============================= Optional Parameters  ==============================
#            'id'                    => [31653,31654],
#            'businessId'            => 3612,
#            'uniqueId'              => '',
#            'categoryCode'          => [],
#            'guildCode'             => ['CLOTHING_GUILD', 'FOOD_GUILD'],
#            'currencyCode'          => '',
#            'firstId'               => 31653,
#            'lastId'                => '',
#            'attributeTemplateCode' => '',
#        'attributes'            => [
#            [
#                'attributeCode'   => 'gender',
#                'attributeValue'  => 'زن',
#            ],
#        ],
        'orderBySale'           => 'asc',
#            'orderByLike'           => 'asc', # خطا میده
#            'orderByPrice'          => 'desc', # خطا میده
#            'tags'                  => ['tag1'],
#            'tagTrees'              => [],
        'scope'                 => 'DEALER_PRODUCT_PERMISSION',
#            'attributeSearchQuery'  => '',
#            'scVoucherHash'         => '',
#            'scApiKey'              => '',

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

getBusinessProductList();
die();

# ======================================== attribute Template List ===================================================
function getAttributeTemplateList()
{
    echo '===================================== attribute Template List ===================================' .PHP_EOL;
    global $ProductService;

    $param =
        [## ============================ *Required Parameters  =============================
            'token'                 => '4d3d6b85e2e844b0ade83cc2ec5b4c85', # ApiToken or AccessToken
#            'size'                  => 50,
#            'offset'                => 0,
        ## =========================== Optional Parameters  ================================
#        'firstId'               => 40,
#            'lastId'                => 100,  # id هارو نمایش نمیده که بر اساس اونها مرتب کنیم

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

#getAttributeTemplateList();
#die();

# ======================================== search Product ===================================================
function searchProduct()
{
    echo '===================================== search Product ===================================' .PHP_EOL;
    global $ProductService;

    $param =
        [## ============================ *Required Parameters  =============================
            'token'                 => '4d3d6b85e2e844b0ade83cc2ec5b4c85', # ApiToken or AccessToken
#            'size'                  => 50,
#            'offset'                => 0,
        ## ============================= Optional Parameters  ==============================
#            'q'                    => 'pod',
        'id'                    => [24523,24475],
#            'businessId'            => 3612, # خطا میده
#            'uniqueId'              => '',
#            'categoryCode'          => [],
#            'guildCode'             => ['CLOTHING_GUILD', 'FOOD_GUILD'],
#            'currencyCode'          => '',
#            'firstId'               => 24472, # خطا میده
#            'lastId'                => 31650,
#            'attributeTemplateCode' => '',
        'attributes'            => [
            [
                'attributeCode'   => 'gender',
                'attributeValue'  => 'زن',
            ],
        ],
#            'orderByLike'           => 'asc', # خطا میده
#        'orderByPrice'          => 'asc', # خطا میده
        'orderBySale'           => 'asc',
#        'tags'                  => ['tag1'],
#            'tagTrees'              => [],
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

searchProduct();
die();
