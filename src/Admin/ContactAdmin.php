<?php

namespace App\Admin;

use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactAdmin extends AbstractAdmin
{
    /** @inheritdoc */
    protected $datagridValues = [
        '_sort_order' => 'DESC',
        '_sort_by' => 'created',
    ];

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, ['label' => 'ADMIN.NAME'])
            ->add('phone', PhoneNumberType::class, ['label' => 'ADMIN.PHONE', 'widget' => PhoneNumberType::WIDGET_SINGLE_TEXT])
            ->add('email', TextType::class, ['label' => 'ADMIN.EMAIL'])
            ->add('comment', TextType::class, ['label' => 'ADMIN.COMMENT', 'required' => false])
            ->add('created', DateTimeType::class, ['label' => 'ADMIN.CREATED']);
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     * @throws \RuntimeException
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('email')
            ->add('phone');
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     * @throws \RuntimeException
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('phone', 'phone_number', ['template' => '@App/admin/phoneNumber_list_field.html.twig'])
            ->addIdentifier('email')
            ->addIdentifier('created')
            ->add('_action',
                'actions',
                array(
                    'actions' => array(
                        'edit'   => array(),
                        'delete' => array(),
                    )
                ));
    }
}
