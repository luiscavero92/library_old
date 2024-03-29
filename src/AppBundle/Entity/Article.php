<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @UniqueEntity("refNumber")
 * @UniqueEntity("isbn")
 */
class Article
{
    const CATEGORY_BOOK  = 'BOOK';
    const CATEGORY_CD    = 'CD';
    const CATEGORY_DVD   = 'DVD';
    const CATEGORY_VHS   = 'VHS';
    const CATEGORY_OTHER = 'OTHER';

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
     * @ORM\Column(name="refNumber", type="string", length=255, unique=true)
     *
     * @Assert\NotBlank(
     *      message="RefNumber should not be a blank."
     * )
     *
     * @Assert\Type(
     *      type="string",
     *      message="The value of RefNumber ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "RefNumber must be at least {{ limit }} characters long",
     *      maxMessage = "RefNumber cannot be longer than {{ limit }} characters"
     * )
     */
    private $refNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=255, unique=true)
     *
     * @Assert\NotBlank(
     *      message="ISBN should not be a blank."
     * )
     *
     * @Assert\Type(
     *      type="string",
     *      message="The value of ISBN ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "ISBN must be at least {{ limit }} characters long",
     *      maxMessage = "ISBN cannot be longer than {{ limit }} characters"
     * )
     */
    private $isbn;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @Assert\NotBlank(
     *      message="Title should not be a blank."
     * )
     *
     * @Assert\Type(
     *      type="string",
     *      message="The value of Title ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Title must be at least {{ limit }} characters long",
     *      maxMessage = "Title cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *      type="string",
     *      message="The value of Subtitle ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Subtitle must be at least {{ limit }} characters long",
     *      maxMessage = "Subtitle cannot be longer than {{ limit }} characters"
     * )
     */
    private $subtitle;

    /**
     * @var array
     * @ORM\Column(name="authors", type="array")
     *
     * @Assert\NotBlank(
     *      message="Authors should not be a blank."
     * )
     *
     * @Assert\Type(
     *      type="array",
     *      message="The value of Authors ({{ value }}) is not a valid {{ type }}."
     * )
     */
    private $authors;

    /**
     * @var integer
     * @ORM\Column(name="editionYear", type="integer", length=4, nullable=true)
     *
     * @Assert\Type(
     *      type="integer",
     *      message="The value of EditionYear ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      minMessage = "EditionYear must be at least {{ limit }} characters long",
     *      maxMessage = "EditionYear cannot be longer than {{ limit }} characters"
     * )
     */
    private $editionYear;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=255)
     *
     * @Assert\NotBlank(
     *      message="Publisher should not be a blank."
     * )
     *
     * @Assert\Type(
     *      type="string",
     *      message="The value of Publisher ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Publisher must be at least {{ limit }} characters long",
     *      maxMessage = "Publisher cannot be longer than {{ limit }} characters"
     * )
     */
    private $publisher;

    /**
     * @var string
     * @ORM\Column(name="legalDeposit", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *      type="string",
     *      message="The value of legalDeposit ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "legalDeposit must be at least {{ limit }} characters long",
     *      maxMessage = "legalDeposit cannot be longer than {{ limit }} characters"
     * )
     */
    private $legalDeposit;

    /**
     * @ORM\ManyToOne(targetEntity="CDU")
     * @ORM\JoinColumn(name="cdu", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *      message="CDU should not be a blank."
     * )
     */
    private $cdu;

    /**
     * @var \AppBundle\Types\ClassTypes\Signature
     *
     * @ORM\Column(name="signature", type="signature")
     *
     * @Assert\NotBlank(
     *      message="Signature should not be a blank."
     * )
     *
     * @AcmeAssert\ContainsSignature
     */
    private $signature;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     *
     * @Assert\Type(
     *      type="string",
     *      message="The value of Location ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Location must be at least {{ limit }} characters long",
     *      maxMessage = "Location cannot be longer than {{ limit }} characters"
     * )
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     *
     * @Assert\NotBlank(
     *      message="Category should not be a blank."
     * )
     *
     * @Assert\Choice(choices = {"BOOK", "DVD", "CD","VHS", "OTHER"}, message = "Choose a valid category.")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=500, nullable=true)
     *
     * @Assert\Type(
     *      type="string",
     *      message="The value of Note ({{ value }}) is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 500,
     *      minMessage = "Note must be at least {{ limit }} characters long",
     *      maxMessage = "Note cannot be longer than {{ limit }} characters"
     * )
     */
    private $note;

     /**
     * @var bool
     *
     * @ORM\Column(name="loanable", type="boolean")
     *
     * @Assert\Type(
     *      type="boolean",
     *      message="The value of Loanable ({{ value }}) is not a valid {{ type }}."
     * )
     */
    private $loanable = true;




    /**
     * Set category
     *
     * @param string $category
     *
     * @return Article
     */
    public function setCategory($category)
    {
        if (!in_array($category, array(self::CATEGORY_BOOK, self::CATEGORY_CD, self::CATEGORY_DVD, self::CATEGORY_VHS, 
            self::CATEGORY_OTHER))) {
            throw new \InvalidArgumentException("Invalid article category. Valid values are: " . self::CATEGORY_BOOK . ', ' . self::CATEGORY_CD . ', ' . self::CATEGORY_DVD . ', ' . self::CATEGORY_VHS . ' and ' . self::CATEGORY_OTHER);
        }
        $this->category = $category;

        return $this;
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
     * Set refNumber
     *
     * @param string $refNumber
     *
     * @return Article
     */
    public function setRefNumber($refNumber)
    {
        $this->refNumber = $refNumber;

        return $this;
    }

    /**
     * Get refNumber
     *
     * @return string
     */
    public function getRefNumber()
    {
        return $this->refNumber;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Article
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Article
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set authors
     *
     * @param array $authors
     *
     * @return Article
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Get authors
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set editionYear
     *
     * @param integer $editionYear
     *
     * @return Article
     */
    public function setEditionYear($editionYear)
    {
        $this->editionYear = $editionYear;

        return $this;
    }

    /**
     * Get editionYear
     *
     * @return integer
     */
    public function getEditionYear()
    {
        return $this->editionYear;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     *
     * @return Article
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set legalDeposit
     *
     * @param string $legalDeposit
     *
     * @return Article
     */
    public function setLegalDeposit($legalDeposit)
    {
        $this->legalDeposit = $legalDeposit;

        return $this;
    }

    /**
     * Get legalDeposit
     *
     * @return string
     */
    public function getLegalDeposit()
    {
        return $this->legalDeposit;
    }

    /**
     * Set signature
     *
     * @param signature $signature
     *
     * @return Article
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return signature
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Article
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Article
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
     * Set loanable
     *
     * @param boolean $loanable
     *
     * @return Article
     */
    public function setLoanable($loanable)
    {
        $this->loanable = $loanable;

        return $this;
    }

    /**
     * Get loanable
     *
     * @return boolean
     */
    public function getLoanable()
    {
        return $this->loanable;
    }

    /**
     * Set cdu
     *
     * @param \AppBundle\Entity\CDU $cdu
     *
     * @return Article
     */
    public function setCdu(\AppBundle\Entity\CDU $cdu = null)
    {
        $this->cdu = $cdu;

        return $this;
    }

    /**
     * Get cdu
     *
     * @return \AppBundle\Entity\CDU
     */
    public function getCdu()
    {
        return $this->cdu;
    }
}
