<?php
namespace LeadClient\Entity;

/**
 * 
 * @author Corrado
 */
class Lead {
    
    /** @var string */
    private $firstname;
    
    /** @var string */
    private $lastname;
    
    /** @var string */
    private $province;
    
    /** @var string */
    private $phone;
    
    /** @var string */
    private $sex;
    
    /** @var string */
    private $mail;
    
    /** @var string */
    private $ip;
    
    /** @var string */
    private $order_id;
    
    /** @var string */
    private $city;
    
    /** @var string */
    private $campaign;

    /** @var string */
    private $note;
    
    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getProvince() {
        return $this->province;
    }

    function getPhone() {
        return $this->phone;
    }

    function getSex() {
        return $this->sex;
    }

    function getMail() {
        return $this->mail;
    }

    function getIp() {
        return $this->ip;
    }

    function getOrder_id() {
        return $this->order_id;
    }

    function getCity() {
        return $this->city;
    }

    function getCampaign() {
        return $this->campaign;
    }

    function getNote() {
        return $this->note;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    function setProvince($province) {
        $this->province = $province;
        return $this;
    }

    function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    function setSex($sex) {
        $this->sex = $sex;
        return $this;
    }

    function setMail($mail) {
        $this->mail = $mail;
        return $this;
    }

    function setIp($ip) {
        $this->ip = $ip;
        return $this;
    }

    function setOrder_id($order_id) {
        $this->order_id = $order_id;
        return $this;
    }

    function setCity($city) {
        $this->city = $city;
        return $this;
    }

    function setCampaign($campaign) {
        $this->campaign = $campaign;
        return $this;
    }
    
    function setNote($note) {
        $this->note = $note;
        return $this;
    }
       
}
