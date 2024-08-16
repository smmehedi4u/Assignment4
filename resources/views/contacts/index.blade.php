@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contacts</h1>

    <!-- Search and Sorting -->
    <form action="{{ route('contacts.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search by name or email" value="{{ request()->search }}">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add New Contact</a>

    <table class="table">
        <thead>
            <tr>
                <th><a href="{{ route('contacts.index', ['sort' => 'name', 'direction' => request()->get('direction') == 'asc' ? 'desc' : 'asc']) }}">Name</a></th>
                <th>Email</th>
                <th>Phone</th>
                <th><a href="{{ route('contacts.index', ['sort' => 'created_at', 'direction' => request()->get('direction') == 'asc' ? 'desc' : 'asc']) }}">Created At</a></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->created_at }}</td>
                    <td>
                        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}
</div>
@endsection
