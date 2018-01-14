<?php

declare(strict_types=1);

namespace Meetup\Controller\Factory;

use Doctrine\ORM\EntityManager;
use Meetup\Controller\MeetupController;
use Meetup\Service\MeetupManager;
use Psr\Container\ContainerInterface;

/**
 * Class MeetupControllerFactory
 * @package Meetup\Controller
 */
class MeetupControllerFactory
{
    /**
     * @param ContainerInterface $container
     * @return MeetupController
     */
    public function __invoke(ContainerInterface $container) : MeetupController
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $meetupManager = $container->get(MeetupManager::class);
        return new MeetupController($entityManager, $meetupManager);
    }
}
