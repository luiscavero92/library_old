<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Copy
 *
 * @ORM\Table(name="copy")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CopyRepository")
 */
class Copy
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
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="article", referencedColumnName="id")
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="copyNumber", type="string", length=255)
     */
    private $copyNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="addedOn", type="date")
     */
    private $addedOn;

    /**
     * @var bool
     *
     * @ORM\Column(name="lost", type="boolean")
     */
    private $lost = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="damaged", type="boolean")
     */
    private $damaged = false;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="Loan", mappedBy="copy")
     */
    private $loans;

    /**
     * @var bool
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available = true;


    public function __construct() {
        $this->loans = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set copyNumber
     *
     * @param string $copyNumber
     *
     * @return Copy
     */
    public function setCopyNumber($copyNumber)
    {
        $this->copyNumber = $copyNumber;

        return $this;
    }

    /**
     * Get copyNumber
     *
     * @return string
     */
    public function getCopyNumber()
    {
        return $this->copyNumber;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     *
     * @return Copy
     */
    public function setAddedOn($addedOn)
    {
        $this->addedOn = $addedOn;

        return $this;
    }

    /**
     * Get addedOn
     *
     * @return \DateTime
     */
    public function getAddedOn()
    {
        return $this->addedOn;
    }

    /**
     * Set lost
     *
     * @param boolean $lost
     *
     * @return Copy
     */
    public function setLost($lost)
    {
        $this->lost = $lost;

        return $this;
    }

    /**
     * Get lost
     *
     * @return boolean
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * Set damaged
     *
     * @param boolean $damaged
     *
     * @return Copy
     */
    public function setDamaged($damaged)
    {
        $this->damaged = $damaged;

        return $this;
    }

    /**
     * Get damaged
     *
     * @return boolean
     */
    public function getDamaged()
    {
        return $this->damaged;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Copy
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return Copy
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Copy
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Add loan
     *
     * @param \AppBundle\Entity\Loan $loan
     *
     * @return Copy
     */
    public function addLoan(\AppBundle\Entity\Loan $loan)
    {
        $this->loans[] = $loan;

        return $this;
    }

    /**
     * Remove loan
     *
     * @param \AppBundle\Entity\Loan $loan
     */
    public function removeLoan(\AppBundle\Entity\Loan $loan)
    {
        $this->loans->removeElement($loan);
    }

    /**
     * Get loans
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLoans()
    {
        return $this->loans;
    }
}
