<?php

namespace App\Admin;

use App\Entity\Page;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\{
    ChoiceType, HiddenType, TextareaType, TextType
};
use Vich\UploaderBundle\Form\Type\VichImageType;

class SystemPagesAdmin extends AbstractAdmin
{
    /** @var string */
    protected $baseRouteName = 'system_pages';

    /** @var string */
    protected $baseRoutePattern = 'system_pages';

    /** @inheritdoc */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $alias = $query->getRootAliases()[0];
        $query->where($alias . '.type = ' . Page::TYPE_SYSTEM);
        $query->andWhere($alias . '.slug != :slug');
        $query->setParameters([
            'slug' => 'thank-you-contact'
        ]);
        return $query;
    }

    /** @inheritdoc */
    public function configure() {
        $this->setTemplate('edit', '@App/admin/page_edit.html.twig');
    }

    /** @inheritdoc */
    protected function configureRoutes(RouteCollection $collection)
    {
        // to remove a single route
        $collection->remove('delete');
        $collection->remove('create');
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
            ->with('ADMIN.HEADER.MAIN')
                ->add('pageTitle', TextType::class, ['label' => 'ADMIN.PAGE.PAGE.TITLE'])
                ->add('content', CKEditorType::class, [
                    'label' => 'ADMIN.PAGE.CONTENT',
                    'required' => false,
                    'config_name' => 'my_config',
                    'trim' => true,
                ], ['required' => true])
                ->add('codeBlock', TextareaType::class, ['label' => 'ADMIN.CODE_BLOCK', 'required' => false])
                ->add('testimonialsActive', ChoiceType::class, ['choices' => ['ADMIN.YES' => true,'ADMIN.NO' => false]])
            ->end();
        if ($this->getRequest()->get('id') != 1) {
            $formMapper
                ->with('ADMIN.HEADER.HEADER_IMAGE')
                ->add('imageHeaderTitle', TextType::class,
                    ['label' => 'ADMIN.PAGE.IMAGE_HEADER_TITLE', 'required' => false])
                ->add('imageHeaderActive', ChoiceType::class, ['choices' => ['ADMIN.YES' => true, 'ADMIN.NO' => false]])
                ->add('imageFile', VichImageType::class, [
                    'label' => 'ADMIN.IMAGE',
                    'required' => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'image_uri' => true,
                    'help' => 'ADMIN.HELP.PAGE'
                ])
                ->end();
        }

        $formMapper
            ->with('ADMIN.HEADER.SEO')
            ->add('htmlTitle', TextType::class, ['label' => 'ADMIN.PAGE.HTML.TITLE', 'required' => false])
            ->add('metaKeywords', TextType::class, ['label' => 'ADMIN.PAGE.META.KEYWORDS', 'required' => false])
            ->add('metaDescription', TextareaType::class,
                ['label' => 'ADMIN.PAGE.META.DESCRIPTION', 'required' => false])
            ->add('type', HiddenType::class, ['data' => Page::TYPE_SYSTEM])
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
        $datagridMapper
            ->add('slug')
            ->add('htmlTitle')
            ->add('pageTitle')
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
            ->addIdentifier('slug')
            ->addIdentifier('page_title')
            ->addIdentifier('active')
            ->add('_action',
                'actions',
                array(
                    'actions' => array(
                        'edit' => array(),
                    )
                ));
    }
}
