<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class IndexPageAdmin extends AbstractAdmin
{
    /** @var string */
    protected $baseRouteName = 'index_page';

    /** @var string */
    protected $baseRoutePattern = 'index_page';

    public function configure() {
        $this->setTemplate('edit', '@App/admin/settings_edit.html.twig');
    }

    /** @inheritdoc */
    protected function configureRoutes(RouteCollection $collection)
    {
        // to remove a single route
        $collection->remove('delete');
        // OR remove all route except named ones
        $collection->clearExcept(array('show', 'list', 'edit'));
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     * @throws \RuntimeException
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('ADMIN.HEADER.INTRO')
            ->add('introTitle', TextType::class, ['label' => 'ADMIN.TITLE'])
            ->add('introLink', TextType::class, ['label' => 'ADMIN.LINK', 'required' => false ])
            ->add('introText', CKEditorType::class, [
                'label' => 'ADMIN.TEXT',
                'required' => false,
                'config_name' => 'my_config',
                'trim' => true,
            ], ['required' => true])
            ->add('image',
                VichImageType::class,
                [
                    'label'        => 'ADMIN.IMAGE',
                    'required'     => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'image_uri'    => true,
                    'help'         => 'ADMIN.HELP.INTRO'
                ])
            ->end();

        $formMapper
            ->with('ADMIN.HEADER.ABOUT')
            ->add('aboutTitle', TextType::class, ['label' => 'ADMIN.TITLE'])
            ->add('aboutText', CKEditorType::class, [
                'label' => 'ADMIN.TEXT',
                'required' => true,
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
                    'help'         => 'ADMIN.HELP.ABOUT'
                ])
            ->end();

        $formMapper
            ->with('ADMIN.HEADER.COMMITMENT')
            ->add('commitmentTitle', TextType::class, ['label' => 'ADMIN.TITLE', 'required' => false])
            ->add('commitmentText', CKEditorType::class, [
                'label' => 'ADMIN.TEXT',
                'required' => false,
                'config_name' => 'my_config',
                'trim' => true,
            ], ['required' => true])
            ->end();
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     * @throws \RuntimeException
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
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
            ->addIdentifier('id')
            ->addIdentifier('phone')
            ->addIdentifier('email')
            ->add('_action',
                'actions',
                [
                    'actions' => [
                        'edit' => [],
                    ]
                ]);
    }
}
