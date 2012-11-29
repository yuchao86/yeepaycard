
首先欢迎您选择易宝支付提供的支付接入服务。此目录的例子是PHP代码版本的，您可以直接把所有文件放在WEB服务器上应用的目录下，进行测试运行。

1)文件列表说明。
|----index.html(提供给商户测试用的首页)
|----req.php(支付请求文件，通过此文件发起支付请求，商家可以在此文件中写入自己的订单信息等，然后把请求提交给易宝支付)
|----callback.php(支付结果返回文件，通过此文件商家判断对应订单的支付状态，并且根据结果修改自己数据库中的订单状态)
|----merchantProperties.php(商家属性文件，商家可以在此文件中修改商户编号和密钥信息)
|----YeePayCommon.php(共通函数文件，不需要进行任何修改)
|----HttpClient.class.php(共通函数文件，用于服务器通讯)

2)商家测试可以先用易宝支付的测试商家测试成功再在merchantProperties.php文件中修改成自己的商户编号和密钥信息。
merchantId = "10001126856";
keyValue = "69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl";
商户编号和密钥需要同时修改才有效！
	
3)支付成功的返回URL请在index.html文件中进行修改。
$p8_Url = "http://localhost/CARDpro/callback.php"; 
商家正式运行时，必须把自己的服务器部署在公网上的服务器上，这样支付成功后易宝支付的服务器才能支付结果及时返回给商家。
	
4)共通文件采用服务器包含的方式进行处理。
如：
include 'yeepayCommon.php';
所以如果您修改共通文件请帮助每个文件能够编译通过。

5)请确保iconv函数，这样就可以支持中文参数。

6)本地的STR，商户编号和KEY的查找位置(在出现“交易签名无效”的错误时需要查找STR)
str:在 虚拟目录下的日志文件中 默认是 YeePay_CARD.log
商户编号:在 merchantProperties.php 文件中的 p1_MerId
keyValue:在 merchantProperties.php 文件中的 merchantKey

7)log保存地址配置
merchantProperties.php文件中的logName	

8)在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理

注意：
提交订单信息到易宝支付的接口，易宝支付即时返回的结果是提交结果，订单的支付结果在易宝支付系统处理完订单信息后返回到订单提交时提交的商户接收支付数据的地址上

