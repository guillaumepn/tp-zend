<?php

namespace Meetup\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class MeetupForm extends Form
{
    public function __construct()
    {
        parent::__construct('add-form');

        $this->setAttribute('method', 'post');

        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        $this->add([
            'type' => 'text',
            'name' => 'title',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'title',
            ],
            'options' => [
                'label' => 'Titre de l\'événement',
            ],
        ]);

        $this->add([
            'type' => 'textarea',
            'name' => 'description',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'description',
            ],
            'options' => [
                'label' => 'Description de l\'événement',
            ],
        ]);

        $this->add([
            'type' => 'date',
            'name' => 'date_start',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'date_start',
            ],
            'options' => [
                'label' => 'Début de l\'événement',
            ],
        ]);

        $this->add([
            'type' => 'date',
            'name' => 'date_end',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'date_end',
            ],
            'options' => [
                'label' => 'Fin de l\'événement',
            ],
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'class' => 'form-control btn-primary',
                'value' => 'Créer l\'événement',
            ],
        ]);
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'     => 'title',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'message' => 'Le titre est obligatoire.',
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 2,
                        'max' => 50,
                        'message' => 'Le titre doit faire entre 2 et 50 caractères.'
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'description',
            'required' => true,
            'filters'  => [
                ['name' => 'StripTags'],
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'message' => 'La description est obligatoire.',
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 10,
                        'max' => 2000,
                        'message' => 'La description doit faire entre 10 et 2000 caractères.'

                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'date_start',
            'required' => true,
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'message' => 'La date de début est obligatoire.',
                    ],
                ],
                [
                    'name' => 'Date',
                    'options' => [
                        'message' => 'Ce n\'est pas une date valide.',
                    ],
                ],
                [
                    'name' => 'Callback',
                    'options' => [
                        'callback' => function ($value, $context = []) {
                            if ($value > $context['date_end']) {
                                return false;
                            }
                            return true;
                        },
                        'message' => 'La date de fin doit être supérieure à la date de début'
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'date_end',
            'required' => true,
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'message' => 'La date de fin est obligatoire.',
                    ],
                ],
                [
                    'name' => 'Date',
                    'options' => [
                        'message' => 'Ce n\'est pas une date valide.',
                    ],
                ],
            ],
        ]);
    }
}
