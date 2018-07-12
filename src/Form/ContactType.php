<?php

namespace App\Form;

use App\Entity\Contact;
use Beelab\Recaptcha2Bundle\Form\Type\RecaptchaType;
use Beelab\Recaptcha2Bundle\Validator\Constraints\Recaptcha2;
use libphonenumber\PhoneNumberFormat;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name',
            TextType::class,
            [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'FORM.NAME',
                ]
            ]);

        $builder->add('email',
            EmailType::class,
            [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'FORM.EMAIL',
                ]
            ]);

        $builder->add('phone',
            PhoneNumberType::class,
            [
                'default_region' => 'CA',
                'widget'         => PhoneNumberType::WIDGET_SINGLE_TEXT,
                'format'         => PhoneNumberFormat::NATIONAL,
                'label'          => false,
                'attr'           => ['placeholder' => 'FORM.PHONE']
            ]);

        $builder->add('comment',
            TextType::class,
            [
                'label'    => false,
                'required' => false,
                'attr'  => [
                    'placeholder' => 'FORM.COMMENT',
                ]
            ]);

            $builder->add('recaptcha', RecaptchaType::class, [
                'label'       => false,
                'mapped'      => false,
                'constraints' => new Recaptcha2(['message' => 'RECAPTCHA.ERROR_MESSAGE']),
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'        => Contact::class,
        ]);
    }
}
