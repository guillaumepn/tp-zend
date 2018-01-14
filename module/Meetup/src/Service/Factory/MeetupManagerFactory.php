<?php

namespace Meetup\Service\Factory;

use Interop\Container\ContainerInterface;
use Meetup\Service\MeetupManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class MeetupManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new MeetupManager($entityManager);
    }
}
