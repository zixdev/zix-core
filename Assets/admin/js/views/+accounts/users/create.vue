<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    <i class="fa fa-pencil"></i> {{ edit ? $t('accounts.users.edit') : $t('accounts.users.add')}}
                </h5>
            </div>

            <div class="ibox-content">

                <form class="form-horizontal" @submit.prevent="save()">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{ $t('table.username') }} :
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text"
                                   v-model="user.username"
                                   required
                                   minlength="3"
                                   maxlength="255"
                            >
                            <span v-if="form.errors && form.errors.username" class="help-block m-b-none text-danger">{{form.errors.username.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{ $t('table.email') }} :
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email"
                                   v-model="user.email"
                                   required
                                   minlength="3"
                                   maxlength="255"
                            >
                            <span v-if="form.errors && form.errors.email" class="help-block m-b-none text-danger">{{form.errors.email.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div v-if="!edit">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ $t('table.password') }} :
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password"
                                       v-model="user.password"
                                       required
                                       minlength="3"
                                       maxlength="255"
                                >
                                <span v-if="form.errors && form.errors.password" class="help-block m-b-none text-danger">{{form.errors.password.toString()}}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ $t('table.password_confirmation') }} :
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password"
                                       v-model="user.password_confirmation"
                                       required
                                       minlength="3"
                                       maxlength="255"
                                >
                                <span v-if="form.errors && form.errors.password_confirmation" class="help-block m-b-none text-danger">{{form.errors.password_confirmation.toString()}}</span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <router-link :to="{name: 'accounts.users.index'}"  class="btn btn-white" >
                                {{ $t('form.cancel') }}
                            </router-link>
                            <button :disabled="form.submitting" class="btn btn-primary" type="submit">
                                <i v-if="form.submitting" class="fa fa-spinner fa-pulse"></i>
                                {{ edit ? $t('form.edit') : $t('form.create') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Component from 'vue-class-component'

    @Component
    export default class Create {
        data() {
            return {
                user: {
                    accept_terms: true
                },
                form: {
                    errors: {}
                }
            };
        }
        get edit() {
            return this.$route.params.id ? true : false;
        }
        created() {
            if(this.edit) {
                this.$http.get(this.$store.state.config.api_url + 'users/' + this.$route.params.id)
                    .then(response => {
                        this.user = response.data.data;
                    });
            }
        }

        save() {
            this.form.submitting = true;
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(this.$store.state.config.api_url + 'users', this.user)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: 'User Account Was Created Successfully!'
                    });
                    this.$router.push({name: 'accounts.users.index'});
                })
                .catch(error => {
                    this.form.errors = error.data;
                    this.form.submitting = false;
                });
        }

        update() {
            this.$http.put(this.$store.state.config.api_url + 'users/' + this.$route.params.id, this.user)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: 'User Account Was Updated Successfully!'
                    });
                    this.$router.push({name: 'accounts.users.index'});
                })
                .catch(error => {
                    this.form.errors = error.data;
                    this.form.submitting = false;
                });
        }
    }
</script>
