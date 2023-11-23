<?php 

/*
 * This file is part of the Raven Atlas package.
 *
 * (c) Michael Ilesanmi - localdev <ioluwamichael@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Localdev\RavenAtlas;

use Illuminate\Support\Facades\Http;
use Localdev\RavenAtlas\Helpers\Bills;
use Localdev\RavenAtlas\Helpers\Cards;
use Localdev\RavenAtlas\Helpers\Collections;
use Localdev\RavenAtlas\Helpers\Merchant;
use Localdev\RavenAtlas\Helpers\Transactions;
use Localdev\RavenAtlas\Helpers\Transfers;
use Localdev\RavenAtlas\Helpers\Verifications;

class RavenAtlas 
{
    protected $publicKey;
    protected $secretKey;
    protected $baseUrl;
    protected $webhookSecret;

    /**
     * Construct
     */
    function __construct()
    {
        $this->publicKey = config('raven.publicKey');
        $this->secretKey = config('raven.secretKey');
        $this->baseUrl = config('raven.baseUrl');
        $this->webhookSecret = config('raven.webhookSecret');
    }

    /**
     * Generate a Unique Transaction Reference
     * @return string
     */
    public function generateTransactionRef(): string
    {
        $reference = 'rv_' . uniqid(time());;
        return $reference;
    }

    
    /**
     * Confirms webhook `secret` is the same as the environment variable
     * @param $request
     * @return boolean
     */
    public function verifyWebhook()
    {
        // https://raven-atlas.readme.io/docs/introduction-to-webhook 
        if (request()->secret) {
            $requestSecret = request()->secret;
            // confirm that the secret matches
            if ($requestSecret == $this->webhookSecret) {
                return true;
            }
        }
        return false;
    }

    /**
     * Bills
     * @return Bills
     */
    public function bills()
    {
        $bills = new Bills($this->publicKey, $this->secretKey, $this->baseUrl);
        return $bills;
    }
    
    /**
     * Cards
     * @return Cards
     */
    public function cards()
    {
        $cards = new Cards($this->publicKey, $this->secretKey, $this->baseUrl);
        return $cards;
    }
    
    /**
     * Collections
     * @return Collections
     */
    public function collections()
    {
        $collections = new Collections($this->publicKey, $this->secretKey, $this->baseUrl);
        return $collections;
    }
    
    /**
     * Merchant
     * @return Merchant
     */
    public function merchant()
    {
        $merchant = new Merchant($this->publicKey, $this->secretKey, $this->baseUrl);
        return $merchant;
    }
    
    /**
     * Transactions
     * @return Transactions
     */
    public function transactions()
    {
        $transactions = new Transactions($this->publicKey, $this->secretKey, $this->baseUrl);
        return $transactions;
    }
    
    /**
     * Transfers
     * @return Transfers
     */
    public function transfers()
    {
        $transfers = new Transfers($this->publicKey, $this->secretKey, $this->baseUrl);
        return $transfers;
    }
    
    /**
     * Verifications
     * @return Verifications
     */
    public function verifications()
    {
        $verifications = new Verifications($this->publicKey, $this->secretKey, $this->baseUrl);
        return $verifications;
    }
}