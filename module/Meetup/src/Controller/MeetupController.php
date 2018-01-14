<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Form\MeetupForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Meetup\Entity\Meetup;

/**
 * Class MeetupController
 * @package Meetup\Controller
 */
class MeetupController extends AbstractActionController
{
    private $entityManager;
    private $meetupManager;

    public function __construct($entityManager, $meetupManager)
    {
        $this->entityManager = $entityManager;
        $this->meetupManager = $meetupManager;
    }

    /**
     * @return ViewModel
     */
    public function indexAction() : ViewModel
    {
        $meetups = $this->entityManager->getRepository(Meetup::class)->findAll();

        return new ViewModel([
            'meetups' => $meetups
        ]);
    }

    public function addAction()
    {
        $form = new MeetupForm();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $this->meetupManager->addMeetup($data);
                return $this->redirect()->toRoute('meetup');
            }
        }
        return new ViewModel([
            'form' => $form
        ]);
    }

    public function editAction()
    {
        $form = new MeetupForm();
        $meetupId = $this->params()->fromRoute('id', -1);
        $meetup = $this->entityManager->
            getRepository(Meetup::class)->
            findOneById($meetupId);

        if ($meetup === null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();
                $this->meetupManager->updateMeetup($meetup, $data);
                return $this->redirect()->toRoute('meetup');
            }
        } else {
            $data = [
                'title' => $meetup->getTitle(),
                'description' => $meetup->getDescription(),
                'date_start' => $meetup->getDateStart(),
                'date_end' => $meetup->getDateEnd()
            ];

            $form->setData($data);
        }

        return new ViewModel([
            'form' => $form,
            'meetup' => $meetup
        ]);
    }

    public function deleteAction()
    {
        $meetupId = $this->params()->fromRoute('id', -1);
        $meetup = $this->entityManager->
            getRepository(Meetup::class)->
            findOneById($meetupId);

        if ($meetup === null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $this->meetupManager->deleteMeetup($meetup);
        return $this->redirect()->toRoute('meetup');
    }
}
