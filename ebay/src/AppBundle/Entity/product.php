<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\productRepository")
 * @Vich\Uploadable
 */
class product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="product", cascade={"persist"})
     *
     */
    private $user;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\bidding", mappedBy="product")
     */
    private $bin;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\category", inversedBy="product", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * One product has One rate.
     * @ORM\OneToOne(targetEntity="rate", mappedBy="product")
     */
    private $rate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Groups({"searchable"})
     */

    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */

    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sell", type="boolean", options={"default"=false})
     */

    private $sell;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=0)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_visits", nullable=true)
     */
    private $productVisits=null;


    /**
     * @var string
     *
     * @ORM\Column(name="immediate_price", type="decimal", precision=10, scale=0)
     */
    private $immediate_price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="saleDate", type="date")
     */
    private $saleDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt=null ;
    
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
     * Set name
     *
     * @param string $name
     *
     * @return product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return product
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
     * Set price
     *
     * @param string $price
     *
     * @return product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set saleDate
     *
     * @param \DateTime $saleDate
     *
     * @return product
     */
    public function setSaleDate($saleDate)
    {
        $this->saleDate = $saleDate;

        return $this;
    }

    /**
     * Get saleDate
     *
     * @return \DateTime
     */
    public function getSaleDate()
    {
        return $this->saleDate;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set category.
     *
     * @param \AppBundle\Entity\category|null $category
     *
     * @return product
     */
    public function setCategory(\AppBundle\Entity\category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \AppBundle\Entity\category|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __toString()
    {
        return $this->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return product
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        return $this->user->removeElement($user);
    }

    /**
     * Get user.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User|null $user
     *
     * @return product
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set immediatePrice.
     *
     * @param string $immediatePrice
     *
     * @return product
     */
    public function setImmediatePrice($immediatePrice)
    {
        $this->immediate_price = $immediatePrice;

        return $this;
    }

    /**
     * Get immediatePrice.
     *
     * @return string
     */
    public function getImmediatePrice()
    {
        return $this->immediate_price;
    }

    /**
     * Set dateEnd.
     *
     * @param \DateTime $dateEnd
     *
     * @return product
     */
    public function setDateEnd($dateEnd)
    {
        $this->date_end = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd.
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * Set rate.
     *
     * @param \AppBundle\Entity\rate|null $rate
     *
     * @return product
     */
    public function setRate(\AppBundle\Entity\rate $rate = null)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate.
     *
     * @return \AppBundle\Entity\rate|null
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set bin.
     *
     * @param \AppBundle\Entity\bidding|null $bin
     *
     * @return product
     */
    public function setBin(\AppBundle\Entity\bidding $bin = null)
    {
        $this->bin = $bin;

        return $this;
    }

    /**
     * Get bin.
     *
     * @return \AppBundle\Entity\bidding|null
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * Add bin.
     *
     * @param \AppBundle\Entity\bidding $bin
     *
     * @return product
     */
    public function addBin(\AppBundle\Entity\bidding $bin)
    {
        $this->bin[] = $bin;

        return $this;
    }

    /**
     * Remove bin.
     *
     * @param \AppBundle\Entity\bidding $bin
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBin(\AppBundle\Entity\bidding $bin)
    {
        return $this->bin->removeElement($bin);
    }

    /**
     * Set sell.
     *
     * @param bool $sell
     *
     * @return product
     */
    public function setSell($sell)
    {
        $this->sell = $sell;

        return $this;
    }

    /**
     * Get sell.
     *
     * @return bool
     */
    public function getSell()
    {
        return $this->sell;
    }

    public function setImageFile2(File $image2 = null)
    {
        $this->imageFile2 = $image2;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image2) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt2 = new \DateTime('now');
        }
    }


    /**
     * Set productVisits.
     *
     * @param string $productVisits
     *
     * @return product
     */
    public function setProductVisits($productVisits)
    {
        $this->productVisits = $productVisits;

        return $this;
    }

    /**
     * Get productVisits.
     *
     * @return string
     */
    public function getProductVisits()
    {
        return $this->productVisits;
    }
}
