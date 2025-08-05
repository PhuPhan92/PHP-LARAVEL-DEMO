@extends("layouts.app")
 
@section("content")
<div class="card ">
    <div class="card-header">
        <h4>Thống kê</h4>
    </div>
    <div class="card-body">
 
        @session("success")
        <div class="alert alert-success">{{ $value }}</div>
        @endsession
 
        <form method="GET" action="/report">
            <div class="input-group" style="margin-right:5px; margin-bottom:20px " >
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

        <canvas id="myChart" height="100"></canvas>

        @if($data->isEmpty())
            <div class="alert alert-warning mt-3">Không có dữ liệu phù hợp</div>
        @else
            <canvas id="myChart" height="100" ></canvas>
            <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const chartData = @json($data);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.map(item => `${item.style} (${item.po}) - ${new Date(item.manufacture_date).toLocaleDateString()}`),
            datasets: [{
                label: 'Sản lượng',
                data: chartData.map(item => item.total),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Sản lượng'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Style - PO - Ngày sản xuất'
                    }
                }
            }
        }
    });
</script>
@endif
    </div>
</div>

<script>

function resetSearchForm () {
    document.getElementById('style').value = '';
    document.getElementById('po').value = '';
    document.getElementById('fromDate').value = '';
    document.getElementById('toDate').value = '';
}
</script>


@endsection