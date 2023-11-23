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


class Transactions
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
     * Get all transactions for a merchant
     * @return $transactions
     */
    function all()
    {
        $transactions = Http::withToken($this->secretKey)->get($this->baseUrl.'/accounts/transactions')->json();
        
        return $transactions;
    }
}