<x-layout>
    <x-slot:heading>
        User profile
    </x-slot:heading>
    <h1 class="font-bold text-lg">{{$user->name}}'s profile</h1>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
        <!-- User Profile Header -->
        <div class="flex items-center mb-6">
            <img class="w-16 h-16 rounded-full border-2 border-gray-300" src="https://via.placeholder.com/150" alt="User Profile Picture">
            <div class="ml-4">
                <h1 class="text-2xl font-bold text-gray-900">{{$user->name}}</h1>
                <p class="text-gray-600">{{$user->email}}</p>
            </div>
        </div>

        <!-- User Information -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Profile Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <label class="text-gray-600 font-medium mb-1" for="name">User name</label>
                    <input type="text" id="name" value="{{$user->name}}" disabled class="bg-gray-200 p-2 rounded border border-gray-300">
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-medium mb-1" for="email">Email address</label>
                    <input type="text" id="email" value="{{$user->email}}" disabled class="bg-gray-200 p-2 rounded border border-gray-300">
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-600 font-medium mb-1" for="email_verified_at">Email Verified</label>
                    <input type="text" id="email_verified_at" value="{{$user->email_verified_at->format('Y-m-d')}}" disabled class="bg-gray-200 p-2 rounded border border-gray-300">
                </div>
            </div>
        </div>

    </div>
</x-layout>
