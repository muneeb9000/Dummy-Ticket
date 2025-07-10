@extends('admin.layouts.app')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <h1 class="page-title fw-semibold fs-18 mb-0">Permissions List</h1>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Permissions List</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.roles.permissions.update', $role->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                <div class="table-responsive mb-4">
                                    <table class="table text-nowrap table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr</th>
                                                <th scope="col">Module</th>
                                                <th scope="col">Permissions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                            $groupedPermissions = $permissions->groupBy(function ($permission) {
                                                $parts = explode('.', $permission->name);
                                                return $parts[0] ?? 'misc';
                                            });
                                            
                                         @endphp

                                        @foreach ($groupedPermissions as $module => $modulePermissions)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="fw-bold">{{ ucfirst($module) }}</td>
                                                <td>
                                                    @foreach ($modulePermissions as $permission)
                                                        @php
                                                            $parts = explode('.', $permission->name);
                                                            $action = $parts[1] ?? $parts[0]; // fallback if no dot
                                                            $isChecked = $role->hasPermissionTo($permission->name);
                                                        @endphp
                                                        <label class="me-2">
                                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                                                {{ $isChecked ? 'checked' : '' }}>
                                                            {{ ucfirst($action) }}
                                                        </label>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Permissions</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection