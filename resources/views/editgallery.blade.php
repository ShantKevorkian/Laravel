@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('gallery.update', ['id' => $gallery->id]) }}" enctype="multipart/form-data">
                            @csrf

                            @method('PUT')
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $gallery->title }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pImage" class="col-md-4 col-form-label text-md-right">{{ __('Multiple image') }}</label>
                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="gallery[]" id="gallery" multiple>
                                        @foreach ($errors->all() as $error)
                                            <strong class="text-danger">{{ $error }}</strong>
                                        @endforeach
                                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div>
                <form method="POST" action="{{ route('gallery.delete', ['id' => $gallery->id]) }}">
                    @csrf

                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <h3 class="card-header w-100 d-flex justify-content-center mb-3">Gallery Images</h3>
            @if($gallery->galleryImages->isEmpty())
                <h2 class = "text-secondary m-auto">No images in this gallery</h2>
            @endif
            @foreach($gallery->galleryImages as $images)
                <div class="col-md-4">
                    <div class="text-right mr-5">
                        <form method="POST" action="{{ route('images.delete', ['id' => $images->id]) }}">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="btn btn-white">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('storage/'.$images->path) }}" alt='avatar' class = 'img-fluid rounded-circle' style = "object-fit: cover; width: 200px; height: 200px;">
                    </div>
                    <strong class="d-flex justify-content-center">{{ $images->original_name }}</strong>
                </div>
            @endforeach
        </div>
    </div>
@endsection
