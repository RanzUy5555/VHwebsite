@extends('layouts.print.app')

@section('content')
    <div class="container-fluid mt-5">
        <a href="{{ route('admin.sales_report.index') }}">
            <img class="img-fluid d-block mx-auto" src="{{ asset('img/logo/logo.png') }}" width="200" alt="logo">
        </a>
        <br>
        <h3 class="text-center">Weekly Sales</h3> <br>
        <form class="d-print-none" action="{{ route('admin.print.handle') }}" method="GET">
            <div class="input-group">
                <input type="hidden" name="records" value="weekly_sales">
                <input type="hidden" name="execute" value="1">
                <input type="date" class="form-control" max="{{ now()->format('Y-m-d') }}" name="weekly">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-warning text-white">Print Record</button>
                </div>
            </div>
        </form>
        <br>
        <table class="table table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Weekly</th>
                    <th>Total Sales (₱)</th>
                </tr>
            </thead>
            <tbody>
                @forelse (array_combine($weekly_sales[0], $weekly_sales[1]) as $weekly => $total_sale)
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

        <br><br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            const url = new URL(location.href);
            const execute = url.searchParams.get('execute');

            execute == true ? print() : false
        });
        onafterprint = function() {
            window.location.href = @json(route('admin.sales_report.index'));
        }
    </script>
@endsection
