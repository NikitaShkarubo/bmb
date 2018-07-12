<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Sonata\AdminBundle\Route\RouteCollection;

class SettingsAdmin extends AbstractAdmin
{
    /** @var string */
    protected $baseRouteName = 'settings';

    /** @var string */
    protected $baseRoutePattern = 'settings';

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
            ->with('ADMIN.HEADER.CONTACTS')
                ->add('phone', TextType::class, ['label' => 'ADMIN.PHONE'])
                ->add('email', TextType::class, ['label' => 'ADMIN.EMAIL'])
                ->add('skype', TextType::class, ['label' => 'ADMIN.SKYPE'])
                ->add('fax', TextType::class, ['label' => 'ADMIN.FAX'])
                ->add('tollFax', TextType::class, ['label' => 'ADMIN.TOLL_FAX'])
                ->add('address', TextareaType::class, ['label' => 'ADMIN.ADDRESS'])
            ->end();

        $formMapper
            ->with('ADMIN.HEADER.TEXT')
                ->add('headerText', TextareaType::class, ['label' => 'ADMIN.HEADER_TEXT'])
                ->add('footerText', TextareaType::class, ['label' => 'ADMIN.FOOTER_TEXT'])
                ->add('codeBlock', TextareaType::class, ['label' => 'ADMIN.CODE_BLOCK', 'required' => false])
            ->end();

        $formMapper
            ->with('ADMIN.HEADER.CONTACT.FORM')
                ->add('contactEmailSendTo', TextType::class, ['label' => 'ADMIN.CONTACT_EMAIL.SEND.TO'])
                ->add('contactEmailSendFrom', TextType::class, ['label' => 'ADMIN.CONTACT_EMAIL.SEND.FROM'])
                ->add('contactEmailSubject', TextType::class, ['label' => 'ADMIN.CONTACT_EMAIL.SUBJECT'])
                ->add('contactSuccessRedirect', TextType::class, [
                    'label' => 'ADMIN.CONTACT_EMAIL.SUCCESS_REDIRECT',
                    'help'  => 'ADMIN.CONTACT_EMAIL.REDIRECT_HELP'
                    ])
            ->end();

        $formMapper
            ->with('ADMIN.HEADER.MAP')
                ->add('mapLink', TextType::class, ['label' => 'ADMIN.MAP.LINK', 'required' => false])
                ->add('mapLongitude', TextType::class, ['label' => 'ADMIN.MAP.LONGITUDE'])
                ->add('mapLatitude', TextType::class, ['label' => 'ADMIN.MAP.LATITUDE'])
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
