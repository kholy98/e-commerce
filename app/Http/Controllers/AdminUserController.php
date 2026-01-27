<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->withCount('orders');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('admin/users/index', [
            'users' => $users,
            'filters' => $request->only(['search']),
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('admin/users/show', [
            'user' => $user->load(['orders.items.product.media', 'addresses']),
        ]);
    }
}
