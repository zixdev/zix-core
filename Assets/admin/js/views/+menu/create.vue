<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    <i class="fa fa-pencil"></i> {{ edit ? $t('menu.edit') : $t('menu.add') }}
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
                                   v-model="menu.name"
                                   required
                                   minlength="3"
                                   maxlength="255"
                                    >
                            <span v-if="form.errors && form.errors.name" class="help-block m-b-none text-danger">{{form.errors.name.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{ $t('table.sites') }} :
                        </label>

                        <div class="col-sm-10">

                            <multiselect
                                    :value="menu.sites"
                                    :options="sites"
                                    :multiple="true"
                                    :track-by="'id'"
                                    label="name"
                                    @input="updateSelected">
                            </multiselect>
                            <span v-if="form.errors && form.errors.sites" class="help-block m-b-none text-danger">{{form.errors.sites.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <router-link :to="{name: 'menu.all'}" class="btn btn-white">
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

<script type="text/babel">
    import Component from 'vue-class-component'
    import Multiselect from 'vue-multiselect'


    @Component({
        components: {
            Multiselect
        }
    })
    export default class Create {
        data() {
            return {
                menu: {
                    name: '',
                    sites: [],
                },
                form: {
                    errors: {}
                },
                sites: [],
            };
        }

        get edit() {
            return this.$route.params.id ? true : false;
        }


        mounted() {

            /*
             * When the route changes from edit to add
             * we need to update the page
             */
            this.$watch('edit', () => {
                this.menu = {
                    name: '',
                    sites: []
                };
                this.edit ? this.updateEditPage() : false;
            });


            /*
             * Load The Sites Data
             */
            this.$http.get('/api/sites')
                    .then(response => {
                        this.sites = response.data.data;
                    });


            this.edit ? this.updateEditPage() : false;
        }

        save() {
            this.form.submitting = true;
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(this.$store.state.config.api_url + 'menu', this.menu)
                    .then(response => {
                        this.$events.$emit('notify', {
                            type: 'info',
                            title: 'Success !',
                            message: 'Your Menu Was Created Successfully!'
                        });
                        this.$router.push({name: 'menu.all'})
                    })
                    .catch(error => {
                        this.$events.$emit('notify', {
                            type: 'warning',
                            title: 'Warning !',
                            message: 'Please Check your menu details!'
                        })
                        this.form.errors = error.data;
                        this.form.submitting = false;
                    });
        }

        update() {
            this.$http.put(this.$store.state.config.api_url + 'menu/' + this.$route.params.id, this.menu)
                    .then(response => {
                        this.$router.push({name: 'menu.all'});
                        this.$events.$emit('notify', {
                            type: 'info',
                            title: 'Success !',
                            message: 'Your Menu Was Updated Successfully!'
                        })
                    })
                    .catch(error => {
                        this.$events.$emit('notify', {
                            type: 'warning',
                            title: 'Warning !',
                            message: 'Please Check your menu details!'
                        })
                        this.form.errors = error.data;
                        this.form.submitting = false;
                    });
        }

        updateEditPage() {
            axios.get(this.$store.state.config.api_url + 'menu/' + this.$route.params.id)
                    .then(response => {
                        this.menu = response.data.data;
                    });
        }

        updateSelected(data) {
            this.menu.sites = data;
        }


    }
</script>
