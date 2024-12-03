<link rel="stylesheet" href="{{ asset('dataTables.bootstrap5.') }}" />



<script src="{{ asset('dataTables.') }}"></script>
<script src="{{ asset('dataTables.bootstrap5.') }}"></script>

<script>
    $(document).ready(function() {
        new DataTable('.datatable');
    });
</script>
