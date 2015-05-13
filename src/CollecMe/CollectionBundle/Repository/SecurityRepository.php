<?php

namespace CollecMe\CollectionBundle\Repository;
use Doctrine\ORM\EntityRepository;
use CollecMe\CollectionBundle\AppUser;
use CollecMe\CollectionBundle\AppRole;
use CollecMe\CollectionBundle\RoleAssociation;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class SecurityRepository extends EntityRepository implements UserProviderInterface {

  public function addUserRoles($appUser) {
    var_dump($appUser);
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery('select a From CollecMeCollectionBundle:RoleAssociation a where a.appUser = :user');
    $query->setParameter("user",$appUser);
    $roles = $query->getResult();
    var_dump($roles);
    $appUser->setRoles($roles);
    return $appUser;
  }

  public function loadUserByUsername($username) {
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery('select u FROM CollecMeCollectionBundle:AppUser u where u.login = :username');
    $query->setParameter("username",$username);
    $user = $query->getResult();

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
    // aparently there are 2n results
    // aditionnal info roles are in the 2n-1 indices
    for($i=0;$i<$count;$i=$i+2) {
      $user = $results[$i];
      $roles = $results[$i+1];
      $map[$i/2] = array("user"=>$user, "roles" => $roles);
    }

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
