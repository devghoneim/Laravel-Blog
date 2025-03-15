@if ($errors->any())
<div class="alert alert-danger p-1">
    <ul>
        @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    title: "Success!",
    text: "{{ session('success') }}",
    icon: "success"
});
</script>
@endif