<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Arrete
 *
 * @ORM\Table(name="arrete")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArreteRepository")
 */
class Arrete
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="dixmilleMat", type="integer", nullable=true)
     */
    private $dixmilleMat;

    /**
     * @var int
     *
     * @ORM\Column(name="dixmilleSoir", type="integer", nullable=true)
     */
    private $dixmilleSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="cinqmilleMat", type="integer", nullable=true)
     */
    private $cinqmilleMat;

    /**
     * @var int
     *
     * @ORM\Column(name="cinqmilleSoir", type="integer", nullable=true)
     */
    private $cinqmilleSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="deuxmilleMat", type="integer", nullable=true)
     */
    private $deuxmilleMat;

    /**
     * @var int
     *
     * @ORM\Column(name="deuxmilleSoir", type="integer", nullable=true)
     */
    private $deuxmilleSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="milleMat", type="integer", nullable=true)
     */
    private $milleMat;

    /**
     * @var int
     *
     * @ORM\Column(name="milleSoir", type="integer", nullable=true)
     */
    private $milleSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="cinqcentMat", type="integer", nullable=true)
     */
    private $cinqcentMat;

    /**
     * @var int
     *
     * @ORM\Column(name="cinqcentSoir", type="integer", nullable=true)
     */
    private $cinqcentSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="deuxcentMat", type="integer", nullable=true)
     */
    private $deuxcentMat;

    /**
     * @var int
     *
     * @ORM\Column(name="deuxcentSoir", type="integer", nullable=true)
     */
    private $deuxcentSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="centMat", type="integer", nullable=true)
     */
    private $centMat;

    /**
     * @var int
     *
     * @ORM\Column(name="centSoir", type="integer", nullable=true)
     */
    private $centSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="cinquanteMat", type="integer", nullable=true)
     */
    private $cinquanteMat;

    /**
     * @var int
     *
     * @ORM\Column(name="cinquanteSoir", type="integer", nullable=true)
     */
    private $cinquanteSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="vingtcinqMat", type="integer", nullable=true)
     */
    private $vingtcinqMat;

    /**
     * @var int
     *
     * @ORM\Column(name="vingtcinqSoir", type="integer", nullable=true)
     */
    private $vingtcinqSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="dixMat", type="integer", nullable=true)
     */
    private $dixMat;

    /**
     * @var int
     *
     * @ORM\Column(name="dixSoir", type="integer", nullable=true)
     */
    private $dixSoir;

    /**
     * @var int
     *
     * @ORM\Column(name="cinqMat", type="integer", nullable=true)
     */
    private $cinqMat;

    /**
     * @var int
     *
     * @ORM\Column(name="cinqSoir", type="integer", nullable=true)
     */
    private $cinqSoir;

    /**
     * @var string
     *
     * @ORM\Column(name="totMat", type="string", length=8, nullable=true)
     */
    private $totMat;

    /**
     * @var string
     *
     * @ORM\Column(name="totSoir", type="string", length=8, nullable=true)
     */
    private $totSoir;

    /**
     * @var string
     *
     * @ORM\Column(name="recette", type="string", length=8, nullable=true)
     */
    private $recette;

    /**
     * 1 pour enregistrement du matin, 2 pour le soir et 3 pour validation gerant
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=1, nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="publie_par", type="string", length=25, nullable=true)
     */
    private $publiePar;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(name="modifie_par", type="string", length=25, nullable=true)
     */
    private $modifiePar;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="publie_le", type="datetimetz", nullable=true)
     */
    private $publieLe;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifie_le", type="datetimetz", nullable=true)
     */
    private $modifieLe;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="arretes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $caissiere;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dixmilleMat
     *
     * @param integer $dixmilleMat
     *
     * @return Arrete
     */
    public function setDixmilleMat($dixmilleMat)
    {
        $this->dixmilleMat = $dixmilleMat;

        return $this;
    }

    /**
     * Get dixmilleMat
     *
     * @return int
     */
    public function getDixmilleMat()
    {
        return $this->dixmilleMat;
    }

    /**
     * Set dixmilleSoir
     *
     * @param integer $dixmilleSoir
     *
     * @return Arrete
     */
    public function setDixmilleSoir($dixmilleSoir)
    {
        $this->dixmilleSoir = $dixmilleSoir;

        return $this;
    }

    /**
     * Get dixmilleSoir
     *
     * @return int
     */
    public function getDixmilleSoir()
    {
        return $this->dixmilleSoir;
    }

    /**
     * Set cinqmilleMat
     *
     * @param integer $cinqmilleMat
     *
     * @return Arrete
     */
    public function setCinqmilleMat($cinqmilleMat)
    {
        $this->cinqmilleMat = $cinqmilleMat;

        return $this;
    }

    /**
     * Get cinqmilleMat
     *
     * @return int
     */
    public function getCinqmilleMat()
    {
        return $this->cinqmilleMat;
    }

    /**
     * Set cinqmilleSoir
     *
     * @param integer $cinqmilleSoir
     *
     * @return Arrete
     */
    public function setCinqmilleSoir($cinqmilleSoir)
    {
        $this->cinqmilleSoir = $cinqmilleSoir;

        return $this;
    }

    /**
     * Get cinqmilleSoir
     *
     * @return int
     */
    public function getCinqmilleSoir()
    {
        return $this->cinqmilleSoir;
    }

    /**
     * Set deuxmilleMat
     *
     * @param integer $deuxmilleMat
     *
     * @return Arrete
     */
    public function setDeuxmilleMat($deuxmilleMat)
    {
        $this->deuxmilleMat = $deuxmilleMat;

        return $this;
    }

    /**
     * Get deuxmilleMat
     *
     * @return int
     */
    public function getDeuxmilleMat()
    {
        return $this->deuxmilleMat;
    }

    /**
     * Set deuxmilleSoir
     *
     * @param integer $deuxmilleSoir
     *
     * @return Arrete
     */
    public function setDeuxmilleSoir($deuxmilleSoir)
    {
        $this->deuxmilleSoir = $deuxmilleSoir;

        return $this;
    }

    /**
     * Get deuxmilleSoir
     *
     * @return int
     */
    public function getDeuxmilleSoir()
    {
        return $this->deuxmilleSoir;
    }

    /**
     * Set milleMat
     *
     * @param integer $milleMat
     *
     * @return Arrete
     */
    public function setMilleMat($milleMat)
    {
        $this->milleMat = $milleMat;

        return $this;
    }

    /**
     * Get milleMat
     *
     * @return int
     */
    public function getMilleMat()
    {
        return $this->milleMat;
    }

    /**
     * Set milleSoir
     *
     * @param integer $milleSoir
     *
     * @return Arrete
     */
    public function setMilleSoir($milleSoir)
    {
        $this->milleSoir = $milleSoir;

        return $this;
    }

    /**
     * Get milleSoir
     *
     * @return int
     */
    public function getMilleSoir()
    {
        return $this->milleSoir;
    }

    /**
     * Set cinqcentMat
     *
     * @param integer $cinqcentMat
     *
     * @return Arrete
     */
    public function setCinqcentMat($cinqcentMat)
    {
        $this->cinqcentMat = $cinqcentMat;

        return $this;
    }

    /**
     * Get cinqcentMat
     *
     * @return int
     */
    public function getCinqcentMat()
    {
        return $this->cinqcentMat;
    }

    /**
     * Set cinqcentSoir
     *
     * @param integer $cinqcentSoir
     *
     * @return Arrete
     */
    public function setCinqcentSoir($cinqcentSoir)
    {
        $this->cinqcentSoir = $cinqcentSoir;

        return $this;
    }

    /**
     * Get cinqcentSoir
     *
     * @return int
     */
    public function getCinqcentSoir()
    {
        return $this->cinqcentSoir;
    }

    /**
     * Set deuxcentMat
     *
     * @param integer $deuxcentMat
     *
     * @return Arrete
     */
    public function setDeuxcentMat($deuxcentMat)
    {
        $this->deuxcentMat = $deuxcentMat;

        return $this;
    }

    /**
     * Get deuxcentMat
     *
     * @return int
     */
    public function getDeuxcentMat()
    {
        return $this->deuxcentMat;
    }

    /**
     * Set deuxcentSoir
     *
     * @param integer $deuxcentSoir
     *
     * @return Arrete
     */
    public function setDeuxcentSoir($deuxcentSoir)
    {
        $this->deuxcentSoir = $deuxcentSoir;

        return $this;
    }

    /**
     * Get deuxcentSoir
     *
     * @return int
     */
    public function getDeuxcentSoir()
    {
        return $this->deuxcentSoir;
    }

    /**
     * Set centMat
     *
     * @param integer $centMat
     *
     * @return Arrete
     */
    public function setCentMat($centMat)
    {
        $this->centMat = $centMat;

        return $this;
    }

    /**
     * Get centMat
     *
     * @return int
     */
    public function getCentMat()
    {
        return $this->centMat;
    }

    /**
     * Set centSoir
     *
     * @param integer $centSoir
     *
     * @return Arrete
     */
    public function setCentSoir($centSoir)
    {
        $this->centSoir = $centSoir;

        return $this;
    }

    /**
     * Get centSoir
     *
     * @return int
     */
    public function getCentSoir()
    {
        return $this->centSoir;
    }

    /**
     * Set cinquanteMat
     *
     * @param integer $cinquanteMat
     *
     * @return Arrete
     */
    public function setCinquanteMat($cinquanteMat)
    {
        $this->cinquanteMat = $cinquanteMat;

        return $this;
    }

    /**
     * Get cinquanteMat
     *
     * @return int
     */
    public function getCinquanteMat()
    {
        return $this->cinquanteMat;
    }

    /**
     * Set cinquanteSoir
     *
     * @param integer $cinquanteSoir
     *
     * @return Arrete
     */
    public function setCinquanteSoir($cinquanteSoir)
    {
        $this->cinquanteSoir = $cinquanteSoir;

        return $this;
    }

    /**
     * Get cinquanteSoir
     *
     * @return int
     */
    public function getCinquanteSoir()
    {
        return $this->cinquanteSoir;
    }

    /**
     * Set vingtcinqMat
     *
     * @param integer $vingtcinqMat
     *
     * @return Arrete
     */
    public function setVingtcinqMat($vingtcinqMat)
    {
        $this->vingtcinqMat = $vingtcinqMat;

        return $this;
    }

    /**
     * Get vingtcinqMat
     *
     * @return int
     */
    public function getVingtcinqMat()
    {
        return $this->vingtcinqMat;
    }

    /**
     * Set vingtcinqSoir
     *
     * @param integer $vingtcinqSoir
     *
     * @return Arrete
     */
    public function setVingtcinqSoir($vingtcinqSoir)
    {
        $this->vingtcinqSoir = $vingtcinqSoir;

        return $this;
    }

    /**
     * Get vingtcinqSoir
     *
     * @return int
     */
    public function getVingtcinqSoir()
    {
        return $this->vingtcinqSoir;
    }

    /**
     * Set dixMat
     *
     * @param integer $dixMat
     *
     * @return Arrete
     */
    public function setDixMat($dixMat)
    {
        $this->dixMat = $dixMat;

        return $this;
    }

    /**
     * Get dixMat
     *
     * @return int
     */
    public function getDixMat()
    {
        return $this->dixMat;
    }

    /**
     * Set dixSoir
     *
     * @param integer $dixSoir
     *
     * @return Arrete
     */
    public function setDixSoir($dixSoir)
    {
        $this->dixSoir = $dixSoir;

        return $this;
    }

    /**
     * Get dixSoir
     *
     * @return int
     */
    public function getDixSoir()
    {
        return $this->dixSoir;
    }

    /**
     * Set cinqMat
     *
     * @param integer $cinqMat
     *
     * @return Arrete
     */
    public function setCinqMat($cinqMat)
    {
        $this->cinqMat = $cinqMat;

        return $this;
    }

    /**
     * Get cinqMat
     *
     * @return int
     */
    public function getCinqMat()
    {
        return $this->cinqMat;
    }

    /**
     * Set cinqSoir
     *
     * @param integer $cinqSoir
     *
     * @return Arrete
     */
    public function setCinqSoir($cinqSoir)
    {
        $this->cinqSoir = $cinqSoir;

        return $this;
    }

    /**
     * Get cinqSoir
     *
     * @return int
     */
    public function getCinqSoir()
    {
        return $this->cinqSoir;
    }

    /**
     * Set totMat
     *
     * @param string $totMat
     *
     * @return Arrete
     */
    public function setTotMat($totMat)
    {
        $this->totMat = $totMat;

        return $this;
    }

    /**
     * Get totMat
     *
     * @return string
     */
    public function getTotMat()
    {
        return $this->totMat;
    }

    /**
     * Set totSoir
     *
     * @param string $totSoir
     *
     * @return Arrete
     */
    public function setTotSoir($totSoir)
    {
        $this->totSoir = $totSoir;

        return $this;
    }

    /**
     * Get totSoir
     *
     * @return string
     */
    public function getTotSoir()
    {
        return $this->totSoir;
    }

    /**
     * Set recette
     *
     * @param string $recette
     *
     * @return Arrete
     */
    public function setRecette($recette)
    {
        $this->recette = $recette;

        return $this;
    }

    /**
     * Get recette
     *
     * @return string
     */
    public function getRecette()
    {
        return $this->recette;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Arrete
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Arrete
     */
    public function setPubliePar($publiePar)
    {
        $this->publiePar = $publiePar;

        return $this;
    }

    /**
     * Get publiePar
     *
     * @return string
     */
    public function getPubliePar()
    {
        return $this->publiePar;
    }

    /**
     * Set modifiePar
     *
     * @param string $modifiePar
     *
     * @return Arrete
     */
    public function setModifiePar($modifiePar)
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    /**
     * Get modifiePar
     *
     * @return string
     */
    public function getModifiePar()
    {
        return $this->modifiePar;
    }

    /**
     * Set publieLe
     *
     * @param \DateTime $publieLe
     *
     * @return Arrete
     */
    public function setPublieLe($publieLe)
    {
        $this->publieLe = $publieLe;

        return $this;
    }

    /**
     * Get publieLe
     *
     * @return \DateTime
     */
    public function getPublieLe()
    {
        return $this->publieLe;
    }

    /**
     * Set modifieLe
     *
     * @param \DateTime $modifieLe
     *
     * @return Arrete
     */
    public function setModifieLe($modifieLe)
    {
        $this->modifieLe = $modifieLe;

        return $this;
    }

    /**
     * Get modifieLe
     *
     * @return \DateTime
     */
    public function getModifieLe()
    {
        return $this->modifieLe;
    }

    /**
     * Set caissiere
     *
     * @param \AppBundle\Entity\User $caissiere
     *
     * @return Arrete
     */
    public function setCaissiere(\AppBundle\Entity\User $caissiere = null)
    {
        $this->caissiere = $caissiere;

        return $this;
    }

    /**
     * Get caissiere
     *
     * @return \AppBundle\Entity\User
     */
    public function getCaissiere()
    {
        return $this->caissiere;
    }
}
