<?php

namespace AppBundle\Repository;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends \Doctrine\ORM\EntityRepository
{
  /**
    * Fonction de recherche du ID du produit
    *
    * Author: Delrodie AMOIKON
    * Date: 21/04/2017
    * Since: v1.0
    */
    public function getProduitID()
    {
        $em = $this->getEntityManager();
        $qb = $this->createQueryBuilder('p')
           ->select('count(p.id)')
       ;
        ;
        try {

            $id = $qb->getQuery()->getSingleScalarResult();

            $id = $id + 1;

            if ($id < 10) {
               $num = '000'.$id;
            } elseif ($id < 100) {
               $num = '00'.$id;
            } elseif ($id < 1000) {
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
     * Recherche du produit dans le tableau
     *
     * Author: Delrodie AMOIKON
     * Date: 24/04/2017
     * Since: v1.0
     */
     public function findArray($array)
     {
       $qb = $this->createQueryBuilder('p')
                ->Select('p')
                ->Where('p.id IN (:array)')
                ->setParameter('array', $array);
        return $qb->getQuery()->getResult();
     }

    /**
     * Liste des produits dont le stock est supérieur a 0
     *
     * @author: Delrodie AMOIKON
     * @date: 30/04/2017
     * @version: v1.0
     */
     public function findProduitStockSupUn()
     {
       $qb = $this->createQueryBuilder('p')
                  -> Select('p')
                  ->Where('p.qte >= :qte')
                  ->setParameter('qte', 1);
        return $qb->getQuery()->getResult();
     }

     /**
      * Recherche du produit dans le tableau
      *
      * Author: Delrodie AMOIKON
      * Date: 01/05/2017
      * Since: v1.0
      */
      public function findDernierProduitEnPanier($array)
      {
        $qb = $this->createQueryBuilder('p')
                 ->Select('p')
                 ->Where('p.id IN (:array)')
                 ->setParameter('array', $array)
                 ->setMaxResults(1);
         return $qb->getQuery()->getSingleResult();
      }
}
