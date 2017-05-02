<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FactureRepository")
 */
class Facture
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
     * @ORM\Column(name="numero", type="string", length=15, nullable=true, unique=true)
     */
    private $numero;

    /**
     * @var int
     *
     * @ORM\Column(name="client", type="integer", nullable=true)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="remise", type="string", length=11, nullable=true)
     */
    private $remise;

    /**
     * @var string
     *
     * @ORM\Column(name="nap", type="string", length=11, nullable=true)
     */
    private $nap;

    /**
     * @var string
     *
     * @ORM\Column(name="verse", type="string", length=11, nullable=true)
     */
    private $verse;

    /**
     * @var array
     *
     * @ORM\Column(name="panier", type="array", nullable=true)
     */
    private $panier;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean", nullable=true)
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Facture
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

    /**
     * Set client
     *
     * @param integer $client
     *
     * @return Facture
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set remise
     *
     * @param string $remise
     *
     * @return Facture
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return string
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set verse
     *
     * @param string $verse
     *
     * @return Facture
     */
    public function setVerse($verse)
    {
        $this->verse = $verse;

        return $this;
    }

    /**
     * Get verse
     *
     * @return string
     */
    public function getVerse()
    {
        return $this->verse;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Facture
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return bool
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set panier
     *
     * @param array $panier
     *
     * @return Facture
     */
    public function setPanier($panier)
    {
        $this->panier = $panier;

        return $this;
    }

    /**
     * Get panier
     *
     * @return array
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Facture
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
     * @return Facture
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
     * @return Facture
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
     * @return Facture
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
     * Set nap
     *
     * @param string $nap
     *
     * @return Facture
     */
    public function setNap($nap)
    {
        $this->nap = $nap;

        return $this;
    }

    /**
     * Get nap
     *
     * @return string
     */
    public function getNap()
    {
        return $this->nap;
    }
}
