<?php
namespace LeadClient\Helper;

/**
 * @author Corrado
 */
class Validator {
    
    /**
     * @var \LeadClient\Entity\Lead
     */
    private $data;        
     
    /**
     * @param  \LeadClient\Entity\Lead $lead    
     * @throws \Exception
     */
    function __construct(\LeadClient\Entity\Lead $lead){
       $this->data = $lead;
       $this->_validateLead();
    }
     
    /**
     * Method Validate single field of Lead
     *
     * @return void
     * @throws \Exception
     */ 
    private function _validateLead() {        
        
        $this->_validateFirstAndLastName();       
        $this->_validateEmail();
        $this->_validatePhone();
        $this->_validateCampaign();
        $this->_validateIP(); 
    }
    
    /**
     * Method Validate First and Lastname
     *
     * @return void
     * @throws \Exception
     */
    private function _validateFirstAndLastName(){


        if(!$this->data->getFirstname() || !preg_match('/^[a-zA-Z -]+$/',  $this->data->getFirstname())){
            throw new \Exception("Il nome inserito non è valido");
        }else{          
            $this->data->setFirstname($this->_capitalizeFirst($this->data->getFirstname()));           
        }
        
        if($this->data->getLastname() !== Null){
            if(!preg_match('/^[a-zA-Z -]+$/',  $this->data->getLastname())){
               throw new \Exception("Il cognome inserito non è valido");
            }else{
              $this->data->setLastname($this->_capitalizeFirst($this->data->getLastname()));  
            }
        }
        
    }
    
    /**
     * Method Validate Email
     *
     * @return void
     * @throws \Exception
     */
    private function _validateEmail(){
        if($this->data->getMail() !== Null){
            if (!filter_var($this->data->getMail(), FILTER_VALIDATE_EMAIL)) {
               throw new \Exception("Inserire una mail valida");
            }
        }
                
    }
    
    /**
     * Method Validate Phone
     *
     * @return void
     * @throws \Exception
     */
    private function _validatePhone(){
        
        if(!$this->data->getPhone()|| 
                (preg_match('/^((00|\+)39[\. ]??)??3\d{2}[\. ]??\d{6,7}$/',  $this->data->getPhone())===0 &&
                       preg_match('/^((00|\+)39[\. ]??)??0\d{2,3}[\. ]??\d{5,7}$/', $this->data->getPhone())===0)){
           throw new \Exception("Inserire un numero di telefono valido.");
        }
        
    }
    
    
    /**
     * Method Validate Campaign, if empty set Dafault Campaign
     *
     * @return void
     * @throws \Exception
     */
    private function _validateCampaign() {
        
        if(!$this->data->getCampaign()){
            if(!defined("DEFAULT_CAMPAIGN")){
                throw new \Exception("Inserire una campagna di default");
            }else{
                $this->data->setCampaign(DEFAULT_CAMPAIGN);
            }
        }                
    }
    
    /**
     * Method Validate Ip, if empty set Remote address or get ip from whatismyip.org
     *
     * @return void
     * @throws \Exception
     */
    private function _validateIP() {
        
        if(!$this->data->getIp()){
            if(isset($_SERVER["REMOTE_ADDR"])){
                $this->data->setIp($_SERVER["REMOTE_ADDR"]);
            }else{
                $this->data->setIp($this->_getRemoteIp());
            }
        }
    }                
    
     
    /**
     * Method to get ip machine
     *
     * @return strimg ip_address
     */
    private function _getRemoteIp(){
    
        try{
            $client =  new \GuzzleHttp\Client([            
                'base_uri' => 'http://whatismyip.org'
            ]);
            $response = $client->request('GET', '/');
            $result = (string) $response->getBody();
            if(preg_match('/(?:[0-9]{1,3}\.){3}[0-9]{1,3}/', $result, $matches)){
                return $matches[0];
            }else{
                return getHostByName(getHostName());
            }
        } catch (\GuzzleHttp\Exception\ClientException $ex) {
            return getHostByName(getHostName());
        }                       
    }

    /**
     * Method to capitalize first letter of string
     * @param type $string
     * @return type $string
     */
    private function _capitalizeFirst($string){
        
        return ucfirst(strtolower($string));
        
    }        
    
    /**
     * 
     * @return \LeadClient\Entity\Lead
     */
    function getValidateLead(){
        
        return $this->data;
    }    
        
}
