<?php

namespace LeadClient\Entity;

/**
 * Class to capture response from remote and set standard output
 *
 * @author Corrado
 */
class LeadResponse {
    
    /**
     *
     * @var boolean
     */
    private $_isValidSend = FALSE;
    
    /**
     *
     * @var integer
     */
    public $code;
    
    /**
     *
     * @var string
     */
    public $status;
    
    /**
     *
     * @var string
     */
    public $message;
    
    /**
     *
     * @var string
     */
    public $lead_token;
    
    /**
     * 
     * @param \GuzzleHttp\Psr7\Response $response
     */    
    public function __construct(\GuzzleHttp\Psr7\Response $response) {

        $result = json_decode((string) $response->getBody());
        $this->code = (isset($result->code)) ? $result->code : 500;
        $this->status = (isset($result->status)) ? $result->status : "ERROR";
        if($this->status == "SUCCESS" || $this->status =="WARNINGS"){
            $this->_isValidSend = TRUE;
        }
        $this->lead_token = (isset($result->lead_token)) ? $result->lead_token : NULL;        
        $this->message = $result->message;
    }
    
    /**
     * 
     * @return boolean
     */
    function isValid(){
        
        return $this->_isValidSend;
    }
}
