<?php

namespace Meetup\Service;

use Meetup\Entity\Meetup;

class MeetupManager
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addMeetup($data)
    {
        echo '<pre><code>';
        print_r($data);
        echo '</code></pre>';
        $meetup = new Meetup();
        $meetup->setTitle($data['title']);
        $meetup->setDescription($data['description']);
        $meetup->setDateStart($data['date_start']);
        $meetup->setDateEnd($data['date_end']);

        $this->entityManager->persist($meetup);
        $this->entityManager->flush();
    }
}