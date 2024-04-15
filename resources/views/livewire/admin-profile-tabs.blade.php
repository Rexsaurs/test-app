<div>
    <div class="profile-tab height-100-p">
        <div class="tab height-100-p">
            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item">
                    <a wire:click.prevent='selectTab("personal_details")'
                        class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}" data-toggle="tab"
                        href="#personal_details" role="tab">Personal details</a>
                </li>
                <li class="nav-item">
                    <a wire:click.prevent='selectTab("update_password")'
                        class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}" data-toggle="tab"
                        href="#update_password" role="tab">Update Password</a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Timeline Tab start -->
                <div class="tab-pane fade {{ $tab == 'personal_details' ? 'active show' : '' }}" id="personal_details"
                    role="tabpanel">
                    <div class="pd-20">
                        <form wire:submit.prevent='updateAdminPersonalDetails()'>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" wire:model='name'
                                            placeholder="Enter Full Name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" wire:model='email'
                                            placeholder="Enter email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" wire:model='username'
                                            placeholder="Enter Username">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
                <!-- Timeline Tab End -->
                <!-- Tasks Tab start -->
                <div class="tab-pane fade {{ $tab == 'update_password' ? 'active show' : '' }}" id="update_password"
                    role="tabpanel">
                    <div class="pd-20 profile-task-wrap">
                        <form wire:submit.prevent='changePassword()'>
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="New Password"
                                name="new_password" wire:model='new_password'>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            @error('new_password')
                                <div class="d-block text-danger" style="margin-top:-25px; margin-bottom:15px;">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Confirm New Password"
                                name="new_password_confirmation" wire:model='new_password_confirmation'>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            @error('new_password_confirmation')
                                <div class="d-block text-danger" style="margin-top:-25px; margin-bottom:15px;">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0">
                
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Tasks Tab End -->
            </div>
        </div>
    </div>
</div>