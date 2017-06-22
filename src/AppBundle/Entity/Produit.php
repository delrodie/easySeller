<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks
 */
class Produit
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
     * @ORM\Column(name="nom", type="string", length=75, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=7, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="model", type="string", length=25, nullable=true, unique=true)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pa", type="string", length=11, nullable=true)
     */
    private $pa;

    /**
     * @var string
     *
     * @ORM\Column(name="pv", type="string", length=11, nullable=true)
     */
    private $pv;

    /**
     * @var string
     *
     * @ORM\Column(name="qte", type="string", length=11, nullable=true)
     */
    private $qte;

    /**
     * @var string
     *
     * @ORM\Column(name="remise", type="string", length=2, nullable=true)
     */
    private $remise;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean", nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"code","nom","model"})
     * @ORM\Column(name="slug", type="string", length=255)
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie", inversedBy="produits")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = strtoupper($nom);

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Produit
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Produit
     */
    public function setModel($model)
    {
        $this->model = strtoupper($model);

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set pa
     *
     * @param integer $pa
     *
     * @return Produit
     */
    public function setPa($pa)
    {
        $this->pa = $pa;

        return $this;
    }

    /**
     * Get pa
     *
     * @return int
     */
    public function getPa()
    {
        return $this->pa;
    }

    /**
     * Set pv
     *
     * @param integer $pv
     *
     * @return Produit
     */
    public function setPv($pv)
    {
        $this->pv = $pv;

        return $this;
    }

    /**
     * Get pv
     *
     * @return int
     */
    public function getPv()
    {
        return $this->pv;
    }

    /**
     * Set qte
     *
     * @param integer $qte
     *
     * @return Produit
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return int
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Produit
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Produit
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
     * @return Produit
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
     * @return Produit
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
     * @return Produit
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
     * @return Produit
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
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Produit
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set remise
     *
     * @param string $remise
     *
     * @return Produit
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
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

        /**
        * @Assert\Image(
        *     maxSize = "2M",
        *     maxWidth = 1920,
        *     maxSizeMessage = "La photo téléchargée est trop lourde",
        *     maxWidthMessage= "La taille de la photo est trop grande {{width}}px. La taille maximum autorisée est {{ max_width}} px"
        *)
        */
        private $file;

        private $tempFileName;

        public function getFile()
        {
          return $this->file;
        }

        public function setFile(UploadedFile $file = null)
        {
            $this->file = $file;
            //die('position');
            // Verification de l'existence d'un fichier pour cette entité
            if (null !== $this->url) {
                $this->tempFileName = $this->url;
                //die('non nul');
                //Réinitialisation des attributs alt et url
                $this->url = null;
                $this->alt = null;
            }
        }

        /**
        * @ORM\PrePersist()
        * @ORM\PreUpdate()
        */
        public function preUpload()
        {
            // S'il n'y a pas de fichier retourner le lien de l'avatar
            if (null === $this->file) {
                return;
            }

            // Affectation de l'extension du fichier à l'url
            $this->url = $this->file->guessExtension();
            //die($this->file->guessExtension());
            // Affectation du nom du fichier
            $this->alt = $this->file->getClientOriginalName();
            //die($this->alt = $this->file->getClientOriginalName());
        }

        /**
        * @ORM\PostPersist()
        * @ORM\PostUpdate()
        */
        public function upload()
        {

            // S'il n'y a pas de fichier
            if (null === $this->file ) {
                //die('dans la fonction upload fichier vide');
                return;
            }

            // Suppression de l'ancien fichier s'il en existe
            if (null !== $this->tempFileName) {
                $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFileName;
                if (file_exists($oldFile)) {
                  unlink($oldFile);
                }
            }

            // Deplacement du fichier dans notre repertoire
            $this->file->move(
                $this->getUploadRootDir(), // Le répertoire de destination
                $this->id.'.'.$this->url   // Le nom du fichier à créer, ici « id.extension »
                //die($this->id.'.'.$this->url)
            );
        }

        /**
        * @ORM\PreRemove()
        */
        public function preRemoveUpload()
        {
            // Sauvegarde temporaire du nom du fichier
            $this->tempFileName = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
        }

        /**
        * @ORM\PostRemove()
        */
        public function removeUpload()
        {
          // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
          if (file_exists($this->tempFilename)) {
              // On supprime le fichier
              unlink($this->tempFilename);
          }
        }

        public function getUploadDir()
        {
            // On retourne le chemin relatif vers l'image pour un navigateur
            return 'produits';
        }

        protected function getUploadRootDir()
        {
            // On retourne le chemin relatif vers l'image pour notre code PHP
            //$racine = sudo chmod ;
            return __DIR__.'/../../../web/ressources/uploads/'.$this->getUploadDir();
        }


    /**
     * Set url
     *
     * @param string $url
     *
     * @return Produit
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Produit
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
}
