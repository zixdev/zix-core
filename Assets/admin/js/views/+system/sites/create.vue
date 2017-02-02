<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    <i class="fa fa-pencil"></i> {{ edit ? $t('system.sites.edit') : $t('system.sites.add')}}
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
                                   v-model="site.name"
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
                            {{ $t('table.url') }} :
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text"
                                   v-model="site.url"
                                   required
                                   minlength="3"
                                   maxlength="255"
                                    >
                            <span v-if="form.errors && form.errors.url" class="help-block m-b-none text-danger">{{form.errors.url.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{ $t('table.ui') }} :
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text"
                                   v-model="site.ui"
                                   required
                                   minlength="3"
                                   maxlength="255"
                                    >
                            <span v-if="form.errors && form.errors.ui" class="help-block m-b-none text-danger">{{form.errors.ui.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <router-link :to="{name: 'system.sites.index'}"  class="btn btn-white" >
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

    @Component
    export default class Create {
        data() {
            return {
                site: {},
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
                this.$http.get(this.$store.state.config.api_url + 'sites/' + this.$route.params.id)
                        .then(response => {
                            this.site = response.data.data;
                        });
            }
        }

        save() {
            this.form.submitting = true;
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(this.$store.state.config.api_url + 'sites', this.site)
                    .then(response => {
                        this.$router.push({name: 'system.sites.index'});
                    })
                    .catch(error => {
                        this.form.errors = error.data;
                        this.form.submitting = false;
                    });
        }

        update() {
            this.$http.put(this.$store.state.config.api_url + 'sites/' + this.$route.params.id, this.site)
                    .then(response => {
                        this.$router.push({name: 'system.sites.index'});
                    })
                    .catch(error => {
                        this.form.errors = error.data;
                        this.form.submitting = false;
                    });
        }
    }
</script>
