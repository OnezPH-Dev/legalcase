<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Legal;
class SampleController extends Controller
{
    public function index()
    {
        $cases = App\Models\Legal::all();
        return view('test', compact('cases'));
    }

    public function destroy(Legal $case)
    {
        $case->delete();
        return back()->with('success', 'Test successfully deleted');
    }
}
