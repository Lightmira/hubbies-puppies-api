<?php
declare(strict_types=1);

namespace App\Services\Serializer;


use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

class Serializer
{
    private $serializer;
    
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }
    
    /**
     * @param       $object // Can be one or many object depending of which method is calling
     * @param array $groups
     *
     * @return string
     */
    public function serialize($object, array $groups): string
    {
        $context = new SerializationContext();
        $context
            ->setSerializeNull(true)
            ->setGroups($groups);
    
        $json = $this->serializer->serialize(
            $object,
            'json',
            $context
        );
        
        return $json;
    }
}