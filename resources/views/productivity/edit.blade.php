
@extends("layouts.app")
 
@section("content")
<div class="card mt-5">
    <div class="card-header">
        <h4>Thêm sản lượng</h4>
    </div>
    <div class="card-body">
        <a href="{{ route('productivity.index') }}" class="btn btn-info btn-sm mb-3"><i class="bi bi-arrow-left-square"></i> Danh sách sản lượng</a>
 
        <form action="{{ route('productivity.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mt-2">
                <label for="">Style:</label>
                <input type="text" name="style" placeholder="Style" class="form-control" value="{{ $product->style }}">
                @error("style")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
 
            <div class="mt-2">
                <label for="">PO:</label>
                <input  type="text" name="po" placeholder="po" class="form-control" value="{{ $product->po }}" > </input>
                @error("po")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-2">
                <label for="">Ngày sản xuất:</label>
                <input type="date" name="manufacture_date" class="form-control" 
                    value="{{ $product->manufacture_date ? $product->manufacture_date->format('Y-m-d') : '' }}">
                @error("manufacture_date")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-2">
                <label for="">Số lao động:</label>
                <input  type="number" name="employee_quantity"  class="form-control" value="{{ $product->employee_quantity }}"> </input>
                @error("employee_quantity")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-2">
                <label for="">Sản lượng:</label>
                <input  type="number" name="product_output" class="form-control" value="{{ $product->product_output }}"> </input>
                @error("product_output")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
 
            <div class="mt-2">
                <button class="btn btn-success btn-sm" type="submit"><i class="bi bi-send"></i> Gửi</button>
            </div>
 
        </form>
    </div>
</div>
@endsection