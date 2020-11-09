@extends('/layouts.app')

@section('title')
Create Post
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Create a new Post
                    </div>
                </div>
                <div class="card-body">
                    <form action="/p" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="caption" class="col-md-4 col-form-label text-md-right">Post Caption</label>

                            <div class="col-md-6">
                                <input id="caption" type="text"
                                    class="form-control @error('caption') is-invalid @enderror" name="caption"
                                    value="{{ old('caption') }}" autocomplete="caption" autofocus>

                                @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Post Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file"
                                    class="form-control-file @error('image') is-invalid @enderror" name="image">

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>
    </div>
</div>
@endsection