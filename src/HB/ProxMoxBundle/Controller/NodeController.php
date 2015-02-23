<?php

namespace HB\ProxMoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class NodeController extends Controller {
	/**
	 * @Route("/nodes")
	 * @Template()
	 */
	public function indexAction() {
		$proxmox = $this->container->get ( 'hb_prox_mox.api' );
		
		$nodes = $proxmox->get ( "/nodes" );
		
		return array (
				'nodes' => $nodes ['data'] 
		);
	}
	
	/**
	 * @Route("/node/{node}", name="node_read")
	 * @Template()
	 */
	public function readAction($node) {
		$proxmox = $this->container->get ( 'hb_prox_mox.api' );
		
		$node_pm = $proxmox->get ( "/nodes/".$node );
		$node_status = $proxmox->get("/nodes/".$node."/status");

		$vms = $proxmox->get( "/nodes/".$node."/qemu");
		
		return array (
				'node_name' => $node,
				'node' => $node_pm ['data'],
				'status' => $node_status['data'],
				'vms' => $vms['data']
		);
	}
}
