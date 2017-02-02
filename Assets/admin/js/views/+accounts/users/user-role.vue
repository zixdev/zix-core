<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    <i class="fa fa-user-secret"></i> {{ $t('accounts.users.roles')}}
                </h5>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" @submit.prevent="save()">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            User Roles :
                        </label>
                        <div class="col-sm-10">
                            <multiselect
                                :value="user_roles"
                                :options="roles"
                                :multiple="true"
                                key="id"
                                label="name"
                                @input="updateSelected">
                            </multiselect>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <router-link :to="{name: 'pages.all'}" class="btn btn-white">
                                {{ $t('form.cancel') }}
                            </router-link>
                            <button :disabled="form.submitting" class="btn btn-primary" type="submit">
                                <i v-if="form.submitting" class="fa fa-spinner fa-pulse"></i>
                                {{  $t('form.update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
	import Component from 'vue-class-component'
    import Multiselect from 'vue-multiselect'

	@Component({
        components: {
            Multiselect
        }
    })
	export default class UserRole {
		data() {
			return {
				roles: [],
                user_roles: [],
                form: {
                    errors: {}
                },
            }
        }
        save() {
			this.form.submitting = true;
            this.$http.post(this.$store.state.config.api_url + 'users/' + this.$route.params.id + '/roles', {roles: this.user_roles})
                .then(res => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: 'User Roles Was Update Successfully!'
                    });
                    this.$router.push({name: 'accounts.users.index'});
                });
        }

		mounted() {
            // get this user roles
            this.$http.get(this.$store.state.config.api_url + 'roles')
                .then(res => {
                    this.roles = res.data.data;
                });
            // get all available roles
            this.$http.get(this.$store.state.config.api_url + 'users/' + this.$route.params.id + '/roles')
                .then(res => {
                    this.user_roles = res.data.data.roles;
                });
        }
        updateSelected(data) {
            this.user_roles = data;
        }
	}
</script>
