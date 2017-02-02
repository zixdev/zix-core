<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$t('accounts.permissions.index')}}</h5>

            </div>
            <div class="ibox-content">
                <div class="row">
                    <h1 class="col-md-3">Type</h1>
                    <h1 class="col-md-2">View</h1>
                    <h1 class="col-md-2">Create</h1>
                    <h1 class="col-md-2">Update</h1>
                    <h1 class="col-md-2">Delete</h1>
                </div>
                <hr >
                <div v-for="type in types" class="row">
                    <h2 class="col-md-3 text-capitalize">
                        {{ type.replace('_', ' ')  }}
                    </h2>
                    <div v-for="permission in models[type]" class="col-md-2">
                        <div class="material-switch" :title="permission.name.replace('_', ' ').toUpperCase()">
                            <input :id="permission.name" v-model="permissions[permission.name]" type="checkbox"/>
                            <label :for="permission.name" class="label-info"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-priamry" @click="save()" :disabled="submitting">
                            <i v-if="submitting" class="fa fa-spinner fa-pulse"></i>
                            {{ $t('form.update') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import Component from 'vue-class-component'

    @Component
    export default class ManageRolePermissions {
        data() {
            return {
                models: [],
                types: [],
                permissions: {full_access:false},
                role: [],
                test: {
                	id: 1,
                    name: 'view_admin',
                    active: true
                },
                submitting: false
            }
        }

        save() {
        	this.submitting = true;
            this.$http.post(this.$store.state.config.api_url + 'roles/' + this.$route.params.id + '/permissions', this.permissions)
                .then(res => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: 'Role Permissions Was Updated Successfully!'
                    });
                    this.submitting = false;
                    this.$router.push({name: 'accounts.roles.index'});
                })
        }

        mounted() {
            // get all permissions
            this.$http.get(this.$store.state.config.api_url + 'roles/all/permissions')
                .then(response => {
                	let data = [];
                	let types = [];
                    let permissions = response.data.data;
                    permissions.map(permission => {
                        data[permission.type] = [];
                        types.push(permission.type)
                    });

                    permissions.map(permission => {
                        data[permission.type].push(permission);
                        this.permissions[permission.name] = permission.name;
                    });

                    this.types = types.filter((type, index, self) => {
                        return self.indexOf(type) === index;
                    });

                    this.models = data;
                });

            // get this role permissions
            this.$http.get(this.$store.state.config.api_url + 'roles/' + this.$route.params.id)
                .then(response => {
                    let role = response.data.data;
                    if(role.permissions.length) {
                        this.permissions = {full_access:false},
                        role.permissions.map(permission => {
                            this.permissions[permission.name] = permission.name;
                        });
                    }
                })
        }
    }
</script>
