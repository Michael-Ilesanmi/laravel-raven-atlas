<?php 

/*
 * This file is part of the Raven Atlas package.
 *
 * (c) Michael Ilesanmi - localdev <ioluwamichael@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Localdev\RavenAtlas\Helpers;

use Illuminate\Support\Facades\Http;


class Merchant
{
    protected $publicKey;
    protected $secretKey;
    protected $baseUrl;

    /**
     * Construct
     */
    function __construct(String $publicKey, String $secretKey, String $baseUrl)
    {
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get merchant's wallet balance
     * @return $balance
     */
    function balance()
    {
        $balance = Http::withToken($this->secretKey)->post($this->baseUrl.'/accounts/wallet_balance')->json();
        return $balance;
    }

    /**
     * Update webhook details
     * @param $data
     * @return $response
     */
    function webhook(array $data)
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/webhooks/update', $data)->json();
        return $response;
    }
    
    /**
     * Change API keys
     * @return $response
     */
    function changeKeys()
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/accounts/change_keys')->json();
        return $response;
    }
    
    /**
     * Change API keys
     * @return $response
     */
    function changeKeysOTP(array $data)
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/accounts/change_keys_with_otp', $data)->json();
        return $response;
    }

    
}