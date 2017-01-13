<?php

namespace LeadClient;

use LeadClient\Helper\Validator;
use LeadClient\Helper\Sender;

class Client{
    
    /**
     * @var \LeadClient\Entity\Lead
     */
    private $_lead;

    /**
     * @param  \LeadClient\Entity\Lead $lead    
     * @throws \Exception
     */
    public function __construct(\LeadClient\Entity\Lead $lead) {
        $this->_lead = $lead;
        $this->_doValidate();
    }
    
    /**
     * Method Validate Lead
     *
     * @return void
     * @throws \Exception
     */    
    private function _doValidate(){
        
        try {
            $validator = new Validator($this->_lead);
            $this->_lead = $validator->getValidateLead();            
        } catch (\Exception $ex) {
            throw new \Exception("Errore nella validazione : ".$ex->getMessage());
        }                
    }        
    
    /**
     * Method Send Lead to Remote
     *
     * @return \LeadClient\Entity\LeadResponse
     * @throws \Exception
     */
    public function sendLead(){
        
        try {
            $sendLead = new Sender();
            $sendLead->send($this->_lead); 
            return $sendLead->getResult();
        } catch (Exception $ex) {
            throw new \Exception("Errore nell'invio della lead : ".$ex->getMessage());
        }
        
    }
    
}
