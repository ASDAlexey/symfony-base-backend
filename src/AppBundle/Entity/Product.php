<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
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
}