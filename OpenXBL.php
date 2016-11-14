<?php

class OpenXBL
{
	private $url_base = "https://xbl.io/api/";
	private $version = "v1";
	var $key;

	public function __construct($apiKey)
	{
		$this->key = $apiKey;
	}

    public function call($method, $url, $options = array())
    {
        $crl = curl_init($this->url_base . $this->version . $url);
        $headr = array();

        if( !empty( $options['headers'] ) )
        {
            foreach( $options['headers'] as $header => $value )
            {
                $headr[] = $header . ':' . $value;
            }
        }

        // pass in the key
        $headr[] = 'X-Authorization: ' . $this->key;

        curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        if($method == 'POST')
        {
            if( !empty( $options['payload'] ) )
            {
                curl_setopt( $crl, CURLOPT_POSTFIELDS, json_encode( $options['payload'] ) );
            }
            
            curl_setopt($crl, CURLOPT_POST,true);           
        }
        else if( $method == 'GET' )
        {
            curl_setopt($crl, CURLOPT_POST,false);     
        }
        else
        {
            curl_setopt($crl, CURLOPT_CUSTOMREQUEST, $method);
        }

        $results = json_decode(curl_exec($crl), true);

        return $results['data'];
    }
}
