
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <form method="POST" action="req.php">
            <h2>易宝支付非银行卡专业版演示</h2>
            <table>
                <tr><td colspan="2"></td></tr>
                <tr><td>商户订单号</td><td><input size="50" type="text" name="p2_Order" value="<?php echo 'gree' . time(); ?>" /></td></tr>
                <tr><td>订单金额</td><td><input size="50" type="text" name="p3_Amt" value="0.1" /></td></tr>
                <tr><td>是否较验订单金额</td><td>
                        <input type="radio" name="p4_verifyAmt" value="true" checked="checked" />较验
                        <input type="radio" name="p4_verifyAmt" value="false" />不较验
                    </td>
                </tr>
                <tr><td>产品名称</td><td><input size="50" type="text" name="p5_Pid" value="" /></td></tr>
                <tr><td>产品类型</td><td><input size="50" type="text" name="p6_Pcat" value="" /></td></tr>
                <tr><td>产品描述</td><td><input size="50" type="text" name="p7_Pdesc" value="" /></td></tr>
                <tr><td>接收支付结果通知地址</td><td><input size="50" type="text" name="p8_Url" value="http://localhost/yeepaycard/callback.php" /></td></tr>
                <tr><td>临时信息</td><td><input size="50" type="text" name="pa_MP" value="临时信息" /></td></tr>
                <tr><td>卡面额</td><td>
                        <input size="20" type="text" name="pa7_cardAmt[]"/>
                        <input size="20" type="text" name="pa7_cardAmt[]"/>
                        <input size="20" type="text" name="pa7_cardAmt[]"/>
                        <input size="20" type="text" name="pa7_cardAmt[]"/>
                    </td></tr>
                <tr><td>卡序列号</td><td>
                        <input size="20" type="text" name="pa8_cardNo[]"/>
                        <input size="20" type="text" name="pa8_cardNo[]"/>
                        <input size="20" type="text" name="pa8_cardNo[]"/>
                        <input size="20" type="text" name="pa8_cardNo[]"/>
                    </td></tr>
                <tr><td>卡密码</td><td>
                        <input size="20" type="text" name="pa9_cardPwd[]"/>
                        <input size="20" type="text" name="pa9_cardPwd[]"/>
                        <input size="20" type="text" name="pa9_cardPwd[]"/>
                        <input size="20" type="text" name="pa9_cardPwd[]"/>
                    </td></tr>
                <tr><td>支付通道编码</td><td><input size="50" type="text" name="pd_FrpId" value="" /><!--支付通道编码在易宝支付非银行卡支付专业版接口文档中--></td></tr>

                <tr><td>用户唯一标识</td>
                    <td><input size="50" type="text" name="pz_userId" value="100001" /></td>
                </tr>
                <tr><td>用户的注册时间</td><td><input size="50" type="text" name="pz1_userRegTime" value="2009-01-01 00:00:00" /></td></tr>
                <tr><td rowspan="2"></td><td><input type="submit" value="马上支付" onClick="return confirm('如果您同时使用的是真实的卡密和易宝支付提供的测试商户ID进行测试，您的支付金额将被存入易宝的测试账户，请谨慎操作！')"/></td>
                </tr>
                <tr>
                    <td height="77"><p><font style="color:#FF0000;font-weight:bold">此操作可能造成交易风险：如果您同时使用的是真实的卡密和易宝支付提供的测试商户ID进行测试，</font>
                            <br>
                            <font style="color:#FF0000;font-weight:bold">您的支付金额将被存入易宝的测试账户，请谨慎操作！</font><br>
                        </p></td>
                </tr>
            </table>
            <p>&nbsp;</p>
        </form>
    </body>
</html>

