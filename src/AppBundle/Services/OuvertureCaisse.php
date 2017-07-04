<?php
namespace AppBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Test de remplissage des champs du billetage
 */
class OuvertureCaisse
{

  function __construct(ContainerInterface $container)
  {
      $this->container = $container;
  }

  /**
   * Affectation de 0 aux champs vides
   *
   * @param array $arrete
   *
   * @return $arrete
   */
  public function ouvertureCaisse($arrete)
  {
    if(!$arrete->getDixmilleMat())$arrete->setDixmilleMat(0);
    if(!$arrete->getCinqmilleMat())$arrete->setCinqmilleMat(0);
    if(!$arrete->getDeuxmilleMat())$arrete->setDeuxmilleMat(0);
    if(!$arrete->getMilleMat())$arrete->setMilleMat(0);
    if(!$arrete->getCinqcentMat())$arrete->setCinqcentMat(0);
    if(!$arrete->getDeuxcentMat())$arrete->setDeuxcentMat(0);
    if(!$arrete->getCentMat())$arrete->setCentMat(0);
    if(!$arrete->getCinquanteMat())$arrete->setCinquanteMat(0);
    if(!$arrete->getVingtcinqMat())$arrete->setVingtcinqMat(0);
    if(!$arrete->getDixMat())$arrete->setDixMat(0);
    if(!$arrete->getCinqMat())$arrete->setCinqMat(0);
    if(!$arrete->getTotMat())$arrete->setTotMat(0);
    $arrete->setStatut(1);

    return $arrete;
  }

  /**
   * Affectation de 0 aux champs vides
   *
   * @param array $arrete
   *
   * @return $arrete
   */
  public function clotureCaisse($arrete)
  {
    if(!$arrete->getDixmilleSoir())$arrete->setDixmilleSoir(0);
    if(!$arrete->getCinqmilleSoir())$arrete->setCinqmilleSoir(0);
    if(!$arrete->getDeuxmilleSoir())$arrete->setDeuxmilleSoir(0);
    if(!$arrete->getMilleSoir())$arrete->setMilleSoir(0);
    if(!$arrete->getCinqcentSoir())$arrete->setCinqcentSoir(0);
    if(!$arrete->getDeuxcentSoir())$arrete->setDeuxcentSoir(0);
    if(!$arrete->getCentSoir())$arrete->setCentSoir(0);
    if(!$arrete->getCinquanteSoir())$arrete->setCinquanteSoir(0);
    if(!$arrete->getVingtcinqSoir())$arrete->setVingtcinqSoir(0);
    if(!$arrete->getDixSoir())$arrete->setDixSoir(0);
    if(!$arrete->getCinqSoir())$arrete->setCinqSoir(0);
    if(!$arrete->getTotSoir())$arrete->setTotSoir(0);
    $arrete->setStatut(2);

    return $arrete;
  }
}
