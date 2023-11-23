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


class Verifications
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
     * Verify a BVN
     * @param $data
     * @return $bvn
     */
    function bvn(array $data)
    {
        $bvn = Http::withToken($this->secretKey)->post($this->baseUrl.'/bvn/verify', $data)->json();
        
        return $bvn;
    }

    /**
     * Verify a NIN
     * @param $data
     * @return $nin
     */
    function nin(array $data)
    {
        $nin = Http::withToken($this->secretKey)->post($this->baseUrl.'/nin/verify', $data)->json();
        
        return $nin;
    }

    /**
     * Verify a Voter's Card
     * @param $data
     * @return $pvc
     */
    function pvc(array $data)
    {
        $pvc = Http::withToken($this->secretKey)->post($this->baseUrl.'/pvc/verify', $data)->json();
        
        return $pvc;
    }

    /**
     * Verify a Voter's Card
     * @param $data
     * @return $passport
     */
    function passport(array $data)
    {
        $passport = Http::withToken($this->secretKey)->post($this->baseUrl.'/passport/verify', $data)->json();
        
        return $passport;
    }
    
    /**
     * Verify a Voter's Card
     * @param $data
     * @return $license
     */
    function license(array $data)
    {
        $license = Http::withToken($this->secretKey)->post($this->baseUrl.'/drivers_license/verify', $data)->json();
        
        return $license;
    }

    /**
     * Verify a Driver's License
     * @param $data
     * @return $response
     */
    function imageMatch(array $data)
    {
        $response = Http::withToken($this->secretKey)->post($this->baseUrl.'/image/match', $data)->json();
        
        return $response;
    }
   
}