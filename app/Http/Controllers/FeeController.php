<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $fees = Fee::where('student_id', 'like', "%$search%")
            ->latest()
            ->paginate(10);

        return view('fees.index', compact('fees', 'search'));
    }

    public function create()
    {
        return view('fees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'fee_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0|lte:fee_amount',
            'due_date' => 'nullable|date',
        ]);

        $pendingAmount = $request->fee_amount - $request->paid_amount;

        if ($pendingAmount == 0) {
            $status = 'paid';
        } elseif ($request->paid_amount > 0) {
            $status = 'partial';
        } else {
            $status = 'pending';
        }

        Fee::create([
            'student_id' => $request->student_id,
            'fee_amount' => $request->fee_amount,
            'paid_amount' => $request->paid_amount,
            'pending_amount' => $pendingAmount,
            'due_date' => $request->due_date,
            'status' => $status,
        ]);

        return redirect('/fees')->with('success', 'Fee added successfully!');
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);

        return view('fees.edit', compact('fee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'fee_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0|lte:fee_amount',
            'due_date' => 'nullable|date',
        ]);

        $fee = Fee::findOrFail($id);

        $pendingAmount = $request->fee_amount - $request->paid_amount;

        if ($pendingAmount == 0) {
            $status = 'paid';
        } elseif ($request->paid_amount > 0) {
            $status = 'partial';
        } else {
            $status = 'pending';
        }

        $fee->update([
            'student_id' => $request->student_id,
            'fee_amount' => $request->fee_amount,
            'paid_amount' => $request->paid_amount,
            'pending_amount' => $pendingAmount,
            'due_date' => $request->due_date,
            'status' => $status,
        ]);

        return redirect('/fees')->with('success', 'Fee updated successfully!');
    }

    public function history()
    {
        $fees = Fee::latest()->paginate(10);

        return view('fees.history', compact('fees'));
    }
}
