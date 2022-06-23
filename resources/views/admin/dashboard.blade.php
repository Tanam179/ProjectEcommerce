@extends('admin_layout')
@section('admin_content')

    <div class="side-app">

        <!-- CONTAINER -->
        @for($i = 1; $i <= 12; $i++)
        <input type="hidden" name="total_month_{{$i}}" value={{${"total_month_" . $i} }}>
        @endfor
        <div class="main-container container-fluid mt-6">

            <!-- PAGE-HEADER -->
            {{-- <div class="page-header">
                <h1 class="page-title">Dashboard 01</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard 01</li>
                    </ol>
                </div>
            </div> --}}
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Tổng khách hàng</h6>
                                            <h2 class="mb-0 number-font">{{$count_user}}</h2>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <i style="font-size: 25px; color: #736bdd" class="ph-users-light"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="type-user" style="display: flex; align-items: center; font-size: 12px; margin-top: 10px;">
                                        <div class="admin" style="display: flex; align-items: center; margin-right: 25px;">
                                            <div class="admin-title" style="width: 50px; height: 15px; align-items: center; background: #66cf82; margin-right: 5px;"></div>
                                            <div class="admin-number">{{$admin}} Admin</div>
                                        </div>
                                        <div class="customer" style="display: flex; align-items: center">
                                            <div class="admin-title" style="width: 50px; height: 15px; align-items: center; background: #736bdd; margin-right: 5px;"></div>
                                            <div class="admin-number">{{$user}} User</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Tổng sản phẩm</h6>
                                            <h2 class="mb-0 number-font">{{$count_product}}</h2>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <i style="font-size: 25px; color: #736bdd" class="ph-cube-light"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span style="margin-top: 10px; display: inline-block;" class="text-muted fs-12"><span class="text-pink"><i
                                                class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>
                                        Last 6 days</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Tổng đơn hàng</h6>
                                            <h2 class="mb-0 number-font">{{$count_order}}</h2>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <i style="font-size: 25px; color: #736bdd" class="ph-scroll-light"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="type-user" style="display: flex; align-items: center; font-size: 12px; margin-top: 10px;">
                                        <div class="admin" style="display: flex; align-items: center; margin-right: 25px;">
                                            <div class="admin-title" style="width: 50px; height: 15px; align-items: center; background: #66cf82; margin-right: 5px;"></div>
                                            <div class="admin-number">{{$paid}} Đã thanh toán</div>
                                        </div>
                                        <div class="customer" style="display: flex; align-items: center">
                                            <div class="admin-title" style="width: 50px; height: 15px; align-items: center; background: #fc2a68; margin-right: 5px;"></div>
                                            <div class="admin-number">{{$cancel}} Đã hủy</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="mt-2">
                                            <h6 class="">Tổng doanh thu tháng này</h6>
                                            <h2 class="mb-0 number-font">{{number_format($total_this_month , 0 , ',' , ',' )}}đ</h2>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="chart-wrapper mt-1">
                                                <i style="font-size: 25px; color: #736bdd" class="ph-coins-light"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($total_last_month == 0)
                                        <span style="margin-top: 10px; display: inline-block; color: #736bdd !important" class="text-muted fs-12">Tháng trước bạn không có đơn hàng</span>
                                    @elseif($total_last_month > 0)
                                        @if($percent > 0)
                                        <span style="margin-top: 10px; display: inline-block; " class="text-muted fs-12"><span style="color: #12b886 !important" class="text-warning"><i
                                                    class="fe fe-arrow-up-circle"></i> {{round($percent, 2)}}%</span>
                                            so với tháng trước </span>
                                        @else
                                        <span style="margin-top: 10px; display: inline-block; " class="text-muted fs-12"><span style="color: #f03e3e !important" class="text-warning"><i
                                            class="fe fe-arrow-down-circle"></i> {{round(abs($percent), 2)}}%</span>
                                        so với tháng trước </span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-1 END -->

            <!-- ROW-2 -->
            
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 50px">
                    <div class="chart" style="padding-top: 55px">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            
            

            <!-- ROW-2 END -->
        </div>
        <!-- CONTAINER END -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        const date = new Date();
        // const option = {
        //     month: 'long',
        //     // weekday: 'short',
        // };

        const ctx = document.querySelector('#myChart').getContext('2d'); 
        let gradient = ctx.createLinearGradient(0,0,0,400);
        gradient.addColorStop(0, 'rgba(58, 123, 213, 1)');
        gradient.addColorStop(0, 'rgba(0, 210, 255, 0.3)');
        const labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        let totalMonth1 = document.querySelector('input[name="total_month_1"]').value;
        let totalMonth2 = document.querySelector('input[name="total_month_2"]').value;
        let totalMonth3 = document.querySelector('input[name="total_month_3"]').value;
        let totalMonth4 = document.querySelector('input[name="total_month_4"]').value;
        let totalMonth5 = document.querySelector('input[name="total_month_5"]').value;
        let totalMonth6 = document.querySelector('input[name="total_month_6"]').value;
        let totalMonth7 = document.querySelector('input[name="total_month_7"]').value;
        let totalMonth8 = document.querySelector('input[name="total_month_8"]').value;
        let totalMonth9 = document.querySelector('input[name="total_month_9"]').value;
        let totalMonth10 = document.querySelector('input[name="total_month_10"]').value;
        let totalMonth11 = document.querySelector('input[name="total_month_11"]').value;
        let totalMonth12 = document.querySelector('input[name="total_month_12"]').value;
        console.log(totalMonth5);
        const data = {
            labels,
            datasets: [
                {
                    data: [totalMonth1, totalMonth2, totalMonth3, totalMonth4, totalMonth5, totalMonth6, totalMonth7, totalMonth8, totalMonth9, totalMonth10, totalMonth11, totalMonth12],
                    label: `Doanh thu hàng tháng năm ${date.getFullYear()}`,
                    fill: true,
                    backgroundColor: 'rgba(115,107,221, 0.3)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: '#fff',
                    tension: 0.4,
                }
            ],
            
        }

        const config = {
            type: 'line',
            data: data,
            options: {
                radius: 5,
                hoverRadius: 10,
                responsive: true,
                scale: {
                    y: {
                        ticks: {
                            callback: function(value){
                                return "$" + value + "m";
                            },
                        },
                    },
                },
            },
            
        };

        const myChart = new Chart(ctx, config);

    </script>

@endsection