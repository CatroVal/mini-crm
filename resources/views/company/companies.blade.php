@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @include('includes.messages')
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Companies')}}</h4>
                </div>
                <div class="card-body bg-secondary">
                    <a href="{{ route('company.create') }}" class="btn btn-success">{{__('Create new company')}}</a>
                </div>
                <br>
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Companies List')}}</h4>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Website')}}</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th></th>
                            </tr>
                            @foreach($companies as $company)
                            <tr>
                                <td><a href="{{ route('company.show', [$company->id]) }}">{{ $company->name }}</a></td>
                                <td>{{ $company->website }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    @if($company->logo)
                                        <div class="logo" align="center">
                                            <img src="{{ asset('storage/'.$company->logo) }}" height="50px">
                                        </div>
                                    @else
                                        <h6 align="center">Company logo<br> not available</h6>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('company.edit', [$company->id]) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                    <div class="clearfix"></div>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                                      {{ __('Delete') }}
                                    </button>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                      <div class="modal-dialog">
                                        <div class="modal-content">

                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                            <h4 class="modal-title">{{ __('Confirm deletion') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>

                                          <!-- Modal body -->
                                          <div class="modal-body">
                                            {{__("You're about to delete a Company. This action can't be undone. Are you sure?")}}
                                          </div>

                                          <!-- Modal footer -->
                                          <div class="modal-footer">
                                            <a href="{{ route('company.delete', [$company->id])}}" class="btn btn-sm btn-danger">{{ __('Confirm') }}</a>
                                            <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">{{ __('Cancel') }}</button>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!--PAGINACION-->
            <br>
            <div class="clearfix">
                {{ $companies->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
