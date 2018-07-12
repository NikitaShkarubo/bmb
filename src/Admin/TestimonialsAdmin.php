<?php

namespace App\Admin;

use App\Entity\Testimonials;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TestimonialsAdmin extends AbstractAdmin
{
    /** @inheritdoc */
    protected $datagridValues = [
        '_sort_order' => 'ASC',
        '_sort_by'    => 'rank',
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
            ->add('link', TextType::class, ['label' => 'ADMIN.LINK', 'required' => false])
            ->add('linkTarget', ChoiceType::class, [
                'label'    => 'ADMIN.LINK_TARGET',
                'required' => false,
                'choices'  => ['ADMIN.TARGET_BLANK' => Testimonials::TARGET_BLANK, 'ADMIN.TARGET_TOP' => Testimonials::TARGET_TOP]])
            ->add('comment', CKEditorType::class, [
                'label'       => 'ADMIN.COMMENT',
                'required'    => true,
                'config_name' => 'testimonials',
                'trim'        => true,
            ])
            ->add('rank', TextType::class, ['label' => 'ADMIN.RANK'])
            ->add('created', DateTimeType::class, ['label' => 'ADMIN.CREATED'])
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
            ->addIdentifier('name')
            ->addIdentifier('active')
            ->add('_action',
                'actions',
                [
                    'actions' => [
                        'edit'    => [],
                        'delete'  => [],
                    ]
                ]);
    }
}
