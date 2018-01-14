<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @package Meetup\Entity
 * @ORM\Entity
 * @ORM\Table(name="meetup")
 */

class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string", length=36)
     */
    public $id;

    /**
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    public $title;

    /**
     * @ORM\Column(name="description", type="string", length=2000, nullable=false)
     */
    public $description;

    /**
     * @ORM\Column(name="date_start", type="string", nullable=false)
     */
    public $date_start;

    /**
     * @ORM\Column(name="date_end", type="string", nullable=false)
     */
    public $date_end;


    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * @param \DateTime $date_start
     */
    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * @param \DateTime $date_end
     */
    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
    }
}
