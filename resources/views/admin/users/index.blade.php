@extends('layouts.admin')

@section('content')
<div class="container-fluid py-6 px-4">
    <!-- Card wrapper -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">Danh Sách Người Dùng</h2>
            <div>
       
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm">+Thêm mới người dùng</a>
                
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th class="py-3 px-4" style="width: 5%">STT</th>
                            <th class="py-3 px-4">Tên</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Quyền</th>
                            <th class="py-3 px-4">Số điện thoại</th>
                            <th class="py-3 px-4">Địa chỉ</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($listUser as $index => $user)
                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 fw-medium">{{ $user->name }}</td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary-subtle text-primary">{{ $user->email }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-success-subtle text-success text-capitalize">{{ $user->role }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    {!! $user->customer->phone ?? '<span class="text-muted fst-italic">Chưa cập nhật</span>' !!}
                                </td>
                                <td class="px-4 py-3">
                                    {!! $user->customer->address ?? '<span class="text-muted fst-italic">Chưa cập nhật</span>' !!}
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-users-slash fa-2x mb-2"></i>
                                        <p class="mb-0">Không có người dùng nào được tìm thấy</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card footer -->
        <div class="card-footer bg-light d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Tổng cộng: {{ $listUser->count() }} người dùng
            </small>
            @if($listUser->hasPages())
                <div>
                    {{ $listUser->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table-hover tbody tr:hover {
        transition: background-color 0.2s ease-in-out;
    }
    
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
</style>
@endsection