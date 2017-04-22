<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Approvisionnement
 *
 * @ORM\Table(name="approvisionnement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ApprovisionnementRepository")
 * @Gedmo\Loggable
 */
class Approvisionnement
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
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=15, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="facture", type="string", length=15, nullable=true)
     */
    private $facture;

    /**
     * @var string
     *
     * @ORM\Column(name="datefac", type="string", length=10, nullable=true)
     */
    private $datefac;

    /**
     * @var int
     *
     * @ORM\Column(name="montant", type="integer", nullable=true)
     */
    private $montant;

    /**
     * @var int
     *
     * @ORM\Column(name="fret", type="integer", nullable=true)
     */
    private $fret;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"facture","montant","fret"})
     * @ORM\Column(name="slug", type="string", length=75)
     */
    private $slug;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fournisseur", inversedBy="approvisionnements")
     * @ORM\JoinColumn(name="fseur_id", referencedColumnName="id")
     */
    private $fournisseur;


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
     * Set facture
     *
     * @param string $facture
     *
     * @return Approvisionnement
     */
    public function setFacture($facture)
    {
        $this->facture = strtoupper($facture);

        return $this;
    }

    /**
     * Get facture
     *
     * @return string
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Set datefac
     *
     * @param string $datefac
     *
     * @return Approvisionnement
     */
    public function setDatefac($datefac)
    {
        $this->datefac = $datefac;

        return $this;
    }

    /**
     * Get datefac
     *
     * @return string
     */
    public function getDatefac()
    {
        return $this->datefac;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     *
     * @return Approvisionnement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return int
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set fret
     *
     * @param integer $fret
     *
     * @return Approvisionnement
     */
    public function setFret($fret)
    {
        $this->fret = $fret;

        return $this;
    }

    /**
     * Get fret
     *
     * @return int
     */
    public function getFret()
    {
        return $this->fret;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Approvisionnement
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Approvisionnement
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
     * @return Approvisionnement
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
     * @return Approvisionnement
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
     * @return Approvisionnement
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
     * Set fournisseur
     *
     * @param \AppBundle\Entity\Fournisseur $fournisseur
     *
     * @return Approvisionnement
     */
    public function setFournisseur(\AppBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \AppBundle\Entity\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Approvisionnement
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }
}
