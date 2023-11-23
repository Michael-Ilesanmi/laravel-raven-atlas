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


class Collections
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
     * Generate a Raven Collection account
     * @param $data 
     * @return $account
     */
    function initiate(array $data)
    {
        $account = Http::withToken($this->secretKey)->post($this->baseUrl.'/pwbt/generate_account', $data)->json();        
        return $account;
    }
    
    /**
     * Retrieve a single Raven Collection account
     * @param $session_id 
     * @return $account
     */
    function getAccount(string $session_id)
    {
        $account = Http::withToken($this->secretKey)->get($this->baseUrl.'/collections?session_id='.$session_id)->json();        
        return $account;
    }

    /**
     * Retrieve all Raven Collection accounts
     * @return $accounts
     */
    function getAccounts()
    {
        $accounts = Http::withToken($this->secretKey)->get($this->baseUrl.'/collections')->json();
        return $accounts;
    }
}