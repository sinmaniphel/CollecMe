<?php
namespace CollecMe\CollectionBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CollecMe\CollectionBundle\Entity\AppUser;

/**
 * AppUser controller.
 *
 * @Route("/item")
 */
class ItemController extends Controller
{

    /**
     *
     * @Route("/list")
     */
    function displaySampleList() {
       return $this->render('CollecMeCollectionBundle:Display:item-grid.html.twig');
    }

    /**
     *
     * @Route("/show")
     */
    function displayItem() {
        return $this->render('CollecMeCollectionBundle:Display:item.html.twig');
    }

    
}