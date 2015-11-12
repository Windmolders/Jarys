<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\SiteSettingRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SiteSettingFormType extends AbstractType
{
    /**
     * @var SiteSettingRepository
     */
    private $data;

    /**
     * @return SiteSettingRepository
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param SiteSettingRepository $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    public function __construct ($data) {
        $this->data = $data;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $sitesettings = $this->getData();

        $builder
            ->add(
                $builder->create('tabs', 'tabs', array('inherit_data' => true))
                    ->add($this->createGeneralTab($builder, $sitesettings))
                    ->add(
                        $this->createActionTab($builder)
                            ->add('save', 'submit', array(
                                'label' => 'Save',
                                'attr' => array('class' => 'btn btn-success pull-left'),
                            ))
                            ->add('cancel', 'submit', array(
                                'label' => 'Cancel',
                                'attr' => array('class' => 'btn btn-default pull-left'),
                            ))
                    )
            );
    }

    /**
     * @param FormBuilderInterface $builder
     * @param string               $name
     * @param array                $options
     *
     * @return FormBuilderInterface
     */
    private function createTab(FormBuilderInterface $builder, $name, $options = array())
    {
        $options = array_replace(
            $options,
            array(
                'inherit_data' => true,
            ));

        return $builder->create($name, 'tabs_tab', $options);
    }

    /**
     * @param FormBuilderInterface $builder
     *
     * @return FormBuilderInterface
     */
    private function createGeneralTab(FormBuilderInterface $builder, SiteSettingRepository $sitesettings)
    {
        $mapColors = $sitesettings->findOneBy(array('name' => 'mapColors'));

        return $this->createTab($builder, 'Map', array('label' => 'Google maps'))
            ->add('mapColors', 'textarea', array(
                'label' => 'Map kleuren -> https://snazzymaps.com/editor',
                'required' => false,
                'data' => is_null($mapColors) ? '' : $mapColors->getValue(),
            ))
            ;
    }

    private function createActionTab(FormBuilderInterface $builder)
    {
        return $builder->create('actions', 'tabs_tab_actions', array(
            'mapped' => false,
            'inherit_data' => true,
        ));
    }

    public function getName()
    {
        return 'clastic_site_setting_form';
    }

}