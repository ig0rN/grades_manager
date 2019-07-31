<?php

namespace App\Responder;
use App\Interfaces\OutputInterface;

class XMLStringOutput implements OutputInterface
{

    public function load($arrayOfData, $rootElement = null, $xml = null)
    {
        $_xml = $xml; 
      
        // If there is no Root Element then insert root 
        if ($_xml === null) { 
            $_xml = new \SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>'); 
        } 
        
        // Visit all key value pair 
        foreach ($arrayOfData as $k => $v) { 
            
            // If there is nested array then 
            if (is_array($v)) {  
                
                // Call function for nested array 
                arrayToXml($v, $k, $_xml->addChild($k)); 
                } 
                
            else { 
                
                // Simply add child element.  
                $_xml->addChild($k, $v); 
            } 
        } 
        
        return $_xml->asXML(); 
    }   

}