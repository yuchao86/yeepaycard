<?php

/*
 * @Description 易宝支付非银行卡支付专业版接口范例
 * @GREE v1.0
 * @Author chao.yu@gree.net
 */

/**
 * Yeepay common function class cluster
 * @Author chao.yu@gree.net
 * */
class YeePayCommon {

    public static function getReqHmacString($OrderInfo,$p0_Cmd, $pr_NeedResponse) {

        $sbOld = "";
        foreach ($OrderInfo as $value)
        {
        	$sbOld .= $value;
        }

        $p2_Order = $OrderInfo['p2_Order'];

        self::logstr($p2_Order, $sbOld, self::HmacMd5($sbOld, merchantKey), merchantKey);
        return self::HmacMd5($sbOld, merchantKey);
    }
    /**
     *       YeePayCommon::annulCard function
		 */
    public static function annulCard($OrderInfo) {


        # 非银行卡支付专业版支付请求，固定值 "ChargeCardDirect".
        $p0_Cmd = "ChargeCardDirect";

        #应答机制.为"1": 需要应答机制;为"0": 不需要应答机制.
        $pr_NeedResponse = "1";

        #进行加密串处理，一定按照下列顺序进行
        $params = array(
            #加入业务类型
            'p0_Cmd' => $p0_Cmd,
            #加入商家ID
            'p1_MerId' => p1_MerId,
            #加入商户订单
            'p2_Order' => $OrderInfo['p2_Order'],
            #加入支付卡面额
            'p3_Amt' => $OrderInfo['p3_Amt'],
            #加入是否较验订单金额
            'p4_verifyAmt' => $OrderInfo['p4_verifyAmt'],
            #加入产品名称
            'p5_Pid' => $OrderInfo['p5_Pid'],
            #加入产品类型
            'p6_Pcat' => $OrderInfo['p6_Pcat'],
            #加入产品描述
            'p7_Pdesc' => $OrderInfo['p7_Pdesc'],
            #加入商户接收交易结果通知的地址
            'p8_Url' => $OrderInfo['p8_Url'],
            #加入临时信息
            'pa_MP' => $OrderInfo['pa_MP'],
            #加入卡面额组
            'pa7_cardAmt' => $OrderInfo['pa7_cardAmt'],
            #加入卡号组
            'pa8_cardNo' => $OrderInfo['pa8_cardNo'],
            #加入卡密组
            'pa9_cardPwd' => $OrderInfo['pa9_cardPwd'],
            #加入支付通道编码
            'pd_FrpId' => $OrderInfo['pd_FrpId'],
            #加入应答机制
            'pr_NeedResponse' => $pr_NeedResponse,

            #用户唯一标识
            'pz_userId' => $OrderInfo['pz_userId'],
            #用户的注册时间
            'pz1_userRegTime' => $OrderInfo['pz1_userRegTime']
        );
        #调用签名函数生成签名串
        $hmac = self::getReqHmacString($params,$p0_Cmd,$pr_NeedResponse);

				#加入校验码
        $hmac = array('hmac' => $hmac);
        $httpParams = array_merge($params,$hmac);


        //$client = new HttpClient($_SERVER['SERVER_NAME']);
        $pageContents = HttpClient::quickPost(reqURL_SNDApro, $httpParams);
        echo "pageContents:" . $pageContents;
        $result = explode("\n", $pageContents);

        $resultcount = count($result);

        $r0_Cmd = ""; #业务类型
        $r1_Code = ""; #支付结果
        $r2_TrxId = ""; #易宝支付交易流水号
        $r6_Order = "";    #商户订单号
        $rq_ReturnMsg = ""; #返回信息
        $hmac = ""; #签名数据
        $unkonw = ""; #未知错误


        for ($index = 0; $index < $resultcount; $index++) {  //数组循环
            $result[$index] = trim($result[$index]);
            if (strlen($result[$index]) == 0) {
                continue;
            }
            $aryReturn = explode("=", $result[$index]);
            $sKey = $aryReturn[0];
            $sValue = $aryReturn[1];
            switch($sKey)
            {
            	case 'r0_Cmd':
            		$r0_Cmd = $sValue;	#取得业务类型
            	case 'r1_Code':
            		$r1_Code = $sValue;   #取得支付结果
            	case 'r2_TrxId':
            		$r2_TrxId = $sValue;	#取得易宝支付交易流水号
            	case 'r6_Order':
            		$r6_Order = $sValue;	 #取得商户订单号
            	case 'rq_ReturnMsg':
            		$rq_ReturnMsg = $sValue;	 #取得交易结果返回信息
            	case 'hmac':
            		$hmac = $sValue;		#取得签名数据

            }
        }


        #进行校验码检查 取得加密前的字符串
        $sbOld = "";
        #加入业务类型
        $sbOld .= $r0_Cmd;
        #加入支付结果
        $sbOld .= $r1_Code;
        #加入易宝支付交易流水号
        //$sbOld .= $r2_TrxId;
        #加入商户订单号
        $sbOld .= $r6_Order;
        #加入交易结果返回信息
        $sbOld .= $rq_ReturnMsg;

        $sNewString = self::HmacMd5($sbOld, merchantKey);
        self::logstr($r6_Order, $sbOld, self::HmacMd5($sbOld, merchantKey), merchantKey);

        #校验码正确
        if ($sNewString === $hmac) {
        	switch($r1_Code){
        		case '1':
                echo "<br>提交成功!" . $rq_ReturnMsg;
                echo "<br>商户订单号:" . $r6_Order . "<br>";
                echo self::generationTestCallback($OrderInfo);
                return;
            case '2':
                echo "<br>提交失败" . $rq_ReturnMsg;
                echo "<br>支付卡密无效!";
                return;
            case '7':
                echo "<br>提交失败" . $rq_ReturnMsg;
                echo "<br>支付卡密无效!";
                return;
            case '11':
                echo "<br>提交失败" . $rq_ReturnMsg;
                echo "<br>订单号重复!";
                return;
            default:
                echo "<br>提交失败" . $rq_ReturnMsg;
                echo "<br>请检查后重新测试支付";
                return;
            }
        } else {
            echo "<br>localhost:" . $sNewString;
            echo "<br>YeePay:" . $hmac;
            echo "<br>交易签名无效!";
            exit;
        }
    }

