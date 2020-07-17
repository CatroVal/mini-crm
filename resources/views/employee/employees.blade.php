@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @include('includes.messages')
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Employees') }}</h4>
                </div>
                <div class="card-body bg-secondary">
                    <a href="{{ route('employee.create') }}" class="btn btn-success">{{ __('Create New Employee') }}</a>
                </div>
                <br>
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Employees List') }}</h4>
                        </div>

                        <table class="table table-bordered">
                            @if(count($employees)== 0)
                                <h4 align="center">{{__('No employees data to display')}}</h4>
                            @else
                                <tr>
                                    <th>{{__('First name')}}</th>
                                    <th>{{__('Last name')}}</th>
                                    <th>{{__('Company')}}</th>
                                    <th>{{__('E-Mail Address')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th></th>
                                </tr>

                                @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->company->name}}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>
                                        <a href="{{ route('employee.edit', [$employee->id]) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                        <!--<div class="clearfix"></div>-->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                                            {{ __('Delete') }}
                                        </button>
                                        <!--The Modal-->
                                        <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!--Modal Header-->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('Confirm deletion') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <!--Modal Body-->
                                                    <div class="modal-body">
                                                        {{__("You're about to delete an Employee. This action can't be undone. Are you sure?")}}
                                                    </div>
                                                    <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <a href="{{ route('employee.delete', [$employee->id]) }}" class="btn btn-sm btn-danger">{{ __('Confirm') }}</a>
                                                        <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">{{ __('Cancel') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <!--PAGINACION-->
            <br>
            <div class="clearfix">

            </div>
        </div>
    </div>
</div>
@endsection
