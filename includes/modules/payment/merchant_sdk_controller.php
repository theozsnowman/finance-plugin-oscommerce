<?php
/**
 * Created by PhpStorm.
 * User: freddie.line
 * Date: 2019-03-18
 * Time: 14:01
 */


class MerchantSDKController
{

    private $sdk;


    /**
     * Constructor
     */
    function __construct($apiKey, $env = \Divido\MerchantSDK\Environment::SANDBOX) {
        $this->sdk = new \Divido\MerchantSDK\Client($apiKey, $env);
    }

    /**
     * get all finance plans
     */
    public function getAllFinancePlans(){
        // Set any request options.
        $requestOptions = (new \Divido\MerchantSDK\Handlers\ApiRequestOptions());

        // Retrieve all finance plans for the merchant.
        $plans = $this->sdk->getAllPlans($requestOptions);

        return $plans->getResources();
    }
}