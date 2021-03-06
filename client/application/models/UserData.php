<?php

class Application_Model_UserData {
	/**
	 * 
	 * @var array
	 */
	private $raw_data;
	
	/**
	 * 
	 * @var array
	 */
	public $comune;
	
	/**
	 * 
	 * @var array
	 */
	public $agenziaentrate;
	
	/**
	 * 
	 * @var array
	 */
	public $agenziaterritorio;
	
	
	/**
	 * 
	 * @param array $raw_data an array of pair the contact uri and the data 
	 * received from that resource server
	 */
	public function __construct(array $raw_data) {
		$this->raw_data = $raw_data;
		
		//TODO RAW DATA MUST BE WITHOUT server uri or token part
		foreach ($this->raw_data as $rd) {
			$resource_server = $rd[0];
			$data = $rd[1];
			
			$this->decode_data($data);
		}
			
	}
	
	
	private function decode_data($data) {
		$array_data = json_decode(base64_decode($data), true);
		
		if ($array_data == false || 
				!is_array($array_data) || 
				!isset($array_data['type']))
			return; //not recognized data
		
		switch ($array_data['type']) {
			case 'comune':
				$this->comune = $array_data;
				break;		
			case 'agenziaentrate':
				$this->agenziaentrate = $array_data;
				break;
			case 'agenziaterritorio':
				$this->agenziaterritorio = $array_data;
				break;
			
		}
	}
}

