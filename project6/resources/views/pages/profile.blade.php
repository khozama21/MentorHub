@extends('pages.layout')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <section>
        <div class="container py-5">

            {{-- {{ route('profile.edit',Auth::user()->id) }} --}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">

                            @if (session('success'))
                                <div>{{ session('success') }}</div>
                            @endif

                            <img style="width: 180px;border-radius: 15%"
                                src="{{ asset('uploads/images/' . Auth::user()->img) }}" alt="image"
                                class="img-fluid">
                            <h5 class="my-3">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-1">{{ Auth::user()->email }}</p>
                            <p class="text-muted mb-3">{{ Auth::user()->mentor_about }}</p>

                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{ route('profile.show', Auth::user()->id) }}" type="button"
                                    class="btn btn-primary">Edit Profile </a>
                                {{-- <button type="button" class="btn btn-outline-primary ml-2">Delete Profile</button> --}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->name }} </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">About</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->mentor_about }}</p>
                                </div>
                            </div>

                        </div>
                        <div class="card mb-4 mb-lg-0">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush rounded-3">

                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                        <p class="mb-0">https://twitter.com</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-instagram fa-lg" style="color: #630821;"></i>
                                        <p class="mb-0">https://www.instagram.com</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                        <p class="mb-0">https://web.facebook.com</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center  p-3">
                                        <a type="button" class="btn btn-primary " style='margin-left:570px'
                                            href="{{ route('course.create') }}">{{ __('Add Course') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            
            @endif
            @php
                use App\Models\mentor_application;
                
                $app = mentor_application::all()->where('mentor_id', Auth::user()->id);
                
            @endphp
            @if (count($app))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h5 class="box-title">Accepted Applicants</h5>

                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead style="background-color: #343a40; color: #fff;">
                                        <tr>
                                            <th class="border-top-0 " style="color: #fff;">Name </th>
                                            <th class="border-top-0" style="color: #fff;"> Email </th>
                                            <th class="border-top-0" style="color: #fff;"> Date of Birth </th>
                                            <th class="border-top-0" style="color: #fff;">Education</th>
                                            <th class="border-top-0" style="color: #fff;">Purpose</th>
                                            <th class="border-top-0" style="color: #fff;">Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($app as $value)
                                            <tr>
                                                <td>{{ $value->name }}</td>

                                                <td><a href="mailto:{{ $value->email }}">{{ $value->email }}</a></td>
                                                <td>{{ $value->age }}</td>
                                                <td>{{ $value->education }}</td>
                                                <td class="text-wrap">{{ $value->purpose }}</td>

                                                <td>
                                                    <form method="post" action="/mapp/{{ $value->id }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-danger btn-flat show_confirm"
                                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                                    </form>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if (Session('message'))
                                    <div style="background-color:aquamarine;width:290px">
                                        <h3>{{ Session('message') }}</h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this applicant?`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
