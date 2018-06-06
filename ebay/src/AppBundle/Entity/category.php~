<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\categoryRepository")
 *
 *
 */
class category
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
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\product", mappedBy="category", cascade={"remove"})
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     *
     * @ORM\OneToMany(targetEntity="category", mappedBy="parent")
     */
    private $children;
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="category", inversedBy="children")
     *
     *
     */
    private $parent;

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
     * @return category
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
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new ArrayCollection();
        $this->parent = new ArrayCollection();
    }

    /**
     * Add product.
     *
     * @param \AppBundle\Entity\product $product
     *
     * @return category
     */
    public function addProduct(\AppBundle\Entity\product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product.
     *
     * @param \AppBundle\Entity\product $product
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProduct(\AppBundle\Entity\product $product)
    {
        return $this->product->removeElement($product);
    }

    /**
     * Get product.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduct()
    {
        return $this->product;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Constructor
     *
     * ArrayCollection
     */


    /**
     * Add child.
     *
     * @param \AppBundle\Entity\category $child
     *
     * @return category
     */
    public function addChild(\AppBundle\Entity\category $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child.
     *
     * @param \AppBundle\Entity\category $child
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeChild(\AppBundle\Entity\category $child)
    {
        return $this->children->removeElement($child);
    }

    /**
     * Get children.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add parent.
     *
     * @param \AppBundle\Entity\category $parent
     *
     * @return category
     */
    public function addParent(\AppBundle\Entity\category $parent)
    {
        $this->parent[] = $parent;

        return $this;
    }

    /**
     * Remove parent.
     *
     * @param \AppBundle\Entity\category $parent
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeParent(\AppBundle\Entity\category $parent)
    {
        return $this->parent->removeElement($parent);
    }

    /**
     * Get parent.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParent()
    {

        return $this->parent;
    }

    /**
     * Set parent.
     *
     * @param \AppBundle\Entity\category|null $parent
     *
     * @return category
     */
    public function setParent(\AppBundle\Entity\category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }
}
