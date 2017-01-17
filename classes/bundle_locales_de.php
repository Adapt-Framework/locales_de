<?php

namespace adapt\locales\de{
    
    /* Prevent Direct Access */
    defined('ADAPT_STARTED') or die;
    
    class bundle_locales_de extends \adapt\bundle{
        
        public function __construct($data){
            parent::__construct('locales_de', $data);
        }
        
        public function boot(){
            if (parent::boot()){
                
                /* Add the validators */
                $this->sanitize->add_validator('de_phone', "^(\+49|0)[1-9]{2,11}$");
                
                $this->sanitize->add_validator('de_postcode', "^[0-9]{5,5}$");
                
                /* Add formatters */
                
                $this->sanitize->add_format('de_time',
                    function($value){
                        return \adapt\date::convert_date('H:i:s', 'H:i', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('H:i:s', 'H:i', value);
                    }"
                );
                
                $this->sanitize->add_format('de_datetime',
                    function($value){
                        return \adapt\date::convert_date('Y-m-d H:i:s', 'Y-m-d H:i', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('Y-m-d H:i:s', 'Y-m-d H:i', value);
                    }"
                );
                
                
                /* Add unformatters */
                
                $this->sanitize->add_unformat('de_time',
                    function($value){
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('Hi', 'H:i:s', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('Hi', 'H:i:s', value);
                    }"
                );
                
                $this->sanitize->add_unformat('de_datetime',
                    function($value){
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('dmYHi', 'Y-m-d H:i:s', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('YmdHi', 'Y-m-d H:i:s', value);
                    }"
                );

                
                return true;
            }
            
            return false;
        }
        
    }
    
    
}

?>