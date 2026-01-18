<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Store a new team member
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'title' => 'required|string|max:255',
            'email' => 'required|email|unique:team_members',
            'social_media' => 'nullable|array',
            'social_media.*' => 'url',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $teamMember = TeamMember::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $teamMember->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.team-members.index')->with('success', 'Team member created successfully');
    }

    /**
     * Update a team member
     */
    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $request->validate([
            'fullname' => 'sometimes|string|max:255',
            'phone' => 'nullable|string|max:20',
            'title' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:team_members,email,'.$teamMember->id,
            'social_media' => 'nullable|array',
            'social_media.*' => 'url',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer',
        ]);

        $teamMember->update($validated);

        // Handle image management
        // Remove specific images if requested
        if ($request->has('remove_images')) {
            $removeImageIds = $request->get('remove_images', []);

            foreach ($removeImageIds as $mediaId) {
                $media = $teamMember->getMedia('images')->find($mediaId);
                if ($media) {
                    $media->delete();
                }
            }
        }

        // Add new images (always keep existing images unless explicitly removed)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $teamMember->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated successfully');
    }

    /**
     * Delete a team member
     */
    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return response()->json([
            'success' => true,
            'message' => 'Team member deleted successfully',
        ]);
    }
}
