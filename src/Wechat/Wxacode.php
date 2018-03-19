<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

namespace Thenbsp\Wechat\Wechat;

use Thenbsp\Wechat\Bridge\Http;

class Wxacode
{

    const CODE_URL    = "https://api.weixin.qq.com/wxa/getwxacode";
    const UNLIMIT_URL = "https://api.weixin.qq.com/wxa/getwxacodeunlimit";
    const QRCODE_URL  = "https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode";

    /**
     * Thenbsp\Wechat\Wechat\AccessToken.
     */
    protected $accessToken;

    /**
     * 构造方法.
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function get($path, $option = [])
    {
        $option['path'] = $path;

        return $this->getCodeResponse(self::CODE_URL, $option);
    }

    public function getUnlimit($scene, $option = [])
    {
        $option['scene'] = $scene;

        return $this->getCodeResponse(self::UNLIMIT_URL, $option);
    }

    public function getQrCode($path, $width = null)
    {
        return $this->getCodeResponse(self::QRCODE_URL, array_filter(['path' => $path, 'width' => $width]));
    }

    protected function getCodeResponse($url, $body)
    {
        $response = Http::request('POST', $url)
            ->withAccessToken($this->accessToken)
            ->withBody($body)
            ->send();

        if (0 != $response['errcode']) {
            throw new \Exception($response['errmsg'], $response['errcode']);
        }

        return $response;
    }

}