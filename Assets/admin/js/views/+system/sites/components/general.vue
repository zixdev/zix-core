<template>
    <form class="form-horizontal" @submit.prevent="save">
        <div class="row">
            <div class="col-md-12">
                <h3>Basic Information</h3>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.site_title') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.app_name" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" :title="$t('config.company_name')">{{ $t('config.company') }}</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.company_name" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.keywords') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.site_keywords" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.description') }} :</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" v-model="config.site_description" rows="6"></textarea>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.email') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="email" v-model="config.site_contact_email" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.phone') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.site_contact_phone" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.fix') }} :</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" v-model="config.site_contact_fix" minlength="3" maxlength="255"/>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.address') }} :</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" v-model="config.site_contact_address" rows="6"></textarea>
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

<script type="text/babel">
  import Component from 'vue-class-component'

  @Component
  export default class General {
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
