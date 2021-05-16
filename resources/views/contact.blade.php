@extends('layouts.app.extend')
@section('pageTitle', 'Contact')
@section('content')
    <div class="content full-height">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="main">
                        <h1>Get In Touch</h1>
                        <form method="POST" action="{{ route('contact.create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}" required="">
                                @error('name')
                                    <small class="error">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}" required="">
                                @error('email')
                                    <small class="error">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <input type="file" name="attachment" class="dropify" data-height="200"  data-max-file-size="200K" data-allowed-file-extensions="pdf xlsx csv"/>
                                @error('attachment')
                                    <small class="error">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message" value="{{old('message')}}" required=""></textarea>
                                @error('message')
                                    <small class="error">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-md" value="Send Message">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('.dropify').dropify();
        </script>
    @endpush
@endsection
