<?php
namespace AstroStudio\Core;

use AstroStudio\Core\Validator\ValidatorInterface;
use InvalidArgumentException;

class Option
{
    /**
     * @param mixed[]                 $options
     * @param string                  $key
     * @param bool                    $required
     * @param mixed|null              $value
     * @param ValidatorInterface|null $validator
     *
     * @return mixed
     */
    static public function get(array $options, string $key, bool $required = false, mixed $value = null, ?ValidatorInterface $validator = null): mixed
    {
        if(!array_key_exists($key, $options)){
            if($required){
                throw new InvalidArgumentException('Option required');
            }

            return $value;
        }

        if($validator){
            if(!empty($validator->validate($options[$key]))){
                throw new InvalidArgumentException('Option invalid');
            }
        }

        return $options[$key];
    }
}