<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=gbk" />
    </head>
    <body>
        <form method="POST" action="req.php">
            <h2>�ױ�֧�������п�רҵ����ʾ</h2>
            <table>
                <tr><td colspan="2"></td></tr>
                <tr><td>�̻�������</td><td><input size="50" type="text" name="p2_Order" value="<?php echo 'gree' . time(); ?>" /></td></tr>
                <tr><td>�������</td><td><input size="50" type="text" name="p3_Amt" value="0.1" /></td></tr>
                <tr><td>�Ƿ���鶩�����</td><td>
                        <input type="radio" name="p4_verifyAmt" value="true" checked="checked" />����
                        <input type="radio" name="p4_verifyAmt" value="false" />������
                    </td>
                </tr>
                <tr><td>��Ʒ����</td><td><input size="50" type="text" name="p5_Pid" value="" /></td></tr>
                <tr><td>��Ʒ����</td><td><input size="50" type="text" name="p6_Pcat" value="" /></td></tr>
                <tr><td>��Ʒ����</td><td><input size="50" type="text" name="p7_Pdesc" value="" /></td></tr>
                <tr><td>����֧�����֪ͨ��ַ</td><td><input size="50" type="text" name="p8_Url" value="http://localhost/yeepaycard/callback.php" /></td></tr>
                <tr><td>��ʱ��Ϣ</td><td><input size="50" type="text" name="pa_MP" value="��ʱ��Ϣ" /></td></tr>
                <tr><td>�����</td><td>
                        <input size="20" type="text" name="pa7_cardAmt[]"/>
                        <input size="20" type="text" name="pa7_cardAmt[]"/>
                        <input size="20" type="text" name="pa7_cardAmt[]"/>
                        <input size="20" type="text" name="pa7_cardAmt[]"/>
                    </td></tr>
                <tr><td>�����к�</td><td>
                        <input size="20" type="text" name="pa8_cardNo[]"/>
                        <input size="20" type="text" name="pa8_cardNo[]"/>
                        <input size="20" type="text" name="pa8_cardNo[]"/>
                        <input size="20" type="text" name="pa8_cardNo[]"/>
                    </td></tr>
                <tr><td>������</td><td>
                        <input size="20" type="text" name="pa9_cardPwd[]"/>
                        <input size="20" type="text" name="pa9_cardPwd[]"/>
                        <input size="20" type="text" name="pa9_cardPwd[]"/>
                        <input size="20" type="text" name="pa9_cardPwd[]"/>
                    </td></tr>
                <tr><td>֧��ͨ������</td><td><input size="50" type="text" name="pd_FrpId" value="" /><!--֧��ͨ���������ױ�֧�������п�֧��רҵ��ӿ��ĵ���--></td></tr>

                <tr><td>�û�Ψһ��ʶ</td>
                    <td><input size="50" type="text" name="pz_userId" value="100001" /></td>
                </tr>
                <tr><td>�û���ע��ʱ��</td><td><input size="50" type="text" name="pz1_userRegTime" value="2009-01-01 00:00:00" /></td></tr>
                <tr><td rowspan="2"></td><td><input type="submit" value="����֧��" onClick="return confirm('�����ͬʱʹ�õ�����ʵ�Ŀ��ܺ��ױ�֧���ṩ�Ĳ����̻�ID���в��ԣ�����֧�����������ױ��Ĳ����˻��������������')"/></td>
                </tr>
                <tr>
                    <td height="77"><p><font style="color:#FF0000;font-weight:bold">�˲���������ɽ��׷��գ������ͬʱʹ�õ�����ʵ�Ŀ��ܺ��ױ�֧���ṩ�Ĳ����̻�ID���в��ԣ�</font>
                            <br>
                            <font style="color:#FF0000;font-weight:bold">����֧�����������ױ��Ĳ����˻��������������</font><br>
                        </p></td>
                </tr>
            </table>
            <p>&nbsp;</p>
        </form>
    </body>
</html>
