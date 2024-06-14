<?php

namespace App\Http\Controllers\Backend;

use App\Models\LogVisitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LogVisitorController extends Controller
{
    public function index(Request $request)
    {
        $visitorToday = LogVisitor::whereDate('visited_at', today())->count();
        // return view('backend.log-visitors.index', compact('visitorToday'));
        return view('log_visitors_revisi.index', compact('visitorToday'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $logs = LogVisitor::with('user')->latest('visited_at');

            return DataTables::of($logs)
                ->addColumn('date_in', function ($log) {
                    return $log->visited_at->format('d F Y');
                })
                ->addColumn('time_in', function ($log) {
                    return $log->visited_at->format('H:i:s') . ' WIB';
                })
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_member' => 'required|exists:users,id_member',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'error', 'errors' => $validator->errors()]);
            }

            $user = User::where('id_member', $request->id_member)->first();

            LogVisitor::create([
                'user_id' => $user->id,
            ]);

            $visitorToday = LogVisitor::whereDate('visited_at', today())->count();

            return response()->json(['user' => $user->name, 'visitorToday' => $visitorToday]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }
}
