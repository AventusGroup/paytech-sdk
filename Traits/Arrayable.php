<?php

namespace PayTech\PayTechBundle\Traits;

trait Arrayable
{
    public function toArray(): array
    {
        $result = [];
        foreach (get_class_vars(self::class) as $key => $var) {
            if ($key == 'logger'){
                continue;
            }
            $result[$key] = $this->$key;
        }

        return $result;
    }
}