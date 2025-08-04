@extends("layouts.app")
 
@section("content")
<div class="card ">

    <div class="card-header">
        <h4>Danh mục sản lượng</h4>
    </div>
    <div class="card-body">
 
        @session("success")
        <div class="alert alert-success">{{ $value }}</div>
        @endsession
 
       
        <form method="GET" action="/productivities/search">
            <div class="input-group" style="margin-right:5px;">
                <div class="form-outline" data-mdb-input-init>
                    <label class="form-label"> <strong>Style: </strong></label>
                     <select class="form-select" name="style" id="style">
                        <option value="">-- Chọn Style --</option>
                        @foreach($styles as $style)
                            <option value="{{ $style }}" 
                                {{ request()->input('style') == $style ? 'selected' : '' }}>
                                {{ $style }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-outline ms-2" data-mdb-input-init>
                    <label class="form-label"><strong>PO:</strong></label>
                    <select class="form-select" name="po" id="po">
                         <option value="">-- Chọn PO --</option>
                        @foreach($pos as $po)
                            <option value="{{ $po }}" 
                                {{ request()->input('po') == $po ? 'selected' : '' }}>
                                {{ $po }}
                            </option>
                                @endforeach
                    </select>
                </div>
                <div class="form-outline ms-2" data-mdb-input-init >
                    <label class="form-label"> <strong>Từ ngày: </strong></label>
                    <input class="form-control" type="date" name="fromDate" id="fromDate" value="{{ request()->input('fromDate') ?? '' }}">
                </div>
                <div class="form-outline ms-2" data-mdb-input-init >
                    <label class="form-label"> <strong>Đến ngày: </strong></label>
                    <input class="form-control" type="date" name="toDate" id="toDate" value="{{ request()->input('toDate') ?? '' }}">
                </div>
                {{-- <button type="submit" class="btn btn-success">Search</button> --}}

                <div style="display: flex; align-items: flex-end; margin-right: 5px; margin-left: 5px;">
                    <button type="submit" class="btn btn-success" style="height: 38px;">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
                <div style="display: flex; align-items: flex-end;">
                    {{-- <a href="/productivities" class="btn btn-secondary" style="height: 38px;">
                        <i class="bi bi-arrow-clockwise"></i> Làm mới
                    </a> --}}
                    <button type="button" class="btn btn-secondary ms-2" style="height: 38px;" onclick="resetSearchForm()">
                        <i class="bi bi-arrow-clockwise"></i> Làm mới 
                    </button>
                </div>


            </div>
        </form>

        <a href="{{ route('productivity.create') }}" class="btn btn-success btn-sm mb-3 mt-3"> <i class="bi bi-plus-lg"></i>Thêm sản lượng</a>
 
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th width="50px">ID</th>
                    <th>STYLE</th>
                    <th>PO</th>
                    <th >Ngày sản xuất</th>
                    <th >Số lao động</th>
                    <th >Sản lượng</th>
                    <th width="120px">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->style }}</td>
                    <td>{{ $product->po }}</td>
                    <td class="text-center">{{ $product->manufacture_date->format('Y-m-d') }}</td>
                    <td class="text-end">{{ $product->employee_quantity }}</td>
                    <td class="text-end">{{ $product->product_output }}</td>
                    <td class="text-center">
                        <form action="{{ route('productivity.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('productivity.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i> </a>
 
                            {{-- <button class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i> </button> --}}

                            <button type="button" class="btn btn-danger btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal"
                                    data-delete-url="{{ route('productivity.destroy', $product->id) }}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                </tr>   
                @endforeach
            </tbody>
        </table>
        <div class="d-flex custom-pagination">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa bản ghi này?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <!-- Form xóa độc lập -->
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteModal');
    
    deleteModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Nút kích hoạt modal
        const deleteUrl = button.getAttribute('data-delete-url');
        
        // Cập nhật action form xóa
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = deleteUrl;
    });
});

function resetSearchForm () {
    document.getElementById('style').value = '';
    document.getElementById('po').value = '';
    document.getElementById('fromDate').value = '';
    document.getElementById('toDate').value = '';
}
</script>
@endsection