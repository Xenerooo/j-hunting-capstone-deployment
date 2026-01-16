<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Employer</th>
            <th>Date Posted</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jobs as $j)
            <tr>
                <td>{{ $j->title }}</td>
                <td>{{ $j->employer->first_name }} {{ $j->employer->mid_name }} {{ $j->employer->last_name }}
                    {{ $j->employer->suffix }}</td>
                <td>{{ $j->created_at->format('F d, Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
