<?php

/**
 * @license MIT
 * @package WalkerChiu\Core
 */

/*
|--------------------------------------------------------------------------
| Prefix
|--------------------------------------------------------------------------
|
| Identify each table in the database.
|
*/

$prefix = 'wk';
$config = [
    /*
    |--------------------------------------------------------------------------
    | Prefix
    |--------------------------------------------------------------------------
    |
    | Identify each table in the database.
    |
    */
    'prefix' => $prefix,

    /*
    |--------------------------------------------------------------------------
    | Language & Timezone
    |--------------------------------------------------------------------------
    |
    | Set default value for all package.
    |
    */
    'language' => 'en_us',
    'timezone' => 'Asia/Taipei',

    /*
    |--------------------------------------------------------------------------
    | Datetime
    |--------------------------------------------------------------------------
    |
    | Set format for all package.
    |
    */
    'datetime' => [
        'onoff'  => true,
        'format' => 'Y-m-d H:i:s',
        'null'   => '-'
    ],

    /*
    |--------------------------------------------------------------------------
    | FormRequest
    |--------------------------------------------------------------------------
    |
    | 1: Laravel Native.
    | 2: Just simple JSON.
    | 3: Custom JSON Format.
    |
    */
    'formRequest' => [
        'returnType' => 3
    ],

    /*
    |--------------------------------------------------------------------------
    | TrustedProxies
    |--------------------------------------------------------------------------
    |
    | Set trusted proxies to get client ip address.
    |
    */
    'trustedProxies' => ['192.168.0.1'],

    /*
    |--------------------------------------------------------------------------
    | Switch association of package to On or Off
    |--------------------------------------------------------------------------
    |
    | When you set someone On:
    |     1. Its Foreign Key Constraints will be created together with data table.
    |     2. You may need to change the corresponding class settings in the config/wk-core.php.
    |
    | When you set someone Off:
    |     1. Association check will not be performed on FormRequest and Observer.
    |     2. Cleaner and Initializer will not handle tasks related to it.
    |
    | Note:
    |     The association still exists, which means you can still access related objects.
    |
    */
    'onoff' => [
        /* If it is enabled, all packages will use it,
           otherwise it will only be used when the specified package is not enabled.*/
        'core-lang_core' => 1,

        'morph-tag' => 0
    ],

    /*
    |--------------------------------------------------------------------------
    | Lang Log
    |--------------------------------------------------------------------------
    |
    | 0: Don't keep data.
    | 1: Keep data.
    |
    */
    /* If it is enabled, all packages will use it,
       otherwise it will only be used when the specified package is not enabled.*/
    'lang_log' => 0,

    /*
    |--------------------------------------------------------------------------
    | Output Data Format from Repository
    |--------------------------------------------------------------------------
    |
    | null:                  Query.
    | query:                 Query.
    | collection:            Query collection.
    | collection_pagination: Query collection with pagination.
    | array:                 Array.
    | array_pagination:      Array with pagination.
    |
    */
    'output_format' => null,

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    */
    'pagination' => [
        'pageName' => 'page',
        'perPage'  => 15
    ],

    /*
    |--------------------------------------------------------------------------
    | Command
    |--------------------------------------------------------------------------
    |
    | Location of Commands.
    |
    */
    'command' => [
        'cleaner'    => 'WalkerChiu\Core\Console\Commands\Cleaner',
        'logCleaner' => 'WalkerChiu\Core\Console\Commands\LogCleaner'
    ],

    /*
    |--------------------------------------------------------------------------
    | Location of tables.
    |--------------------------------------------------------------------------
    |
    */
    'table' => [
        'core' => [
            'lang_core'    => 'core_langs_core',
            'logs'         => 'core_logs',
            'logs_request' => 'core_logs_request',
            'logs_search'  => 'core_logs_search',
            'logs_sys'     => 'core_logs_sys'
        ],
        'account' => [
            'profiles' => 'account_profiles'
        ],
        'api' => [
            'settings'      => 'api_settings',
            'settings_lang' => 'api_settings_lang'
        ],
        'blog' => [
            'articles'    => 'blog_articles',
            'blogs'       => 'blog_blogs',
            'blogs_lang'  => 'blog_blogs_lang',
            'follows'     => 'blog_follows',
            'likes'       => 'blog_likes',
            'tags'        => 'blog_tags',
            'tags_morphs' => 'blog_tags_morphs',
            'touches'     => 'blog_touches'
        ],
        'coupon' => [
            'coupons'      => 'coupon_coupons',
            'coupons_lang' => 'coupon_coupons_lang'
        ],
        'currency' => [
            'currencies'      => 'currency_currencies',
            'currencies_lang' => 'currency_currencies_lang'
        ],
        'device' => [
            'devices'      => 'device_devices',
            'devices_lang' => 'device_devices_lang'
        ],
        'device-sensor' => [
            'devices'                => 'device_sensor_devices',
            'devices_lang'           => 'device_sensor_devices_lang',
            'devices_registers'      => 'device_sensor_devices_registers',
            'devices_registers_lang' => 'device_sensor_devices_registers_lang',
            'devices_states'         => 'device_sensor_devices_states',
            'devices_states_lang'    => 'device_sensor_devices_states_lang',
            'data'                   => 'device_sensor_data'
        ],
        'device-modbus' => [
            'channels'             => 'device_modbus_channels',
            'channels_lang'        => 'device_modbus_channels_lang',
            'main'                 => 'device_modbus_main',
            'main_lang'            => 'device_modbus_main_lang',
            'main_states'          => 'device_modbus_main_state',
            'main_states_lang'     => 'device_modbus_main_state_lang',
            'settings'             => 'device_modbus_settings',
            'settings_lang'        => 'device_modbus_settings_lang',
            'settings_states'      => 'device_modbus_settings_state',
            'settings_states_lang' => 'device_modbus_settings_state_lang',
            'addresses'            => 'device_modbus_addresses',
            'addresses_lang'       => 'device_modbus_addresses_lang',
            'data'                 => 'device_modbus_data'
        ],
        'device-rfid' => [
            'readers'                => 'device_rfid_readers',
            'readers_lang'           => 'device_rfid_readers_lang',
            'readers_registers'      => 'device_rfid_readers_registers',
            'readers_registers_lang' => 'device_rfid_readers_registers_lang',
            'readers_states'         => 'device_rfid_readers_states',
            'readers_states_lang'    => 'device_rfid_readers_states_lang',
            'cards'                  => 'device_rfid_cards',
            'cards_lang'             => 'device_rfid_cards_lang',
            'data'                   => 'device_rfid_data'
        ],
        'firewall' => [
            'settings'      => 'firewall_settings',
            'settings_lang' => 'firewall_settings_lang',
            'items'         => 'firewall_items'
        ],
        'friendship' => [
            'friendships' => 'friendship_friendships'
        ],
        'group' => [
            'groups'        => 'groups',
            'groups_lang'   => 'groups_lang',
            'groups_morphs' => 'groups_morphs'
        ],
        'mall-cart' => [
            'channels'      => 'mall_cart_channels',
            'channels_lang' => 'mall_cart_channels_lang',
            'items'         => 'mall_cart_items'
        ],
        'mall-order' => [
            'orders'  => 'mall_order_orders',
            'reviews' => 'mall_order_reviews'
        ],
        'mall-shelf' => [
            'products'       => 'mall_shelf_products',
            'products_lang'  => 'mall_shelf_products_lang',
            'catalogs'       => 'mall_shelf_catalogs',
            'catalogs_lang'  => 'mall_shelf_catalogs_lang',
            'stocks'         => 'mall_shelf_stocks',
            'stocks_lang'    => 'mall_shelf_stocks_lang',
            'relations'      => 'mall_shelf_relations',
            'relations_lang' => 'mall_shelf_relations_lang'
        ],
        'mall-tablerate' => [
            'settings'      => 'mall_tablerate_settings',
            'settings_lang' => 'mall_tablerate_settings_lang',
            'items'         => 'mall_tablerate_items'
        ],
        'mall-wishlist' => [
            'items'  => 'mall_wishlist_items'
        ],
        'morph-address' => [
            'addresses'      => 'morph_addresses',
            'addresses_lang' => 'morph_addresses_lang'
        ],
        'morph-board' => [
            'boards'      => 'morph_boards',
            'boards_lang' => 'morph_boards_lang'
        ],
        'morph-category' => [
            'categories'        => 'morph_categories',
            'categories_lang'   => 'morph_categories_lang',
            'categories_morphs' => 'morph_categories_morphs'
        ],
        'morph-comment' => [
            'comments'      => 'morph_comments',
            'comments_lang' => 'morph_comments_lang'
        ],
        'morph-image' => [
            'images'      => 'morph_images',
            'images_lang' => 'morph_images_lang'
        ],
        'morph-nav' => [
            'navs'      => 'morph_navs',
            'navs_lang' => 'morph_navs_lang'
        ],
        'morph-rank' => [
            'levels'        => 'morph_levels',
            'levels_lang'   => 'morph_levels_lang',
            'statuses'      => 'morph_statuses',
            'statuses_lang' => 'morph_statuses_lang'
        ],
        'morph-registration' => [
            'registrations' => 'morph_registrations'
        ],
        'morph-tag' => [
            'tags'        => 'morph_tags',
            'tags_lang'   => 'morph_tags_lang',
            'tags_morphs' => 'morph_tags_morphs'
        ],
        'morph-link' => [
            'links'      => 'morph_links',
            'links_lang' => 'morph_links_lang'
        ],
        'newsletter' => [
            'articles'      => 'newsletter_articles',
            'settings'      => 'newsletter_settings',
            'settings_lang' => 'newsletter_settings_lang'
        ],
        'payment' => [
            'payments'      => 'payments',
            'payments_lang' => 'payments_lang',
            'applepay'      => 'payments_applepay',
            'alipay'        => 'payments_alipay',
            'banks'         => 'payments_banks',
            'ecpay'         => 'payments_ecpay',
            'esafe'         => 'payments_esafe',
            'ezpay'         => 'payments_ezpay',
            'googlepay'     => 'payments_googlepay',
            'linepay'       => 'payments_linepay',
            'newebpay'      => 'payments_newebpay',
            'paypal'        => 'payments_paypal',
            'recon'         => 'payments_recon',
            'ttpay'         => 'payments_ttpay'
        ],
        'point' => [
            'settings'      => 'point_settings',
            'settings_lang' => 'point_settings_lang',
            'wallets'       => 'point_wallets',
            'logs'          => 'point_logs'
        ],
        'role' => [
            'roles'             => 'role_roles',
            'roles_lang'        => 'role_roles_lang',
            'permissions'       => 'role_permissions',
            'permissions_lang'  => 'role_permissions_lang',
            'roles_permissions' => 'role_roles_permissions',
            'users_roles'       => 'role_users_roles'
        ],
        'role-simple' => [
            'roles'             => 'role_simple_roles',
            'permissions'       => 'role_simple_permissions',
            'roles_permissions' => 'role_simple_roles_permissions',
            'users_roles'       => 'role_simple_users_roles'
        ],
        'rule' => [
            'rules'           => 'rule_rules',
            'rules_lang'      => 'rule_rules_lang',
            'situations'      => 'rule_situations',
            'situations_lang' => 'rule_situations_lang',
            'conditions'      => 'rule_conditions',
            'tasks'           => 'rule_tasks',
            'tasks_lang'      => 'rule_tasks_lang',
            'variables'       => 'rule_variables'
        ],
        'rule-hit' => [
            'rulehits'      => 'rule_rulehits',
            'rulehits_lang' => 'rule_rulehits_lang'
        ],
        'shipment' => [
            'settings'        => 'shipment_settings',
            'settings_lang'   => 'shipment_settings_lang',
            'e_can'           => 'shipment_e_can',
            'eflocker'        => 'shipment_eflocker',
            'fedex'           => 'shipment_fedex',
            'hct'             => 'shipment_hct',
            'kerry_express'   => 'shipment_kerry_express',
            'ktj'             => 'shipment_ktj',
            'morning_express' => 'shipment_morning_express',
            'post'            => 'shipment_post',
            'post_box'        => 'shipment_post_box',
            'presco'          => 'shipment_presco',
            'reyi'            => 'shipment_reyi',
            'sf_express'      => 'shipment_sf_express',
            'sf_plus'         => 'shipment_sf_plus',
            'shipany'         => 'shipment_shipany',
            't_cat'           => 'shipment_t_cat',
            'ups'             => 'shipment_ups'
        ],
        'site' => [
            'sites'        => 'site_sites',
            'sites_lang'   => 'site_sites_lang',
            'emails'       => 'site_emails',
            'emails_lang'  => 'site_emails_lang',
            'layouts'      => 'site_layouts',
            'layouts_lang' => 'site_layouts_lang'
        ],

        // Other package
        'user' => 'users'
    ],

    /*
    |--------------------------------------------------------------------------
    | Location of classes.
    |--------------------------------------------------------------------------
    |
    */
    'class' => [
        'core' => [
            'baud'                 => 'WalkerChiu\Core\Models\Constants\Baud',
            'condition'            => 'WalkerChiu\Core\Models\Constants\Condition',
            'countryZone'          => 'WalkerChiu\Core\Models\Constants\CountryZone',
            'dataType'             => 'WalkerChiu\Core\Models\Constants\DataType',
            'filter'               => 'WalkerChiu\Core\Models\Constants\Filter',
            'language'             => 'WalkerChiu\Core\Models\Constants\Language',
            'operator'             => 'WalkerChiu\Core\Models\Constants\Operator',
            'parity'               => 'WalkerChiu\Core\Models\Constants\Parity',
            'stopbit'              => 'WalkerChiu\Core\Models\Constants\Stopbit',
            'timeZone'             => 'WalkerChiu\Core\Models\Constants\TimeZone',
            'langCore'             => 'WalkerChiu\Core\Models\Entities\LangCore',
            'langCoreObserver'     => 'WalkerChiu\Core\Models\Observers\LangCoreObserver',
            'log'                  => 'WalkerChiu\Core\Models\Entities\Log',
            'logObserver'          => 'WalkerChiu\Core\Models\Observers\LogObserver',
            'logRepository'        => 'WalkerChiu\Core\Models\Repositories\LogRepository',
            'logRequest'           => 'WalkerChiu\Core\Models\Entities\LogRequest',
            'logRequestObserver'   => 'WalkerChiu\Core\Models\Observers\LogRequestObserver',
            'logRequestRepository' => 'WalkerChiu\Core\Models\Repositories\LogRequestRepository',
            'logSearch'            => 'WalkerChiu\Core\Models\Entities\LogSearch',
            'logSearchObserver'    => 'WalkerChiu\Core\Models\Observers\LogSearchObserver',
            'logSearchRepository'  => 'WalkerChiu\Core\Models\Repositories\LogSearchRepository',
            'logSys'               => 'WalkerChiu\Core\Models\Entities\LogSys',
            'logSysObserver'       => 'WalkerChiu\Core\Models\Observers\LogSysObserver',
            'logSysRepository'     => 'WalkerChiu\Core\Models\Repositories\LogSysRepository',
            'commonMiddleware'     => 'WalkerChiu\Core\Middleware\CommonMiddleware',
            'locale'               => 'WalkerChiu\Core\Middleware\Locale',
            'preventBackHistory'   => 'WalkerChiu\Core\Middleware\PreventBackHistory'
        ],
        'user' => config('auth.providers.users.model'),
        'account' => [
            'memberRepository'  => 'WalkerChiu\Account\Models\Repositories\MemberRepository',
            'profile'           => 'WalkerChiu\Account\Models\Entities\Profile',
            'profileObserver'   => 'WalkerChiu\Account\Models\Observers\ProfileObserver',
            'profileRepository' => 'WalkerChiu\Account\Models\Repositories\ProfileRepository'
        ],
        'api' => [
            'setting'             => 'WalkerChiu\API\Models\Entities\Setting',
            'settingLang'         => 'WalkerChiu\API\Models\Entities\SettingLang',
            'settingObserver'     => 'WalkerChiu\API\Models\Observers\SettingObserver',
            'settingLangObserver' => 'WalkerChiu\API\Models\Observers\SettingLangObserver',
            'settingRepository'   => 'WalkerChiu\API\Models\Repositories\SettingRepository'
        ],
        'blog' => [
            'article'             => 'WalkerChiu\Blog\Models\Entities\Article',
            'articleObserver'     => 'WalkerChiu\Blog\Models\Observers\ArticleObserver',
            'articleRepository'   => 'WalkerChiu\Blog\Models\Repositories\ArticleRepository',
            'blog'                => 'WalkerChiu\Blog\Models\Entities\Blog',
            'blogLang'            => 'WalkerChiu\Blog\Models\Entities\BlogLang',
            'blogObserver'        => 'WalkerChiu\Blog\Models\Observers\BlogObserver',
            'blogLangObserver'    => 'WalkerChiu\Blog\Models\Observers\BlogLangObserver',
            'blogRepository'      => 'WalkerChiu\Blog\Models\Repositories\BlogRepository',
            'follow'              => 'WalkerChiu\Blog\Models\Entities\Follow',
            'followObserver'      => 'WalkerChiu\Blog\Models\Observers\FollowObserver',
            'followRepository'    => 'WalkerChiu\Blog\Models\Repositories\FollowRepository',
            'like'                => 'WalkerChiu\Blog\Models\Entities\Like',
            'likeObserver'        => 'WalkerChiu\Blog\Models\Observers\LikeObserver',
            'likeRepository'      => 'WalkerChiu\Blog\Models\Repositories\LikeRepository',
            'tag'                 => 'WalkerChiu\Blog\Models\Entities\Tag',
            'tagObserver'         => 'WalkerChiu\Blog\Models\Observers\TagObserver',
            'touch'               => 'WalkerChiu\Blog\Models\Entities\Touch',
            'touchObserver'       => 'WalkerChiu\Blog\Models\Observers\TouchObserver',
            'touchRepository'     => 'WalkerChiu\Blog\Models\Repositories\TouchRepository'
        ],
        'coupon' => [
            'coupon'             => 'WalkerChiu\Coupon\Models\Entities\Coupon',
            'couponObserver'     => 'WalkerChiu\Coupon\Models\Observers\CouponObserver',
            'couponRepository'   => 'WalkerChiu\Coupon\Models\Repositories\CouponRepository',
            'couponLang'         => 'WalkerChiu\Coupon\Models\Entities\CouponLang',
            'couponLangObserver' => 'WalkerChiu\Coupon\Models\Observers\CouponLangObserver'
        ],
        'currency' => [
            'currency'             => 'WalkerChiu\Currency\Models\Entities\Currency',
            'currencyObserver'     => 'WalkerChiu\Currency\Models\Observers\CurrencyObserver',
            'currencyRepository'   => 'WalkerChiu\Currency\Models\Repositories\CurrencyRepository',
            'currencyLang'         => 'WalkerChiu\Currency\Models\Entities\CurrencyLang',
            'currencyLangObserver' => 'WalkerChiu\Currency\Models\Observers\CurrencyLangObserver'
        ],
        'device' => [
            'device'             => 'WalkerChiu\Device\Models\Entities\Device',
            //'device'             => 'WalkerChiu\Device\Models\Entities\DeviceWithImage',
            'deviceObserver'     => 'WalkerChiu\Device\Models\Observers\DeviceObserver',
            'deviceRepository'   => 'WalkerChiu\Device\Models\Repositories\DeviceRepository',
            'deviceLang'         => 'WalkerChiu\Device\Models\Entities\DeviceLang',
            'deviceLangObserver' => 'WalkerChiu\Device\Models\Observers\DeviceLangObserver'
        ],
        'device-sensor' => [
            'device'                     => 'WalkerChiu\DeviceSensor\Models\Entities\Device',
            //'device'                     => 'WalkerChiu\DeviceSensor\Models\Entities\DeviceWithImage',
            'deviceObserver'             => 'WalkerChiu\DeviceSensor\Models\Observers\DeviceObserver',
            'deviceRepository'           => 'WalkerChiu\DeviceSensor\Models\Repositories\DeviceRepository',
            'deviceLang'                 => 'WalkerChiu\DeviceSensor\Models\Entities\DeviceLang',
            'deviceLangObserver'         => 'WalkerChiu\DeviceSensor\Models\Observers\DeviceLangObserver',
            'deviceRegister'             => 'WalkerChiu\DeviceSensor\Models\Entities\DeviceRegister',
            'deviceRegisterObserver'     => 'WalkerChiu\DeviceSensor\Models\Observers\DeviceRegisterObserver',
            'deviceRegisterRepository'   => 'WalkerChiu\DeviceSensor\Models\Repositories\DeviceRegisterRepository',
            'deviceRegisterLang'         => 'WalkerChiu\DeviceSensor\Models\Entities\DeviceRegisterLang',
            'deviceRegisterLangObserver' => 'WalkerChiu\DeviceSensor\Models\Observers\DeviceRegisterLangObserver',
            'deviceState'                => 'WalkerChiu\DeviceSensor\Models\Entities\DeviceState',
            'deviceStateObserver'        => 'WalkerChiu\DeviceSensor\Models\Observers\DeviceStateObserver',
            'deviceStateRepository'      => 'WalkerChiu\DeviceSensor\Models\Repositories\DeviceStateRepository',
            'deviceStateLang'            => 'WalkerChiu\DeviceSensor\Models\Entities\DeviceStateLang',
            'deviceStateLangObserver'    => 'WalkerChiu\DeviceSensor\Models\Observers\DeviceStateLangObserver',
            'data'                       => 'WalkerChiu\DeviceSensor\Models\Entities\Data',
            'dataRepository'             => 'WalkerChiu\DeviceSensor\Models\Repositories\DataRepository',
            'dataObserver'               => 'WalkerChiu\DeviceSensor\Models\Observers\DataObserver'
        ],
        'device-modbus' => [
            'format'       => 'WalkerChiu\DeviceModbus\Models\Constants\Format',
            'functionCode' => 'WalkerChiu\DeviceModbus\Models\Constants\FunctionCode',
            'protocolType' => 'WalkerChiu\DeviceModbus\Models\Constants\ProtocolType',
            'typology'     => 'WalkerChiu\DeviceModbus\Models\Constants\Typology',

            'channel'             => 'WalkerChiu\DeviceModbus\Models\Entities\Channel',
            'channelObserver'     => 'WalkerChiu\DeviceModbus\Models\Observers\ChannelObserver',
            'channelRepository'   => 'WalkerChiu\DeviceModbus\Models\Repositories\ChannelRepository',
            'channelLang'         => 'WalkerChiu\DeviceModbus\Models\Entities\ChannelLang',
            'channelLangObserver' => 'WalkerChiu\DeviceModbus\Models\Observers\ChannelLangObserver',

            'main'                  => 'WalkerChiu\DeviceModbus\Models\Entities\Main',
            'mainObserver'          => 'WalkerChiu\DeviceModbus\Models\Observers\MainObserver',
            'mainRepository'        => 'WalkerChiu\DeviceModbus\Models\Repositories\MainRepository',
            'mainLang'              => 'WalkerChiu\DeviceModbus\Models\Entities\MainLang',
            'mainLangObserver'      => 'WalkerChiu\DeviceModbus\Models\Observers\MainLangObserver',
            'mainState'             => 'WalkerChiu\DeviceModbus\Models\Entities\MainState',
            'mainStateObserver'     => 'WalkerChiu\DeviceModbus\Models\Observers\MainStateObserver',
            'mainStateRepository'   => 'WalkerChiu\DeviceModbus\Models\Repositories\MainStateRepository',
            'mainStateLang'         => 'WalkerChiu\DeviceModbus\Models\Entities\MainStateLang',
            'mainStateLangObserver' => 'WalkerChiu\DeviceModbus\Models\Observers\MainStateLangObserver',

            'setting'                  => 'WalkerChiu\DeviceModbus\Models\Entities\Setting',
            'settingObserver'          => 'WalkerChiu\DeviceModbus\Models\Observers\SettingObserver',
            'settingRepository'        => 'WalkerChiu\DeviceModbus\Models\Repositories\SettingRepository',
            'settingLang'              => 'WalkerChiu\DeviceModbus\Models\Entities\SettingLang',
            'settingLangObserver'      => 'WalkerChiu\DeviceModbus\Models\Observers\SettingLangObserver',
            'settingState'             => 'WalkerChiu\DeviceModbus\Models\Entities\SettingState',
            'settingStateObserver'     => 'WalkerChiu\DeviceModbus\Models\Observers\SettingStateObserver',
            'settingStateRepository'   => 'WalkerChiu\DeviceModbus\Models\Repositories\SettingStateRepository',
            'settingStateLang'         => 'WalkerChiu\DeviceModbus\Models\Entities\SettingStateLang',
            'settingStateLangObserver' => 'WalkerChiu\DeviceModbus\Models\Observers\SettingStateLangObserver',

            'address'             => 'WalkerChiu\DeviceModbus\Models\Entities\Address',
            'addressObserver'     => 'WalkerChiu\DeviceModbus\Models\Observers\AddressObserver',
            'addressRepository'   => 'WalkerChiu\DeviceModbus\Models\Repositories\AddressRepository',
            'addressLang'         => 'WalkerChiu\DeviceModbus\Models\Entities\AddressLang',
            'addressLangObserver' => 'WalkerChiu\DeviceModbus\Models\Observers\AddressLangObserver',

            'data'           => 'WalkerChiu\DeviceModbus\Models\Entities\Data',
            'dataRepository' => 'WalkerChiu\DeviceModbus\Models\Repositories\DataRepository',
            'dataObserver'   => 'WalkerChiu\DeviceModbus\Models\Observers\DataObserver'
        ],
        'device-rfid' => [
            'reader'                     => 'WalkerChiu\DeviceRFID\Models\Entities\Reader',
            //'reader'                     => 'WalkerChiu\DeviceRFID\Models\Entities\ReaderWithImage',
            'readerObserver'             => 'WalkerChiu\DeviceRFID\Models\Observers\ReaderObserver',
            'readerRepository'           => 'WalkerChiu\DeviceRFID\Models\Repositories\ReaderRepository',
            'readerLang'                 => 'WalkerChiu\DeviceRFID\Models\Entities\ReaderLang',
            'readerLangObserver'         => 'WalkerChiu\DeviceRFID\Models\Observers\ReaderLangObserver',
            'readerRegister'             => 'WalkerChiu\DeviceRFID\Models\Entities\ReaderRegister',
            'readerRegisterObserver'     => 'WalkerChiu\DeviceRFID\Models\Observers\ReaderRegisterObserver',
            'readerRegisterRepository'   => 'WalkerChiu\DeviceRFID\Models\Repositories\ReaderRegisterRepository',
            'readerRegisterLang'         => 'WalkerChiu\DeviceRFID\Models\Entities\ReaderRegisterLang',
            'readerRegisterLangObserver' => 'WalkerChiu\DeviceRFID\Models\Observers\ReaderRegisterLangObserver',
            'readerState'                => 'WalkerChiu\DeviceRFID\Models\Entities\ReaderState',
            'readerStateObserver'        => 'WalkerChiu\DeviceRFID\Models\Observers\ReaderStateObserver',
            'readerStateRepository'      => 'WalkerChiu\DeviceRFID\Models\Repositories\ReaderStateRepository',
            'readerStateLang'            => 'WalkerChiu\DeviceRFID\Models\Entities\ReaderStateLang',
            'readerStateLangObserver'    => 'WalkerChiu\DeviceRFID\Models\Observers\ReaderStateLangObserver',
            'card'                       => 'WalkerChiu\DeviceRFID\Models\Entities\Card',
            //'card'                       => 'WalkerChiu\DeviceRFID\Models\Entities\CardWithImage',
            'cardObserver'               => 'WalkerChiu\DeviceRFID\Models\Observers\CardObserver',
            'cardRepository'             => 'WalkerChiu\DeviceRFID\Models\Repositories\CardRepository',
            'cardLang'                   => 'WalkerChiu\DeviceRFID\Models\Entities\CardLang',
            'cardLangObserver'           => 'WalkerChiu\DeviceRFID\Models\Observers\CardLangObserver',
            'data'                       => 'WalkerChiu\DeviceRFID\Models\Entities\Data',
            'dataRepository'             => 'WalkerChiu\DeviceRFID\Models\Repositories\DataRepository',
            'dataObserver'               => 'WalkerChiu\DeviceRFID\Models\Observers\DataObserver'
        ],
        'firewall' => [
            'setting'             => 'WalkerChiu\Firewall\Models\Entities\Setting',
            'settingObserver'     => 'WalkerChiu\Firewall\Models\Observers\SettingObserver',
            'settingRepository'   => 'WalkerChiu\Firewall\Models\Repositories\SettingRepository',
            'settingLang'         => 'WalkerChiu\Firewall\Models\Entities\SettingLang',
            'settingLangObserver' => 'WalkerChiu\Firewall\Models\Observers\SettingLangObserver',
            'item'                => 'WalkerChiu\Firewall\Models\Entities\Item',
            'itemObserver'        => 'WalkerChiu\Firewall\Models\Observers\ItemObserver',
            'itemRepository'      => 'WalkerChiu\Firewall\Models\Repositories\ItemRepository'
        ],
        'friendship' => [
            'friendshipState'      => 'WalkerChiu\Friendship\Models\Constants\FriendshipState',
            'friendship'           => 'WalkerChiu\Friendship\Models\Entities\Friendship',
            'friendshipObserver'   => 'WalkerChiu\Friendship\Models\Observers\FriendshipObserver',
            'friendshipRepository' => 'WalkerChiu\Friendship\Models\Repositories\FriendshipRepository'
        ],
        'group' => [
            'group'             => 'WalkerChiu\Group\Models\Entities\Group',
            //'group'             => 'WalkerChiu\Group\Models\Entities\GroupWithImage',
            'groupObserver'     => 'WalkerChiu\Group\Models\Observers\GroupObserver',
            'groupRepository'   => 'WalkerChiu\Group\Models\Repositories\GroupRepository',
            //'groupRepository'   => 'WalkerChiu\Group\Models\Repositories\GroupRepositoryWithImage',
            'groupLang'         => 'WalkerChiu\Group\Models\Entities\GroupLang',
            'groupLangObserver' => 'WalkerChiu\Group\Models\Observers\GroupLangObserver'
        ],
        'mall-cart' => [
            'channel'             => 'WalkerChiu\MallCart\Models\Entities\Channel',
            'channelObserver'     => 'WalkerChiu\MallCart\Models\Observers\ChannelObserver',
            'channelRepository'   => 'WalkerChiu\MallCart\Models\Repositories\ChannelRepository',
            'channelLang'         => 'WalkerChiu\MallCart\Models\Entities\ChannelLang',
            'channelLangObserver' => 'WalkerChiu\MallCart\Models\Observers\ChannelLangObserver',
            'item'                => 'WalkerChiu\MallCart\Models\Entities\Item',
            'itemObserver'        => 'WalkerChiu\MallCart\Models\Observers\ItemObserver',
            'itemRepository'      => 'WalkerChiu\MallCart\Models\Repositories\ItemRepository'
        ],
        'mall-order' => [
            'orderState'       => 'WalkerChiu\MallOrder\Models\Constants\OrderState',
            'order'            => 'WalkerChiu\MallOrder\Models\Entities\Order',
            'orderObserver'    => 'WalkerChiu\MallOrder\Models\Observers\OrderObserver',
            'orderRepository'  => 'WalkerChiu\MallOrder\Models\Repositories\OrderRepository',
            'review'           => 'WalkerChiu\MallOrder\Models\Entities\Review',
            'reviewObserver'   => 'WalkerChiu\MallOrder\Models\Observers\ReviewObserver',
            'reviewRepository' => 'WalkerChiu\MallOrder\Models\Repositories\ReviewRepository'
        ],
        'mall-shelf' => [
            'product'              => 'WalkerChiu\MallShelf\Models\Entities\Product',
            'productObserver'      => 'WalkerChiu\MallShelf\Models\Observers\ProductObserver',
            'productRepository'    => 'WalkerChiu\MallShelf\Models\Repositories\ProductRepository',
            'productLang'          => 'WalkerChiu\MallShelf\Models\Entities\ProductLang',
            'productLangObserver'  => 'WalkerChiu\MallShelf\Models\Observers\ProductLangObserver',
            'catalog'              => 'WalkerChiu\MallShelf\Models\Entities\Catalog',
            'catalogObserver'      => 'WalkerChiu\MallShelf\Models\Observers\CatalogObserver',
            'catalogRepository'    => 'WalkerChiu\MallShelf\Models\Repositories\CatalogRepository',
            'catalogLang'          => 'WalkerChiu\MallShelf\Models\Entities\CatalogLang',
            'catalogLangObserver'  => 'WalkerChiu\MallShelf\Models\Observers\CatalogLangObserver',
            'stock'                => 'WalkerChiu\MallShelf\Models\Entities\Stock',
            'stockObserver'        => 'WalkerChiu\MallShelf\Models\Observers\StockObserver',
            'stockRepository'      => 'WalkerChiu\MallShelf\Models\Repositories\StockRepository',
            'stockLang'            => 'WalkerChiu\MallShelf\Models\Entities\StockLang',
            'stockLangObserver'    => 'WalkerChiu\MallShelf\Models\Observers\StockLangObserver',
            'relation'             => 'WalkerChiu\MallShelf\Models\Entities\Relation',
            'relationObserver'     => 'WalkerChiu\MallShelf\Models\Observers\RelationObserver',
            'relationRepository'   => 'WalkerChiu\MallShelf\Models\Repositories\RelationRepository',
            'relationLang'         => 'WalkerChiu\MallShelf\Models\Entities\RelationLang',
            'relationLangObserver' => 'WalkerChiu\MallShelf\Models\Observers\RelationLangObserver'
        ],
        'mall-tablerate' => [
            'setting'             => 'WalkerChiu\MallTableRate\Models\Entities\Setting',
            'settingObserver'     => 'WalkerChiu\MallTableRate\Models\Observers\SettingObserver',
            'settingRepository'   => 'WalkerChiu\MallTableRate\Models\Repositories\SettingRepository',
            'settingLang'         => 'WalkerChiu\MallTableRate\Models\Entities\SettingLang',
            'settingLangObserver' => 'WalkerChiu\MallTableRate\Models\Observers\SettingLangObserver',
            'item'                => 'WalkerChiu\MallTableRate\Models\Entities\Item',
            'itemObserver'        => 'WalkerChiu\MallTableRate\Models\Observers\ItemObserver',
            'itemRepository'      => 'WalkerChiu\MallTableRate\Models\Repositories\ItemRepository'
        ],
        'mall-wishlist' => [
            'item'           => 'WalkerChiu\MallWishlist\Models\Entities\Item',
            'itemObserver'   => 'WalkerChiu\MallWishlist\Models\Observers\ItemObserver',
            'itemRepository' => 'WalkerChiu\MallWishlist\Models\Repositories\ItemRepository'
        ],
        'morph-address' => [
            'addressType'         => 'WalkerChiu\MorphAddress\Models\Constants\AddressType',
            'address'             => 'WalkerChiu\MorphAddress\Models\Entities\Address',
            'addressObserver'     => 'WalkerChiu\MorphAddress\Models\Observers\AddressObserver',
            'addressRepository'   => 'WalkerChiu\MorphAddress\Models\Repositories\AddressRepository',
            'addressLang'         => 'WalkerChiu\MorphAddress\Models\Entities\AddressLang',
            'addressLangObserver' => 'WalkerChiu\MorphAddress\Models\Observers\AddressLangObserver'
        ],
        'morph-board' => [
            'boardType'         => 'WalkerChiu\MorphBoard\Models\Constants\BoardType',
            'board'             => 'WalkerChiu\MorphBoard\Models\Entities\Board',
            //'board'             => 'WalkerChiu\MorphBoard\Models\Entities\BoardWithImage',
            //'board'             => 'WalkerChiu\MorphBoard\Models\Entities\BoardWithImageAndLink',
            'boardObserver'     => 'WalkerChiu\MorphBoard\Models\Observers\BoardObserver',
            'boardRepository'   => 'WalkerChiu\MorphBoard\Models\Repositories\BoardRepository',
            //'boardRepository'   => 'WalkerChiu\MorphBoard\Models\Repositories\BoardRepositoryWithComment',
            'boardLang'         => 'WalkerChiu\MorphBoard\Models\Entities\BoardLang',
            'boardLangObserver' => 'WalkerChiu\MorphBoard\Models\Observers\BoardLangObserver'
        ],
        'morph-category' => [
            'morphType'            => 'WalkerChiu\MorphCategory\Models\Constants\MorphType',
            'category'             => 'WalkerChiu\MorphCategory\Models\Entities\Category',
            //'category'             => 'WalkerChiu\MorphCategory\Models\Entities\CategoryWithImage',
            //'category'             => 'WalkerChiu\MorphCategory\Models\Entities\CategoryWithImageAndLink',
            'categoryObserver'     => 'WalkerChiu\MorphCategory\Models\Observers\CategoryObserver',
            'categoryRepository'   => 'WalkerChiu\MorphCategory\Models\Repositories\CategoryRepository',
            //'categoryRepository'   => 'WalkerChiu\MorphCategory\Models\Repositories\CategoryRepositoryWithImage',
            'categoryLang'         => 'WalkerChiu\MorphCategory\Models\Entities\CategoryLang',
            'categoryLangObserver' => 'WalkerChiu\MorphCategory\Models\Observers\CategoryLangObserver'
        ],
        'morph-comment' => [
            'comment'             => 'WalkerChiu\MorphComment\Models\Entities\Comment',
            'commentObserver'     => 'WalkerChiu\MorphComment\Models\Observers\CommentObserver',
            'commentRepository'   => 'WalkerChiu\MorphComment\Models\Repositories\CommentRepository',
            'commentLang'         => 'WalkerChiu\MorphComment\Models\Entities\CommentLang',
            'commentLangObserver' => 'WalkerChiu\MorphComment\Models\Observers\CommentLangObserver'
        ],
        'morph-image' => [
            'imageType'         => 'WalkerChiu\MorphImage\Models\Constants\ImageType',
            'image'             => 'WalkerChiu\MorphImage\Models\Entities\Image',
            'imageObserver'     => 'WalkerChiu\MorphImage\Models\Observers\ImageObserver',
            'imageRepository'   => 'WalkerChiu\MorphImage\Models\Repositories\ImageRepository',
            //'imageRepository'   => 'WalkerChiu\MorphImage\Models\Repositories\ImageRepositoryWithComment',
            'imageLang'         => 'WalkerChiu\MorphImage\Models\Entities\ImageLang',
            'imageLangObserver' => 'WalkerChiu\MorphImage\Models\Observers\ImageLangObserver'
        ],
        'morph-nav' => [
            'morphType'       => 'WalkerChiu\MorphNav\Models\Constants\MorphType',
            'nav'             => 'WalkerChiu\MorphNav\Models\Entities\Nav',
            'navObserver'     => 'WalkerChiu\MorphNav\Models\Observers\NavObserver',
            'navRepository'   => 'WalkerChiu\MorphNav\Models\Repositories\NavRepository',
            'navLang'         => 'WalkerChiu\MorphNav\Models\Entities\NavLang',
            'navLangObserver' => 'WalkerChiu\MorphNav\Models\Observers\NavLangObserver'
        ],
        'morph-rank' => [
            'level'              => 'WalkerChiu\MorphRank\Models\Entities\Level',
            'levelObserver'      => 'WalkerChiu\MorphRank\Models\Observers\LevelObserver',
            'levelRepository'    => 'WalkerChiu\MorphRank\Models\Repositories\LevelRepository',
            'levelLang'          => 'WalkerChiu\MorphRank\Models\Entities\LevelLang',
            'levelLangObserver'  => 'WalkerChiu\MorphRank\Models\Observers\LevelLangObserver',
            'status'             => 'WalkerChiu\MorphRank\Models\Entities\Status',
            'statusObserver'     => 'WalkerChiu\MorphRank\Models\Observers\StatusObserver',
            'statusRepository'   => 'WalkerChiu\MorphRank\Models\Repositories\StatusRepository',
            'statusLang'         => 'WalkerChiu\MorphRank\Models\Entities\StatusLang',
            'statusLangObserver' => 'WalkerChiu\MorphRank\Models\Observers\StatusLangObserver'
        ],
        'morph-registration' => [
            'registration'           => 'WalkerChiu\MorphRegistration\Models\Entities\Registration',
            'registrationObserver'   => 'WalkerChiu\MorphRegistration\Models\Observers\RegistrationObserver',
            'registrationRepository' => 'WalkerChiu\MorphRegistration\Models\Repositories\RegistrationRepository'
        ],
        'morph-tag' => [
            'morphType'       => 'WalkerChiu\MorphTag\Models\Constants\MorphType',
            'tag'             => 'WalkerChiu\MorphTag\Models\Entities\Tag',
            'tagObserver'     => 'WalkerChiu\MorphTag\Models\Observers\TagObserver',
            'tagRepository'   => 'WalkerChiu\MorphTag\Models\Repositories\TagRepository',
            'tagLang'         => 'WalkerChiu\MorphTag\Models\Entities\TagLang',
            'tagLangObserver' => 'WalkerChiu\MorphTag\Models\Observers\TagLangObserver'
        ],
        'morph-link' => [
            'link'             => 'WalkerChiu\MorphLink\Models\Entities\Link',
            'linkObserver'     => 'WalkerChiu\MorphLink\Models\Observers\LinkObserver',
            'linkRepository'   => 'WalkerChiu\MorphLink\Models\Repositories\LinkRepository',
            'linkLang'         => 'WalkerChiu\MorphLink\Models\Entities\LinkLang',
            'linkLangObserver' => 'WalkerChiu\MorphLink\Models\Observers\LinkLangObserver'
        ],
        'newsletter' => [
            'article'             => 'WalkerChiu\Newsletter\Models\Entities\Article',
            'articleObserver'     => 'WalkerChiu\Newsletter\Models\Observers\ArticleObserver',
            'articleRepository'   => 'WalkerChiu\Newsletter\Models\Repositories\ArticleRepository',
            'setting'             => 'WalkerChiu\Newsletter\Models\Entities\Setting',
            'settingObserver'     => 'WalkerChiu\Newsletter\Models\Observers\SettingObserver',
            'settingRepository'   => 'WalkerChiu\Newsletter\Models\Repositories\SettingRepository',
            'settingLang'         => 'WalkerChiu\Newsletter\Models\Entities\SettingLang',
            'settingLangObserver' => 'WalkerChiu\Newsletter\Models\Observers\SettingLangObserver'
        ],
        'payment' => [
            'paymentType'         => 'WalkerChiu\Payment\Models\Constants\PaymentType',
            'payment'             => 'WalkerChiu\Payment\Models\Entities\Payment',
            'paymentObserver'     => 'WalkerChiu\Payment\Models\Observers\PaymentObserver',
            'paymentRepository'   => 'WalkerChiu\Payment\Models\Repositories\PaymentRepository',
            'paymentLang'         => 'WalkerChiu\Payment\Models\Entities\PaymentLang',
            'paymentLangObserver' => 'WalkerChiu\Payment\Models\Observers\PaymentLangObserver',
            'applepay'            => 'WalkerChiu\Payment\Models\Entities\ApplePay',
            'applepayObserver'    => 'WalkerChiu\Payment\Models\Observers\ApplePayObserver',
            'applepayRepository'  => 'WalkerChiu\Payment\Models\Repositories\ApplePayRepository',
            'alipay'              => 'WalkerChiu\Payment\Models\Entities\ALIPay',
            'alipayObserver'      => 'WalkerChiu\Payment\Models\Observers\ALIPayObserver',
            'alipayRepository'    => 'WalkerChiu\Payment\Models\Repositories\ALIPayRepository',
            'bank'                => 'WalkerChiu\Payment\Models\Entities\Bank',
            'bankObserver'        => 'WalkerChiu\Payment\Models\Observers\BankObserver',
            'bankRepository'      => 'WalkerChiu\Payment\Models\Repositories\BankRepository',
            'ecpay'               => 'WalkerChiu\Payment\Models\Entities\ECPay',
            'ecpayObserver'       => 'WalkerChiu\Payment\Models\Observers\ECPayObserver',
            'ecpayRepository'     => 'WalkerChiu\Payment\Models\Repositories\ECPayRepository',
            'esafe'               => 'WalkerChiu\Payment\Models\Entities\ESafe',
            'esafeObserver'       => 'WalkerChiu\Payment\Models\Observers\ESafeObserver',
            'esafeRepository'     => 'WalkerChiu\Payment\Models\Repositories\ESafeRepository',
            'ezpay'               => 'WalkerChiu\Payment\Models\Entities\EZPay',
            'ezpayObserver'       => 'WalkerChiu\Payment\Models\Observers\EZPayObserver',
            'ezpayRepository'     => 'WalkerChiu\Payment\Models\Repositories\EZPayRepository',
            'googlepay'           => 'WalkerChiu\Payment\Models\Entities\GooglePay',
            'googlepayObserver'   => 'WalkerChiu\Payment\Models\Observers\GooglePayObserver',
            'googlepayRepository' => 'WalkerChiu\Payment\Models\Repositories\GooglePayRepository',
            'linepay'             => 'WalkerChiu\Payment\Models\Entities\LinePay',
            'linepayObserver'     => 'WalkerChiu\Payment\Models\Observers\LinePayObserver',
            'linepayRepository'   => 'WalkerChiu\Payment\Models\Repositories\LinePayRepository',
            'newebpay'            => 'WalkerChiu\Payment\Models\Entities\NewebPay',
            'newebpayObserver'    => 'WalkerChiu\Payment\Models\Observers\NewebPayObserver',
            'newebpayRepository'  => 'WalkerChiu\Payment\Models\Repositories\NewebPayRepository',
            'paypal'              => 'WalkerChiu\Payment\Models\Entities\PayPal',
            'paypalObserver'      => 'WalkerChiu\Payment\Models\Observers\PayPalObserver',
            'paypalRepository'    => 'WalkerChiu\Payment\Models\Repositories\PayPalRepository',
            'recon'               => 'WalkerChiu\Payment\Models\Entities\Recon',
            'reconObserver'       => 'WalkerChiu\Payment\Models\Observers\ReconObserver',
            'reconRepository'     => 'WalkerChiu\Payment\Models\Repositories\ReconRepository',
            'ttpay'               => 'WalkerChiu\Payment\Models\Entities\TTPay',
            'ttpayObserver'       => 'WalkerChiu\Payment\Models\Observers\TTPayObserver',
            'ttpayRepository'     => 'WalkerChiu\Payment\Models\Repositories\TTPayRepository'
        ],
        'point' => [
            'setting'             => 'WalkerChiu\Point\Models\Entities\Setting',
            'settingObserver'     => 'WalkerChiu\Point\Models\Observers\SettingObserver',
            'settingRepository'   => 'WalkerChiu\Point\Models\Repositories\SettingRepository',
            'settingLang'         => 'WalkerChiu\Point\Models\Entities\SettingLang',
            'settingLangObserver' => 'WalkerChiu\Point\Models\Observers\SettingLangObserver',
            'wallet'              => 'WalkerChiu\Point\Models\Entities\Wallet',
            'walletObserver'      => 'WalkerChiu\Point\Models\Observers\WalletObserver',
            'walletRepository'    => 'WalkerChiu\Point\Models\Repositories\WalletRepository',
            'log'                 => 'WalkerChiu\Point\Models\Entities\Log',
            'logObserver'         => 'WalkerChiu\Point\Models\Observers\LogObserver',
            'logRepository'       => 'WalkerChiu\Point\Models\Repositories\LogRepository'
        ],
        'role' => [
            'role'                   => 'WalkerChiu\Role\Models\Entities\Role',
            'roleObserver'           => 'WalkerChiu\Role\Models\Observers\RoleObserver',
            'roleRepository'         => 'WalkerChiu\Role\Models\Repositories\RoleRepository',
            'roleLang'               => 'WalkerChiu\Role\Models\Entities\RoleLang',
            'roleLangObserver'       => 'WalkerChiu\Role\Models\Observers\RoleLangObserver',
            'permission'             => 'WalkerChiu\Role\Models\Entities\Permission',
            'permissionObserver'     => 'WalkerChiu\Role\Models\Observers\PermissionObserver',
            'permissionRepository'   => 'WalkerChiu\Role\Models\Repositories\PermissionRepository',
            'permissionLang'         => 'WalkerChiu\Role\Models\Entities\PermissionLang',
            'permissionLangObserver' => 'WalkerChiu\Role\Models\Observers\PermissionLangObserver',
            'verifyRole'             => 'WalkerChiu\Role\Middleware\VerifyRole',
            'verifyPermission'       => 'WalkerChiu\Role\Middleware\VerifyPermission'
        ],
        'role-simple' => [
            'role'                   => 'WalkerChiu\RoleSimple\Models\Entities\Role',
            'roleObserver'           => 'WalkerChiu\RoleSimple\Models\Observers\RoleObserver',
            'roleRepository'         => 'WalkerChiu\RoleSimple\Models\Repositories\RoleRepository',
            'permission'             => 'WalkerChiu\RoleSimple\Models\Entities\Permission',
            'permissionObserver'     => 'WalkerChiu\RoleSimple\Models\Observers\PermissionObserver',
            'permissionRepository'   => 'WalkerChiu\RoleSimple\Models\Repositories\PermissionRepository',
            'verifyRole'             => 'WalkerChiu\RoleSimple\Middleware\VerifyRole',
            'verifyPermission'       => 'WalkerChiu\RoleSimple\Middleware\VerifyPermission'
        ],
        'rule' => [
            'morphType'             => 'WalkerChiu\Rule\Models\Constants\MorphType',
            'rule'                  => 'WalkerChiu\Rule\Models\Entities\Rule',
            'ruleObserver'          => 'WalkerChiu\Rule\Models\Observers\RuleObserver',
            'ruleRepository'        => 'WalkerChiu\Rule\Models\Repositories\RuleRepository',
            'ruleLang'              => 'WalkerChiu\Rule\Models\Entities\RuleLang',
            'ruleLangObserver'      => 'WalkerChiu\Rule\Models\Observers\RuleLangObserver',
            'situation'             => 'WalkerChiu\Rule\Models\Entities\Situation',
            'situationObserver'     => 'WalkerChiu\Rule\Models\Observers\SituationObserver',
            'situationRepository'   => 'WalkerChiu\Rule\Models\Repositories\SituationRepository',
            'situationLang'         => 'WalkerChiu\Rule\Models\Entities\SituationLang',
            'situationLangObserver' => 'WalkerChiu\Rule\Models\Observers\SituationLangObserver',
            'condition'             => 'WalkerChiu\Rule\Models\Entities\Condition',
            'conditionObserver'     => 'WalkerChiu\Rule\Models\Observers\ConditionObserver',
            'conditionRepository'   => 'WalkerChiu\Rule\Models\Repositories\ConditionRepository',
            'task'                  => 'WalkerChiu\Rule\Models\Entities\Task',
            'taskObserver'          => 'WalkerChiu\Rule\Models\Observers\TaskObserver',
            'taskRepository'        => 'WalkerChiu\Rule\Models\Repositories\TaskRepository',
            'taskLang'              => 'WalkerChiu\Rule\Models\Entities\TaskLang',
            'taskLangObserver'      => 'WalkerChiu\Rule\Models\Observers\TaskLangObserver',
            'variable'              => 'WalkerChiu\Rule\Models\Entities\Variable',
            'variableObserver'      => 'WalkerChiu\Rule\Models\Observers\VariableObserver',
            'variableRepository'    => 'WalkerChiu\Rule\Models\Repositories\VariableRepository',
            'variableLang'          => 'WalkerChiu\Rule\Models\Entities\VariableLang',
            'variableLangObserver'  => 'WalkerChiu\Rule\Models\Observers\VariableLangObserver'
        ],
        'rule-hit' => [
            'conditionAddress'     => 'WalkerChiu\RuleHit\Models\Constants\ConditionAddress',
            'conditionCoupon'      => 'WalkerChiu\RuleHit\Models\Constants\ConditionCoupon',
            'conditionType'        => 'WalkerChiu\RuleHit\Models\Constants\ConditionType',
            'conditionAddressType' => 'WalkerChiu\RuleHit\Models\Constants\ConditionAddressType',
            'conditionCouponType'  => 'WalkerChiu\RuleHit\Models\Constants\ConditionCouponType',
            'ruleHit'              => 'WalkerChiu\RuleHit\Models\Entities\RuleHit',
            'ruleHitObserver'      => 'WalkerChiu\RuleHit\Models\Observers\RuleHitObserver',
            'ruleHitRepository'    => 'WalkerChiu\Rule\Models\Repositories\RuleHitRepository',
            'ruleHitLang'          => 'WalkerChiu\RuleHit\Models\Entities\RuleHitLang',
            'ruleHitLangObserver'  => 'WalkerChiu\RuleHit\Models\Observers\RuleHitLangObserver'
        ],
        'shipment' => [
            'shipmentType'             => 'WalkerChiu\Shipment\Models\Constants\ShipmentType',
            'shipment'                 => 'WalkerChiu\Shipment\Models\Entities\Shipment',
            'shipmentLang'             => 'WalkerChiu\Shipment\Models\Entities\ShipmentLang',
            'shipmentObserver'         => 'WalkerChiu\Shipment\Models\Observers\ShipmentObserver',
            'shipmentLangObserver'     => 'WalkerChiu\Shipment\Models\Observers\ShipmentLangObserver',
            'shipmentRepository'       => 'WalkerChiu\Shipment\Models\Repositories\ShipmentRepository',
            'ecan'                     => 'WalkerChiu\Shipment\Models\Entities\ECan',
            'ecanObserver'             => 'WalkerChiu\Shipment\Models\Observers\ECanObserver',
            'ecanRepository'           => 'WalkerChiu\Shipment\Models\Repositories\ECanRepository',
            'eflocker'                 => 'WalkerChiu\Shipment\Models\Entities\EFLocker',
            'eflockerObserver'         => 'WalkerChiu\Shipment\Models\Observers\EFLockerObserver',
            'eflockerRepository'       => 'WalkerChiu\Shipment\Models\Repositories\EFLockerRepository',
            'fedex'                    => 'WalkerChiu\Shipment\Models\Entities\FedEx',
            'fedexObserver'            => 'WalkerChiu\Shipment\Models\Observers\FedExObserver',
            'fedexRepository'          => 'WalkerChiu\Shipment\Models\Repositories\FedExRepository',
            'hct'                      => 'WalkerChiu\Shipment\Models\Entities\HCT',
            'hctObserver'              => 'WalkerChiu\Shipment\Models\Observers\HCTObserver',
            'hctRepository'            => 'WalkerChiu\Shipment\Models\Repositories\HCTRepository',
            'kerryExpress'             => 'WalkerChiu\Shipment\Models\Entities\KerryExpress',
            'kerryExpressObserver'     => 'WalkerChiu\Shipment\Models\Observers\KerryExpressObserver',
            'kerryExpressRepository'   => 'WalkerChiu\Shipment\Models\Repositories\KerryExpressRepository',
            'ktj'                      => 'WalkerChiu\Shipment\Models\Entities\KTJ',
            'ktjObserver'              => 'WalkerChiu\Shipment\Models\Observers\KTJObserver',
            'ktjRepository'            => 'WalkerChiu\Shipment\Models\Repositories\KTJRepository',
            'morningExpress'           => 'WalkerChiu\Shipment\Models\Entities\MorningExpress',
            'morningExpressObserver'   => 'WalkerChiu\Shipment\Models\Observers\MorningExpressObserver',
            'morningExpressRepository' => 'WalkerChiu\Shipment\Models\Repositories\MorningExpressRepository',
            'post'                     => 'WalkerChiu\Shipment\Models\Entities\Post',
            'postObserver'             => 'WalkerChiu\Shipment\Models\Observers\PostObserver',
            'postRepository'           => 'WalkerChiu\Shipment\Models\Repositories\PostRepository',
            'postBox'                  => 'WalkerChiu\Shipment\Models\Entities\PostBox',
            'postBoxObserver'          => 'WalkerChiu\Shipment\Models\Observers\PostBoxObserver',
            'postBoxRepository'        => 'WalkerChiu\Shipment\Models\Repositories\PostBoxRepository',
            'presco'                   => 'WalkerChiu\Shipment\Models\Entities\PRESCO',
            'prescoObserver'           => 'WalkerChiu\Shipment\Models\Observers\PRESCOObserver',
            'prescoRepository'         => 'WalkerChiu\Shipment\Models\Repositories\PRESCORepository',
            'reyi'                     => 'WalkerChiu\Shipment\Models\Entities\REYI',
            'reyiObserver'             => 'WalkerChiu\Shipment\Models\Observers\REYIObserver',
            'reyiRepository'           => 'WalkerChiu\Shipment\Models\Repositories\REYIRepository',
            'sfExpress'                => 'WalkerChiu\Shipment\Models\Entities\SFExpress',
            'sfExpressObserver'        => 'WalkerChiu\Shipment\Models\Observers\SFExpressObserver',
            'sfExpressRepository'      => 'WalkerChiu\Shipment\Models\Repositories\SFExpressRepository',
            'sfPlus'                   => 'WalkerChiu\Shipment\Models\Entities\SFPlus',
            'sfPlusObserver'           => 'WalkerChiu\Shipment\Models\Observers\SFPlusObserver',
            'sfPlusRepository'         => 'WalkerChiu\Shipment\Models\Repositories\SFPlusRepository',
            'shipany'                  => 'WalkerChiu\Shipment\Models\Entities\ShipAny',
            'shipanyObserver'          => 'WalkerChiu\Shipment\Models\Observers\ShipAnyObserver',
            'shipanyRepository'        => 'WalkerChiu\Shipment\Models\Repositories\ShipAnyRepository',
            'tcat'                     => 'WalkerChiu\Shipment\Models\Entities\TCat',
            'tcatObserver'             => 'WalkerChiu\Shipment\Models\Observers\TCatObserver',
            'tcatRepository'           => 'WalkerChiu\Shipment\Models\Repositories\TCatRepository',
            'ups'                      => 'WalkerChiu\Shipment\Models\Entities\UPS',
            'upsObserver'              => 'WalkerChiu\Shipment\Models\Observers\UPSObserver',
            'upsRepository'            => 'WalkerChiu\Shipment\Models\Repositories\UPSRepository'
        ],
        'site' => [
            'emailType'          => 'WalkerChiu\Site\Models\Constants\EmailType',
            'layoutType'         => 'WalkerChiu\Site\Models\Constants\LayoutType',
            'site'               => 'WalkerChiu\Site\Models\Entities\Site',
            'siteObserver'       => 'WalkerChiu\Site\Models\Observers\SiteObserver',
            'siteLang'           => 'WalkerChiu\Site\Models\Entities\SiteLang',
            'siteLangObserver'   => 'WalkerChiu\Site\Models\Observers\SiteLangObserver',
            'siteRepository'     => 'WalkerChiu\Site\Models\Repositories\SiteRepository',
            'email'              => 'WalkerChiu\Site\Models\Entities\Email',
            'emailObserver'      => 'WalkerChiu\Site\Models\Observers\EmailObserver',
            'emailLang'          => 'WalkerChiu\Site\Models\Entities\EmailLang',
            'emailLangObserver'  => 'WalkerChiu\Site\Models\Observers\EmailLangObserver',
            'emailRepository'    => 'WalkerChiu\Site\Models\Repositories\EmailRepository',
            'layout'             => 'WalkerChiu\Site\Models\Entities\Layout',
            'layoutObserver'     => 'WalkerChiu\Site\Models\Observers\LayoutObserver',
            'layoutLang'         => 'WalkerChiu\Site\Models\Entities\LayoutLang',
            'layoutLangObserver' => 'WalkerChiu\Site\Models\Observers\LayoutLangObserver',
            'layoutRepository'   => 'WalkerChiu\Site\Models\Repositories\LayoutRepository',
            'verifyEnable'       => 'WalkerChiu\Site\Middleware\verifyEnable'
        ]
    ]
];

foreach ($config['table'] as $key => $items) {
    if (is_array($items)) {
        foreach ($items as $key2 => $item) {
            $config['table'][$key][$key2] = $prefix .'_'. $item;
        }
    }
}

return $config;
