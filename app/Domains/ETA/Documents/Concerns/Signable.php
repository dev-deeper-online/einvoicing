<?php

namespace App\Domains\ETA\Documents\Concerns;

trait Signable
{
    public function serialize(): string
    {
        return $this->toCanonicalString($this->toArray());
    }

    public function hashedSerialization(bool $binary = true): string
    {
        return hash('sha256', $this->serialize(), $binary);
    }

    /**
     * @return array
     */
    public function getSignatures(): array
    {
        return [[
            'type' => 'I',
            'value' => $this->hashedSerialization(false),
        ]];
    }

    protected function toCanonicalString(mixed $documentStructure): string
    {
        if (! is_array($documentStructure)) {
            return '"'.$documentStructure.'"';
        }

        $serializedString = '';

        foreach ($documentStructure as $item => $value) {
            if (! is_array($value)) {
                $serializedString .= strtoupper('"'.$item.'"');
                $serializedString .= self::toCanonicalString($value);
            }

            if (is_array($value)) {
                $serializedString .= strtoupper('"'.$item.'"');
                foreach ($value as $subItem => $subValue) {
                    $serializedString .= is_int($subItem) ? strtoupper('"'.$item.'"') : strtoupper('"'.$subItem.'"');
                    $serializedString .= self::toCanonicalString($subValue);
                }
            }
        }

        return $serializedString;
    }
}
