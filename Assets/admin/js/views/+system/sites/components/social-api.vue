<template>
    <form class="form-horizontal" @submit.prevent="save">
        <div class="row">
            <div class="col-md-6" v-for="social of socials">
                <h1 class="text-center"><small>{{ social.name }} :</small></h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ $t('config.app_id') }} :</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" v-model="config[social.id + &quot;_clientId&quot;]" minlength="3" maxlength="255"/>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ $t('config.app_secret') }} :</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" v-model="config[social.id + &quot;_clientSecret&quot;]" minlength="3" maxlength="255"/>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                    </div>
                </div>
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
  export default class SocialApi {
    data() {
      return {
        config: {},
        form: {
            submitting: false
        },
        socials: [
          {
            id: 'services_facebook',
            name: 'Facebook'
          },
          {
            id: 'services_twitter',
            name: 'Twitter'
          },
          {
            id: 'services_google',
            name: 'Google Plus'
          },
          {
            id: 'services_github',
            name: 'Github'
          },
        ]
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
