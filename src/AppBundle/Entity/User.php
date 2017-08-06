<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="Email already in use")
 */
class User implements UserInterface {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Assert\NotBlank(groups={"Registration"})
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="user")
     */
    private $products;

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

    public function getUsername() {
        return $this->email;
    }

    public function getRoles() {
        $roles = $this->roles;

        if (!in_array('ROLE_USER', $roles)) $roles[] = 'ROLE_USER';

        return $roles;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
    }

    public function eraseCredentials() {
        $this->plainPassword = null;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword() {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles) {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return ArrayCollection|Product[]
     */
    public function getNotes() {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getProducts() {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products) {
        $this->products = $products;
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