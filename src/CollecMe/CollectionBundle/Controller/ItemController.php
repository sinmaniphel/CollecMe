<?php
namespace CollecMe\CollectionBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CollecMe\CollectionBundle\Entity\AppUser;
use CollecMe\CollectionBundle\Entity\Collectible;
use CollecMe\CollectionBundle\Entity\ItemCaracteristics;

/**
 * AppUser controller.
 *
 * @Route("/item")
 */
class ItemController extends Controller
{

    /**
     *
     * @Route("/list", name="route_item_list")
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

    /**
     *
     *@Route("/edit")
     */
    function editItem() {
        return $this->render('CollecMeCollectionBundle:Display:item.html.twig');
    }

    /**
     *
     *@Route("/new")
     */
    function newItem(Request $request) {

        $item = new Collectible();

        $formType = $this->get('colme.form.type.collectible');

        $form = $this->createForm($formType,$item);
        
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            return $this->redirectToRoute('route_item_list');
        }
        
        return $this->render('CollecMeCollectionBundle:Collectible:new-collectible.html.twig',array('form' => $form->createView(),));
    }

    
}