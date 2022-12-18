<?php

namespace App\Domains\ETA\Documents\Concerns;

trait InteractsWithSeller
{
    private string $branchCode = '0';

    /**
     * @return string
     */
    protected function getBranchCode(): string
    {
        return $this->branchCode;
    }

    /**
     * @return array
     */
    protected function getSeller(): array
    {
        return [
            'rin' => 562415149,
            'companyTradeName' => 'coup',
            'branchCode' => $this->getBranchCode(),
            'deviceSerialNumber' => '13NQ9Z1',
            'activityCode' => '4751',
            'branchAddress' => [
                'country' => 'EG',
                'governate' => 'cairo',
                'regionCity' => 'el nozha',
                'street' => 'josef tito',
                'buildingNumber' => '74',
                'postalCode' => '11223',
                'floor' => '4',
                'room' => '1',
                'landmark' => '1',
                'additionalInformation' => '1',
            ],
        ];
    }
}
