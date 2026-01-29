<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_parameters
{

    public function get()
    {
        $path = APPPATH . 'views/user_semester/online_examination/parameters.json';

        if (!file_exists($path)) {
            return null;   // or return []
        }

        return file_get_contents($path);
    }

    // Optional helper if you want array
    public function getArray()
    {
        $content        = $this->get();
        return $content ? json_decode($content, true) : [];
    }
    
}
