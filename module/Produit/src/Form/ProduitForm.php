<?php
namespace Produit\Form;

use Zend\Form\Form;

class ProduitForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Product');
        $this->setAttribute('method', 'post');
        $this->addElements();
        
    }

    private function addElements(){
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'nom',
            'type' => 'text',
            'options' => [
                'label' => 'Nom',
            ],
        ]);
        $this->add([
            'name' => 'description',
            'type' => 'text',
            'options' => [
                'label' => 'Description',
            ],
        ]);
        $this->add([
            'name' => 'prix',
            'type' => 'number',
            'options' => [
                'label' => 'Prix',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}