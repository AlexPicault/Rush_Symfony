<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * rate
 *
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\rateRepository")
 */
class rate
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
     *@var int
     * 
     *@Assert\Range(
     *      min = 0,
     *      max = 5,
     *      minMessage = "You must be at least {{ limit }}",
     *      maxMessage = "You cannot be taller than {{ limit }}"
     * )
     *
     * @ORM\Column(name="rate", type="integer", nullable=true)
     */
    private $rate = null;

    /**
     * One rate has One product
     * @ORM\OneToOne(targetEntity="product", inversedBy="rate")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    private $product;

    /**
     * One rate has One product
     * @ORM\ManyToOne(targetEntity="User", inversedBy="rate")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    private $user;
    /**
     *@var int
     *
     *@Assert\Range(
     *      min = 0,
     *      max = 5,
     *      minMessage = "You must be at least {{ limit }}",
     *      maxMessage = "You cannot be taller than {{ limit }}"
     * )
     *
     *  @ORM\Column(name="rate_user", type="integer", nullable=true)
     */
    private $rate_user=null;
    
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_user", type="text")
     */
    private $comment_user;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rate.
     *
     * @param int $rate
     *
     * @return rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate.
     *
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return rate
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set rateProduct.
     *
     * @param int $rateProduct
     *
     * @return rate
     */
    public function setRateProduct($rateProduct)
    {
        $this->rate_product = $rateProduct;

        return $this;
    }

    /**
     * Get rateProduct.
     *
     * @return int
     */
    public function getRateProduct()
    {
        return $this->rate_product;
    }

    /**
     * Set rateUser.
     *
     * @param int $rateUser
     *
     * @return rate
     */
    public function setRateUser($rateUser)
    {
        $this->rate_user = $rateUser;

        return $this;
    }

    /**
     * Get rateUser.
     *
     * @return int
     */
    public function getRateUser()
    {
        return $this->rate_user;
    }

    /**
     * Set product.
     *
     * @param \AppBundle\Entity\product|null $product
     *
     * @return rate
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
    public function __toString()
    {
        $rate = $this->getRate();
        $convRate = (string)$rate;
        return $convRate;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User|null $user
     *
     * @return rate
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set commentUser.
     *
     * @param string $commentUser
     *
     * @return rate
     */
    public function setCommentUser($commentUser)
    {
        $this->comment_user = $commentUser;

        return $this;
    }

    /**
     * Get commentUser.
     *
     * @return string
     */
    public function getCommentUser()
    {
        return $this->comment_user;
    }
}
