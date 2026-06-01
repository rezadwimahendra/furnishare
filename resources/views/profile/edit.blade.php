@extends('layouts.customer')

@section('title', 'Profil Saya - Furnishare')

@section('content')
    <section class="py-16 bg-[#FDFCFB] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="serif-title text-3xl font-bold text-gray-900 mb-10 border-b border-gray-200 pb-4">
                {{ __('Pengaturan Profil') }}
            </h1>

            <div class="grid grid-cols-1 gap-8 max-w-4xl">
                <!-- Update Profile Information -->
                <div class="p-8 bg-white border border-gray-100 shadow-sm sm:rounded-2xl relative overflow-hidden group hover:shadow-md transition duration-300">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-[#C5A880]"></div>
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="p-8 bg-white border border-gray-100 shadow-sm sm:rounded-2xl relative overflow-hidden group hover:shadow-md transition duration-300">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-gray-300"></div>
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="p-8 bg-[#FAF8F5] border border-red-100 shadow-sm sm:rounded-2xl mt-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
