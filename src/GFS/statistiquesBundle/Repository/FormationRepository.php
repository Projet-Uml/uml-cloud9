<?php

namespace GFS\statistiquesBundle\Repository;

/**
 * FormationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FormationRepository extends \Doctrine\ORM\EntityRepository
{
    public function getFormationAtSelectedOption($option) {
        $qb = $this->createQueryBuilder('Formation')
            ->select('Formation.id, Formation.nom')
            ->where('Formation.optionDep = :option')
            ->setParameter('option', $option)
        ;
        return $qb->getQuery()->getArrayResult();
    }
    
    public function getAllFormation() {
        $sql = 'SELECT f.nom, f.id as idFormation, d.id as idDepartement, d.nom as nomDepartement 
              FROM GFSstatistiquesBundle:Formation f,
              GFSstatistiquesBundle:Departement d, GFSstatistiquesBundle:OptionDep o 
              where f.optionDep = o and o.departement=d order by f.nom';
        return $this->getEntityManager()->createQuery($sql)->getArrayResult();
    }
}
