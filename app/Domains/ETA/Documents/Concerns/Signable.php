<?php

namespace App\Domains\ETA\Documents\Concerns;

trait Signable
{
    /**
     * Serialize the document instance.
     *
     * @return string
     */
    public function serialize(): string
    {
        return $this->toCanonicalString([
            'receipts' => [
                $this->toArray(),
            ],
        ]);
    }

    /**
     * Create a SHA256 hash from serialized instance.
     *
     * @param  bool  $binary
     * @return string
     */
    public function hashedSerialization(bool $binary = true): string
    {
        return hash('sha256', $this->serialize(), $binary);
    }

    /**
     * Get the document signatures.
     *
     * @return array
     */
    public function getSignatures(): array
    {
        return [[
            'type' => 'I',
            'value' => $this->hashedSerialization(false),
        ]];
    }

    /**
     * Create a canonical representation from the document instance.
     *
     * @param  mixed  $documentStructure
     * @return string
     */
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
