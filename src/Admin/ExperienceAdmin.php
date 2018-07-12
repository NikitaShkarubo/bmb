<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExperienceAdmin extends AbstractAdmin
{
    /** @inheritdoc */
    protected $datagridValues = [
        '_sort_order' => 'ASC',
        '_sort_by' => 'rank',
    ];

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', TextType::class, ['label' => 'ADMIN.TITLE'])
            ->add('description', TextareaType::class, ['label' => 'ADMIN.DESCRIPTION'])
            ->add('imageFile',
                VichImageType::class,
                [
                    'label'        => 'ADMIN.IMAGE',
                    'required'     => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'image_uri'    => true,
                    'help'         => 'ADMIN.HELP.EXPERIENCE'
                ])
            ->add('link', TextType::class, ['label' => 'ADMIN.LINK','required' => false])
            ->add('rank', TextType::class, ['label' => 'ADMIN.RANK'])
            ->add('active', ChoiceType::class, ['label' => 'ADMIN.ACTIVE', 'choices' => ['ADMIN.YES' => true, 'ADMIN.NO' => false]]);
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
            ->add('title')
            ->add('link')
            ->add('active');
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
            ->addIdentifier('rank', null, ['header_style' => 'width:50px;'])
            ->addIdentifier('title')
            ->addIdentifier('link')
            ->addIdentifier('active', null, ['header_style' => 'width:100px;'])
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
