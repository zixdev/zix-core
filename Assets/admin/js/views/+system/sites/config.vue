<template>

    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#general" aria-controls="home" role="tab" data-toggle="tab">
                            <i class="fa fa-book"></i> General
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#security" aria-controls="profile" role="tab" data-toggle="tab">
                            <i class="fa fa-lock"></i> Security
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#seo" aria-controls="profile" role="tab" data-toggle="tab">
                            <i class="fa fa-search"></i> Search Engine Optimization
                        </a>
                    </li>
                    <li class="dropdown" role="presentation">
                        <a class="dropdown-toggle"  id="email-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-envelope"></i>
                            Emails
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="email-menu">
                            <li><a href="#email-settings" aria-controls="profile" role="tab" data-toggle="tab"> Email Settings</a></li>
                            <li><a href="#contact-email-settings" aria-controls="profile" role="tab" data-toggle="tab"> Contact Email Settings</a></li>

                        </ul>
                    </li>

                    <li role="presentation">
                        <a href="#social-api" aria-controls="profile" role="tab" data-toggle="tab">
                            <i class="fa fa-share-alt"></i> Social API
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#maintenance" aria-controls="profile" role="tab" data-toggle="tab">
                            <i class="fa fa-share"></i> Maintenance
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="general">
                        <general></general>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="security">
                        <security></security>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="seo">
                        <seo></seo>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="contact-email-settings">
                        <contact-email-settings></contact-email-settings>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="email-settings">
                        <email-settings></email-settings>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="social-api">
                        <social-api></social-api>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="maintenance">
                        <maintenance></maintenance>
                    </div>


                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Component from 'vue-class-component'
    import General from './components/general'
    import Security from './components/security'
    import EmailSettings from './components/email-settings'
    import ContactEmailSettings from './components/contact-email-settings'
    import SocialApi from './components/social-api'
    import Maintenance from './components/maintenance'
    import Seo from './components/seo'

    @Component({
        components: {
            General, Security, EmailSettings, SocialApi, Maintenance, Seo, ContactEmailSettings
        }
    })
    export default class Index {
        data() {
            return {
                config: {}
            };
        }
        mounted() {
            this.$http.get(this.$store.state.config.api_url + 'sites/' + this.$route.params.id + '/config')
                    .then(response => {
                        let data = response.data.data;
                        data.map(config => {
                            this.config[config.key] = config.value;
                        });
                        this.$events.$emit('update-config', this.config);
                    });
        }
    }
</script>
<style scoped>
    .tab-content {
        margin-top: 15px;
    }
</style>
