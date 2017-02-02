<template>
    <form class="form-horizontal" @submit.prevent="save">
        <div class="row">
            <div class="col-md-12">
                <h1>Contact Email Sender</h1>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.name') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.forms_contact_from_name" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.email') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="email" v-model="config.forms_contact_from_email" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-12">
                <h1>General Settings</h1>
                <div class="hr-line-dashed"></div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Notify user that we receive him contact :</label>
                    <div class="col-sm-6 material-switch">
                        <input id="notify-user" v-model="config.forms_notifyUser" type="checkbox"/>
                        <label for="notify-user" class="label-primary"></label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-6 control-label">Notify admin when we receive new contact :</label>
                    <div class="col-sm-6 material-switch">
                        <input id="notify-admin" v-model="config.forms_notifyAdmin" type="checkbox"/>
                        <label for="notify-admin" class="label-primary"></label>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3" v-if="config.forms_notifyAdmin">
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Please Enter Admin Email"
                               v-model="config.forms_notifyAdminEmail" minlength="3" maxlength="255"/>
                    </div>
                <div class="hr-line-dashed"></div>

            </div>


        </div>

        <div class="row">
            <div class="col-md-12">
                <router-link class="btn btn-white" :to="{name: 'system.sites.index'}">{{ $t('form.cancel') }}</router-link>
                <button class="btn btn-primary" :disabled="form.submitting" type="submit">
                    <i class="fa fa-spinner fa-pulse" v-if="form.submitting"></i><span>{{ $t('form.save') }}</span>
                </button>
            </div>
        </div>
    </form>

</template>

<script>
    import Component from 'vue-class-component'

    @Component
    export default class ContactEmailSettings {
        data() {
            return {
                config: {},
                form: {
                    submitting: false
                },
            }
        }

        save() {
            this.form.submitting = true;

            this.$http.post(this.$store.state.config.api_url + 'sites/' + this.$route.params.id + '/config', this.config)
                .then(res => {
                    this.form.submitting = false;
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: this.$t('config.site_config'),
                        message: this.$t('config.config_success')
                    })
                })
        }

        mounted() {
            this.$events.$on('update-config', conf => this.config = conf)
        }
    }
</script>
