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


class Cards
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
     * Generate a Raven Virtual Card
     * @param $data 
     * @return $card
     */
    function generate(array $data)
    {
        $card = Http::withToken($this->secretKey)->post($this->baseUrl.'/cards/create', $data)->json();
        
        return $card;
    }
    
    /**
     * Fund a Raven Virtual Card
     * @param $data 
     * @return $response
     */
    function fund(array $data)
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/cards/fund', $data)->json();
        
        return $response;
    }
    
    /**
     * Retrieve a single Raven Virtual Card
     * @param $card_id 
     * @return $card
     */
    function getVirtualCard(string $card_id)
    {
        $card = Http::withToken($this->secretKey)->get($this->baseUrl.'/cards/card?card_id='.$card_id)->json();
        
        return $card;
    }

    /**
     * Retrieve all Raven Virtual Card 
     * @return $cards
     */
    function getVirtualCards()
    {
        $cards = Http::withToken($this->secretKey)->get($this->baseUrl.'/cards/all')->json();
        
        return $cards;
    }

    /**
     * Retrieve all Transactions for A Raven Virtual Card
     * @param $card_id 
     * @return $transactions
     */
    function transactions(string $card_id)
    {
        $transactions = Http::withToken($this->secretKey)->get($this->baseUrl.'/cards/transactions?card_id='.$card_id)->json();
        
        return $transactions;
    }

    /**
     * Freeze a Raven Virtual Card
     * @param $data 
     * @return $response
     */
    function freeze(array $data)
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/cards/freeze', $data)->json();
        
        return $response;
    }

    /**
     * Unfreeze a Raven Virtual Card
     * @param $data 
     * @return $response
     */
    function unfreeze(array $data)
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/cards/unfreeze', $data)->json();
        
        return $response;
    }

    /**
     * Withdraw from a Raven Virtual Card
     * @param $data 
     * @return $response
     */
    function withdraw(array $data)
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/cards/withdraw', $data)->json();        
        return $response;
    }

    /**
     * Enable Email notifications for cards
     * @return $response
     */
    function alert()
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/cards/enable_alert')->json();        
        return $response;
    }

    /**
     * Retrieve Raven Virtual Card Fees
     * @return $fees
     */
    function fees()
    {
        $fees = Http::withToken($this->secretKey)->get($this->baseUrl.'/cards/fees')->json();
        return $fees;
    }
}