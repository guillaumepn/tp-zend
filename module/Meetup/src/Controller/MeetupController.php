<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Form\AddForm;
use Meetup\InputFilter\AddMeetup;
use Zend\I18n\View\Helper\Translate;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\I18n\Translator;
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
        $form = new AddForm();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $this->meetupManager->addMeetup($data);
                return $this->redirect()->toRoute('meetup', ['action' => 'index']);
            }
        }
        return new ViewModel([
            'form' => $form
        ]);
    }

    public function deleteAction($id)
    {
//        $meetup = new Meetup();
//
//        return new ViewModel([
//            'meetup' => $meetup
//        ]);
    }
}