<?php

namespace HB\ProxMoxBundle\Service;

// Use the library namespace
use ProxmoxVE\Proxmox;

class ProxMoxService extends Proxmox
{
	
	public function __construct($hostname, $port, $realm, $user, $password) {

		
		// Create your credentials array
		$credentials = [
				'hostname' => $hostname,  // Also can be an IP
				'port' => $port,
				'realm' => $realm,
				'username' => $user,
				'password' => $password,
		];

		// Then simply pass your credentials when creating the API client object.
		return parent::__construct($credentials);

	}
}