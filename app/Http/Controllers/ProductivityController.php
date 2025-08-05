<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productivity;
use Illuminate\Support\Facades\DB;

class ProductivityController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = Productivity::orderBy('manufacture_date', 'DESC')->paginate(10);
        $styles = Productivity::distinct()->pluck('style');
        $pos = Productivity::distinct()->pluck('po');
        return view('productivity.index', compact('products', 'styles', 'pos'));
    }



    public function create(Request $request)
    {
        return view('productivity.create');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            "style" => "required",
            "po" => "required",
            "manufacture_date" => "required|date|before_or_equal:today",
            "employee_quantity" => "required|numeric|min:0",
            "product_output" => "required|integer|min:0",
        ],
        [
            'style.required' => 'Style không được trống!',
            'po.required' => 'Mã PO không được để trống!',
            'manufacture_date.required' => 'Ngày SX không được trống!',
            'manufacture_date.before_or_equal' => 'Ngày SX không vượt quá ngày hiện tại!',
            'employee_quantity.required' => 'Số lao động không được trống!',
            'product_output.required' => 'Sản lượng không được trống!',
            'employee_quantity.min' => 'Số lao động phải ≥ 0',
            'product_output.min' => 'Sản lượng phải ≥ 0',
        ]);
 
        Productivity::create([
            "style" => $request->style,
            "po" => $request->po,
            "manufacture_date" => $request->manufacture_date,
            "employee_quantity" => $request->employee_quantity,
            "product_output" => $request->product_output

        ]);
 
        return redirect()->route('productivity.index')
            ->with('success', 'Thêm sản lượng thành công.');
    }

      public function edit(Productivity $product)
    {
        return view('productivity.edit', compact('product'));
    }
 
    public function update(Request $request, Productivity $product)
    {
        $request->validate([
            "style" => "required",
            "po" => "required",
            "manufacture_date" => "required|date|before_or_equal:today",
            "employee_quantity" => "required|numeric|min:0",
            "product_output" => "required|integer|min:0",
        ],
        [
            'style.required' => 'Style không được trống!',
            'po.required' => 'Mã PO không được để trống!',
            'manufacture_date.required' => 'Ngày SX không được trống!',
            'manufacture_date.before_or_equal' => 'Ngày SX không vượt quá ngày hiện tại!',
            'employee_quantity.required' => 'Số lao động không được trống!',
            'product_output.required' => 'Sản lượng không được trống!',
            'employee_quantity.min' => 'Số lao động phải ≥ 0',
            'product_output.min' => 'Sản lượng phải ≥ 0',
        ]);
 
        $product->update([
            "style" => $request->style,
            "po" => $request->po,
            "manufacture_date" => $request->manufacture_date,
            "employee_quantity" => $request->employee_quantity,
            "product_output" => $request->product_output
        ]);
 
        return redirect()->route('productivity.index')
            ->with('success', 'Cập nhật sản lượng thành công.');
    }
 
    public function destroy(Request $request, Productivity $product)
    {
        $product->delete();
        return redirect()->route('productivity.index')
            ->with('success', 'Xóa thành công.');
    }

    public function search(Request $request)
    {
        $query = Productivity::query();
        
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
        
        $products = $query->orderBy('manufacture_date', 'DESC')
                        ->paginate(10)
                        ->appends($request->query());

        $styles = Productivity::distinct()->pluck('style');
        $pos = Productivity::distinct()->pluck('po');
        
        return view('productivity.index', compact('products', 'styles', 'pos'));
    }
 
}
