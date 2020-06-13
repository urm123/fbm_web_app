@extends('layouts.common')

@section('content')
    @include('layouts.headers.reports')

    <section class="page-content dashbord" id="store">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Store</h3>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">

                    </div>
                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card">
                        <div class="title">
                            <h4 class="text-left">Inventory Report</h4>
                        </div>


                        <div class="content" style="overflow:visible;min-height:1150px;">


                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="ClientName">Client Name</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control selectpicker" v-model="client" id="client"
                                                name="client">
                                            <option value="">Select a client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="InputTaskType">Time Range</label>
                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control selectpicker" v-model="time">
                                            <option selected="selected" value="all">All</option>
                                            @foreach($dates as $date)
                                                <option value="{{$date->year}}-{{$date->month}}-01">
                                                    {{$date->year}} {{$date->month_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
                                 style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px;">
                                <div class="form-group">
                                    <div class="col-sm-12">

                                        <div class="Preview Scroll">

                                            <div class="page">
                                                <table class="table table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Client</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Minimum Amount</th>
                                                        <th>Customer Allocation Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="product in filtered_products">
                                                        <td>@{{product.client_name}}</td>
                                                        <td>@{{product.product_name}}</td>
                                                        <td>@{{product.price}}</td>
                                                        <td>@{{product.client_quantity}} @{{product.units}}</td>
                                                        <td>@{{product.shortage_alert}}</td>
                                                        <td>@{{product.stock_date}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                <a href="{{URL::to('reports/store/download')}}" target="_blank" type="submit"
                                   class="btn btn-default save">Download as Excel</a>

                            </div>

                        </div>
                        <!--/end tab-pane-->


                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


            </div>
        </div>

    </section>

    <script type="text/javascript">

        var data = {
            inventory: {!! $inventory !!},
            products: [],
            client: '',
            time: ''
        };
        var store = new Vue({
            data: data,
            el: '#store',
            mounted: function () {
                this.products = this.inventory
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#client').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.client = this.value;
                        vm.$emit('input', this.value);
                    });
                });
            },
            computed: {
                filtered_products: function () {
                    var client = this.client;
                    var time = this.time;
                    var case_name = 'none';
                    if (client != '') {
                        case_name = 'client';
                    }
                    if (time != 'all' && time != '') {
                        if (client != '') {
                            case_name = 'client-time';
                        } else {
                            case_name = 'time';
                        }
                    }
                    if (client == '' && (time == 'all' || time == '')) {
                        case_name = 'none';
                    }

                    var $this = this;

                    var filtered_product = this.inventory.filter(function (inventory_item) {
                        switch (case_name) {
                            case 'client-time':
                                return inventory_item.client_id == client && moment(inventory_item.stock_date).isSameOrAfter($this.compareTime(time), 'year') && moment(inventory_item.stock_date).isSame($this.compareTime(time), 'month');
                            case 'client':
                                return inventory_item.client_id == client;
                            case 'time':
                                return moment(inventory_item.stock_date).isSame($this.compareTime(time), 'year') && moment(inventory_item.stock_date).isSame($this.compareTime(time), 'month');
                            case 'none':
                                return true;
                        }
                    });
                    return this.products = filtered_product;
                }
            },
            methods: {
                compareTime: function (time) {
                    switch (time) {
                        case 'last-month':
                            return moment().substract(1, 'month');
                            break;
                        default:
                            return time;
                            break;
                    }
                }
            }
        });
    </script>

@endsection