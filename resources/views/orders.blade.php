@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Orders</div>  


                    <div class="card-body">  

                        <form method="GET" action="">
                            <div class="form-group">
                                <label for="financial_status">Financial Status:</label>
                                <select name="financial_status" class="form-control">
                                    <option value="">All</option>
                                    </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Total Price</th>
                                    <th>Financial Status</th>
                                    <th>Fulfillment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->customer->email }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>{{ $order->financial_status }}</td>
                                        <td>{{ $order->fulfillment_status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $orders->links() }}

                        <button type="button" class="btn btn-primary mt-3" id="import-data">Import Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/import.js') }}"></script>
@endsection