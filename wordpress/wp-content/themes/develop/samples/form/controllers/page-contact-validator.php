<?php
// Create custom validate
$Validate->_test = function($field, $message) use ($Validate) {
    if ( $field->value ) {
        $Validate->addError($field->name, 'test', $message[0]);
    }
};

$Validate->name('fullname', '氏名')
        ->required('message required')
        // ->test('message test')
        // ->hiragana('message hiragana')
        ;

$Validate->name('namekana', 'フリガナ')
        // ->max('message max',10)
        // ->required('message required')
        ;
$Validate->name('year', '年齢');
$Validate->name('email', 'メールアドレス');
$Validate->name('emailconfirm', 'メールアドレス（確認用）');
$Validate->name('gender', '性別');
$Validate->name('hope', '希望連絡方法');
$Validate->name('zipcode', '住所');
$Validate->name('pref', '都道府県');
$Validate->name('country', '国名');
$Validate->name('city', '市区町村');
$Validate->name('address', '丁目番地（建物名）');
$Validate->name('recruitment', '募集を知ったきっかけ');
$Validate->name('pr', '自己PR');
$Validate->name('agreement', 'プライバシーポリシーの同意');
