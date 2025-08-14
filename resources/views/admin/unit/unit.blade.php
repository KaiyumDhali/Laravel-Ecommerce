@extends('admin.layout.app')

@section('title', 'Product List')

@section('content')

<main>
    <div class="page-content">
        <div class="container-xxl">
            <section class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-4">
                         <div class="card-header bg-light text-white text-center">
                        <h4 class="mb-0">Create New Unit</h4>
                        </div>
                        <div class="card-body p-5">
                       

                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Form Start -->
                            <form method="POST" action="{{ route('add.unit') }}">
                                    @csrf

                                    <div>
                                    
                                        <div class="col-md-3 lebel">
                                            <label>Unit name</label>
                                        </div>
                                        <div class="col-md-9 mb-4 " >
                                            <input class="input-f form-control" type="text" name="unit" placeholder="Unit name" value="">
                                            
                                        </div>


                                        <div class="col-md-4"></div>
                                        <!-- <div class="col-md-4">
                                            <button style="font-size: 18px; margin-top:20px; margin-bottom: 50px; background-color: #33ffda; width:60%; height:40px; border-radius:5px; border:none;">
                                                Save
                                            </button>
                                        </div> -->
                                          {{-- Submit Button --}}
                            <div class="d-flex justify-content-end gap-2 col-md-9 text-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                                    
                                    </div>
                                </form>
                            <!-- Form End -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- JavaScript to Toggle Parent Category -->
<script>
    function toggleSelectBox(checkbox) {
        document.getElementById('selectBox').hidden = !checkbox.checked;
    }
</script>

@endsection
