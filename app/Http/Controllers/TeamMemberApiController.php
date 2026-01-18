<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamMemberApiController extends Controller
{
    /**
     * Get all team members
     */
    public function index(Request $request): JsonResponse
    {
        $query = TeamMember::query();

        // Search by name or email
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('fullname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Sort
        if ($request->has('sort_by')) {
            $sort = $request->sort_by;
            $direction = $request->get('sort_direction', 'asc');
            if (in_array($sort, ['fullname', 'email', 'created_at'])) {
                $query->orderBy($sort, $direction);
            }
        } else {
            $query->orderBy('fullname');
        }

        $teamMembers = $query->paginate($request->get('per_page', 15));

        $data = $teamMembers->getCollection()->map(function ($teamMember) {
            return [
                'id' => $teamMember->id,
                'fullname' => $teamMember->fullname,
                'phone' => $teamMember->phone,
                'title' => $teamMember->title,
                'email' => $teamMember->email,
                'social_media' => $teamMember->social_media,
                'images' => $teamMember->getMedia('images')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'name' => $media->name,
                        'url' => $media->getUrl(),
                        'thumb_url' => $media->getUrl('thumb'),
                    ];
                }),
                'created_at' => $teamMember->created_at,
                'updated_at' => $teamMember->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'pagination' => [
                'current_page' => $teamMembers->currentPage(),
                'last_page' => $teamMembers->lastPage(),
                'per_page' => $teamMembers->perPage(),
                'total' => $teamMembers->total(),
            ],
        ]);
    }

    /**
     * Get a single team member
     */
    public function show(TeamMember $teamMember): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $teamMember->id,
                'fullname' => $teamMember->fullname,
                'phone' => $teamMember->phone,
                'title' => $teamMember->title,
                'email' => $teamMember->email,
                'social_media' => $teamMember->social_media,
                'images' => $teamMember->getMedia('images')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'name' => $media->name,
                        'url' => $media->getUrl(),
                        'thumb_url' => $media->getUrl('thumb'),
                    ];
                }),
                'created_at' => $teamMember->created_at,
                'updated_at' => $teamMember->updated_at,
            ],
        ]);
    }
}