    public static function generationTestCallback($OrderInfo) {


        # 非银行卡支付专业版支付请求，固定值 "AnnulCard".
        $p0_Cmd = "AnnulCard";

        #应答机制.为"1": 需要应答机制;为"0": 不需要应答机制.
        $pr_NeedResponse = "1";

        # 非银行卡支付专业版请求地址,无需更改.
        //$reqURL_SNDApro		= "https://www.yeepay.com/app-merchant-proxy/command.action";
        $reqURL_SNDApro = "http://tech.yeepay.com:8080/robot/generationCallback.action";
        #调用签名函数生成签名串
        $hmac = self::getReqHmacString($OrderInfo,$p0_Cmd,$pr_NeedResponse);
        #进行加密串处理，一定按照下列顺序进行
        $params = array(
            #加入业务类型
            'p0_Cmd' => $p0_Cmd,
            #加入商家ID
            'p1_MerId' => p1_MerId,
            #加入商户订单号
            'p2_Order' => $OrderInfo['p2_Order'],
            #加入支付卡面额
            'p3_Amt' => $OrderInfo['p3_Amt'],
            #加入商户接收交易结果通知的地址
            'p8_Url' => $OrderInfo['p8_Url'],
            #加入支付卡序列号
            'pa7_cardNo' => $OrderInfo['pa8_cardNo'],
            #加入支付卡密码
            'pa8_cardPwd' => $OrderInfo['pa9_cardPwd'],
            #加入支付通道编码
            'pd_FrpId' => $OrderInfo['pd_FrpId'],
            #加入应答机制
            'pr_NeedResponse' => $OrderInfo['pr_NeedResponse'],
            #加入应答机制
            'pa_MP' => '1',
            'hmac' => $hmac,
            #用户唯一标识
            'pz_userId' => $OrderInfo['pz_userId'],
            #用户的注册时间
            'pz1_userRegTime' => $OrderInfo['pz1_userRegTime']);


        //$client = new HttpClient($_SERVER['SERVER_NAME']);
        $pageContents = HttpClient::quickPost($reqURL_SNDApro, $params);
        return $pageContents;
    }

