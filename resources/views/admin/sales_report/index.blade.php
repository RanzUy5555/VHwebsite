@extends('layouts.admin.app')

@section('title', 'Admin | Sales Report')

@section('content')
    <!-- Page Content -->
    <div class="container-fluid mt-3">

        <ul class="nav nav-pills nav-fill flex-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 @if (!request()->query('tab') || request()->query('tab') == 'graphs') active @endif" id="tabs-icons-text-0-tab"
                    data-toggle="tab" href="#tabs-icons-text-0" role="tab" aria-controls="tabs-icons-text-0"
                    aria-selected="true"><i class="fas fa-project-diagram mr-2"></i>Graphs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 @if (request()->query('tab') == 'tables') active @endif"
                    id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                    aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-table mr-2"></i>Tables</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            {{-- Tab 0 --}}
            <div class="tab-pane fade @if (!request()->query('tab') || request()->query('tab') == 'graphs') show active @endif" id="tabs-icons-text-0"
                role="tabpanel" aria-labelledby="tabs-icons-text-0-tab">
                <br>
                {{-- Start Daily Sales Report --}}
                <form class action="{{ route('admin.sales_report.index') }}" method="get">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <select class="form-control form-control-sm" name="category">
                                <option value="">-- All Category --</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" @if (filled(request('category')) && request('category') == $category->id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="date" class="form-control form-control-sm" max="{{ now()->format('Y-m-d') }}"
                            name="daily">
                        <input type="hidden" name="tab" value="graphs">
                        <button class="btn btn-sm btn-warning">Filter</button>


                    </div>
                </form>
                <br>
                {{-- Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Daily Sales
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_daily_sales", "Total Daily Sales")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_daily_sales"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Row --}}
                {{-- End Daily Sales Report --}}
                <br>

                {{-- Start Weekly Sales Report --}}
                <form class action="{{ route('admin.sales_report.index') }}" method="get">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <select class="form-control form-control-sm" name="category">
                                <option value="">-- All Category --</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" @if (filled(request('category')) && request('category') == $category->id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" class="form-control form-control-sm" max="{{ now()->format('Y-m-d') }}"
                            name="start_date" onclick="this.type='date'" placeholder="Start Date">
                        <input type="text" class="form-control form-control-sm" max="{{ now()->format('Y-m-d') }}"
                            name="end_date" onclick="this.type='date'" placeholder="End Date">
                        <input type="hidden" name="tab" value="graphs">
                        <button class="btn btn-sm btn-warning">Filter</button>


                    </div>
                </form>
                <br>
                {{-- Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Weekly Sales

                                            @if (request('start_date') && request('end_date'))
                                                (From - {{ formatDate(request('start_date')) }}
                                                To - {{ formatDate(request('end_date')) }})
                                            @else
                                                {{ now() }})
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_weekly_sales", "Total Weekly Sales")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_weekly_sales"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Row --}}
                {{-- End Weekly Sales Report --}}
                <br>

                <form class action="{{ route('admin.sales_report.index') }}" method="get">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <select class="form-control form-control-sm" name="category">
                                <option value="">-- All Category --</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" @if (filled(request('category')) && request('category') == $category->id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <select class="form-control form-control-sm" name="month">
                            <option value="">-- Select Month --</option>
                            @foreach (getOrderMonths() as $month)
                                <option value="{{ $month['month_no'] }}"
                                    @if (filled(request('month')) && request('month')) selected @endif>
                                    {{ $month['month'] }}
                                </option>
                            @endforeach
                        </select>

                        <div class="input-group-append">
                            <select class="form-control form-control-sm" name="year">
                                <option value="">-- Select Year --</option>
                                @foreach (getOrderYears() as $year)
                                    <option value="{{ $year['year'] }}" @if (filled(request('month')) && request('month')) selected @endif>
                                        {{ $year['year'] }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="tab" value="graphs">
                            <button class="btn btn-sm btn-warning">Filter</button>

                        </div>
                    </div>
                </form>
                <br>
                {{-- Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Monthly Sales
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_monthly_sales", "Total Monthly Sales")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_monthly_sales"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Row --}}

                {{-- Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">

                                            Total Yearly Sales

                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_yearly_sales", "Total Yearly Sales")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_yearly_sales"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Row --}}

                {{-- Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Products By Category
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_product_by_category", "Total Product By Category")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_product_by_category"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Row --}}

                {{-- Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Top Selling Product
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_top_selling_product", "Top Selling Product")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_top_selling_product"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Row --}}

            </div>
            {{-- End Tab 0 --}}


            {{-- Tab 1 --}}
            <div class="tab-pane fade @if (request()->query('tab') == 'tables') show active @endif" id="tabs-icons-text-1"
                role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <br>

                {{-- Start Daily Sales --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL DAILY SALES (₱)

                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="{{ route('admin.print.handle') }}?records=daily_sales"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>Total Sales </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse (array_combine($chart_total_daily_sales[0], $chart_total_daily_sales[1]) as $daily => $total_sale)
                                                        <tr>
                                                            <td>{{ $daily }}</td>
                                                            <td>{{ $total_sale }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- End Daily Sales --}}

                {{-- Start Weekly Sales --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL WEEKLY SALES (₱)
                                            @if (request('start_date') && request('end_date'))
                                                (From - {{ formatDate(request('start_date')) }}
                                                To - {{ formatDate(request('end_date')) }})
                                            @else
                                                {{ now() }})
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="{{ route('admin.print.handle') }}?records=weekly_sales"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Weekly</th>
                                                        <th>Total Sales </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse (array_combine($chart_total_weekly_sales[0], $chart_total_weekly_sales[1]) as $weekly => $total_sale)
                                                        <tr>
                                                            <td>{{ $weekly }}</td>
                                                            <td>{{ $total_sale }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- End Weekly Sales --}}

                <form class action="{{ route('admin.sales_report.index') }}" method="get">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <select class="form-control form-control-sm" name="category">
                                <option value="">-- All Category --</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}"
                                        @if (filled(request('category')) && request('category') == $category->id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <select class="form-control form-control-sm" name="month">
                            <option value="">-- Select Month --</option>
                            @foreach (getOrderMonths() as $month)
                                <option value="{{ $month['month_no'] }}"
                                    @if (filled(request('month')) && request('month')) selected @endif>
                                    {{ $month['month'] }}
                                </option>
                            @endforeach
                        </select>

                        <div class="input-group-append">
                            <select class="form-control form-control-sm" name="year">
                                <option value="">-- Select Year --</option>
                                @foreach (getOrderYears() as $year)
                                    <option value="{{ $year['year'] }}"
                                        @if (filled(request('month')) && request('month')) selected @endif>
                                        {{ $year['year'] }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="tab" value="graphs">
                            <button class="btn btn-sm btn-warning">Filter</button>

                        </div>
                    </div>
                </form>
                <br>
                {{-- Start Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL MONTHLY SALES (₱)


                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="{{ route('admin.print.handle') }}?records=monthly_sales"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Month</th>
                                                        <th>Total Sales </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse (array_combine($chart_total_monthly_sales[0], $chart_total_monthly_sales[1]) as $month => $total_sale)
                                                        <tr>
                                                            <td>{{ $month }}</td>
                                                            <td>{{ $total_sale }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- End Row --}}

                {{-- Start Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL YEARLY SALES (₱)
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="{{ route('admin.print.handle') }}?records=yearly_sales"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Year</th>
                                                        <th>Total Sales </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse (array_combine($chart_total_yearly_sales[0], $chart_total_yearly_sales[1]) as $year => $total_sale)
                                                        <tr>
                                                            <td>{{ $year }}</td>
                                                            <td>{{ $total_sale }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- End Row --}}

                {{-- Start Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL PRODUCTS BY CATEGORY
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="{{ route('admin.print.handle') }}?records=product_by_category"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Total Products </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse (array_combine($chart_total_product_by_category[0], $chart_total_product_by_category[1]) as $category => $total_product)
                                                        <tr>
                                                            <td>{{ $category }}</td>
                                                            <td>{{ $total_product }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- End Row --}}

                {{-- Start Row --}}
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL SELLING PRODUCT
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="{{ route('admin.print.handle') }}?records=top_selling_product"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Total Successful Order Attempt </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse (array_combine($chart_top_selling_product[0], $chart_top_selling_product[1]) as $product => $total_order)
                                                        <tr>
                                                            <td>{{ $product }}</td>
                                                            <td>{{ $total_order }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- End Row --}}


            </div>
            {{-- End Tab 1 --}}
        </div>
    </div>
    <!-- End Page Content -->
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            Chart.register(ChartDataLabels); // enable chart js plugins

            const bgc = [
                '#B77729',
                '#AF8F00',
                '#1E1E1E',
                '#2D56B3',
                '#95a5a6',
                '#2c3e50',
                '#FFA0B4',
                '#ecf0f1',
                '#F7630C',
                '#32325d',
            ];


            const categories = @json($chart_total_product_by_category[0]);
            const total_products = @json($chart_total_product_by_category[1]);

            const chart_total_product_by_category = document.getElementById('chart_total_product_by_category');
            const CHART_A = new Chart(chart_total_product_by_category, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: categories,
                    datasets: [{
                        label: 'Total Products',
                        data: total_products,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    // title: {
                    //     display: true,
                    //     text: 'Total Products'
                    // },
                    // barThickness: 'flex',

                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });


            const CHART_DAILY_SALES_days = @json($chart_total_daily_sales[0]);
            const CHART_DAILY_SALES_days_total_daily_sales = @json($chart_total_daily_sales[1]);

            const chart_total_daily_sales = document.getElementById('chart_total_daily_sales');
            const CHART_DAILY_SALES = new Chart(chart_total_daily_sales, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_DAILY_SALES_days,
                    datasets: [{
                        label: 'Total Daily Sales (₱)',
                        data: CHART_DAILY_SALES_days_total_daily_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Daily Sales (₱)'
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });


            const CHART_WEEKLY = @json($chart_total_weekly_sales[0]);
            const CHART_WEEKLY_total_sales = @json($chart_total_weekly_sales[1]);

            const chart_total_weekly_sales = document.getElementById('chart_total_weekly_sales');
            const CHART_WEEKLY_SALES = new Chart(chart_total_weekly_sales, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_WEEKLY,
                    datasets: [{
                        label: `Total Weekly Sales`,
                        data: CHART_WEEKLY_total_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: `Total Weekly Sales`
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });



            const CHART_B_months = @json($chart_total_monthly_sales[0]);
            const CHART_B_total_monthly_sales = @json($chart_total_monthly_sales[1]);

            const chart_total_monthly_sales = document.getElementById('chart_total_monthly_sales');
            const CHART_B = new Chart(chart_total_monthly_sales, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_B_months,
                    datasets: [{
                        label: 'Total Monthly Sales (₱)',
                        data: CHART_B_total_monthly_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Monthly Sales (₱)'
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });

            const CHART_C_years = @json($chart_total_yearly_sales[0]);
            const CHART_C_total_yearly_sales = @json($chart_total_yearly_sales[1]);

            const chart_total_yearly_sales = document.getElementById('chart_total_yearly_sales');
            const CHART_C = new Chart(chart_total_yearly_sales, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_C_years,
                    datasets: [{
                        label: 'Total Yearly Sales (₱)',
                        data: CHART_C_total_yearly_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Yearly Sales (₱)'
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });


            const CHART_D_years = @json($chart_top_selling_product[0]);
            const CHART_D_total_yearly_sales = @json($chart_top_selling_product[1]);

            const chart_top_selling_product = document.getElementById('chart_top_selling_product');
            const CHART_D = new Chart(chart_top_selling_product, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_D_years,
                    datasets: [{
                        label: 'Total Successful Order Attempt',
                        data: CHART_D_total_yearly_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Order'
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });




        });
    </script>
@endsection
