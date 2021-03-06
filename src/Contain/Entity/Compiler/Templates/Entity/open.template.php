<?php echo '<?php'; ?>

namespace <?php echo $this->namespace; ?>;

use Contain\Entity\AbstractEntity;
use Contain\Entity\Property\Property;

/**
 * <?php echo $this->name; ?> Entity (auto-generated by the Contain module)
 *
 * This instance should not be edited directly. Edit the definition file instead
 * and recompile.
 */
class <?php echo $this->name; ?> extends AbstractEntity<?php
    if ($this->implementors): ?> implements <?php echo implode(', ', $this->implementors); endif; ?>

{
<?php foreach ($this->constants as $name => $value): ?>
    const <?php echo strtoupper($name); ?> = <?php var_export($value); ?>;
<?php endforeach; ?>

<?php if ($this->aliases): ?>
    protected $aliases = <?php var_export($this->aliases); ?>;
<?php endif; ?>

<?php if ($this->filter): ?>
    protected $inputFilter = '<?php echo $this->filter; ?>';
    protected $messages = array();

<?php endif; ?>
    /**
     * Initializes the properties of this entity.
     *
     * @return self
     */
    public function init()
    {
<?php foreach ($this->properties as $name => $property): ?>
<?php if ($options = $property->getOptions() + $property->getType()->getOptions()): ?>
        $this->define('<?php echo $name; ?>', '<?php echo $property->getTypeAlias();
            ?>', <?php var_export($options); ?>);
<?php else: ?>
        $this->define('<?php echo $name; ?>', '<?php echo $property->getTypeAlias(); ?>');
<?php endif; ?>
<?php endforeach; ?>
<?php echo $this->init; ?>
    }

<?php foreach ($this->allProperties as $name => $property): ?>
<?php $property = $this->properties[$property]; ?>
<?php if ($property->getType() instanceof \Contain\Entity\Property\Type\ListType ||
          $property->getType() instanceof \Contain\Entity\Property\Type\HashType): ?>
    /**
     * Searches for a value and returns its index or FALSE if not found.
     *
     * @param   mixed         $value  Value to search for
     * @param   bool  $strict Strict type checking
     *
     * @return  integer|false
     */
    public function indexOf<?php echo ucfirst($name); ?>($value, $strict = false)
    {
        return $this->indexOf('<?php echo $name; ?>', $value, $strict);
    }

    /**
     * Prepends a value to a list property.
     *
     * @param string|integer $index Index to unset
     *
     * @return self
     */
    public function unset<?php echo ucfirst($name); ?>($index)
    {
        return $this->unsetIndex('<?php echo $name; ?>', $index);
    }

    /**
     * Sets a value for a list item at a given index.
     *
     * @param string $index Property name
     * @param mixed  $index Property value
     *
     * @return mixed|null Value or null if unset
     */
    public function put<?php echo ucfirst($name); ?>($index, $value)
    {
        return $this->put('<?php echo $name; ?>', $index, $value);
    }

    /**
     * Fetches a list item by its numerical index position.
     *
     * @param string $index Property name
     *
     * @return mixed|null Value or null if unset
     */
    public function at<?php echo ucfirst($name); ?>($index)
    {
        return $this->at('<?php echo $name; ?>', $index);
    }

<?php endif; ?>
<?php if ($property->getType() instanceof \Contain\Entity\Property\Type\ListType): ?>
    /**
     * Prepends a value to a list property.
     *
     * @param mixed $value Value to prepend
     *
     * @return self
     */
    public function unshift<?php echo ucfirst($name); ?>($value)
    {
        return $this->unshift('<?php echo $name; ?>', $value);
    }

    /**
     * Appends a value to a list property.
     *
     * @param mixed $value Value to append
     *
     * @return self
     */
    public function push<?php echo ucfirst($name); ?>($value)
    {
        return $this->push('<?php echo $name; ?>', $value);
    }

    /**
     * Removes a property from the end of a list and returns it.
     *
     * @param mixed $value
     *
     * @return mixed List item (now removed)
     */
    public function pop<?php echo ucfirst($name); ?>($value)
    {
        return $this->pop('<?php echo $name; ?>', $value);
    }

    /**
     * Removes a property from the beginning of a list and returns it.
     *
     * @param mixed $value
     *
     * @return mixed List item (now removed)
     */
    public function shift<?php echo ucfirst($name); ?>($value)
    {
        return $this->shift('<?php echo $name; ?>', $value);
    }

    /**
     * Extracts a slice of the list.
     *
     * @param int      $offset
     * @param int|null $length
     *
     * @return array
     */
    public function slice<?php echo ucfirst($name); ?>($offset, $length = null)
    {
        return $this->slice('<?php echo $name; ?>', $offset, $length);
    }

    /**
     * Merges the list with another array.
     *
     * @param array $arr    Array to merge with
     * @param bool  $source True if existing list is the source vs. target
     * @return  array
     */
    public function merge<?php echo ucfirst($name); ?>($arr, $source = true)
    {
        return $this->merge('<?php echo $name; ?>', $arr, $source);
    }

    /**
     * Removes a single item from the list by value if it exists.
     *
     * @param mixed $value Value to remove
     *
     * @return array
     */
    public function remove<?php echo ucfirst($name); ?>($value)
    {
        return $this->remove('<?php echo $name; ?>', $value);
    }

    /**
     * Adds an item to the list if it doesn't already exist.
     *
     * @param mixed $value   Value to add
     * @param bool  $prepend True for prepend, false for append
     * @return self
     */
    public function add<?php echo ucfirst($name); ?>($value, $prepend = true)
    {
        return $this->add('<?php echo $name; ?>', $value, $prepend);
    }
<?php endif; ?>

    /**
     * Accessor getter for the <?php echo $name; ?> property
     *
     * @return mixed See: <?php echo get_class($property->getType()); ?>::getValue()
     */
    public function get<?php echo ucfirst($name); ?>()
    {
        return $this->get('<?php echo $name; ?>');
    }

    /**
     * Accessor setter for the <?php echo $name; ?> property
     *
     * @param mixed $value See: <?php echo get_class($property->getType()); ?>::parse()
     *
     * @return self
     */
    public function set<?php echo ucfirst($name); ?>($value)
    {
        return $this->set('<?php echo $name; ?>', $value);
    }

    /**
     * Accessor existence checker for the <?php echo $name; ?> property
     *
     * @return boolean
     */
    public function has<?php echo ucfirst($name); ?>()
    {
        $property = $this->property('<?php echo $name; ?>');
        return !($property->isUnset() || $property->isEmpty());
    }
<?php endforeach; ?>

