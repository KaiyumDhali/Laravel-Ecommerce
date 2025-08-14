@extends('admin.layout.app')
@section('title' ,'loin')

@section('content')

<main>
<div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-fluid">

                    <!-- Start here.... -->
                    <div class="row">
                         <div class="col-xxl-5">
                              <div class="row">
                                   <div class="col-12">
                                        <div class="alert alert-primary text-truncate mb-3" role="alert">
                                             We regret to inform you that our server is currently experiencing technical difficulties.
                                        </div>
                                   </div>

                                   <div class="col-md-12">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-6">
                                                            <div class="avatar-md bg-soft-primary rounded">
                                                                 <iconify-icon icon="solar:cart-5-bold-duotone" class="avatar-title fs-32 text-primary"></iconify-icon>
                                                            </div>
                                                       </div> <!-- end col -->
                                                       <div class="col-6 text-end">
                                                            <p class="text-muted mb-0 text-truncate">Total Orders</p>
                                                            <h3 class="text-dark mt-1 mb-0">{{$totalorder}}</h3>
                                                       </div> <!-- end col -->
                                                  </div> <!-- end row-->
                                             </div> <!-- end card body -->
                                             <div class="card-footer py-2 bg-light bg-opacity-50">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                            <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i> 2.3%</span>
                                                            <span class="text-muted ms-1 fs-12">Last Week</span>
                                                       </div>
                                                       <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                                                  </div>
                                             </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                   </div> <!-- end col -->
                                <!-- end col -->
                                <!-- end col -->
                              </div> <!-- end row -->
                         </div> <!-- end col -->

                         <div class="col-xxl-7">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                             <h4 class="card-title">Performance</h4>
                                             <div>
                                                  <button type="button" class="btn btn-sm btn-outline-light">ALL</button>
                                                  <button type="button" class="btn btn-sm btn-outline-light">1M</button>
                                                  <button type="button" class="btn btn-sm btn-outline-light">6M</button>
                                                  <button type="button" class="btn btn-sm btn-outline-light active">1Y</button>
                                             </div>
                                        </div> <!-- end card-title-->

                                        <div dir="ltr">
                                             <div id="dash-performance-chart" class="apex-charts"></div>
                                        </div>
                                   </div> <!-- end card body -->
                              </div> <!-- end card -->
                         </div> <!-- end col -->
                    <!-- end row -->

                    <div class="row">
                         <div class="col">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <h4 class="card-title">
                                                  Recent Orders
                                             </h4>

                                             <a href="#!" class="btn btn-sm btn-soft-primary">
                                                  <i class="bx bx-plus me-1"></i>Create Order
                                             </a>
                                        </div>
                                   </div>
                                   <!-- end card body -->
                                   
                                   <div class="table-responsive table-centered">
                                        <table class="table mb-0">
                                             <thead class="bg-light bg-opacity-50">
                                                  <tr>
                                                       <th class="ps-3">
                                                            Order ID.
                                                       </th>
                                                       <th>
                                                            Date
                                                       </th>
                                                       <th>
                                                            Product
                                                       </th>
                                                       <th>
                                                            Customer Name
                                                       </th>
                                                       <th>
                                                            Email ID
                                                       </th>
                                                       <th>
                                                            Phone No.
                                                       </th>
                                                       <th>
                                                            Address
                                                       </th>
                                                       <th>
                                                            Payment Type
                                                       </th>
                                                       <th>
                                                            Status
                                                       </th>
                                                  </tr>
                                             </thead>
                                             <!-- end thead-->
                                             <tbody>
                                                   @foreach($orders as $order)
                                                  <tr>
                                                       <td class="ps-3">
                                                            <a href="order-detail.html">{{$order->id}}</a>
                                                       </td>
                                                       <td>{{ $order->created_at->format('d M Y') }}</td>
                                                      <td>
                                                            @foreach($order->orderDetails as $details)
                                                                 <div class="d-flex align-items-center mb-1">
                                                                      <img src="{{ $details->image ? asset($details->image) : asset('images/default.png') }}" 
                                                                           alt="" class="img-fluid avatar-sm me-2">
                                                                      <span>{{ $details->name }}</span>
                                                                 </div>
                                                            @endforeach
                                                       </td>

                                                       <td>
                                                   
                                                            <a href="#!">{{$order->user_name}}</a>
                                                      
                                                       </td>
                                                       <td>{{$order->user_email}}</td>
                                                       <td>{{$order->user_phone}}</td>
                                                       <td>{{$order->full_address}}</td>
                                                       <td>{{$order->payment_method}}</td>
                                                       <td>
                                                           @php
                                                                 $statusColor = match($order->status) {
                                                                      'pending' => 'text-warning', // হলুদ
                                                                      'delivered' => 'text-success', // সবুজ
                                                                      'cancelled', 'canceled' => 'text-danger', // লাল
                                                                      default => 'text-secondary' // ডিফল্ট ধূসর
                                                                 };
                                                            @endphp

                                                            <i class="bx bxs-circle {{ $statusColor }} me-1"></i> {{ ucfirst($order->status) }}

                                                       </td>
                                                  </tr>
                                                        @endforeach
                                             </tbody>
                                             <!-- end tbody -->
                                        </table>
                                  
                                        <!-- end table -->
                                   </div>
                                   <!-- table responsive -->

                                   <div class="card-footer border-top">
                                        <div class="row g-3">
                                             <div class="col-sm">
                                                  <div class="text-muted">
                                                       Showing
                                                       <span class="fw-semibold">5</span>
                                                       of
                                                       <span class="fw-semibold">90,521</span>
                                                       orders
                                                  </div>
                                             </div>

                                             <div class="col-sm-auto">
                                                  <ul class="pagination m-0">
                                                       <li class="page-item">
                                                            <a href="#" class="page-link"><i class="bx bx-left-arrow-alt"></i></a>
                                                       </li>
                                                       <li class="page-item active">
                                                            <a href="#" class="page-link">1</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link">2</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link">3</a>
                                                       </li>
                                                       <li class="page-item">
                                                            <a href="#" class="page-link"><i class="bx bx-right-arrow-alt"></i></a>
                                                       </li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <!-- end card -->
                         </div>
                         <!-- end col -->
                    </div> <!-- end row -->

               </div>
               <!-- End Container Fluid -->

               <!-- ========== Footer Start ========== -->
               <footer class="footer">
                   <div class="container-fluid">
                       <div class="row">
                           <div class="col-12 text-center">
                               <script>document.write(new Date().getFullYear())</script> &copy; Larkon. Crafted by <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon> <a
                                   href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Techzaa</a>
                           </div>
                       </div>
                   </div>
               </footer>
               <!-- ========== Footer End ========== -->

          </div>

          </main>
          @endsection