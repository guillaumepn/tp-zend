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
        $meetup = new Meetup();
        $meetup->setTitle($data['title']);
        $meetup->setDescription($data['description']);
        $meetup->setDateStart($data['date_start']);
        $meetup->setDateEnd($data['date_end']);

        $this->entityManager->persist($meetup);
        $this->entityManager->flush();
    }

    public function updateMeetup($meetup, $data)
    {
        $meetup->setTitle($data['title']);
        $meetup->setDescription($data['description']);
        $meetup->setDateStart($data['date_start']);
        $meetup->setDateEnd($data['date_end']);

        $this->entityManager->flush();
    }

    public function deleteMeetup($meetup)
    {
        $this->entityManager->remove($meetup);
        $this->entityManager->flush();
    }
}
