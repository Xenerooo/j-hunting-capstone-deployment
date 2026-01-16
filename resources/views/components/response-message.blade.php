@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#2367d1',
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Failed!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
        });
    </script>
@endif
