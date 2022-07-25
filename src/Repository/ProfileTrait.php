<?php

namespace App\Repository;

use App\Entity\User;

Trait ProfileTrait 
{
    private function __findByUser(User $user)
    {
        return $this->createQueryBuilder('p')
            // faire une jointure avec l'utilisateur lié au profil editeur
            ->join('p.user', 'u')
            // ne retenir que le profile editeur qui est associé à l'utilisateur passé en paramètre de la fonction
            ->andWhere('u.id = :userId')
            ->setParameter('userId', $user->getId())
            // exécution de la requête
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}