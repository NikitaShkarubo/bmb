<?php

namespace App\Admin;

use App\Entity\Team;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TeamAdmin extends AbstractAdmin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', TextType::class, ['label' => 'ADMIN.TITLE'])
            ->add('description', TextareaType::class, ['label' => 'ADMIN.DESCRIPTION', 'required' => false])
            ->add('inRow', ChoiceType::class, ['choices' => ['ADMIN.ROW_3' => Team::THREE_IN_ROW, 'ADMIN.ROW_2' => Team::TWO_IN_ROW]])
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
            ->add('title')
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
            ->addIdentifier('active')
            ->addIdentifier('title')
            ->add('_action',
                'actions',
                [
                    'actions' => [
                        'members' => ['template' => '@App/admin/team.html.twig'],
                        'edit'    => [],
                        'delete'  => [],
                    ]
                ]);
    }
}
