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


class Transfers
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
     * Make a transfer
     * @param $data 
     * @return $transfer
     */
    function initiate(array $data)
    {
        $transfer = Http::withToken($this->secretKey)->post($this->baseUrl.'/transfers/create', $data)->json();
        
        return $transfer;
    }
    
    /**
     * Account Number Lookup
     * @param $data 
     * @return $account
     */
    function findAccount(array $data)
    {
        $account = Http::withToken($this->secretKey)->post($this->baseUrl.'/account_number_lookup', $data)->json();
        
        return $account;
    }
    
    /**
     * Get list of all banks
     * @return $banks
     */
    function banks()
    {
        $banks = Http::withToken($this->secretKey)->get($this->baseUrl.'/banks')->json();

        // sort banks by name
        usort($banks['data'], function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        
        return $banks;
    }

    /**
     * Get single  transfer
     * @param $reference 
     * @return $reference
     */
    function getTransfer(string $reference)
    {
        $transfer = Http::withToken($this->secretKey)->get($this->baseUrl.'/get-transfer?trx_ref='.$reference)->json();
        
        return $transfer;
    }
}