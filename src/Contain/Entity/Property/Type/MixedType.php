<?php
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

namespace Contain\Entity\Property\Type;

use Contain\Entity\Exception;
use Traversable;

/**
 * Mixed/native Data Type
 *
 * @category    akandels
 * @package     contain
 * @copyright   Copyright (c) 2012 Andrew P. Kandels (http://andrewkandels.com)
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 */
class MixedType extends StringType
{
    /**
     * Parse a given input into a suitable value for the current data type.
     *
     * @param   mixed               Value to be set
     * @return  mixed
     * @throws  Contain\Exception\InvalidArgumentException
     */
    public function parse($value = null)
    {
        if ($value instanceof Traversable) {
            $value = iterator_to_array($value);
        }

        if (is_object($value)) {
            throw new Exception\InvalidArgumentException('$value cannot be an object for type mixed');
        }

        return $value;
    }

    /**
     * Returns the internal value represented as an integer value
     * for purposes of debugging or export.
     *
     * @param   mixed       Internal value
     * @return  string
     * @throws  Contain\Exception\InvalidArgumentException
     */
    public function export($value)
    {
        return $this->parse($value);
    }

    /**
     * The value to compare the internal value to which translates to empty or null.
     *
     * @return  mixed
     */
    public function getEmptyValue()
    {
        return false;
    }
}
