<?php
namespace App\Repositories;

use App\Models\Withdrawal;
use App\Repository\IWithdrawalRepository;

class WithdrawalRepository implements IWithdrawalRepository
{
    public function create(array $data): Withdrawal
    {
        return Withdrawal::create($data);
    }

}