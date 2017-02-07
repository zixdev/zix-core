<default-settings-security-password-screen inline-template>
    <div class="panel panel-default">
        <div class="panel-heading">Update Password</div>

        <div class="panel-body">
            <div class="alert alert-success" v-if="getError('message')">
                <strong>Great!</strong> Your password was successfully updated.
            </div>

            <form class="form-horizontal" role="form" @submit.prevent="update()">
                <div class="form-group" :class="{'has-error': getError('current_password')}">
                    <label class="col-md-4 control-label">
                        Current Password :
                    </label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" v-model="password.current_password">
                        <span class="help-block" v-show="getError('current_password')">
                            <strong>@{{ getError('current_password') }}</strong>
                        </span>
                    </div>

                </div>

                <div class="form-group" :class="{'has-error': getError('password')}">
                    <label class="col-md-4 control-label">
                        Password :
                    </label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" v-model="password.password">
                        <span class="help-block" v-show="getError('password')">
                            <strong>@{{ getError('password') }}</strong>
                        </span>
                    </div>

                </div>

                <div class="form-group" :class="{'has-error': getError('password_confirmation')}">
                    <label class="col-md-4 control-label">
                        Confirm Password :
                    </label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" v-model="password.password_confirmation">
                        <span class="help-block" v-show="getError('password_confirmation')">
                            <strong>@{{ getError('password_confirmation') }}</strong>
                        </span>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary"
                                :disabled="form.submitting">
                            <span v-if="form.submitting">
                                <i class="fa fa-btn fa-spinner fa-spin"></i> Updating
                            </span>

                            <span v-else>
                                <i class="fa fa-btn fa-save"></i> Update
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</default-settings-security-password-screen>
