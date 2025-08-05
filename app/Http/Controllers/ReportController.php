<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productivity;

class ReportController extends Controller
{
   public function index(Request $request)
    {
        $styles = Productivity::distinct()->pluck('style');
        $pos = Productivity::distinct()->pluck('po');

        $query = Productivity::selectRaw('style, po, manufacture_date, SUM(product_output) as total')
            ->groupBy('style', 'po', 'manufacture_date');

        $hasSearchConditions = $request->filled('style') || 
                               $request->filled('po') || 
                               $request->filled('fromDate') || 
                               $request->filled('toDate');

        if (!$hasSearchConditions) {
            $tenDaysAgo = now()->subDays(9)->format('Y-m-d');
            $today = now()->format('Y-m-d');
                    
            $query->whereBetween('manufacture_date', [$tenDaysAgo, $today]);
        }else {
            if ($request->filled('style')) {
                $query->where('style', $request->input('style'));
            }

            if ($request->filled('po')) {
                $query->where('po', $request->input('po'));
            }

            if ($request->filled('fromDate') && $request->filled('toDate')) {
                $query->whereBetween('manufacture_date', [
                    $request->input('fromDate'),
                    $request->input('toDate')
                ]);
            }
            elseif ($request->filled('fromDate')) {
                $query->where('manufacture_date', '>=', $request->input('fromDate'));
            }
            elseif ($request->filled('toDate')) {
                $query->where('manufacture_date', '<=', $request->input('toDate'));
            }

        }                      
       
        $data = $query->orderBy('manufacture_date', 'DESC')->get();
        return view('report.index', compact( 'styles', 'pos', 'data'));
    }
}
