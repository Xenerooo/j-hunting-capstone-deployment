<table>
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Job Type</th>
            <th>City</th>
            <th>Date Joined</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employers as $e)
            <tr>
                <td>{{ $e->first_name }} {{ $e->mid_name }} {{ $e->last_name }} {{ $e->suffix }}</td>
                <td>{{ $e->account->email ?? 'N/A' }}</td>
                <td>{{ $e->account && $e->account->is_active ? 'Active' : 'Inactive' }}</td>
                <td>{{ $e->job_type }}</td>
                <td>{{ $e->city }}</td>
                <td>{{ $e->created_at->format('F d, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
