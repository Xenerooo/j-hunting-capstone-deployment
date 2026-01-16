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
        @foreach ($seekers as $s)
            <tr>
                <td>{{ $s->first_name }} {{ $s->mid_name }} {{ $s->last_name }} {{ $s->suffix }}</td>
                <td>{{ $s->account->email ?? 'N/A' }}</td>
                <td>{{ $s->account && $s->account->is_active ? 'Active' : 'Inactive' }}</td>
                <td>{{ $s->job_type }}</td>
                <td>{{ $s->city }}</td>
                <td>{{ $s->created_at->format('F d, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
