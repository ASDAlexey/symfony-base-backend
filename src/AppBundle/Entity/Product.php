<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="product")
 */
class Product {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string"))
     */
    private $name;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $price;
    /**
     * @ORM\Column(type="text", nullable=true))
     */
    private $description;
    /**
     * @ORM\Column(type="string", nullable=true))
     */
    private $color;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\Image(
     *  mimeTypes = {
     *        "image/png",
     *        "image/jpeg",
     *      }
     * )
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * created Time/Date
     *
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * updated Time/Date
     *
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color) {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year) {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    /**
     * Set createdAt
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt() {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @ORM\PreUpdate
     */
    public function setUpdatedAt() {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }
}