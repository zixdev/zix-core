<template>
    <form class="form-horizontal" @submit.prevent="save">
        <div class="row">
            <div class="col-md-12">
                <h3>Captcha</h3>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.public_key') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.captcha_public_key" required="" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.private_key') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.captcha_private_key" required="" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
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
  export default class Security {
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
