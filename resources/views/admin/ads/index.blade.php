@extends('layouts.admin')

@section('content')
<input type="hidden" id="headerdata" value="{{ __('Ads') }}">
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('All Ads') }}</h4>
                <ul class="links">
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a></li>
                    <li><a href="{{ route('ads.index') }}">{{ __('Advertisements') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="mr-table allproduct">
                    
                    @include('includes.admin.form-success')
                    @include('includes.admin.flash-message')

                    {{-- === ADD BUTTON SECTION START === --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="action-list" style="text-align: right; padding: 15px;">
                                <a class="btn btn-primary" href="{{ route('ads.create') }}" style="background-color: #1f224f; border:none;">
                                    <i class="fas fa-plus"></i> {{ __('Add New Advertisement') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- === ADD BUTTON SECTION END === --}}

                    <div class="table-responsiv">
                        <table id="elitedesigntable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Ads Placement') }}</th>
                                    <th>{{ __('Ad Size') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade-scale" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">{{ __('You are about to delete this Advertisement.') }}</p>
                <p class="text-center">{{ __('Do you want to proceed?') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var table = $('#elitedesigntable').DataTable({
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: '{{ route('ads.datatables') }}',
        columns: [
            {data: 'photo', name: 'photo'},
            {data: 'add_placement', name: 'add_placement'},
            {data: 'addSize', name: 'addSize'},
            {data: 'status', name: 'status'},
            {data: 'action', searchable: false, orderable: false}
        ],
        language : {
            processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
        },
        drawCallback: function (settings) {
            $('.select').niceSelect();
        }
    });
</script>
@endsection