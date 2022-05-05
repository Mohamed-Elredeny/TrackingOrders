@extends("layouts.admin")
@section("pageTitle", "Sells Channels")
@section("style")
@endsection
@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive ">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12 ">

                            <div class="row ">
                                <div class="col-sm-1"></div>
                                <a href="{{route('admin.orders.index',['state'=>'today','from'=>'1','to'=>'1'])}}" class="col-sm-3 mr-1 btn btn-dark"> Today Orders</a>
                                <a href="{{route('admin.orders.index',['state'=>'7days','from'=>'1','to'=>'1'])}}" class="col-sm-3 mr-1 btn btn-dark">Last 7 Days</a>
                                <a  data-toggle="modal" data-target="#exampleModalCenterCustom"  class="col-sm-3 btn btn-dark">Custom Date</a>
                            </div>
                            <hr>
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable"
                                           class="table table-striped dt-responsive nowrap table-vertical"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Shop Name</th>
                                            <th>Products</th>
                                            <th>Customer Details</th>
                                            <th>Status</th>
                                            <th>Deliver Time</th>
                                            <th>Track</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr>
                                                <td>
                                                    #{{$record->id}}
                                                </td>
                                                <td>
                                                    <a class="btn btn-dark col-sm-12 d-block"  data-toggle="modal" data-target="#exampleModalCenter{{$record->id}}">
                                                        {{$record->shop['title_'.App::getlocale()]}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-dark col-sm-12 d-block"  data-toggle="modal" data-target="#exampleModalCenterProducts{{$record->id}}">
                                                        {{$record->shop['title_'.App::getlocale()]}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-dark col-sm-12 d-block"  data-toggle="modal" data-target="#exampleModalCenterCustomer{{$record->id}}">
                                                        {{$record->customer_name}}
                                                    </a>
                                                </td>
                                                <td>

                                                    @if( $record->status == 0)
                                                        <span class="btn btn-warning" style="width:200px">New Order</span>
                                                    @elseif( $record->status == 1)
                                                        <span class="btn btn-info"  style="width:200px">Call Center Received</span>
                                                    @elseif( $record->status == 2 )
                                                        <span class="btn btn-danger"  style="width:200px">No Answer Call Center</span>
                                                    @elseif ($record->status == 3)
                                                        <span class="btn btn-danger"  style="width:200px">Wrong Answer</span>
                                                    @elseif($record->status == 4)
                                                        <span class="btn btn-success"  style="width:200px">Confirm Order</span>
                                                    @elseif( $record->status == 5)
                                                        <span class="btn btn-secondary"  style="width:200px">Not Confirm Order</span>
                                                    @elseif($record->status == 6)
                                                        <span class="btn btn-danger"  style="width:200px">is Canceled Order</span>
                                                    @elseif($record->status == 7)
                                                        <span class="btn btn-success"  style="width:200px">is Ready to be Delivered</span>
                                                    @elseif($record->status == 8)
                                                        <span class="btn btn-success"  style="width:200px">Received by Delivery</span>
                                                    @elseif($record->status == 9)
                                                        <span class="btn btn-danger"  style="width:200px">Delivery Refused Order</span>
                                                    @elseif($record->status == 10)
                                                        <span class="btn btn-primary"  style="width:200px">Customer Received</span>
                                                    @elseif($record->status == 11)
                                                        <span class="btn btn-danger"  style="width:200px">Customer Refused</span>
                                                    @elseif($record->status ==12)
                                                        <span class="btn btn-danger"  style="width:200px">No Answer Delivery Boy</span>
                                                    @elseif($record->status == 13)
                                                        <span class="btn btn-danger"  style="width:200px">Customer Didn't deliver</span>
                                                    @endif


                                                </td>
                                                <td>
                                                    @if($record->delivery_date)
                                                        {{date('m/d/Y', strtotime($record->delivery_date)) }}
                                                    @else
                                                        {{'Unknown'}}
                                                    @endif
                                                </td>


                                                <td>
                                                    <a class="btn btn-dark col-sm-12 d-block"  target="_blank" href="{{route('admin.site.trackOrder',['id'=>$record->id])}}">
                                                        View
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>


                </div> <!-- container-fluid -->

                {{--
                                    {{ $data->links() }}
                --}}
            </div>
        </div>
    </div> <!-- end col -->
    </div>
    <div id="modelImagee">

    </div>
    <div id="modelAdd">

    </div>

@endsection
<!-- Name -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenterCustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Custom Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.orders.postDate')}}" method="post">
                    @csrf
                    From <input type="date" class="form-control" name="from" required>
                    To <input type="date" class="form-control" name="to" required>
                    <br>
                    <center>
                        <input type="submit" value="submit" class="btn btn-dark">
                    </center>
                </form>
            </div>

        </div>
    </div>
</div>
@foreach($records as $record)

    <div class="modal fade" id="exampleModalCenterProducts{{$record['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table col-sm-12 table-bordered text-center">
                        <tr>
                            <td>
                                Product name
                            </td>
                            <td>
                                total price
                            </td>
                            <td>
                                amount
                            </td>

                        </tr>
                        <?php $price = 0 ?>
                        @foreach($record->product as $pro)
                            <tr>

                                <td>
                                    {{$pro->one_product->product_name}}
                                </td>
                                <td>
                                    {{$pro->price}}
                                </td>
                                <td>
                                    {{$pro->amount}}
                                </td>

                            </tr>

                        @endforeach

                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter{{$record['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered"  role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Shop Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table col-sm-12 table-bordered text-center">
                        <tr>

                            <td>
                                Name
                            </td>

                            <td>
                                Shop Url
                            </td>
                        </tr>
                        <tr>

                            <td>
                                {{$record->shop['title_en']}}
                            </td>

                            <td >
                                {{$record->shop['shop_url']}}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenterCustomer{{$record['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer Details </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table col-sm-12 table-bordered text-center">
                        <tr>
                            <td>
                                Customer Name
                            </td>
                            <td>
                                Phone 1
                            </td>


                        </tr>
                        <tr>
                            <td>
                                {{$record->customer_phone1}}
                            </td>
                            <td>
                                {{$record->customer_phone1}}
                            </td>

                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenterAddress{{$record['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table col-sm-12 table-bordered text-center">
                        <tr>
                            <td>
                                Country
                            </td>
                            <td>
                                City
                            </td>
                            <td>
                                Zone
                            </td>
                            <td>
                                District
                            </td>
                            <td>
                                Address
                            </td>

                        </tr>
                        <tr>
                            @if($record->country)
                                <td>
                                    {{$record->country['title_'. App::getLocale()]}}
                                </td>
                            @else
                                <td>
                                    There is no country yet!
                                </td>
                            @endif
                            @if($record->city)
                                <td>
                                    {{$record->city['title_'. App::getLocale()]}}
                                </td>
                            @else
                                <td>
                                    There is no city yet!
                                </td>
                            @endif
                            @if($record->zone)
                                <td>
                                    {{$record->zone['title_'. App::getLocale()]}}
                                </td>
                            @else
                                <td>
                                    There is no zone yet!
                                </td>
                            @endif
                            @if($record->district)
                                <td>
                                    {{$record->district['title_'. App::getLocale()]}}
                                </td>
                            @else
                                <td>
                                    There is no district yet!
                                </td>
                            @endif
                            <td>
                                {{$record->address}}
                            </td>

                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach