<?php

namespace App\Admin;

use App\Entity\Menu;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MenuChildrenAdmin extends AbstractAdmin
{
    /** @var string */
    protected $parentAssociationMapping = 'parentMenu';

    /** @var string */
    protected $baseRouteName = 'menu_child';

    /** @var string */
    protected $baseRoutePattern = 'menu_child';

    /** @inheritdoc */
    protected $datagridValues = [
        '_sort_order' => 'ASC',
        '_sort_by' => 'rank',
    ];

    /** @inheritdoc */
    public function configure() {
        $this->setTemplate('edit', '@App/admin/page_js.html.twig');
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', TextType::class, ['label' => 'ADMIN.TITLE'])
            ->add('linkType', ChoiceType::class, [
                'label'    => 'ADMIN.LINK_TYPE',
                'attr'     => ['class' => 'link_select_custom'],
                'required' => false,
                'choices'  => ['ADMIN.LINK' => 'link', 'ADMIN.PAGE.PAGE' => 'page']])
            ->add('page', ModelType::class, [
                'label'    => 'ADMIN.PAGE.PAGE',
                'property' => 'slug',
                'attr'     => ['class' => 'page_select_custom'],
                'required' => false,
                'btn_add'  => false],
                ['admin_code' => 'admin.page'])
            ->add('link', TextType::class, ['label' => 'ADMIN.LINK', 'attr' => ['class' => 'link_input_custom'], 'required' => false])
            ->add('linkTarget', ChoiceType::class, [
                'label'   => 'ADMIN.LINK_TARGET',
                'choices' => ['ADMIN.TARGET_BLANK' => Menu::TARGET_BLANK, 'ADMIN.TARGET_TOP' => Menu::TARGET_TOP]])
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
            ->add('rank')
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
                [
                    'actions' => [
                        'children' => ['template' => '@App/admin/menu.html.twig'],
                        'edit'     => [],
                        'delete'   => [],
                    ]
                ]);
    }
}
