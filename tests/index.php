<?php


use Itech\Brandedsms\BrandedSms;

require_once  '../vendor/autoload.php';



$sms = new Itech\Brandedsms\BrandedSms();

$sms->secret('userid' , 'key' , 'mask');

$sms->send('1000' , "qweqeq");




$sms = new BrandedSms();

$sms->secret('userid' , 'key' , 'mask');

$sms->send('1000' , "qweqeq");