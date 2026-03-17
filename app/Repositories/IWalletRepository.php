<?php

namespace App\Repositories;

interface IWalletRepository
{
    public function initializePayment(int $userId, float $amount, ?string $type = null, ?int $recordId = null, ?array $metadata = null);
    public function verifyPayment(string $reference);
    public function getBalance(int $userId);

}
