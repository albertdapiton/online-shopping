<?php

declare(strict_types=1);

use example\Mutation\ExampleMutation;
use example\Query\ExampleQuery;
use example\Type\ExampleRelationType;
use example\Type\ExampleType;

return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each route
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    // ]
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Rebing\GraphQL\GraphQLController@query',
    //     'mutation' => '\Rebing\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Rebing\GraphQL\GraphQLController::class.'@query',

    // Any middleware for the graphql route group
    'middleware' => [],

    // Additional route group attributes
    //
    // Example:
    //
    // 'route_group_attributes' => ['guard' => 'api']
    //
    'route_group_attributes' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\ProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //      'user/me' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\MyProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //  ]
    //
    'schemas' => [
        'default' => [
            'query' => [
                'roles'     => App\GraphQL\Queries\RolesQuery::class,
                //'users'     => App\GraphQL\Queries\UsersQuery::class,
            ],
            'mutation' => [
                
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
        'billings'  => [
            'query' => [
                App\GraphQL\Queries\BillingsQuery::class,
            ],
            'middleware' => ['auth:api'],
            'method' => ['get'],
        ],
        'checkout'  => [
            'query' => [],
            'mutation' => [
                'orderItems' => App\GraphQL\Mutations\CheckoutMutation::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
        'register' => [
            'query' => [],
            'mutation' => [
                App\GraphQL\Mutations\RegisterUserMutation::class
            ],
            'middleware' => [],
            'method' => ['post'],
        ],
        'me'    => [
            'query' => [
                //App\GraphQL\Queries\MeQuery::class
            ],
            'mutation' => [
                'billing' => App\GraphQL\Mutations\BillingMutation::class,
                'profile'   => App\GraphQL\Mutations\UserMutation::class,
                'shipping' => App\GraphQL\Mutations\ShippingMutation::class,
            ],
            'middleware' => ['auth:api'],
            'method' => ['get', 'post'],
        ],
        'order' => [
            'query' => [
                App\GraphQL\Queries\OrderQuery::class
            ],
            'mutation' => [

            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
        'orders' => [
            'query' => [
                App\GraphQL\Queries\OrdersQuery::class
            ],
            'mutation' => [
                
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
        'payment' => [
            'query' => [
                App\GraphQL\Queries\PaymentQuery::class
            ],
            'mutation' => [
                App\GraphQL\Mutations\PaymentMutation::class
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
        'payments' => [
            'query' => [
                App\GraphQL\Queries\PaymentsQuery::class
            ],
            'mutation' => [
                App\GraphQL\Mutations\PaymentMutation::class
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
        'products' => [
            'query' => [
                'product'   => App\GraphQL\Queries\ProductQuery::class,
                'products'  => App\GraphQL\Queries\ProductsQuery::class,
            ],
            'mutation' => [
                'createProduct' => App\GraphQL\Mutations\Products\CreateProductMutation::class,
                'deleteProduct' => App\GraphQL\Mutations\Products\DeleteProductMutation::class,
                'updateProduct' => App\GraphQL\Mutations\Products\UpdateProductMutation::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post', 'put'],
        ],
        'shippings'  => [
            'query' => [
                App\GraphQL\Queries\ShippingsQuery::class,
            ],
            'middleware' => ['auth:api'],
            'method' => ['get'],
        ],
        'user'  => [
            'query' => [
                App\GraphQL\Queries\UserQuery::class
            ],
            'mutation' => [
                'UpdateUserMutation'    => App\GraphQL\Mutations\UpdateUserMutation::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
        'users' => [
            'query' => [
                'billings'  => App\GraphQL\Queries\UserBillingsQuery::class,
                'shippings' => App\GraphQL\Queries\UserShippingsQuery::class,
                'user'      => App\GraphQL\Queries\UserQuery::class,
                'users'     => App\GraphQL\Queries\UsersQuery::class,
            ],
            'mutation' => [
                'createBilling'     => App\GraphQL\Mutations\Users\CreateUserBillingMutation::class,
                'createUser'        => App\GraphQL\Mutations\Users\CreateUserMutation::class,
                'createShipping'    => App\GraphQL\Mutations\Users\CreateUserShippingMutation::class,
                'deleteBilling'     => App\GraphQL\Mutations\Users\DeleteUserBillingMutation::class,
                'deleteUser'        => App\GraphQL\Mutations\Users\DeleteUserMutation::class,
                'deleteShipping'    => App\GraphQL\Mutations\Users\DeleteUserShippingMutation::class,
                'updateBilling'     => App\GraphQL\Mutations\Users\UpdateUserBillingMutation::class,
                'updateUser'        => App\GraphQL\Mutations\Users\UpdateUserMutation::class,
                'updateShipping'    => App\GraphQL\Mutations\Users\UpdateUserShippingMutation::class,
            ],
            'middleware' => ['auth:api'],
            'method' => ['get', 'post', 'put'],
        ],
        'verify' => [
            'mutation' => [
                'verifyUserEmail' => App\GraphQL\Mutations\VerifyMutation::class
            ],
            'middleware' => [],
            'method' => ['get'],
        ],
    ], 
    'types' => [
        'AccessToken'   => App\GraphQL\Types\AccessTokenType::class,
        'BillingInput'  => App\GraphQL\InputTypes\BillingInputType::class,
        'BillingType'   => App\GraphQL\Types\BillingType::class,
        'Checkout'      => App\GraphQL\Types\CheckoutType::class,
        'ItemInput'     => App\GraphQL\InputTypes\ItemInputType::class,
        'Order'         => App\GraphQL\Types\OrderType::class,
        'OrderItem'     => App\GraphQL\Types\OrderItemType::class,
        'OrderBilling'  => App\GraphQL\Types\OrderBillingType::class,
        'OrderShipping' => App\GraphQL\Types\OrderShippingType::class,
        'Payment'       => App\GraphQL\Types\PaymentType::class,
        'PaymentInput'  => App\GraphQL\InputTypes\PaymentInputType::class,
        'ProductType'   => App\GraphQL\Types\ProductType::class,
        'Profile'       => App\GraphQL\Types\ProfileType::class,
        'Role'          => App\GraphQL\Types\RoleType::class,
        'ShippingInput' => App\GraphQL\InputTypes\ShippingInputType::class,
        'ShippingType'  => App\GraphQL\Types\ShippingType::class,
        'User'          => App\GraphQL\Types\UserType::class,
    ],

    // The types will be loaded on demand. Default is to load all types on each request
    // Can increase performance on schemes with many types
    // Presupposes the config type key to match the type class name property
    'lazyload_types' => false,

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://webonyx.github.io/graphql-php/security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix' => '/graphiql',
        'controller' => \Rebing\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', true),
    ],

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     *
     * Example:
     *
     * ```php
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     * },
     * ```
     * or
     * ```php
     * 'defaultFieldResolver' => [SomeKlass::class, 'someMethod'],
     * ```
     */
    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,
];
