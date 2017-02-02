<template>
    <form class="form-horizontal" @submit.prevent="save">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.enabled') }} :</label>
                    <div class="col-sm-9 material-switch">
                        <input id="maintenance_active" v-model="config.maintenance_active" type="checkbox"/>
                        <label for="maintenance_active" class="label-primary"></label>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.debug_mode') }} :</label>
                    <div class="col-sm-9 material-switch">
                        <input id="app_debug" v-model="config.app_debug" type="checkbox"/>
                        <label for="app_debug" class="label-primary"></label>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.maintenance_type') }} :</label>
                    <div class="col-sm-9">
                        <select class="form-control">
                            <option value="0">Completely Down</option>
                            <option value="1">Maintenance in Progress Banner Only</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $t('config.maintenance_message') }} :</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="6" v-model="config.maintenance_message"></textarea>
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
  export default class Maintenance {
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
