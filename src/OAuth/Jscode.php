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

namespace Thenbsp\Wechat\OAuth;

use Thenbsp\Wechat\Bridge\Http;

class Jscode
{
    const JSCODE2SESSION = "https://api.weixin.qq.com/sns/jscode2session";
    /**
     * 公众号 Appid.
     */
    protected $appid;

    /**
     * 公众号 AppSecret.
     */
    protected $appsecret;

    public function __construct($appid, $appsecret)
    {
        $this->appid     = $appid;
        $this->appsecret = $appsecret;
    }

    public function getSession($code)
    {
        $query = [
            'appid'      => $this->appid,
            'secret'     => $this->appsecret,
            'js_code'    => $code,
            'grant_type' => 'authorization_code'
        ];

        $response = Http::request('GET', static::JSCODE2SESSION)
            ->withQuery($query)
            ->send();

        if (0 != $response['errcode']) {
            throw new \Exception($response['errmsg'], $response['errcode']);
        }

        return $response;
    }
}