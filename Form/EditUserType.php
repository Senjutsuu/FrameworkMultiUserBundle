<?php

namespace SumoCoders\FrameworkMultiUserBundle\Form;

use SumoCoders\FrameworkMultiUserBundle\DataTransferObject\UserDataTransferObject;
use SumoCoders\FrameworkMultiUserBundle\Form\Interfaces\FormWithDataTransferObject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType implements FormWithDataTransferObject
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => $this->getDataTransferObjectClass(),
            ]
        );
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'userName',
            TextType::class
        )->add(
            'displayName',
            TextType::class
        )->add(
            'email',
            EmailType::class
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multi_user_form_edit_user';
    }

    /**
     * @return string
     */
    public function getDataTransferObjectClass()
    {
        return UserDataTransferObject::class;
    }
}
