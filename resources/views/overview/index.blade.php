@extends('dashboard.index')
@section('content')
<style>
    /* Define your CSS styles inline */
    .overview-card {
        /* Your card styles */
        border: 1px solid #ccc;
        padding: 10px;
    }

    .text-white {
        color: white;
    }

    .accent-color-1 {
        background-color: #ff6347; /* Tomato */
    }

    .accent-color-2 {
        background-color: #87ceeb; /* Sky Blue */
    }

    .accent-color-3 {
        background-color: #20b2aa; /* Light Sea Green */
    }
    .accent-color-4 {
        background-color: #0D6EFD; /* Light Sea Green */
    }
    .accent-color-5 {
        background-color: #FFC107; /* Light Sea Green */
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Overview</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card accent-color-1">
                                    <div class="card-body text-white">
                                        <div class="text-align-center">
                                            <div class="">Total Users: {{ $overviewData['user_total'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accent-color-2">
                                    <div class="card-body text-white">
                                        <div class="text-align-center">
                                            @foreach ($overviewData['label_totals'] as $label)
                                                <div class="">{{ $label['name'] }}: {{ $label['tickets_count'] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card accent-color-3">
                                    <div class="card-body text-white">
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card accent-color-4">
                                    <div class="card-body text-white">
                                        <div class="text-align-center">
                                            @foreach ($overviewData['priority_counts'] as $priority => $count)
                                                <div class="">{{ ucfirst($priority) }} Priority: {{ $count }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card accent-color-1">
                                    <div class="card-body text-white">
                                        <div class="text-align-center">
                                            @foreach ($overviewData['category_totals'] as $category)
                                                <div class="">{{ $category['name'] }}: {{ $category['tickets_count'] }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card accent-color-5">
                                    <div class="card-body text-white">
                                        <div class="text-align-center">
                                            @php
                                                $opened_count = $overviewData['opened_count'];
                                                $closed_count = $overviewData['closed_count'];
                                                $total = $opened_count + $closed_count;
                                            @endphp
                        
                                            <div class="">Opened Tickets: {{ $opened_count }}</div>
                                            <div class="">Closed Tickets: {{ $closed_count }}</div>
                                            <div class=""> Total Tickets: {{ $total }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
