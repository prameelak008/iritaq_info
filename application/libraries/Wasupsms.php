                                        <?php
                                        if (!defined('BASEPATH')) {
                                        exit('No direct script access allowed');
                                        }
                                        
                                        class Wasupsms
                                        {
                                        private $_CI;
                                        public $URL            = "https://quicksender.co.in/api/send.php?";
                                        var $AUTH_KEY;     
                                        var $senderId; 
                                        var $routeId; 
                                        var $smsContentType; 
                                        
                                        
                                        public function __construct($params)
                                        {
                                        $this->_CI          = &get_instance();
                                        
                                        $this->AUTH_KEY=$params['authkey'];     
                                        $this->senderId=$params['senderid']; 
                                        $this->api_id=$params['api_id']; 
                                        $this->smsContentType="";
                                        $this->session_name = $this->_CI->setting_model->getCurrentSessionName();
                                        }
                                        
                                        
                                        
                                        
                                        public function sendSms($to, $message)
                                        {
                                        $api_ky            =  $this->api_id;
                                        $type              =  "text";      
                                        $string_from_array = implode(',',$to);
                                        $content = 'number=' . $string_from_array .
                                        '&type=' . rawurlencode($type) .
                                        '&message=' . rawurlencode($message) .
                                        '&instance_id=' . $this->senderId .
                                        '&access_token=' . rawurlencode($this->AUTH_KEY) ;
                                        $ch = curl_init($api_ky . $content);
                                        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                                        $response = curl_exec($ch);
                                        curl_close($ch);
                                        return $response;
                                        }
                                        
                                        
                                        
                                        public function sendSms_absent($to, $message)
                                        {
                                        $api_ky            =  $this->api_id;
                                        $type              =  "text";      
                                        $string_from_array = implode(',',$to);
                                        $content = 'number=' . $string_from_array .
                                        '&type=' . rawurlencode($type) .
                                        '&message=' . rawurlencode($message) .
                                        '&instance_id=' . $this->senderId .
                                        '&access_token=' . rawurlencode($this->AUTH_KEY) ;
                                        $ch = curl_init($api_ky . $content);
                                        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                                        $response = curl_exec($ch);
                                        curl_close($ch);
                                        return $response;
                                        }
                                        }
