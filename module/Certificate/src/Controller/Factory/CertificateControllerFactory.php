<?php 
namespace Certificate\Controller\Factory;

use Certificate\Controller\CertificateController;
use Certificate\Form\CertificateForm;
use Certificate\Model\CertificateModel;
use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Zend\ServiceManager\Factory\FactoryInterface;

class CertificateControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new CertificateController();
        $uuid = new Uuid();
        $date = new \DateTime('now',new \DateTimeZone('EDT'));
        $today = $date->format('Y-m-d H:i:s');
        
        $adapter = $container->get('certificate-model-primary-adapter');
        $controller->setDbAdapter($adapter);
        
        $model = new CertificateModel($adapter);
        $model->UUID = $uuid->value;
        $model->DATE_CREATED = $today;
        $model->STATUS = $model::ACTIVE_STATUS;
        
        $controller->setModel($model);
        
        $form = new CertificateForm();
        $form->initialize();
        $controller->setForm($form);
        
        return $controller;
    }
}