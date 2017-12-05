<?php
////
//require_once '../vendor/libs/rb.php';
////
////
//$db = require '../config/config_db.php';
////
////// connection to Db.
//R::setup($db['dsn'], $db['user'], $db['pass'], $options);
////// freeze structure of the tables.
////R::freeze(TRUE);
////R::fancyDebug(TRUE);
////
////// test connection.
//var_dump(R::testConnection());
////
////// create new table category
/////*
////$category = R::dispense('category');
////$category->title = 'category first';
////$id = R::store($category);
////*/
////
////// read data: table, id.
////$category = R::load('category', 1);
////
////// change record in table.
//////$category->title = 'new value ';
//////R::store($category);
////
////// delete record in the table.
//////R::trash($category);
////
////// find All.
////$catOne = R::findOne('category', 'id = 2');
////
////// find All with where.
////$cats = R::findAll('category', 'id > ?', [10]);
////
////// find One.
////
////
////
////
////var_dump($catOne);