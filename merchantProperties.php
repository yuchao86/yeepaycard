<?php

/*
 * @Description 易宝支付非银行卡支付专业版接口范例
 * @V3.0
 * @Author chao.yu@gree.net
 */

/* 商户编号p1_MerId,以及密钥merchantKey 需要从易宝支付平台获得 */
if(!defined('p1_MerId'))
{
  define('p1_MerId', "10001126856");  #测试使用
}

if(!defined('merchantKey'))
{
   define('merchantKey' , "69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl");   #测试使用
}
if(!defined('logName'))
{
   define('logName' , "YeePay_CARD.log");
}
# 非银行卡支付专业版请求地址,无需更改.
if(!defined('reqURL_SNDApro'))
{
   define('reqURL_SNDApro', "https://www.yeepay.com/app-merchant-proxy/command.action");
}
?>
