<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Contact\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ContactType
 * @package Kristofvc\Contact\Form\Type
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
class ContactType extends AbstractType implements ContactTypeInterface
{
    /**
     * @var bool
     */
    private $hasRecaptcha = false;

    /**
     * @var string
     */
    private $dataClass;

    /**
     * @var string
     */
    private $name;

    /**
     * @param $hasRecaptcha
     * @param string $dataClass
     * @param string $name
     */
    public function __construct($hasRecaptcha, $dataClass = 'Kristofvc\Contact\Model\Contact', $name = 'contact_type')
    {
        $this->hasRecaptcha = $hasRecaptcha;
        $this->dataClass = $dataClass;
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            'text',
            [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Name',
                    'tabindex' => 1
                ]
            ]
        );

        $builder->add(
            'email',
            'email',
            [
                'required' => true,
                'attr' => [
                    'placeholder' => 'E-mail',
                    'tabindex' => 1
                ]
            ]
        );

        if ($this->hasRecaptcha) {
            $builder->add('recaptcha', 'ewz_recaptcha');
        }

        $builder->add(
            'message',
            'textarea',
            [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Message',
                    'tabindex' => 1,
                    'rows' => 7
                ]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}
