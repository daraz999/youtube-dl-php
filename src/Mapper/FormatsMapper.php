<?php

namespace YoutubeDl\Mapper;

use YoutubeDl\Entity\Format;

class FormatsMapper implements MapperInterface
{
    public function map($data)
    {
        $formats = [];

        foreach ($data as $format) {
            if (in_array($field, array('protocol', 'segment_urls', 'initialization_url'))) {
                continue;
            }
            
            $entity = new Format();
            $reflection = new \ReflectionObject($entity);

            foreach ($format as $field => $value) {
                $prop = $reflection->getProperty(lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field)))));
                $prop->setAccessible(true);
                $prop->setValue($entity, $value);
            }

            $formats[] = $entity;
        }

        return $formats;
    }
}
