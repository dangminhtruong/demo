<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function apply(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|string|max:20',
            'github_profile' => 'required|string|url',
            'linkedin_profile' => 'required|string|url',
            'year_of_experience' => 'required|integer|min:0',
            'status' => 'required|string|in:' . implode(',', [
                Candidate::STATUS_INITIAL_REVIEW,
                Candidate::STATUS_FIRST_CONTACT,
                Candidate::STATUS_TECHNICAL_REVIEW,
                Candidate::STATUS_TECHNICAL_TEST,
                Candidate::STATUS_SPECIFIC_MAINTENANCE,
                Candidate::STATUS_REJECTED,
            ]),
        ]);

        $candidate = Candidate::create($validatedData);

        return response()->json([
            'message' => 'Candidate created successfully!',
            'candidate' => $candidate
        ], 201);
    }

    /**
     * Retrieve candidates grouped by their status.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCandidatesByStatus()
    {
        $statuses = [
            Candidate::STATUS_INITIAL_REVIEW,
            Candidate::STATUS_FIRST_CONTACT,
            Candidate::STATUS_TECHNICAL_REVIEW,
            Candidate::STATUS_TECHNICAL_TEST,
            Candidate::STATUS_SPECIFIC_MAINTENANCE,
            Candidate::STATUS_REJECTED,
        ];

        $candidatesByStatus = [];

        foreach ($statuses as $status) {
            $candidatesByStatus[$status] = Candidate::where('status', $status)->get();
        }

        return response()->json($candidatesByStatus);
    }

    public function updateStatus(Request $request)
    {
        $validatedData = $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'new_status' => 'required|string|in:' . implode(',', [
                Candidate::STATUS_INITIAL_REVIEW,
                Candidate::STATUS_FIRST_CONTACT,
                Candidate::STATUS_TECHNICAL_REVIEW,
                Candidate::STATUS_TECHNICAL_TEST,
                Candidate::STATUS_SPECIFIC_MAINTENANCE,
                Candidate::STATUS_REJECTED,
            ]),
        ]);

        $candidate = Candidate::findOrFail($validatedData['candidate_id']);
        $candidate->update(['status' => $validatedData['new_status']]);

        return response()->json([
            'message' => 'Candidate status updated successfully!',
            'candidate' => $candidate
        ]);
    }

    public function getCandidateDetails($id)
    {
        $candidate = Candidate::findOrFail($id);

        return response()->json([
            'candidate' => $candidate
        ]);
    }
}
