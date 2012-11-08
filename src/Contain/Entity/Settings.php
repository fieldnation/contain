<?php
namespace Contain\Entity;

use Contain\Entity\AbstractEntity;
use Contain\Entity\Property\Property;
use Zend\EventManager\Event;
use Zend\EventManager\EventManager;

/**
 * Settings Entity (auto-generated by the Contain module)
 *
 * This instance should not be edited directly. Edit the definition file instead
 * and recompile.
 */
class Settings extends AbstractEntity
{
    protected $inputFilter = 'Contain\Entity\Filter\Settings';
    protected $messages = array();

    /**
     * Initializes the properties of this entity.
     *
     * @return  $this
     */
    public function init()
    {
        $this->properties['settings'] = array('type' => '\Contain\Entity\Property\Type\ListType', 'options' => array (
  'type' => 'entity',
  'className' => 'Contain\\Entity\\Setting',
));
            }

    /**
     * Accessor getter for the settings property
     *
     * @return  See: Contain\Entity\Property\Type\ListType::getValue()
     */
    public function getSettings()
    {
        return $this->get('settings');
    }

    /**
     * Accessor setter for the settings property
     *
     * @param   See: Contain\Entity\Property\Type\ListType::parse()
     * @return  $this
     */
    public function setSettings($value)
    {
        return $this->set('settings', $value);
    }

    /**
     * Accessor existence checker for the settings property
     *
     * @return  boolean
     */
    public function hasSettings()
    {
        $property = $this->property('settings');
        return !($property->isUnset() || $property->isEmpty());
    }

    /**
     * Gets a site setting value by name.
     *
     * @param   string                      Name
     * @return  mixed
     */
    public function getSetting($name)
    {
        if ($settings = $this->getSettings()) {
            foreach ($settings as $setting) {
                if ($setting->getName() == $name) {
                    return $setting->getValue();
                }
            }
        }

        return null;
    }

    /**
     * Verifies that a setting key exists.
     *
     * @param   string                      Name
     * @return  boolean
     */
    public function hasSetting($name)
    {
        if ($settings = $this->getSettings()) {
            foreach ($settings as $setting) {
                if ($setting->getName() == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Sets a site setting.
     *
     * @param   string                      Name
     * @param   mixed                       Value
     * @return  $this
     */
    public function addSetting($name, $value)
    {
        return $this->setSetting($name, $value);
    }

    /**
     * Removes a setting by key.
     *
     * @param   string                      Name
     * @return  $this
     */
    public function removeSetting($name)
    {
        if ($settings = $this->getSettings()) {
            foreach ($settings as $index => $setting) {
                if ($setting->getName() == $name) {
                    unset($settings[$index]);
                    break;
                }
            }
        }

        $this->setSettings(array_merge(array(), $settings));

        return $this;
    }

    /**
     * Sets a site setting.
     *
     * @param   string                      Name
     * @param   mixed                       Value
     * @return  $this
     */
    public function setSetting($name, $value)
    {
        if ($settings = $this->getSettings()) {
            foreach ($settings as $setting) {
                if ($setting->getName() == $name) {
                    $setting->setValue($value);
                    return $this;
                }
            }
        } else {
            $settings = array();
        }

        $setting = new \Contain\Entity\Setting(array(
            'name' => $name,
            'value' => $value,
        ));

        $settings[] = $setting;
        $this->setSettings($settings);

        return $this;
    }

}
