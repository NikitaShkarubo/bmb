<?php

namespace App\Admin;

use App\Manager\UserManager;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsersAdmin extends AbstractAdmin
{
    /** @var UserManager */
    private $userManager;

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', TextType::class, ['label' => 'USERNAME'])
            ->add('email', TextType::class, ['label' => 'ADMIN.EMAIL'])
            ->add('plainPassword',
                RepeatedType::class,
                [
                    'type'           => PasswordType::class,
                    'required'       => false,
                    'first_options'  => array('label' => 'ADMIN.PASSWORD'),
                    'second_options' => array('label' => 'ADMIN.REPEAT.PASSWORD'),
                ]);
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     * @throws \RuntimeException
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('username')
            ->add('email');
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
            ->addIdentifier('username')
            ->addIdentifier('email')
            ->add('action',
                'actions',
                array(
                    'actions' => array(
                        'edit'   => array(),
                        'delete' => array(),
                    )
                ));
    }

    /** @inheritdoc */
    public function prePersist($object)
    {
        $this->userManager->prePersist($object);
    }

    /** @inheritdoc */
    public function preUpdate($object)
    {
        $this->userManager->preUpdate($object);
    }

    /**
     * @param UserManager $userManager
     */
    public function setUserManager(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }
}
