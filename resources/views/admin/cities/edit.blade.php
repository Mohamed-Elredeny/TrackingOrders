@extends("layouts.admin")
@section("pageTitle", "Edit City")
@section("content")

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">



                    <form method="post" action="{{route('cities.update',['city'=>$record->id])}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('Title English')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="example-text-input" name="title_en" value="{{$record->title_en}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{__('Title Arabic')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="example-text-input" name="title_ar" value="{{$record->title_ar}}">
                            </div>
                        </div>
                        @if(Auth::guard('admin')->user()->is_super_admin)
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">

                                <select class="form-control"  id="example-text-input" name="country_id" required>
                                    <option value="{{$record->country_id}}">{{$record->country['title_' . App::getLocale()]}}</option>
                                    @foreach($countries as $rec)
                                        @if($rec->id != $record->country_id)
                                        <option value="{{$rec->id}}">{{$rec['title_'. App::getlocale() ]}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @else
                            <input type="hidden" name="country_id" value="{{Auth::guard('admin')->user()->country_id}}">
                        @endif

                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-dark w-25">{{__('Save Changes')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
@section("script")
    <script src="{{asset("assets/admin/js/app.js")}}"></script>

@endsection
