<?php

namespace CollecMe\CollectionBundle\Repository;
use Doctrine\ORM\EntityRepository;
use CollecMe\CollectionBundle\Entity\AppUser;
use CollecMe\CollectionBundle\Entity\AppRole;
use CollecMe\CollectionBundle\Entity\RoleAssociation;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class SecurityRepository extends EntityRepository implements UserProviderInterface {

  public function addUserRoles(UserInterface $appUser) {
    $userId = $appUser->getId();

    $this->

    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery("select a
                                from CollecMeCollectionBundle:RoleAssociation a
                                where a.appUser = :userId");
    $query->setParameter('userId',$userId);



    //$roles = $query->getResult();
  //  $appUser->setRoles($roles);
    return $appUser;
  }

  public function loadUserByUsername($username) {
    $entityManager = $this->getEntityManager();
    $user = $this->findByLogin($username);

    if (null === $user) {
           $message = sprintf(
               'Unable to find an active admin AppBundle:User object identified by "%s".',
               $username
           );
           throw new UsernameNotFoundException($message);
       }

    if(0 == count($user)) {
      $message = sprintf(
          'Unable to find an active admin AppBundle:User object identified by "%s".',
          $username
      );
      throw new UsernameNotFoundException($message);
    }
    $user = $user[0];
    $user->setRoles(array());
    $this->addUserRoles($user);

    return $user;
  }

  public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }

        return $this->find($user->getId());
    }

    public function supportsClass($class)
    {
        return $this->getEntityName() === $class
            || is_subclass_of($class, $this->getEntityName());
    }

  public function deleteRole($roleId) {
    $entityManager = $this->getEntityManager();

    // remove associations
    $query = $entityManager->createQuery("delete from CollecMeCollectionBundle:RoleAssociation r
                                where r.appRole = :roleId");

    $query->setParameter("roleId",$roleId);

    $ret = $query->execute();

    // remove roles
    $query = $entityManager->createQuery("delete from CollecMeCollectionBundle:AppRole r
                                where r.id = :roleId");

    $query->setParameter("roleId",$roleId);

    $ret = $query->execute();

    return $ret;


  }

  public function findUsersAndRoles() {
    $entityManager = $this->getEntityManager();

    //left join fetch of users and associated roles
    $query = $entityManager->createQuery(
"select u, a from CollecMeCollectionBundle:AppUser u LEFT JOIN  CollecMeCollectionBundle:RoleAssociation a where a.appUser = u order by u.login"
    );

    $results = $query->execute();
    $count = count($results);
    $map = array();
    $roles = array();
    $currentUser = null;
    foreach($results as $result) {
      if($result instanceof AppUser ) {
        if($currentUser != null) {
          array_push($map,array("user"=>$currentUser, "roles"=>$roles));
        }
        $roles=array();
        $currentUser = $result;
      }
      else if($result instanceof RoleAssociation) {
        array_push($roles,$result->getAppRole()->getRoleName());
      }
    }
    array_push($map,array("user"=>$currentUser, "roles"=>$roles));



    return $map;

  }

  public function findRolesForUserId($userId) {
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery("select a
                                from CollecMeCollectionBundle:RoleAssociation a
                                where a.appUser = :userId");
    $query->setParameter('userId',$userId);

    $results = $query->getResult();
    $returned = array();
    foreach($results as $role) {
      array_push($returned,$role->getAppRole()->getRoleName());
    }

    return $returned;

  }


}

?>
