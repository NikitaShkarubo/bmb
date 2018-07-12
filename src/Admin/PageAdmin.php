<?php

namespace App\Admin;

use App\Entity\Page;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PageAdmin extends AbstractAdmin
{
    /** @var string */
    protected $baseRouteName = 'page';

    /** @var string */
    protected $baseRoutePattern = 'page';

    /** @inheritdoc */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $alias = $query->getRootAliases()[0];
        $query->where($alias . '.type = ' . Page::TYPE_COMMON);

        return $query;
    }


    /**
     * @param FormMapper $formMapper
     * @throws \RuntimeException
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('ADMIN.HEADER.MAIN')
            ->add('pageTitle', TextType::class, ['label' => 'ADMIN.PAGE.PAGE.TITLE'])
            ->add('content', CKEditorType::class, [
                'label' => 'ADMIN.PAGE.CONTENT',
                'required' => true,
                'config_name' => 'my_config',
                'trim' => true,
            ])
            ->add('codeBlock', TextareaType::class, ['label' => 'ADMIN.CODE_BLOCK', 'required' => false])
            ->add('redirect', TextType::class, [
                'label' => 'ADMIN.PAGE.REDIRECT',
                'help' => 'ADMIN.PAGE.REDIRECT_HELP',
                'required' => false
            ])
            ->add('active', ChoiceType::class,
                ['choices' => ['ADMIN.YES' => true, 'ADMIN.NO' => false], 'label' => 'ADMIN.PAGE.ACTIVE'])
            ->add('contactFormActive', ChoiceType::class, ['choices' => ['ADMIN.YES' => true, 'ADMIN.NO' => false]])
            ->add('testimonialsActive', ChoiceType::class, ['choices' => ['ADMIN.YES' => true, 'ADMIN.NO' => false]])
            ->end();

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

        $formMapper
            ->with('ADMIN.HEADER.SEO')
            ->add('slug', TextType::class, ['label' => 'ADMIN.PAGE.SLUG', 'required' => false])
            ->add('htmlTitle', TextType::class, ['label' => 'ADMIN.PAGE.HTML.TITLE', 'required' => false])
            ->add('metaKeywords', TextType::class, ['label' => 'ADMIN.PAGE.META.KEYWORDS', 'required' => false])
            ->add('metaDescription', TextareaType::class,
                ['label' => 'ADMIN.PAGE.META.DESCRIPTION', 'required' => false])
            ->add('type', HiddenType::class, ['data' => Page::TYPE_COMMON])
            ->end();
    }

    /** @inheritdoc */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('slug')
            ->add('htmlTitle')
            ->add('pageTitle')
            ->add('active');
    }

    /** @inheritdoc */
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
                        'delete' => array(),
                    )
                ));
    }
}

