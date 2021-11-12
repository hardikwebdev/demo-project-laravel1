@extends('layouts.app')
@section('title', __('custom.help_and_faq'))
@section('page_title', __('custom.help_and_faq'))
@section('content')
    <div class="content-wrapper mt-5">
        <div class="row justify-content-center mt-3">
            <div class="col-12 mt-4">
                <div class="tab-content border-0">
                    <div id="home" class="tab-pane active">
                        <div class="card">
                            <div class="card-body p-md-5">
                                <div class="row">
                                    {!! trans('custom.helpone') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
