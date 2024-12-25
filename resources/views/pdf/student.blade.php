<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
        padding: 5px;
    }
    #title {
        text-align: center;
    }
</style>
<div id="title">
    <h1>Student List</h1>
    <p>Generated at: {{now()}}</p>
</div>
<table border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Class</th>
            <th>Dob</th>
        </tr>
    </thead>
    <tbody>
        @forelse($students as $key => $student)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$student->user->username}}</td>
                <td>{{$student->full_name}}</td>
                <td>{{$student->email}}</td>
                <td>{{$student->phone}}</td>
                <td>{{$student->class}}</td>
                <td>{{$student->dob}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No students found</td>
            </tr>
        @endforelse
    </tbody>
</table>