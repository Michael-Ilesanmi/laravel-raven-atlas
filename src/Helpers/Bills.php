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


class Bills
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
     * Get all Data Plans
     * @return $plans
     */
    function dataPlans()
    {
        $plans = Http::withToken($this->secretKey)->get($this->baseUrl.'/data_plans')->json();
        return $plans;
    }
  
    /**
     * Purchase a data plan
     * @param $data
     * @return $response
     */
    function purchaseData(array $data)
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/data_plans/recharge', $data)->json();
        return $response;
    }
  
    /**
     * Fetch Data Purchase Records 
     * @return $records
     */
    function dataRecords()
    {
        $records = Http::withToken($this->secretKey)->get($this->baseUrl.'/data/records')->json();        
        return $records;
    }

}