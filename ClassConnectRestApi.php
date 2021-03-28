<?php
/**
 * Description of ClassConnectRestApi
 *
 * @author Adam Berger
 */
class ClassConnectRestApi {
     public $URL      = null;
     public $protokol = null;
     public $method   = null;
     public $header   = null;
     public $content  = null;
     public $tmeOut   = 60;
     private $streamContext = null;
     
    public function __construct($url){
         $this->URL = $url;
    }
     
    private function setOptions(){
        if(empty($this->content) || 
           empty($this->protokol) ||
           empty($this->method) ||
           empty($this->header)){
            throw new Exception("Options bez parametrów");
        }

        if(is_array($this->content)){
            // array
             $contentt = http_build_query($this->content);
        }else{
            // jonson
            $contentt = $this->content;
        }

      $options = [$this->protokol =>[
                  "method" => $this->method,
                  "header" => $this->header,
                  "content" => $contentt,
                  "timeout" => $this->tmeOut
                           ]
                 ]; 
      $this->streamContext = stream_context_create($options);
    }
    
    public function apiViewAll() {
        
        $this->setOptions();
        
        if(empty($this->streamContext) ||
           empty($this->URL)){
           throw new Exception("Stream Context bez parametrów lub brak adresu");
        }
        return file_get_contents($this->URL, false, $this->streamContext);    
    }
}
