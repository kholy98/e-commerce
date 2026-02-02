<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Team Members
 *
 * APIs for managing and retrieving team member information.
 *
 * These endpoints provide access to team member data including contact details,
 * professional titles, social media links, and profile images.
 */
class TeamMemberApiController extends Controller
{
    /**
     * List all team members
     *
     * Get a paginated list of all team members with optional filtering and sorting.
     * Returns team member details including contact information, images, and social media links.
     *
     * @unauthenticated
     *
     * @queryParam search string Search by full name or email address. Example: john
     * @queryParam sort_by string Sort field - allowed values: `fullname`, `email`, `created_at`. Example: fullname
     * @queryParam sort_direction string Sort direction - allowed values: `asc`, `desc`. Default: `asc`. Example: asc
     * @queryParam per_page integer Number of items per page. Default: 15. Example: 10
     *
     *
     * @response 200 scenario="Success with results" {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "fullname": "John Doe",
     *       "phone": "+1 (555) 123-4567",
     *       "title": "Senior Software Engineer",
     *       "email": "john.doe@example.com",
     *       "social_media": [
     *         "https://twitter.com/johndoe",
     *         "https://linkedin.com/in/john-doe-profile",
     *         "https://github.com/johndoe"
     *       ],
     *       "images": [
     *         {
     *           "id": 1,
     *           "name": "john-profile",
     *           "url": "https://example.com/storage/media/1/john-profile.jpg",
     *           "thumb_url": "https://example.com/storage/media/1/conversions/john-profile-thumb.jpg"
     *         }
     *       ],
     *       "created_at": "2024-01-15T10:30:00.000000Z",
     *       "updated_at": "2024-01-15T14:45:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "fullname": "Jane Smith",
     *       "phone": "+1 (555) 987-6543",
     *       "title": "Product Manager",
     *       "email": "jane.smith@example.com",
     *       "social_media": [
     *         "https://twitter.com/janesmith",
     *         "https://linkedin.com/in/janesmith-pm",
     *         "https://github.com/janesmith"
     *       ],
     *       "images": [],
     *       "created_at": "2024-01-10T08:00:00.000000Z",
     *       "updated_at": "2024-01-12T16:20:00.000000Z"
     *     }
     *   ],
     *   "pagination": {
     *     "current_page": 1,
     *     "last_page": 3,
     *     "per_page": 15,
     *     "total": 42
     *   }
     * }
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
     *
     * Retrieve detailed information about a specific team member by their ID.
     * Returns complete team member data including all images and social media links.
     *
     * @unauthenticated
     *
     * @urlParam teamMember integer required The ID of the team member. Example: 1
     *
     * @responseField success boolean Indicates if the request was successful
     * @responseField data object Team member details
     * @responseField data.id integer Team member ID
     * @responseField data.fullname string Full name of the team member
     * @responseField data.phone string|null Phone number
     * @responseField data.title string|null Job title or position
     * @responseField data.email string Email address
     * @responseField data.social_media object|null Social media links
     * @responseField data.images array Array of profile images
     * @responseField data.images[].id integer Image ID
     * @responseField data.images[].name string Image file name
     * @responseField data.images[].url string Full-size image URL
     * @responseField data.images[].thumb_url string Thumbnail image URL
     * @responseField data.created_at string ISO 8601 datetime string
     * @responseField data.updated_at string ISO 8601 datetime string
     *
     * @response 200 scenario="Team member found" {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "fullname": "John Doe",
     *     "phone": "+1 (555) 123-4567",
     *     "title": "Senior Software Engineer",
     *     "email": "john.doe@example.com",
     *     "social_media": {
     *       "twitter": "@johndoe",
     *       "linkedin": "john-doe-profile",
     *       "github": "johndoe",
     *       "website": "https://johndoe.dev"
     *     },
     *     "images": [
     *       {
     *         "id": 1,
     *         "name": "john-profile-main",
     *         "url": "https://example.com/storage/media/1/john-profile-main.jpg",
     *         "thumb_url": "https://example.com/storage/media/1/conversions/john-profile-main-thumb.jpg"
     *       },
     *       {
     *         "id": 2,
     *         "name": "john-profile-alt",
     *         "url": "https://example.com/storage/media/2/john-profile-alt.jpg",
     *         "thumb_url": "https://example.com/storage/media/2/conversions/john-profile-alt-thumb.jpg"
     *       }
     *     ],
     *     "created_at": "2024-01-15T10:30:00.000000Z",
     *     "updated_at": "2024-01-15T14:45:00.000000Z"
     *   }
     * }
     *
     * @response 404 scenario="Team member not found" {
     *   "message": "No query results for model [App\\Models\\TeamMember] 999"
     * }
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
