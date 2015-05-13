<?php

namespace CollecMe\CollectionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CollecMe\CollectionBundle\Entity\AppRole;
use CollecMe\CollectionBundle\Entity\RoleAssociation;


class UserController extends Controller
{

  /**
  * @Route("/user/list", name="user_list_route")
  */
  public function listUsers() {
    $repo = $this->getDoctrine()->getRepository('CollecMeCollectionBundle:AppUser');
    $users = $repo->findUsersAndRoles();
    return $this->render('CollecMeCollectionBundle:User:list.html.twig',array('users' => $users));
  }

  /**
  * @Route("/role/list", name="role_list_route")
  */
  public function listRoles(Request $request) {
    $repo = $this->getDoctrine()->getRepository('CollecMeCollectionBundle:AppRole');
    $roles = $repo->findAll();
    return $this->render('CollecMeCollectionBundle:Role:list.html.twig',array('roles' => $roles));

  }

  /**
  * @Route("/role/add", name="role_add_route")
  */
  public function addRole(Request $request) {
    // TODO handle with repository ?
    $name = $request->request->get('_roleName');
    $description = $request->request->get('_roleDescription');

    $role = new AppRole();
    $role->setRoleName($name);
    $role->setRoleDescription($description);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($role);
    $entityManager->flush();

    $this->get('session')->getFlashBag()->add('pop', 'Role '.$name.' successfully created');

    return $this->redirectToRoute('role_list_route');

  }

  /**
  * @Route("/role/delete/{roleId}/", name="role_delete_route")
  */
  public function deleteRole($roleId) {
    // TODO Quick and dirty implementation. To be secured, handle exception catching
    // TODO Declare SecurityRepository as repository for Role also
    $repo = $this->getDoctrine()->getRepository('CollecMeCollectionBundle:AppUser');
    $result = $repo->deleteRole($roleId);
    if($result) {
      $this->get('session')->getFlashBag()->add('pop', 'Role '.$roleId.' successfully deleted');
      return $this->redirectToRoute('role_list_route');
    }
    $error = "Could not delete role";
    return $this->redirectToRoute('role_list_route',array("error" => $error));

  }

  /**
  * @Route("/user/roles/{userId}", name="user_roles_route")
  */
  public function userRolesPage($userId) {
    $roleRepo = $this->getDoctrine()->getRepository('CollecMeCollectionBundle:AppRole');
    $allRoles = $roleRepo->findAll();

    $userRepo = $this->getDoctrine()->getRepository('CollecMeCollectionBundle:AppUser');

    $user = $userRepo->findOneById($userId);

    $userRepo = $this->getDoctrine()->getRepository('CollecMeCollectionBundle:AppUser');
    $userRoleNames = $userRepo->findRolesForUserId($userId);

    $content = array();
    foreach($allRoles as $role) {
      $roleName = $role->getRoleName();
      $toggled = in_array($roleName,$userRoleNames);
      $result = array("roleId" => $role->getId(),
                      "roleName" => $roleName,
                      "description" => $role->getRoleDescription(),
                      "enabled"=>$toggled);
      array_push($content, $result);
    }

    return $this->render("CollecMeCollectionBundle:User:addrole.html.twig",array(
                                                                              "user" => $user,
                                                                              "roles" => $content)

                                                                            );

  }

  /**
  * @Route("/user/addRole/{userId}/{roleId}", name="user_add_role_route")
  */
  public function addRoleToUser($userId,$roleId) {
    // TODO clean that, to many things
    $ra = new RoleAssociation;
    $userRepo = $this->getDoctrine()->getRepository('CollecMeCollectionBundle:AppUser');

    $user = $userRepo->findOneByLogin($userId);

    $roleRepo = $this->getDoctrine()->getRepository('CollecMeCollectionBundle:AppRole');
    $role = $roleRepo->findOneByRoleName($roleId);

    $ra->setAppUser($user);
    $ra->setAppRole($role);
    $ra->setSince(new \DateTime("now"));

    $em = $this->getDoctrine()->getManager();
    $em->persist($ra);
    $em->flush();

    $this->get('session')->getFlashBag()->add('pop', 'Role '.$roleId.' successfully added to user '.$userId);
    return $this->redirect("/user/roles/".$user->getId());

  }




}

?>
