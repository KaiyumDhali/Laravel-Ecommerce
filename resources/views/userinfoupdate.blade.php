@extends('layout.app')

@section('content')
<section class="account-section py-5">
    <div class="container">
        <h1 class="text-center mb-4 display-4 text-uppercase">My Account</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card premium-card shadow-lg border-0">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Account Information</h2>
                        
                        <!-- Account Info Form -->
                        <form id="accountForm" method="post" action="{{ route('user.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-muted">First Name</h5>
                                    <input type="text" id="userName" class="form-control font-weight-bold" value="{{ session('user_name') }}" name="userName" required>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-muted">Last Name</h5>
                                    <input type="text" id="userLastName" class="form-control font-weight-bold" value="{{ session('user_lastname') }}" name="userLastName" required>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-muted">Email</h5>
                                    <input type="email" id="userEmail" class="form-control font-weight-bold" value="{{ session('email') }}" name="userEmail" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-muted">Phone</h5>
                                    <input type="text" id="userPhone" class="form-control font-weight-bold" value="{{ session('phone') }}" name="userPhone" required>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-muted">Address</h5>
                                    <input type="text" id="userAddress" class="form-control font-weight-bold" value="{{ session('address') }}" name="userAddress" required>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6" style="padding-top:20px;padding-bottom:100px;">
                                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block rounded-pill">Update Account</button>
                                </div>
                                <div class="col-md-6 "style="padding-top:20px;padding-bottom:100px;">
                                <a href="" class="btn btn-outline-secondary btn-lg btn-block rounded-pill">Change Password</a>
                            </div>
                            </div>
                        </form>

                        <!-- Alert Message -->
                        <div id="alertMessage" class="mt-4" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Section Styling */
    .account-section {
        background-color: #f4f6f9;
    }

    /* Premium Card Styling */
    .premium-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    /* Typography */
    h1 {
        letter-spacing: 3px;
        font-weight: 700;
        color: #2c3e50;
    }
    .card-title {
        font-size: 24px;
        font-weight: 600;
        color: #34495e;
    }
    .text-muted {
        font-size: 14px;
        color: #95a5a6;
    }
    .font-weight-bold {
        font-size: 16px;
        color: #2c3e50;
    }

    /* Button Styling */
    .btn-outline-primary, .btn-outline-secondary {
        border: 2px solid;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
        padding: 10px 20px;
    }
    .btn-outline-primary {
    border-color: #F65421;
    color: #F65421;
}
.btn-outline-primary:hover {
    background-color: #F65421;
    color: white;
}
    .btn-outline-secondary {
        border-color: #F65421;
        color: #F65421;
    }
    .btn-outline-secondary:hover {
        background-color: #F65421;
    color: white;
    }

    /* General Card Body Padding */
    .card-body {
        padding: 50px;
    }

    /* Responsive Breakpoint Styling */
    @media (max-width: 768px) {
        .card-body {
            padding: 30px;
        }
        .btn-lg {
            font-size: 14px;
            padding: 10px 15px;
        }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // AJAX Form Submission
        document.getElementById('accountForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch('{{ route('user.update') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1000,  // Auto close after 1500 ms
                         // Allows user to close the alert
                       
                      
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error updating the information!',
                          // Auto close after 1500 ms
                         // Allows user to close the alert
                        
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                      // Auto close after 1500 ms
                     // Allows user to close the alert
                   
                });
            });
        });
    });
</script>



@endsection
