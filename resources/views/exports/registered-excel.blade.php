<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Active Account</th>
            <th>Verified</th>
            <th>Approved</th>
            <th>Registered At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->account_id }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->user_type }}</td>
                <td>{{ $user->is_active ? 'Yes' : 'No' }}</td>
                <td>{{ $user->is_verified ? 'Yes' : 'No' }}</td>
                <td>{{ $user->is_approved ? 'Yes' : 'No' }}</td>
                <td>{{ $user->created_at->format('F d, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
