<?php

namespace LeadClient\Helper;

use GuzzleHttp\Client;
use LeadClient\Entity\LeadResponse;

/**
 * 
 * @author Corrado
 */
class Sender {
    
    /**
     * @var object GuzzleHttp\Client
     */
    private $_client;     
    
    /**
     * @var object LeadClient\Entity\LeadResponse
     */
    private $_result;

    /**
     * Check if defined API_URL and API_KEY and instance GuzzleClient
     * 
     * @throws \Exception
     */
       
    public function __construct() {
                
        if(!defined("API_URL")){
            throw new \Exception("La costante API_URL non e' definita");
        }
        if(!defined("API_KEY")){
            throw new \Exception("La costante API_KEY non e' definita");
        }
        $this->_client = new Client([            
            'base_uri' => API_URL,     
            'headers' => ['apikey' => API_KEY]
        ]);
    }
    
    /**
     * Method send lead to remote
     * 
     * @param \LeadClient\Entity\Lead $lead
     * @throws \Exception
     */
    function send(\LeadClient\Entity\Lead $lead){
        
        $params = [
            "firstname" => $lead->getFirstname(),
            "lastname" => $lead->getLastname(),
            "province" => $lead->getProvince(),
            "phone" => $lead->getPhone(),
            "sex" => $lead->getSex(),
            "mail" => $lead->getMail(),
            "ip" => $lead->getIp(),
            "order_id" => $lead->getOrder_id(),
            "city" => $lead->getCity(),
            "campaign" => $lead->getCampaign(),
            "api_token" => API_KEY   
        ];        
        try{
            $response = $this->_client->request("POST", "providers/contact/format/json",[
                "form_params" => $params
            ]);            
            $this->_result = new LeadResponse($response) ;            
        } catch (\GuzzleHttp\Exception\ClientException $ex) {
            throw new \Exception($ex->getMessage());
        }                
    }
    
    /**
     * 
     * @return type 
     */
    function getResult() {
        return $this->_result;
    }

}
