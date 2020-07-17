@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Company') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('company.update') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="company_id" value="{{ $company->id }}">

                        <div class="form-group row">
                            <label for="comp-name" class="col-md-4 col-form-label text-md-right">{{ __('Company name') }}:</label>
                            <div class="col-md-6">
                                <input id="comp-name" type="text" class="form-control @error('comp-name') is-invalid @enderror" name="comp-name" value="{{ $company->name }}" required>
                                @error('comp-name')
                                    <span class="invalid feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}:</label>
                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $company->website }}">
                                @error('website')
                                    <span class="invalid feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comp-email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}:</label>
                            <div class="col-md-6">
                                <input id="comp-email" type="email" class="form-control @error('comp-email') is-invalid @enderror" name="comp-email" value="{{ $company->email }}">
                                @error('comp-email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{__('Company Logo')}}:</label>
                                <img src="{{ asset('storage/'.$company->logo) }}" class="img-thumbnail thumbnail">
                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
