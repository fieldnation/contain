<?php
namespace ContainTest\Entity;

use Contain\Entity\AbstractEntity;
use Contain\Entity\Property\Property;

class SampleChildEntity extends AbstractEntity
{
    public function init()
    {
        $this->properties['firstName'] = new Property('string', array('primary' => true));
    }
}
