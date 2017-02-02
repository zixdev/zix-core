<template>
    <form class="form-horizontal" @submit.prevent="save">
        <div class="row">
            <div class="col-md-12">
                <h1>Email Sender</h1>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.name') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.mail_from_name" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.email') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.mail_from_address" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-12">
                <h1>Driver<small class="text-uppercase">({{ config.mail_driver }})</small></h1>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.mail_system') }}</label>
                    <div class="col-sm-9">
                        <select class="form-control" type="text" v-model="config.mail_driver">
                            <option value="smtp">SMTP</option>
                            <option value="mail">MAIL</option>
                            <option value="sendmail">SENDMAIL</option>
                            <option value="mailgun">MAILGUN</option>
                            <option value="mandrill">MANDRILL</option>
                            <option value="sparkpost">SPARKPOST</option>
                            <option value="ses">SES</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
        </div>
        <div class="row" v-if="config.mail_driver == 'smtp'">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.smtp.host') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.mail_host" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.smtp.port') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.mail_port" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label" :title="$t('config.email')">{{ $t('config.smtp.username') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.mail_username" :title="$t('config.email')" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.smtp.password') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" v-model="config.mail_password" minlength="3" maxlength="255"/>
                    </div>
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
  export default class EmailSettings {
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
