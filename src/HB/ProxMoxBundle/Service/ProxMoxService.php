<?php

namespace HB\ProxMoxBundle\Service;

// Use the library namespace
use ProxmoxVE\Proxmox;

class ProxMoxService extends Proxmox
{
	
	public function __construct() {

		
		// Create your credentials array
		$credentials = [
				'hostname' => '192.168.11.19',  // Also can be an IP
				'port' => '8006',
				'username' => 'root',
				'password' => 'hb2015',
		];
		
		// realm and port defaults to 'pam' and '8006' but you can specify them like so
		/*$credentials = [
				'hostname' => 'proxmox.server.com',
				'username' => 'root',
				'password' => 'secret',
				'realm' => 'pve',
				'port' => '9009',
		];*/
		
		// Then simply pass your credentials when creating the API client object.
		return parent::__construct($credentials);

	}
	public function testMe()
	{
		return true;
	}
	
	public function getNodes() {
		return $this->get("/nodes");
	}
}