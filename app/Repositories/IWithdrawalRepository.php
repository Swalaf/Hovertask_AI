<?php
namespace App\Repositories;
use App\Models\Withdrawal;
use App\Repository\IWithdrawalRepository;

interface IWithdrawalRepository
{
    public function create(array $data): Withdrawal;
}