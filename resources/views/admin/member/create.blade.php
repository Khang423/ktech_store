@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Member
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            List
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Invite 
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form action="{{ route('admin.members.store') }}" method="post" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <h4 class="header-title mb-3">Information</h4>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Name"
                                                name="name" required>
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">Tel</label>
                                            <input type="text" class="form-control" id="phone" placeholder="Tel"
                                                name="phone" required>
                                            <div class="text-danger mt-1 error-phone"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Email" aria-describedby="inputGroupPrepend" required
                                                    name="email">
                                            </div>
                                            <div class="text-danger mt-1 error-email"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select" id="gender" name="gender" style="height: 48px">
                                                <option value="" hidden>Change Gender</option>
                                                <option value="0">Male</option>
                                                <option value="1">Female</option>
                                                <option value="2">Other</option>

                                            </select>
                                            <div class="text-danger mt-1 error-gender"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password" class="form-control"
                                                    placeholder="Password" required name="password">
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                            <div class="text-danger mt-1 error-password"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label fw-semibold">Birthday</label>
                                            <input type="text" id="datepicker" class="form-control" name="birthday"
                                                placeholder="Birthday">
                                            <div class="text-danger mt-1 error-birthday"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ward" class="form-label">Address</label>
                                            <div class="input-group">
                                                <textarea class="form-control" placeholder="Address" id="address" style="height: 100px" name="address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="avatar">Choose Avatar</label>
                                                    <input class="form-control" type="file" id="avatar"
                                                        name="avatar">
                                                    <div class="text-danger mt-1 error-avatar"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <img id="preview-avatar"
                                                        src="{{ asset('asset/admin/systemImage/avatar.png') }}"
                                                        alt="image" class="img-fluid avatar-lg rounded-circle">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="btn-store">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    <span>Invite Member</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/libraries/select2/custom_select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/libraries/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/libraries/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap5'
            });
            $('.select2').select2();

            $('#avatar').on('change', function() {
                const file = event.target.files[0];
                if (file) {
                    const previewUrl = URL.createObjectURL(file);
                    $('#preview-avatar').attr('src', previewUrl);
                }
            })

            $('#btn-store').click(function(e) {
                e.preventDefault();
                let form = $(this).parents('form');
                let form_data = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function() {
                        window.location.href = '{{ route('admin.members.index') }}';
                    },
                    error: function(data) {
                        $('.text-danger').text('');
                        if (data.responseJSON && data.responseJSON.errors) {
                            let errors = data.responseJSON.errors;
                            for (let field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    $(`.error-${field}`).text(errors[field][0]);
                                }
                            }
                        }
                    }
                });
            });

        });
    </script>
@endpush
