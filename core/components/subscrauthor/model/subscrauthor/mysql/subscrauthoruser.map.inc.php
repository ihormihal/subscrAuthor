<?php
$xpdo_meta_map['subscrAuthorUser']= array (
  'package' => 'subscrauthor',
  'version' => '1.1',
  'table' => 'subscrauthor_user',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'user_id' => '',
    'user_email' => '',
    'author' => ''
  ),
  'fieldMeta' => 
  array (
    'user_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => true,
      'default' => '',
    ),
    'user_email' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'author' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => true,
      'default' => '',
    )
  )
);
