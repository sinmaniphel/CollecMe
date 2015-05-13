<?php

namespace CollecMe\CollectionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{

  /**
  * @Route("/login_check", name="login_check_route")
  */
  public function checkLogin() {

  }

  /**
  * @Route("/login", name="login_route")
  */
  public function doLogin(Request $request) {
    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render(
        'CollecMeCollectionBundle:Security:login.html.twig',
        array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error'         => $error,
        )
    );
  }



}

?>
