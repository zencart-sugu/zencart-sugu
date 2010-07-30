<?php
    define('MODULE_VALIDATE_EMAIL_EXISTENCE_TITLE',                  '会員登録仮登録');
    define('MODULE_VALIDATE_EMAIL_EXISTENCE_DESCRIPTION',            '仮登録によりメールアドレスの有効性を確認するためのモジュールです');

    define('MODULE_VALIDATE_EMAIL_EXISTENCE_STATUS_TITLE',           '会員登録仮登録の有効化');
    define('MODULE_VALIDATE_EMAIL_EXISTENCE_STATUS_DESCRIPTION',     '会員登録仮登録を有効にしますか？ <br />true: 有効<br />false: 無効');

    define('MODULE_VALIDATE_EMAIL_EXISTENCE_SORT_ORDER_TITLET',      '優先順');
    define('MODULE_VALIDATE_EMAIL_EXISTENCE_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

    //ブロック管理用
	define('MODULE_VALIDATE_EMAIL_EXISTENCE_BLOCK_TITLE', '会員登録仮登録');



	define('EMAIL_MEMBER_INTERIM_REGIST_SUBJECT', STORE_NAME . '会員　仮登録のお知らせ');
	define('EMAIL_MEMBER_INTERIM_REGIST_GREET_MR', '%s 様' . "\n\n");
	define('EMAIL_MEMBER_INTERIM_REGIST_GREET_MS', '%s 様' . "\n\n");
	define('EMAIL_MEMBER_INTERIM_REGIST_GREET_NONE', '%s 様' . "\n\n");

	define('EMAIL_MEMBER_INTERIM_REGIST_BODY', '
この度は、ボイジャーストア会員の登録を申し込みしていただきありがとうございました。' . "\n" .
'もしも、登録手続きしていないのに、このメールを受け取られた方は、' . "\n" .
STORE_OWNER_EMAIL_ADDRESS . '宛までご連絡ください。' . "\n\n" .

'このメールは、仮登録のお知らせメールです。' . "\n" .

'仮登録の有効期限は1時間です。それまでに本登録していただかないと会員登録は有効となりません。' . "\n\n" .

'仮登録の状態では、ログインすることはできません。' . "\n" .
'仮登録後、本登録完了前に1時間経過してしまった場合は、最初から登録をお願いいたします。' . "\n\n" .

'本登録は、Webブラウザで以下のURLへアクセスして、表示された指示に従って手続きをお願いします。' . "\n"
	);

	define('EMAIL_MEMBER_REGIST_SUBJECT', STORE_NAME . '会員　正式登録のお知らせ');
	define('EMAIL_MEMBER_REGIST_GREET_MR', '%s 様' . "\n\n");
	define('EMAIL_MEMBER_REGIST_GREET_MS', '%s 様' . "\n\n");
	define('EMAIL_MEMBER_REGIST_GREET_NONE', '%s 様' . "\n\n");

	define('EMAIL_MEMBER_REGIST_BODY', '
会員ID %sの会員登録が完了いたしました。' . "\n\n" .

'登録の手続きしていないのに、このメールを受け取られた方は、' . STORE_OWNER_EMAIL_ADDRESS . '宛までご連絡ください。' . "\n\n" .

'お客様の登録内容の確認、修正はメンバーページから行えます' . "\n"
	);
?>