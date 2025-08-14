@extends('admin.layout.app')
@section('title', 'Order List')

@section('content')
<main class="page-content">
<section class="py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-5 fw-bold">Order List</h1>

        @if($orders->count() > 0)
        <div class="table-responsive shadow-sm rounded bg-white p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light text-muted text-uppercase small">
                    <tr>
                        <th>#ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="fw-bold text-center">#{{ $order->id }}</td>
                        <td>{{ $order->user_name ?? 'Guest' }}</td>
                        <td class="text-success fw-semibold">৳{{ number_format($order->total_amount, 2) }}</td>

                        <!-- Status Dropdown -->
                        <td>
                            <select class="form-select form-select-sm status-update" 
                                    data-order-id="{{ $order->id }}" 
                                    style="height:28px; padding:0 0.25rem; font-size:0.85rem;">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </td>

                        <td class="text-muted small">{{ $order->created_at->format('d M Y, h:i A') }}</td>

                        <!-- Actions -->
                        <td class="text-center">
                            <!-- Modal Trigger -->
                            <button class="btn btn-outline-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                Details
                            </button>
                            <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="btn btn-outline-secondary btn-sm mb-1">Invoice</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <h3 class="text-muted">No orders found</h3>
            <a href="{{ route('index.view') }}" class="btn btn-outline-dark mt-3">Back to Shop</a>
        </div>
        @endif
    </div>
</section>
</main>

<!-- Modals for all orders (outside table) -->
@foreach($orders as $order)
<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable"> <!-- Changed modal-lg to modal-xl -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Order #{{ $order->id }} Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive"> <!-- Makes the table scroll horizontally if needed -->
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr class="text-muted small">
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_name ?? 'Guest' }}</td>
                                <td>{{ $order->user_phone}}</td>
                                <td>{{ $order->full_address}}</td>
                                <td class="text-success fw-semibold">৳{{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ $order->status }}</td>
                                <td class="text-muted small">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                @foreach($order->orderDetails as $detail)
                                    <td>{{ $detail->name }}</td>
                                    <td>{{ $detail->size }}</td>
                                    <td>{{ $detail->color }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td class="text-success">৳{{ number_format($detail->price, 2) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                 <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="btn btn-outline-secondary btn-sm mb-1">Invoice</a>
            </div>
        </div>
    </div>
</div>

@endforeach

<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateDropdownColor(select) {
        const status = select.value;
        select.style.backgroundColor = status === 'pending' ? '#ffc107' 
            : status === 'delivered' ? '#28a745' 
            : '#dc3545';
        select.style.color = 'white';
    }

    document.querySelectorAll('.status-update').forEach(select => {
        updateDropdownColor(select);

        select.addEventListener('change', function () {
            const orderId = this.dataset.orderId;
            const newStatus = this.value;

            fetch(`/admin/orders/update-status/${orderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Order status updated successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    updateDropdownColor(select);
                } else {
                    Swal.fire('Error','Failed to update order status','error');
                }
            })
            .catch(err => Swal.fire('Error','Something went wrong','error'));
        });
    });
});
</script>
@endsection
