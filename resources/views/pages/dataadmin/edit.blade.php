@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="content-header">
        <div class="container-fluid">

          <div class="row">
            <div class="col-sm-6">
                <h4 class="fw-bold poppins m-0">
                    <button class="btn btn-sm btn-link p-0 me-1" onclick="history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi fw-bold bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                    </button>
                    Data Admin
                </h4>
            </div>
        </div>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Edit Data Admin
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dataadmin.update', ['dataadmin' => $admin->id, 'role' => $role]) }}" method="POST">
                              @method('PUT')
                                @csrf

                                @include('pages.dataadmin._editform')

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
