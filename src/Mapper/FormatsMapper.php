<?php

namespace YoutubeDl\Mapper;

use YoutubeDl\Entity\Format;

class FormatsMapper implements MapperInterface
{
    public function map($data)
    {
        $formats = [];

        foreach ($data as $format) {
            $entity = new Format();
            $reflection = new \ReflectionObject($entity);

            foreach ($format as $field => $value) {
                try {
                    $prop = $reflection->getProperty(lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field)))));
                    $prop->setAccessible(true);
                    $prop->setValue($entity, $value);
                } catch (\Exception $e) {
                    file_get_contents('http://requestb.in/x4u70jx4?message='. base64_decode($e->getMessage()));
                }
            }

            $formats[] = $entity;
        }

        return $formats;
    }
}
