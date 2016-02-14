<?php

require './example.php';

use Thenbsp\Wechat\Payment\Unifiedorder;
use Thenbsp\Wechat\Payment\Qrcode\Temporary;

/**
 * 统一下单
 */
$unifiedorder = new Unifiedorder(APPID, MCHID, MCHKEY);
$unifiedorder->set('body',          'iphone 6 plus');
$unifiedorder->set('total_fee',     1);
$unifiedorder->set('out_trade_no',  date('YmdHis').mt_rand(10000, 99999));
$unifiedorder->set('notify_url',    'http://dev.funxdata.com/wechat/example/payment-unifiedorder.php');

/**
 * 生成二维码
 */
$qrcode = new Temporary($unifiedorder);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Wechat SDK</title>
</head>
<body ontouchstart="">

<h1>微信扫码支付-模式二</h1>
<p>请在 PC 端扫描二给码，如果在手机上可长按识别二维码</p>

<img src="http://qr.liantu.com/api.php?&bg=ffffff&fg=000000&text=<?php echo $qrcode; ?>" style="border:1px solid #ccc;" />

</script>
</body>
</html>