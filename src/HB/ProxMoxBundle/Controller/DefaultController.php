<?php

namespace HB\ProxMoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/test")
     * @Template()
     * 
     */
    public function testAction()
    {
    	$proxmox = $this->container->get('hb_prox_mox.api');
    	if ($proxmox->testMe()) echo "Génial";
    	return array();
    }
}
