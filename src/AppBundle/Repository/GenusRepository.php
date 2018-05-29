<?php
/**
 * Created by PhpStorm.
 * User: nmoller
 * Date: 28/05/18
 * Time: 3:53 PM
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class GenusRepository extends EntityRepository
{
    /**
     * @return Genus[]
     */
    public function findAllPublishedOrderedBySize(){
        return $this->createQueryBuilder('genus')
            ->andWhere('genus.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('genus.speciesCount', 'DESC')
            ->getQuery()
            ->execute();
    }

    /**
     * @return Genus[]
     */
    public function findAllPublishedOrderedByRecentlyActive(){
        return $this->createQueryBuilder('genus')
          ->andWhere('genus.isPublished = :isPublished')
          ->setParameter('isPublished', true)
          ->leftJoin('genus.notes', 'genus_note')
          ->orderBy('genus_note.createdAt', 'DESC')
          ->getQuery()
          ->execute();
    }
}