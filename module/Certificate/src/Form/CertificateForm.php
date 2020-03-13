<?php 
namespace Certificate\Form;

use Midnet\Form\AbstractBaseForm;
use Zend\Form\Element\Date;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;

class CertificateForm extends AbstractBaseForm
{
    public function initialize()
    {
        parent::initialize();
        
        $this->add([
            'name' => 'NAME',
            'type' => Text::class,
            'attributes' => [
                'id' => 'NAME',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DOB',
            'type' => Date::class,
            'attributes' => [
                'id' => 'DOB',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Date of Birth',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'BIRTHPLACE',
            'type' => Hidden::class,
            'attributes' => [
                'id' => 'BIRTHPLACE',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Place of Birth',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'SEX',
            'type' => Text::class,
            'attributes' => [
                'id' => 'SEX',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Sex',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DOI',
            'type' => Date::class,
            'attributes' => [
                'id' => 'DOI',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Date of Issuance',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DOR',
            'type' => Date::class,
            'attributes' => [
                'id' => 'DOR',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Reg. Date',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'SFN',
            'type' => Text::class,
            'attributes' => [
                'id' => 'SFN',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Registration No.',
            ],
        ],['priority' => 100]);
    }
}