<?php

namespace App\Domains\ETA\APIs;

use App\Domains\ETA\DTO;
use Closure;

class Receipt extends API
{
    /**
     * Submits the given receipt.
     *
     * @param  DTO\Receipt  $receipt
     * @param  Closure  $callback
     * @return void
     *
     * @throws \App\Domains\ETA\Exceptions\BadRequestException
     * @throws \JsonException
     */
    public function submit(DTO\Receipt $receipt, Closure $callback): void
    {
        $auth = app(Auth::class)->login();

        $response = $this->asJson()
            ->withToken($auth->access_token, $auth->token_type)
            ->post('/receiptsubmissions', [
                'receipts' => [$receipt],
                'signatures' => $receipt->getSignatures(),
            ]);

        $callback($response);
    }
}