	#调用签名函数生成签名串.
   public static function getCallbackHmacString($BackInfo){

        #进行校验码检查 取得加密前的字符串
        $sbOld = "";
        #加入业务类型
        foreach($BackInfo as $value)
        {
        	$sbOld .= $value;
        }
        
        $p2_Order = $BackInfo['rb_Order'];

        echo "<br/>[" . $sbOld . "]";
        self::logstr($p2_Order, $sbOld, self::HmacMd5($sbOld, merchantKey), merchantKey);
        return self::HmacMd5($sbOld, merchantKey);
    }

		#取得返回串中的所有参数.
		public static function getCallBackValue(){
        $BackInfo['r0_Cmd'] = $_REQUEST['r0_Cmd'];
        $BackInfo['r1_Code'] = $_REQUEST['r1_Code'];
        $BackInfo['p1_MerId'] = $_REQUEST['p1_MerId'];
        $BackInfo['rb_Order'] = $_REQUEST['rb_Order'];
        $BackInfo['r2_TrxId'] = $_REQUEST['r2_TrxId'];
        $BackInfo['pa_MP'] = $_REQUEST['pa_MP'];
        $BackInfo['rc_Amt'] = $_REQUEST['rc_Amt'];
        $BackInfo['rq_CardNo'] = $_REQUEST['rq_CardNo'];
        /*$BackInfo['p3_Amt'] = $_REQUEST['p3_Amt'];
        $BackInfo['p4_FrpId'] = $_REQUEST['p4_FrpId'];
        $BackInfo['p5_CardNo'] = $_REQUEST['p5_CardNo'];
        $BackInfo['p6_confirmAmount'] = $_REQUEST['p6_confirmAmount'];
        $BackInfo['p7_realAmount'] = $_REQUEST['p7_realAmount'];
        $BackInfo['p8_cardStatus'] = $_REQUEST['p8_cardStatus'];
        $BackInfo['p9_MP'] = $_REQUEST['p9_MP'];
        $BackInfo['pb_BalanceAmt'] = $_REQUEST['pb_BalanceAmt'];
        $BackInfo['pc_BalanceAct'] = $_REQUEST['pc_BalanceAct'];
        */
        $BackInfo['hmac'] = $_REQUEST['hmac'];

        return $BackInfo;
    }
    
    #验证返回参数中的hmac与商户端生成的hmac是否一致.

    public static function CheckHmac($BackInfo){
     		$hmac = $BackInfo['hmac'];
     		unset($BackInfo['hmac']);
        if ($hmac === self::getCallbackHmacString($BackInfo))
            return true;
        else
            return false;
    }

    public static function HmacMd5($data, $key) {
        # RFC 2104 HMAC implementation for php.
        # Creates an md5 HMAC.
        # Eliminates the need to install mhash to compute a HMAC
        # Hacked by Lance Rushing(NOTE: Hacked means written)
        #需要配置环境支持iconv，否则中文参数不能正常处理
        $key = iconv("GBK", "UTF-8//IGNORE", $key);
        $data = iconv("GBK", "UTF-8//IGNORE", $data);
        //$key = mb_convert_encoding($key,"GBK","UTF-8");
        //$data = mb_convert_encoding($data,"GBK","UTF-8");

        $b = 64; # byte length for md5
        if (strlen($key) > $b) {
            $key = pack("H*", md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack("H*", md5($k_ipad . $data)));
    }

    public static function logstr($orderid, $str, $hmac, $keyValue) {
        $james = fopen(logName, "a+");
        fwrite($james, "\r\n" . date("Y-m-d H:i:s") . "|orderid[" . $orderid . "]|str[" . $str . "]|hmac[" . $hmac . "]|keyValue[" . $keyValue . "]");
        fclose($james);
   }

   public static function arrToString($arr, $Separators) {
        $returnString = "";
        foreach ($arr as $value) {
            $returnString = $returnString . $value . $Separators;
        }
        return substr($returnString, 0, strlen($returnString) - strlen($Separators));
   }

   public static function arrToStringDefault($arr) {
        return self::arrToString($arr, ",");
   }

}

?>
