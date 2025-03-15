@extends('layout.app')

@section('content')
    <div class="col-12">
        <h1 class="my-3 text-center">
             Update Tag
        </h1>

        <div class="col-6 m-auto">
            <form action="{{ route('tags.update',$tag->id) }}" id="send-data" class="form border p-3" method="POST">
                @csrf
                @method('PUT')
                {{-- @include('inc.message') --}}
                <div class="alert  d-none" id="show-message"></div>

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $tag->name }}" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Add" class="bg-success text-white form-control">
                </div>
            </form>
        </div>

    </div>
@endsection

@section('script')

<script>

    let formElement = document.getElementById('send-data');
    let messageElement = document.getElementById('show-message');

    formElement.addEventListener('submit',function(e){
        e.preventDefault();
        let token = document.querySelector('input[name=_token]').value
        let inputName = document.querySelector('input[name=name]').value
        
        fetch(formElement.action ,{

            method:"PUT",
            headers:{
                'X-CSRF-TOKEN':token,
                'Accept':"application/json",
                'Content-Type':"application/json"
            },
            body: JSON.stringify({name:inputName})


        }).then(res=>{
            return res.json();
        }).then(data=>{
            messageElement.classList.remove('d-none');
            if (data['status']) {
                messageElement.classList.add('alert-success')


            }else
            {
                messageElement.classList.add('alert-danger');
            }

            messageElement.textContent=data.message

        })

    })



</script>
@endsection