<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller {
    public function index(Request $request) {
        $query = Applicant::where('company', Auth::user()->company);

        if ($request->has('county')) {
            $query->where('county', $request->county);
        }

        if ($request->has('require_dbs_check')) {
            $query->where('require_dbs_check', $request->require_dbs_check);
        }

        if ($request->has('applied_for')) {
            $query->where('applied_for', $request->applied_for);
        }

        return response()->json($query->get());
    }

    public function show($id) {
        $applicant = Applicant::where('company', Auth::user()->company)->findOrFail($id);
        return response()->json($applicant);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:applicants',
            'phone' => 'required|string',
            'company' => 'required|string',
            'address1' => 'required|string',
            'county' => 'required|string',
            'country' => 'required|string',
            'post_code' => 'required|string',
            'require_dbs_check' => 'required|boolean',
            'applied_for' => 'required|string',
            'cv' => 'required|string',
        ]);

        $validated['company'] = Auth::user()->company;

        $applicant = Applicant::create($validated);
        return response()->json($applicant, 201);
    }

    public function update(Request $request, $id) {
        $applicant = Applicant::where('company', Auth::user()->company)->findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:applicants,email,' . $id,
            'phone' => 'sometimes|required|string',
            'address1' => 'sometimes|required|string',
            'county' => 'sometimes|required|string',
            'country' => 'sometimes|required|string',
            'post_code' => 'sometimes|required|string',
            'require_dbs_check' => 'sometimes|required|boolean',
            'applied_for' => 'sometimes|required|string',
            'cv' => 'sometimes|required|string',
        ]);

        $applicant->update($validated);
        return response()->json($applicant);
    }

    public function destroy($id) {
        $applicant = Applicant::where('company', Auth::user()->company)->findOrFail($id);
        $applicant->delete();
        return response()->json(null, 204);
    }

    public function downloadCV($id) {
        $applicant = Applicant::where('company', Auth::user()->company)->findOrFail($id);
        $cvContent = $applicant->cv;
        return response($cvContent, 200)
            ->header('Content-Type', 'application/rtf')
            ->header('Content-Disposition', 'attachment; filename="cv.rtf"');
    }
}