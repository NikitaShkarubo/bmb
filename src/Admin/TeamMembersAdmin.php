<?php

namespace App\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TeamMembersAdmin extends AbstractAdmin
{
    /** @inheritdoc */
    protected $parentAssociationMapping = 'team';

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
            ->add('name', TextType::class, ['label' => 'ADMIN.NAME'])
            ->add('phone', TextType::class, ['label' => 'ADMIN.PHONE', 'required' => false])
            ->add('extension', TextType::class, ['label' => 'ADMIN.EXTENSION', 'required' => false])
            ->add('email', TextType::class, ['label' => 'ADMIN.EMAIL'])
            ->add('shortDescription', TextareaType::class, ['label' => 'ADMIN.SHORT_DESCRIPTION', 'required' => false])
            ->add('description', CKEditorType::class, [
                'label' => 'ADMIN.DESCRIPTION',
                'required' => false,
                'config_name' => 'my_config',
                'trim' => true,
            ], ['required' => true])
            ->add('imageFile',
                VichImageType::class,
                [
                    'label'        => 'ADMIN.IMAGE',
                    'required'     => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'image_uri'    => true,
                    'help'         => 'ADMIN.UPLOAD_FILE'
                ])
            ->add('rank', TextType::class, ['label' => 'ADMIN.RANK'])
            ->add('active', ChoiceType::class, ['choices' => ['ADMIN.YES' => true,'ADMIN.NO' => false]]);
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
            ->add('rank');
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
            ->addIdentifier('name')
            ->addIdentifier('email')
            ->add('_action',
                'actions',
                [
                    'actions' => [
                        'edit'   => [],
                        'delete' => [],
                    ]
                ]);
    }
}
