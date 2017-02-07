<default-settings-profile-basics-screen inline-template>
    <div class="panel panel-default">
        <div class="panel-heading">The Basics</div>

        <div class="panel-body">
            <div class="alert alert-success" v-if="getError('message')">
                <i class="fa fa-btn fa-check-circle"></i>
                @{{ getError('message') }}
            </div>

            <form class="form-horizontal" role="form" @submit.prevent="updateProfile()">
                <div class="form-group" :class="{'has-error': getError('username')}">
                    <label class="col-md-4 control-label">
                        Username
                    </label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" v-model="user.username">
                        <span class="help-block" v-show="getError('username')">
                            <strong>@{{ getError('username') }}</strong>
                        </span>
                    </div>

                </div>

                <div class="form-group" :class="{'has-error': getError('email')}">
                    <label class="col-md-4 control-label">
                        E-Mail Address
                    </label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" v-model="user.email">
                        <span class="help-block" v-show="getError('email')">
                            <strong>@{{ getError('email') }}</strong>
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
</default-settings-profile-basics-screen>

