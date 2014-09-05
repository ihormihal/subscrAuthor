<?php

$settings = array();

$tmp = array(
	/*'some_setting' => array(
		'xtype' => 'combo-boolean',
		'value' => true,
		'area' => 'subscrauthor_main',
	),*/
	'mail_from' => array(
		'xtype' => 'textfield',
		'value' => 'no-reply@game-wiki.guru',
		'area' => 'subscrauthor_main',
	),
	'mail_from_name' => array(
		'xtype' => 'textfield',
		'value' => 'Game Wiki',
		'area' => 'subscrauthor_main',
	),
	'mail_subject' => array(
		'xtype' => 'textfield',
		'value' => 'Добавлен новый документ!',
		'area' => 'subscrauthor_main',
	),
	'mail_subject_confirm' => array(
		'xtype' => 'textfield',
		'value' => 'Подтверждение подписки на автора!',
		'area' => 'subscrauthor_main',
	),
	'templateId' => array(
		'xtype' => 'textfield',
		'value' => '3',
		'area' => 'subscrauthor_main',
	),
	'unsubscr' => array(
		'xtype' => 'textfield',
		'value' => '170',
		'area' => 'subscrauthor_main',
	),
	'mailtpl' => array(
		'xtype' => 'textfield',
		'value' => 'subscrAuthorNotify',
		'area' => 'subscrauthor_main',
	),
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'subscrauthor_'.$k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	),'',true,true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
