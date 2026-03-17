<?php
namespace App\Repositories;

use App\Models\Wallet;
use App\Models\Task;

interface IDashboardRepository
{
    public function getDashboardData();

    public function getUserData();
}