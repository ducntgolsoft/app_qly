@extends('Layout.Site')

@section('content')
    <div class="border-b pb-3 flex justify-between">
        <h1 class="text-2xl font-bold">Student Manager</h1>
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('students.create')}}">Add Student</a>
    </div>
    <div class="mt-5">
        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border">ID</th>
                    <th class="border">Name</th>
                    <th class="border">Email</th>
                    <th class="border">Phone</th>
                    <th class="border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td class="border">{{$student->id}}</td>
                        <td class="border">{{$student->name}}</td>
                        <td class="border">{{$student->email}}</td>
                        <td class="border">{{$student->phone}}</td>
                        <td class="border">
                            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" href="{{route('students.edit', $student->id)}}">Edit</a>
                            <form action="{{route('students.delete', $student->id)}}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border text-center">No students found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection