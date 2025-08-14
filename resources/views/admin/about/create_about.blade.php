@extends('admin.layout.app')

@section('title', 'Edit Company Information')

@section('content')
<main class="page-content bg-gray-100 min-h-screen py-10">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl p-8 relative overflow-hidden">
            
            {{-- Decorative gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-br from-teal-100 to-cyan-200 opacity-10 rounded-2xl"></div>

            <h1 class="text-2xl font-bold text-gray-700 mb-6 relative z-10 text-center">Edit Company Information</h1>
            
            @if(session('success'))
                <div class="bg-teal-100 text-teal-800 font-medium rounded-lg p-4 mb-6 relative z-10">
                    {{ session('success') }}
                </div>
            @endif

            <form action="" method="POST" class="space-y-5 relative z-10">
                @csrf
                @method('POST')

                <div>
                    <label for="company_name" class="block text-gray-700 font-semibold mb-1">Company Name</label>
                    <input type="text" name="company_name" id="company_name"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400"
                           value="{{ old('company_name', $companyInfo->company_name) }}" required>
                </div>

                <div>
                    <label for="mobile" class="block text-gray-700 font-semibold mb-1">Company Mobile</label>
                    <input type="text" name="mobile" id="mobile"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400"
                           value="{{ old('mobile', $companyInfo->mobile) }}" required>
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-1">Company Email</label>
                    <input type="text" name="email" id="email"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400"
                           value="{{ old('email', $companyInfo->email) }}" required>
                </div>

                <div>
                    <label for="mission" class="block text-gray-700 font-semibold mb-1">Mission</label>
                    <input type="text" name="mission" id="mission"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400"
                           value="{{ old('mission', $companyInfo->mission) }}" required>
                </div>

                <div>
                    <label for="vision" class="block text-gray-700 font-semibold mb-1">Vision</label>
                    <input type="text" name="vision" id="vision"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400"
                           value="{{ old('vision', $companyInfo->vision) }}" required>
                </div>

                <div>
                    <label for="values" class="block text-gray-700 font-semibold mb-1">Values</label>
                    <input type="text" name="values" id="values"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400"
                           value="{{ old('values', $companyInfo->values) }}" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-black font-semibold px-6 py-3 rounded-lg shadow-md transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
