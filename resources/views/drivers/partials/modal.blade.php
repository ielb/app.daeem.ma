<div class="modal fade" id="modal-change-passowrd" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>{{__('Notice that you\'ll be logged out')}}</small>
                        </div>
                        <form method="post" role="form" action="{{ route('update.password', $driver) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3 {{ $errors->has('current_password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" id="current_password" placeholder="Current password" type="password">
                                    @if ($errors->has('current_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-3 {{ $errors->has('new_password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control {{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" id="new_password" placeholder="New password" type="password">
                                    @if ($errors->has('new_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="new_confirm_password" id="new_confirm_password" placeholder="Confirm password" type="password">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>