<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get dashboard data
     */
    public function dashboard(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'status' => true,
                'data' => [
                    'user' => $user,
                    'balance' => $user->balance ?? 0,
                    'tasks_completed' => 0,
                    'earnings' => 0,
                    'statistics' => [
                        'total_tasks' => 0,
                        'total_adverts' => 0,
                        'total_sales' => 0,
                    ],
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get user data
     */
    public function user(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'user' => $request->user(),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
