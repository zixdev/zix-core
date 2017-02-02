<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    <i class="fa fa-pencil"></i> {{ edit ? $t('accounts.roles.edit') : $t('accounts.roles.create')}}
                </h5>
            </div>

            <div class="ibox-content">

                <form class="form-horizontal" @submit.prevent="save()">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{ $t('table.name') }} :
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text"
                                   v-model="role.name"
                                   required
                                   minlength="3"
                                   maxlength="255"
                            >
                            <span v-if="form.errors && form.errors.name" class="help-block m-b-none text-danger">{{form.errors.name.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <router-link :to="{name: 'accounts.roles.index'}"  class="btn btn-white" >
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
                role: {
                    name: ''
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
                this.$http.get(this.$store.state.config.api_url + 'roles/' + this.$route.params.id + '/edit')
                    .then(response => {
                        this.role = response.data.data;
                    });
            }
        }

        save() {
            this.form.submitting = true;
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(this.$store.state.config.api_url + 'roles', this.role)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: 'Role Was Create Successfully, Please Select it\'s Permissions!'
                    });
                    this.$router.push({name: 'accounts.permissions.index', params: {id: response.data.data.id}});
                })
                .catch(error => {
                    this.form.errors = error.data;
                    this.form.submitting = false;
                });
        }

        update() {
            this.$http.put(this.$store.state.config.api_url + 'roles/' + this.$route.params.id, this.role)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: 'Role Was Updated Successfully!'
                    });
                    this.$router.push({name: 'accounts.roles.index'});
                })
                .catch(error => {
                    this.form.errors = error.data;
                    this.form.submitting = false;
                });
        }
    }
</script>
