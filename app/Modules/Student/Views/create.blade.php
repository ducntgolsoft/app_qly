@extends('Layout.Site')

@section('content')
    <div class="border-b pb-3">
        <h1 class="text-2xl font-bold">Student Create</h1>
    </div>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Username
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="username" name="username" type="text" placeholder="Username">
            @error('username')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="full_name">
                Full Name
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="full_name" name="full_name" type="text" placeholder="Full Name">
            @error('full_name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="class">
                Class
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="class" name="class" type="text" placeholder="Class">
            @error('class')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">
                Date of Birth
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="dob" name="dob" type="date" placeholder="Date of Birth">
            @error('dob')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="email" name="email" type="email" placeholder="Email">
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                Phone
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="phone" name="phone" type="text" placeholder="Phone">
            @error('phone')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <a class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2.5 px-4 rounded mr-2" href="{{ route('students.index') }}">
                Back
            </a>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                Create
            </button>
        </div>
    </form>
@endsection