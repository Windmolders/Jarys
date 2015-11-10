<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SiteSetting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clastic\BlockBundle;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;

class SiteSettingController extends Controller
{

    public function indexAction(Request $request)
    {
        /** @var \Symfony\Component\Form\Form $form */
        $form = $this->createSettingForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $settings = $form->getData();

            foreach($settings as $key => $value) {
                $this->setSetting($key, $value);
            }

            return $this->redirectToRoute('clastic_backoffice_dashboard');
         }

        return $this->render('AppBundle:SiteSetting:edit.html.twig', array_merge ( array(
                'record' => array(
                    'icon' => 'fa-envelope-o',
                    'class' => 'blauw',
                    'displayTitle' => 'Contact',
                ),
                'form' => $form->createView(),
            ), $this->getTemplateData()
        ));
    }

    public function getSetting($name, $default = '') {
        $sitesettings = $this->getDoctrine()->getRepository('AppBundle:SiteSetting');

        /** @var SiteSetting $value */
        $setting = $sitesettings->findOneBy(array('name' => $name));

        if (is_null($setting)) {
            return $default;
        }

        return $setting->getValue();
    }

    public function setSetting($name, $value) {
        $em = $this->getDoctrine()->getManager();
        $sitesettings = $this->getDoctrine()->getRepository('AppBundle:SiteSetting');

        /** @var SiteSetting $value */
        $setting = $sitesettings->findOneBy(array('name' => $name));

        if (is_null($setting)) {
            $setting = new SiteSetting();
            $setting->setName($name);
            $setting->setValue($value);
        } else {
            $setting->setValue($value);
        }

        $em->persist($setting);
        $em->flush();
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
     * @return \Symfony\Component\Form\Form
     */
    public function createSettingForm() {

        $defaultData = array();

        /** @var FormBuilder $form */
        $form = $this->createFormBuilder($defaultData);

        $this->createTab($form, 'Map')
            ->add('mapColors', 'textarea', array(
                'label' => 'Map kleuren -> https://snazzymaps.com/editor',
                'required' => false,
            ));


        $form->add('mapColors', 'textarea', array(
            'label' => 'Map kleuren -> https://snazzymaps.com/editor',
            'required' => false,
        ));
        $form->get('mapColors')->setData($this->getSetting('mapColors'))
        ;

        $form->add('submit', 'submit', array(
            'label' => 'Opslaan',
            'attr'  => array('class' => 'btn-jarys')
        ));

        return $form->getForm();;

    }

    /**
     * @return string
     */
    public function getType() {
        return 'site_setting';
    }

    /**
     * @return string
     */
    public function getEntityType() {
        return 'site_setting';
    }

    /**
     * @return string
     */
    public function getEntityName() {
        return 'AppBundle:SiteSetting';
    }

    /**
     * @return string
     */
    public function getDisplayTitle() {
        return 'Instellingen';
    }

    /**
     * Returns array with extra template data
     *
     * @return array
     */
    public function getTemplateData() {
        return array(
            'type' => $this->getType(),
            'entityType' => $this->getEntityType(),
            'module' => $this->get('clastic.module_manager')->getModule($this->getType()),
            'submodules' => array(),
            'links' => array(),
            'displayTitle' => $this->getDisplayTitle(),
        );
    }

}
