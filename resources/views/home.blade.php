@extends ('template.template')

@section('content')

<section class="text-white container-fluid p-1 px-3">
    <div class="d-flex justify-content-center">
        <button class="btn btn-primary px-5 mb-4" id="addBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD</button>
    </div>

    <div class="row row-cols-1 row-cols-lg-3 gy-3">
        @foreach($to_dos as $todo)
        <div class="col">
            <div class="card {{$todo->status != 'complete' ? '' : 'text-bg-success'}} position-relative">
                <a href="/deletetodo?id={{$todo->id}}" class="jl-x-btn position-absolute top-0 end-0 pe-3">X</a>
                <div class="card-body">
                    <h5 class="card-title">{{$todo->title}}</h5>

                    <p class="card-text">{{$todo->description}}</p>
                    @if ($todo->status != 'complete')
                    <a href="/completetodo?id={{$todo->id}}" class="btn btn-success">Complete</a>
                    @endif
                    <a href="#" class="btn btn-primary update-btn" data-id="{{$todo->id}}" data-title="{{$todo->title}}" data-description="{{$todo->description}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitle">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/addtodo" method="post" id="modalForm">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input name="title" type="text" class="form-control" id="title" placeholder="Get a Job.">
                        <label for="floatingInput">Title</label>
                    </div>
                    <div class="form-floating">
                        <textarea name="description" class="form-control" placeholder="Leave a comment here" id="description"></textarea>
                        <label for="floatingTextarea">Description</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.update-btn').on('click', function() {
            let id = $(this).data('id');
            $('#title').val($(this).data('title'))
            $('#description').val($(this).data('description'))
            $('#modalTitle').text('UPDATE')
            $('#modalForm').attr('action', '/updatetodo?id=' + id)
        })

        $('#addBtn').on('click', function() {
            $('#title').val('')
            $('#description').val('')
            $('#modalTitle').text('ADD')
            $('#modalForm').attr('action', '/addtodo')
        })

    })
</script>
@endpush
