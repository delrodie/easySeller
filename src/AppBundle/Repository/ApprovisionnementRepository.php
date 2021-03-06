<?php

namespace AppBundle\Repository;

/**
 * ApprovisionnementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApprovisionnementRepository extends \Doctrine\ORM\EntityRepository
{
  /**
    * Fonction de recherche de l'ID de l'approvisionnement
    *
    * Author: Delrodie AMOIKON
    * Date: 22/04/2017
    * Since: v1.0
    */
    public function getApprovisionnementID()
    {
        $em = $this->getEntityManager();
        $qb = $this->createQueryBuilder('a')
           ->select('count(a.id)')
       ;
        ;
        try {

            $id = $qb->getQuery()->getSingleScalarResult();

            $id = $id + 1;

            if ($id < 10) {
               $num = '00'.$id;
            } elseif ($id < 100) {
               $num = '0'.$id;
            } else{
               $num = $id;
            }

            return $num;

        } catch (NoResultException $e) {
            return $e;
        }
    }

  /**
   * Liste des fournisseurs concernés par les approvisionnements
   *
   * @author: Delrodie AMOIKON
   * @date: 28/04/2017 01:37
   * @version: v1.0
   */
   public function getFournisseurByApprovisionnement()
   {
     $em = $this->getEntityManager();
     $qb = $em->createQuery('
            SELECT DISTINCT(a.fournisseur) as id
            FROM AppBundle:Approvisionnement a
     ');
     try {
         $result = $qb->getResult();

         return $result;

     } catch (NoResultException $e) {
         return $e;
     }

   }

   /**
    * Statistiques des fournisseurs concernés par les approvisionnements
    *
    * @author: Delrodie AMOIKON
    * @date: 28/04/2017 01:37
    * @version: v1.0
    */
    public function getStatistiquesFournisseur($id)
    {
      $em = $this->getEntityManager();
      $qb = $em->createQuery('
             SELECT SUM(a.montant) as montant, SUM(a.fret) as fret, SUM(a.valider) as valider
             FROM AppBundle:Approvisionnement a
             WHERE a.fournisseur = :id
      ')->setParameter('id',$id)
      ;
      try {
          $result = $qb->getResult();

          return $result;

      } catch (NoResultException $e) {
          return $e;
      }

    } 

}
