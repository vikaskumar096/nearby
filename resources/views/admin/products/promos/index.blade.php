@extends('admin.layouts.masteradmin')
@section('title', 'Promo codes')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/customcss.css') }}?v={{ time() }}">
@endsection
@section('content')
    <div class="card shadow-none px-4 bg-transparent mt-5">
        <div class="card-body shadow-lg bg-white rounded-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div id="status-message"></div>
            <div class="d-flex align-items=center justify-content-between mb-3">
                <h4 class="mb-0">Promo codes</h4>
                @if(auth()->guard('admin')->user()->hasPermission('create_promo'))
                <a href="{{ route('admin.products.promos.create') }}" class="btn btn-primary">Add Promo codes</a>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Promo code</th>
                            <th>Discount</th>
                            <th>validity From</th>
                            <th>validity To</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promos as $index => $promo)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $promo->promocode }}</td>
                                <td>{{ $promo->discount  }}</td>
                                <td>{{ $promo->validity_from   }}</td>
                                <td>{{ $promo->validity_to   }}</td>
                                <td class="d-flex align-items-center gap-2">
                                    <!-- Toggle Switch -->
                                     @if(auth()->guard('admin')->user()->hasPermission('changestatus_promo'))
                                    <div class="form-check form-switch">
                                        <input class="form-check-input toggle-status" type="checkbox" 
                                            data-id="{{ $promo->id }}" 
                                            {{ $promo->status ? 'checked' : '' }}>
                                    </div>
                                    @endif
                                    @if(auth()->guard('admin')->user()->hasPermission('edit_promo'))
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.products.promos.edit', $promo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                    @if(auth()->guard('admin')->user()->hasPermission('delete_promo'))
                                    <!-- Delete Form -->
                                    <form action="{{ route('admin.products.promos.destroy', $promo->id) }}" method="POST" class="d-inline" 
                                        onsubmit="return confirm('Are you sure you want to delete this promo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endif
                                </td>                            
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Promos available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/js/promos.js') }}"></script>
@endpush