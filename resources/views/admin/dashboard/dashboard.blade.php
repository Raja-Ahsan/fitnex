@extends('layouts.admin.app')

@section('title', $page_title)

@push('css')
<!-- Highcharts CSS -->
<link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
<style>
    .info-box {
        cursor: pointer;
        transition: transform 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
        transform: translateZ(0) scale(1);
    }
    .info-box:hover {
        transform: translateZ(0) scale(1.02);
        box-shadow: 0 8px 16px rgba(0,0,0,0.12);
    }
    .chart-container {
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<!-- dashboard -->
<section class="content-header">
    <h1>Dashboard <small>Overview & Statistics</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <!-- Statistics Row 1: Core Metrics -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('trainer.index') }}" style="text-decoration: none;">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Trainers</span>
                        <span class="info-box-number">{{ number_format($total_trainer) }}</span>
                        {{-- <small class="text-muted">Active trainers</small> --}}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.bookings.index') }}" style="text-decoration: none;">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Bookings</span>
                        <span class="info-box-number">{{ number_format($total_bookings) }}</span>
                        {{-- <small class="text-muted">{{ $confirmed_bookings }} confirmed</small> --}}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.bookings.index') }}" style="text-decoration: none;">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Appointments</span>
                        <span class="info-box-number">{{ number_format($total_appointments) }}</span>
                        {{-- <small class="text-muted">{{ $confirmed_appointments }} confirmed</small> --}}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Revenue</span>
                    <span class="info-box-number">${{ number_format($total_revenue, 2) }}</span>
                    {{-- <small class="text-muted">${{ number_format($monthly_revenue, 2) }} this month</small> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Row 2: Users & Services -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('user.index') }}" style="text-decoration: none;">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <span class="info-box-number">{{ number_format($total_users) }}</span>
                        {{-- <small class="text-muted">{{ $recent_users }} new (7 days)</small> --}}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.slots.index') }}" style="text-decoration: none;">
                <div class="info-box">
                    <span class="info-box-icon bg-purple"><i class="fa fa-clock-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Time Slots</span>
                        <span class="info-box-number">{{ number_format($total_slots) }}</span>
                        {{-- <small class="text-muted">{{ $available_slots }} available</small> --}}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('services.index') }}" style="text-decoration: none;">
                <div class="info-box">
                    <span class="info-box-icon bg-teal"><i class="fa fa-code-fork"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Services</span>
                        <span class="info-box-number">{{ number_format($total_category) }}</span>
                        {{-- <small class="text-muted">Active services</small> --}}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('contactus.index') }}" style="text-decoration: none;">
                <div class="info-box">
                    <span class="info-box-icon bg-maroon"><i class="fa fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Contact Messages</span>
                        <span class="info-box-number">{{ number_format($total_contactus) }}</span>
                        {{-- <small class="text-muted">Unread messages</small> --}}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Statistics Row 3: Payment & Activity -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Paid Bookings</span>
                    <span class="info-box-number">{{ number_format($paid_bookings) }}</span>
                    {{-- <small class="text-muted">{{ $pending_payments }} pending</small> --}}
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass-half"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Bookings</span>
                    <span class="info-box-number">{{ number_format($pending_bookings) }}</span>
                    {{-- <small class="text-muted">Awaiting confirmation</small> --}}
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-calendar-plus-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Upcoming Slots</span>
                    <span class="info-box-number">{{ number_format($upcoming_slots) }}</span>
                    {{-- <small class="text-muted">{{ $booked_slots }} booked</small> --}}
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-ban"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Blocked Slots</span>
                    <span class="info-box-number">{{ number_format($blocked_slots) }}</span>
                    {{-- <small class="text-muted">Unavailable times</small> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1: Revenue & Trends -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-line-chart"></i> Revenue Trend (Last 30 Days)</h3>
                </div>
                <div class="box-body">
                    <div id="revenueChart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2: Status Distributions -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pie-chart"></i> Booking Status Distribution</h3>
                </div>
                <div class="box-body">
                    <div id="bookingStatusChart" style="height: 350px;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-pie-chart"></i> Appointment Status Distribution</h3>
                </div>
                <div class="box-body">
                    <div id="appointmentStatusChart" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 3: Monthly Trends -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-bar-chart"></i> Monthly Booking & Appointment Trends (Last 6 Months)</h3>
                </div>
                <div class="box-body">
                    <div id="monthlyTrendChart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 4: Top Trainers -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-trophy"></i> Top 5 Trainers by Confirmed Bookings</h3>
                </div>
                <div class="box-body">
                    <div id="topTrainersChart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Summary -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-clock-o"></i> Recent Activity (Last 7 Days)</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="description-block border-right">
                                <span class="description-percentage text-green"><i class="fa fa-calendar-check-o"></i></span>
                                <h5 class="description-header">{{ number_format($recent_bookings) }}</h5>
                                <span class="description-text">New Bookings</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="description-block border-right">
                                <span class="description-percentage text-yellow"><i class="fa fa-calendar"></i></span>
                                <h5 class="description-header">{{ number_format($recent_appointments) }}</h5>
                                <span class="description-text">New Appointments</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="description-block border-right">
                                <span class="description-percentage text-blue"><i class="fa fa-user-plus"></i></span>
                                <h5 class="description-header">{{ number_format($recent_users) }}</h5>
                                <span class="description-text">New Users</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="description-block">
                                <span class="description-percentage text-purple"><i class="fa fa-users"></i></span>
                                <h5 class="description-header">{{ number_format($recent_trainers) }}</h5>
                                <span class="description-text">New Trainers</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<!-- Highcharts JS -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
(function() {
    'use strict';

    // Function to initialize all charts
    function initCharts() {
        // Check if Highcharts is loaded
        if (typeof Highcharts === 'undefined') {
            console.error('Highcharts library not loaded');
            setTimeout(initCharts, 100);
            return;
        }

        console.log('Initializing charts...');

        try {
        // Revenue Trend Chart
        var revenueData = {!! json_encode($revenue_chart_data) !!};
        console.log('Revenue data:', revenueData);
    Highcharts.chart('revenueChart', {
        chart: {
            type: 'line',
            backgroundColor: 'transparent'
        },
        title: {
            text: 'Daily Revenue Trend'
        },
        subtitle: {
            text: 'Last 30 Days'
        },
        xAxis: {
            categories: revenueData.map(function(item) { return item.date; }),
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: 'Revenue ($)'
            },
            labels: {
                formatter: function() {
                    return '$' + this.value.toFixed(2);
                }
            }
        },
        tooltip: {
            formatter: function() {
                return '<b>' + this.x + '</b><br/>Revenue: <b>$' + this.y.toFixed(2) + '</b>';
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: false
                },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Revenue',
            data: revenueData.map(function(item) { return item.revenue; }),
            color: '#27ae60'
        }],
        credits: {
            enabled: false
        }
    });

    // Booking Status Pie Chart
    Highcharts.chart('bookingStatusChart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            backgroundColor: 'transparent'
        },
        title: {
            text: 'Booking Status Distribution'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br/>Total: <b>{point.y}</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Bookings',
            colorByPoint: true,
            data: {!! json_encode($booking_status_data) !!}
        }],
        credits: {
            enabled: false
        }
    });

    // Appointment Status Pie Chart
    Highcharts.chart('appointmentStatusChart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            backgroundColor: 'transparent'
        },
        title: {
            text: 'Appointment Status Distribution'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br/>Total: <b>{point.y}</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Appointments',
            colorByPoint: true,
            data: {!! json_encode($appointment_status_data) !!}
        }],
        credits: {
            enabled: false
        }
    });

    // Monthly Trend Chart
    Highcharts.chart('monthlyTrendChart', {
        chart: {
            type: 'column',
            backgroundColor: 'transparent'
        },
        title: {
            text: 'Monthly Booking & Appointment Trends'
        },
        subtitle: {
            text: 'Last 6 Months'
        },
        xAxis: {
            categories: {!! json_encode(array_column($monthly_booking_data, 'month')) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Count'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Bookings',
            data: {!! json_encode(array_column($monthly_booking_data, 'bookings')) !!},
            color: '#3498db'
        }, {
            name: 'Appointments',
            data: {!! json_encode(array_column($monthly_booking_data, 'appointments')) !!},
            color: '#f39c12'
        }],
        credits: {
            enabled: false
        }
    });

    // Top Trainers Chart
    Highcharts.chart('topTrainersChart', {
        chart: {
            type: 'bar',
            backgroundColor: 'transparent'
        },
        title: {
            text: 'Top 5 Trainers by Confirmed Bookings'
        },
        xAxis: {
            categories: {!! json_encode($top_trainers->pluck('name')->toArray()) !!},
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of Bookings',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' bookings'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Confirmed Bookings',
            data: {!! json_encode($top_trainers->pluck('bookings_count')->toArray()) !!},
            color: '#27ae60'
        }]
    });

        console.log('All charts initialized successfully');
        } catch (error) {
            console.error('Error initializing charts:', error);
        }
    }

    // Initialize charts when DOM is ready and Highcharts is loaded
    function checkAndInit() {
        if (typeof Highcharts !== 'undefined') {
            initCharts();
        } else {
            setTimeout(checkAndInit, 100);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkAndInit);
    } else {
        checkAndInit();
    }
})();
</script>
@endpush
