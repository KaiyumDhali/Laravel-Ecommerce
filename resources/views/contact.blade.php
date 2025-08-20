@extends('layout.app')

@section('title', 'Contact Us')

@section('content')
<section class="contact-section" style="background-color: #f4f6f9; padding: 60px 0;">
    <div class="container">
        <h1 class="text-center mb-5" style="font-weight:700; font-size:40px;">Contact Us</h1>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-default" style="padding:30px; background:#fff; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.05);">
                    <h3 class="panel-title" style="margin-bottom:20px; font-weight:bold;">Get In Touch</h3>
                    <form action="" method="POST" id="contactForm">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="message" rows="5" placeholder="Type your message here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" style="border-radius:50px; padding:12px 0; margin-top:10px;">Send Message</button>
                    </form>
                </div>
            </div>

            <!-- Contact Info & Map -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-default" style="padding:30px; background:#fff; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.05); margin-bottom:20px;">
                    <h3 class="panel-title" style="margin-bottom:20px; font-weight:bold;">Contact Info</h3>
                    <p><i class="glyphicon glyphicon-map-marker text-primary"></i> <strong>Address:</strong> {{$company_info->company_address}}</p>
                    <p><i class="glyphicon glyphicon-envelope text-primary"></i> <strong>Email:</strong> {{$company_info->email}}</p>
                    <p><i class="glyphicon glyphicon-earphone text-primary"></i> <strong>Phone:</strong> {{$company_info->mobile}}</p>
                    <p><i class="glyphicon glyphicon-time text-primary"></i> <strong>Working Hours:</strong> Mon - Fri, 9:00 AM - 6:00 PM</p>
                </div>

                <!-- Google Map -->
                <div class="panel panel-default" style="overflow:hidden; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.05);">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.902547366965!2d90.4008!3d23.8103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf3a1a66e8e3%3A0x7e3dfd5e5c2e8f0!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1692265600000!5m2!1sen!2sbd" 
                        width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
