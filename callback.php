<?php
/*
 * @Description 易宝支付非银行卡支付专业版接口范例 
 * @GREE v1.0
 * @Author chao.yu@gree.net
 */

include dirname(__FILE__).'/merchantProperties.php';
include dirname(__FILE__).'/YeePayCommon.php';
include dirname(__FILE__).'/HttpClient.class.php';

#	解析返回参数.
$return = YeePayCommon::getCallBackValue();

#	判断返回签名是否正确（True/False）

$bRet = YeePayCommon::CheckHmac($return);

$return['p2_Order'] = $return['rb_Order'];
#	以上代码和变量不需要修改.
#	校验码正确.
if ($bRet) {
    echo "success";
    #在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理
    if ($return['r1_Code'] == "1") {
        echo "<br>支付成功!";
        echo "<br>商户订单号:" . $return['p2_Order'];
        //echo "<br>支付金额:" . $return['p3_Amt'];
        exit;
    } else if ($return['r1_Code'] == "2") {
        echo "<br>支付失败!";
        echo "<br>商户订单号:" . $return['p2_Order'];
        exit;
    }
} else {

   $hmac = YeePayCommon::getCallbackHmacString($return);
    echo "<br>localhost:" . serialize($return);
    echo "<br>YeePay:" . $hmac;
    echo "<br>交易签名无效!";
    exit;
}
?> 
<html>
    <head>
        <title>Return from YeePay Page</title>
    </head>
    <body>
    </body>
</html>