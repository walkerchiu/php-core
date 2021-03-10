<?php

return [

    /*
    |--------------------------------------------------------------------------
    | System
    |--------------------------------------------------------------------------
    |
    | 
    | 
    | 
    |
    */

    'home'      => 'Home',
    'location'  => '現在位置：',

    'null'              => '無',
    'empty'             => '目前無任何資料',
    'refresh'           => '重新整理',
    'loading'           => '載入中...',
    'yes'               => "是",
    'no'                => "否",
    'enable'            => '啟用',
        'enable_all'        => '全部啟用',
    'disable'           => '不啟用',
        'disable_all'       => '全部不啟用',
    'agree'             => "同意",
    'optional'          => "可選的",
    'original'          => "原本的",
    'created_at'        => '建立於 :date',
    'updated_at'        => '更新於 :date',
    'deleted_at'        => '刪除於 :date',
    'more'              => '更多...',
    'more_detail'       => '閱讀更多',

    'begin'    => '開始',
    'end'      => '終止',
    'start'    => '開始',
    'stop'     => '停止',
    'abort'    => '中止',
    'finish'   => '完成',
    'over'     => '結束',
    'continue' => '繼續',

    'greaterThan'       => "大於",
    'lessThan'          => "小於",
    'equal'             => "等於",

    'load'              => '讀取',
    'save'              => '儲存',
    'import'            => '匯入',
    'export'            => '匯出',
    'sponsor'           => '我要贊助',
        'sponsor_short'     => '贊助',
    'apply'             => '採用',
        'apply_for'         => '申請',
    'list'              => '列表',
    'write'             => '發表',
    'add'               => '新增',
        'add_one'           => '新增一筆',
    'create'            => '新建',
        'create_direct'     => '直接新建',
    'edit'              => '修改',
    'browse'            => '瀏覽',
    'view'              => '查看',
    'review'            => '審核',
        'review_info'       => '審核意見',
    'change'            => '變更',
    'modify'            => '更改',
    'delete'            => '刪除',
        'deleted'           => '已刪除',
        'delete_record'     => '刪除紀錄',
        'record_deleted '   => '某個已被刪除的標的',
    'restore'           => '復原',
    'clone'             => '複製',
    'copy'              => '複製',
    'open'              => '開啟',
    'close'             => '關閉',
    'cancel'            => '取消',
    'clear'             => '清除',
    'confirm'           => '確定',
    'exit'              => '離開',
    'leave'             => '離開',
    'submit'            => '提交',
    'reset'             => '重設',
    'spread'            => '展開',
       'spread_all'         => '全部展開',
    'switch'            => '切換',
    'collapse'          => '收合',
       'collapse_all'       => '全部收合',
    'click2do'          => '按此執行',
    'click2openImg'     => '按此開啟圖片「:name」',
    'dblclick2do'       => '快按兩下執行',
    'details'           => '詳細資料',
    'unlimited'         => '不限制',
    'select'            => '請選擇',
        'select_all'        => '選擇全部',
        'select_all_not'    => '都不選擇',
        'select_toggle'     => '反向選擇',
    'preview'           => '預覽',
        'preview_mode'      => '預覽模式',

    'attribute' => [
        'id'            => '序號',
        'created_at'    => '建立時間',
        'updated_at'    => '更新時間',
        'deleted_at'    => '刪除時間',
        'actions'       => '動作'
    ],
    'switcher' => [
        'language' => '切換語系：',
        'timezone' => '切換時區：',
        'currency' => '切換貨幣：'
    ],
    'search' => [
        'search'             => '搜尋',
        'search_placeholder' => '請輸入關鍵字',
        'filter'             => '篩選',
        'filterOn'           => '篩選項目',
        'to'                 => '至',
        'within'             => '在 :target 內',
        'scope'              => '範圍',
        'sortBy'             => '排序',
        'sortByDefault'      => '預設排序',
        'ascending'          => '升冪排列',
        'descending'         => '降冪排列',
        'ascending_number'   => '由小到大',
        'descending_number'  => '由大到小',
        'ascending_date'     => '由舊到新',
        'descending_date'    => '由新到舊',
        'empty'              => '目前查無任何紀錄',
        'empty_filtered'     => '目前的篩選查無任何紀錄',
        'of_page'            => '目前顯示第 :now 頁，共 :total 頁',
        'per_page'           => '每頁顯示 :number 筆',
        'keyword_hot'        => '熱門關鍵字'
    ],
    'modal' => [
        'signout' => [
            'header' => '確定要離開嗎？',
            'body'   => '按下「登出」即確定離開。'
        ],
        'logout' => [
            'header' => '確定要離開嗎？',
            'body'   => '按下「登出」即確定離開。'
        ],
        'confirm' => [
            'header' => '警告',
            'body'   => '您是否確定要:action？'
        ],
        'then' => [
            'header' => '提示',
            'body'   => '您提交的資料已成功送出！'
        ],
        'catch' => [
            'header' => '錯誤',
            'body'   => '您提交的某些資料有問題！'
        ],
        'idle' => [
            'header' => '閒置提醒',
            'body'   => '您已一段時間沒有動作。如不進行活動，系統將在 :lifetime 秒後自動登出。'
        ],
        'timeout' => [
            'header' => '閒置超時提示',
            'body'   => '您已超過一段時間沒有進行任何動作，系統已自動登出。'
        ]
    ],

    'signUp'         => 'Sign-up',
    'signUp_title'   => 'Sign up',
    'signUp_welcome' => 'Sign up, Welcome!',
    'signUp_about'   => 'If you can make a wish, then don\'t wait.',
    'signUp_memo'    => '註冊說明',
    'signUp_memo_info'    => '填寫邀請碼、贊助證明或其他有利於審核的資訊',
    'signUp_agree1'  => '我了解並同意',
    'signUp_agree2'  => '我同意並願意遵守',

    'confirm_title'  => 'Verify your email address for your account',
    'confirm_text'   => '<p>Thanks for creating an account on :name.</p><p>Please follow the link below to verify your email address.</p>',

    'register'       => '註冊',

    'signIn'         => '登入',
    'signIn_with'    => '第三方登入',
    'signIn_welcome' => '歡迎回來，請登入！',
    'signOut'        => '登出',

    'logIn'          => '登入',
    'logIn_with'     => '第三方登入',
    'logIn_welcome'  => '歡迎回來，請登入！',
    'logOut'         => '登出',

    'remember_me'          => '記住我',
    'forgot_your_password' => '忘記密碼了嗎？'
];
