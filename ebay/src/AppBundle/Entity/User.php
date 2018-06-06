<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\product", mappedBy="User")
     */
    private $product;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\bidding", mappedBy="User")
     */
    private $bin;

    /**
     * One user has many rate.
     * @ORM\OneToMany(targetEntity="rate", mappedBy="User")
     */
    private $rate;

    /**
     * @var int
     *
     * @ORM\Column(name="user_visits", type="integer")
     */
    private $userVisits;

    /**
     * @var int
     *
     * @ORM\Column(name="average_rate", type="integer")
     */
    private $averageRate;

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
     * Set product.
     *
     * @param \AppBundle\Entity\product|null $product
     *
     * @return User
     */
    public function setProduct(\AppBundle\Entity\product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \AppBundle\Entity\product|null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Add product.
     *
     * @param \AppBundle\Entity\product $product
     *
     * @return User
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
     * Set bin.
     *
     * @param \AppBundle\Entity\bidding|null $bin
     *
     * @return User
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
     * @return User
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
     * Set rate.
     *
     * @param \AppBundle\Entity\rate|null $rate
     *
     * @return User
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
     * Add rate.
     *
     * @param \AppBundle\Entity\rate $rate
     *
     * @return User
     */
    public function addRate(\AppBundle\Entity\rate $rate)
    {
        $this->rate[] = $rate;

        return $this;
    }

    /**
     * Remove rate.
     *
     * @param \AppBundle\Entity\rate $rate
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRate(\AppBundle\Entity\rate $rate)
    {
        return $this->rate->removeElement($rate);
    }

    /**
     * Set userVisits.
     *
     * @param int $userVisits
     *
     * @return User
     */
    public function setUserVisits($userVisits)
    {
        $this->userVisits = $userVisits;

        return $this;
    }

    /**
     * Get userVisits.
     *
     * @return int
     */
    public function getUserVisits()
    {
        return $this->userVisits;
    }

    /**
     * Set averageRate.
     *
     * @param int $averageRate
     *
     * @return User
     */
    public function setAverageRate($averageRate)
    {
        $this->averageRate = $averageRate;

        return $this;
    }

    /**
     * Get averageRate.
     *
     * @return int
     */
    public function getAverageRate()
    {
        return $this->averageRate;
    }
}
