<?php

namespace HB\ProxMoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * 
 * @author humanbooster
 * @Route("/node/{node}")
 */
class VmController extends Controller {
	/**
	 * @Route("/vms")
	 * @Template()
	 */
	public function indexAction($node) {
		$proxmox = $this->container->get ( 'hb_prox_mox.api' );
		
		$nodes = $proxmox->get ( "/nodes" );
		
		return array (
				'nodes' => $nodes ['data'] 
		);
	}
	
	/**
	 * @Route("/vm/{vmid}", name="vm_read")
	 * @Template()
	 */
	public function readAction($node, $vmid) {
		$proxmox = $this->container->get ( 'hb_prox_mox.api' );
		
		$node_pm = $proxmox->get ( "/nodes/".$node );

		$vm = $proxmox->get( "/nodes/".$node."/qemu/".$vmid);
		
		return array (
				'node' => $node_pm ['data'],
				'vm' => $vm['data']
		);
	}
	
	/**
	 * @Route("/vm/{vmid}/clone", name="vm_clone")
	 * @Template()
	 */
	public function cloneAction($node, $vmid) {
		$proxmox = $this->container->get ( 'hb_prox_mox.api' );
	
		// get next insert Id
		$newid = $proxmox->get("/cluster/nextid")['data'];
		
		print_r($newid);
		
		$post = ["newid"=> $newid,
				"node" => $node,
				"vmid" => $vmid];
		
		$response = $proxmox->create("/nodes/".$node."/qemu/".$vmid."/clone", $post);
		
		return $this->redirect( $this->generateUrl("vm_read", array("node" => $node, "vmid" => $newid)) );
	}
}
