<?php echo '<?php'; ?>

/**
 * Contain Project
 *
 * This source file is subject to the BSD license bundled with
 * this package in the LICENSE.txt file. It is also available
 * on the world-wide-web at http://www.opensource.org/licenses/bsd-license.php.
 * If you are unable to receive a copy of the license or have 
 * questions concerning the terms, please send an email to
 * me@andrewkandels.com.
 *
 * @category    akandels
 * @package     contain
 * @author      Andrew Kandels (me@andrewkandels.com)
 * @copyright   Copyright (c) 2012 Andrew P. Kandels (http://andrewkandels.com)
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link        http://andrewkandels.com/contain
 */

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
    /**
     * Initializes the properties of this entity.
     *
     * @return  $this
     */
    public function init()
    {
<?php foreach ($this->properties as $name => $property): ?>
        $this->properties['<?php echo $name; ?>'] = new Property('\<?php echo get_class($property->getType()); ?>');
<?php if ($options = $property->getType()->getOptions()): ?>
        $this->properties['<?php echo $name; ?>']->setOptions(<?php var_export($options); ?>);
<?php endif; ?>
<?php endforeach; ?>
    }

