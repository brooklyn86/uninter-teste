@if(session('success'))
<script>
    Swal.fire({
    title: 'Done!',
    text: "{{ session('success') }}",
    icon: 'success',
    confirmButtonText: 'Fechar'
    })
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
    title: 'Falha!',
    text: "{{ session('error') }}",
    icon: 'error',
    confirmButtonText: 'Fechar'
    })
</script>
@endif
@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif