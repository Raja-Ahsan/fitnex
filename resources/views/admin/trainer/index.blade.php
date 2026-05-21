@extends('layouts.admin.app')

@section('title', $page_title)

@section('content')
<input type="hidden" id="page_url" value="{{ route('trainer.index') }}">

<section class="content">
    <div class="admin-themed-page">
        <div class="admin-hero">
            <div>
                <h1><i class="fa fa-users"></i> {{ $page_title }}</h1>
                <p>Manage coach profiles, status, and listings.</p>
            </div>
            @can('trainer-create')
                <a href="{{ route('trainer.create') }}" class="btn btn-hero">
                    <i class="fa fa-plus"></i> Add trainer
                </a>
            @endcan
        </div>

        @if (session('status'))
            <div class="admin-alert-success">
                <i class="fa fa-check-circle"></i> {{ session('status') }}
            </div>
        @endif

        <div class="admin-panel">
            <div class="admin-panel__head"><i class="fa fa-filter"></i> Search &amp; filter</div>
            <div class="admin-panel__body">
                <div class="admin-filters">
                    <input type="text" id="search" class="form-control" placeholder="Search by name, email, type..." style="flex:1;min-width:200px;">
                    <select name="status" id="status" class="form-control status" style="width:200px;">
                        <option value="All" selected>All statuses</option>
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </div>

                <div class="table-responsive admin-table-desktop">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Coach</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Owner</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="body">
                            @include('admin.trainer.partials.rows', ['trainers' => $trainers])
                        </tbody>
                    </table>
                </div>

                <div class="admin-cards" id="body-cards">
                    @foreach($trainers as $key => $trainer)
                        <div class="admin-card" id="trainer-row-{{ $trainer->id }}-card">
                            <div class="admin-card__title">{{ $trainer->name ?: '—' }}</div>
                            <div class="admin-card__row"><span>Type</span><span>{{ $trainer->trainer_type_display ?: '—' }}</span></div>
                            <div class="admin-card__row"><span>Price</span><span>{{ $trainer->price ? '$'.$trainer->price : '—' }}</span></div>
                            <div class="admin-card__row">
                                <span>Status</span>
                                <span>
                                    @if($trainer->status)
                                        <span class="admin-badge admin-badge--success">Active</span>
                                    @else
                                        <span class="admin-badge admin-badge--danger">Inactive</span>
                                    @endif
                                </span>
                            </div>
                            <div class="admin-actions" style="margin-top:10px;">
                                @can('trainer-edit')
                                    <a href="{{ route('trainer.edit', $trainer->id) }}" class="btn btn-xs btn-admin-primary"><i class="fa fa-edit"></i> Edit</a>
                                @endcan
                                @can('trainer-delete')
                                    <button type="button" class="btn btn-xs btn-danger btn-admin-danger delete"
                                        data-row-id="trainer-row-{{ $trainer->id }}"
                                        data-del-url="{{ url('trainer/'.$trainer->id) }}"
                                        title="Delete trainer">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                    @if($trainers->hasPages())
                        <div class="text-center">{!! $trainers->links('pagination::bootstrap-4') !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
