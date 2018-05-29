<?php
/**
 * Created by PhpStorm.
 * User: nmoller
 * Date: 28/05/18
 * Time: 3:53 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Genus;
use Doctrine\ORM\EntityRepository;

class GenusNoteRepository extends EntityRepository
{
    /**
     * @return Genus[]
     */
    public function findAllRecentNotesForGenus(Genus $genus){
        return $this->createQueryBuilder('genus_note')
          ->andWhere('genus_note.genus = :genus')
          ->setParameter('genus', $genus)
          ->andWhere('genus_note.createdAt > :recentDate')
          ->setParameter('recentDate', new \DateTime('-3 month'))
            ->getQuery()
            ->execute();
    }
}