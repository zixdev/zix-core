<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$t('forms.contact.reply')}}</h5>

            </div>
            <div class="ibox-content">
                <table class="table">
                    <tbody>
                    <tr>
                        <td><strong class="pull-right">{{ $t('table.name') }} :</strong></td>
                        <td>{{ contact.name }}</td>
                    </tr>
                    <tr>
                        <td><strong class="pull-right">{{ $t('table.email') }} :</strong></td>
                        <td>{{ contact.email }}</td>
                    </tr>
                    <tr>
                        <td><strong class="pull-right">{{ $t('table.phone') }} :</strong></td>
                        <td>{{ contact.phone }}</td>
                    </tr>
                    <tr>
                        <td><strong class="pull-right">{{ $t('table.address') }} :</strong></td>
                        <td>{{ contact.address }}</td>
                    </tr>

                    <tr>
                        <td><strong class="pull-right">{{ $t('table.subject') }} :</strong></td>
                        <td>{{ contact.subject }}</td>
                    </tr>
                    <tr>
                        <td><strong class="pull-right">{{ $t('table.message') }} :</strong></td>
                        <td>{{ contact.message }}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <div class="hr-line-dashed"></div>
                <h2 class="text-center">{{ $t('form.send_reply') }}</h2>
                <div class="hr-line-dashed"></div>
                <form class="form-horizontal" @submit.prevent="save()">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{ $t('table.subject') }} :
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text"
                                   v-model="reply.subject"
                                   required
                                   minlength="3"
                                   maxlength="255"
                            >
                            <span v-if="form.errors && form.errors.subject" class="help-block m-b-none text-danger">{{form.errors.subject.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            {{ $t('table.message') }} :
                        </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="6"
                                v-model="reply.message"
                            ></textarea>
                            <span v-if="form.errors && form.errors.message" class="help-block m-b-none text-danger">{{form.errors.message.toString()}}</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <router-link :to="{name: 'accounts.roles.index'}"  class="btn btn-white" >
                                {{ $t('form.cancel') }}
                            </router-link>
                            <button :disabled="form.submitting" class="btn btn-primary" type="submit">
                                <i v-if="form.submitting" class="fa fa-spinner fa-pulse"></i>
                                {{ $t('form.reply') }}
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
    export default class ContactReply {
        data() {
            return {
                contact: {},
                reply: {
                    message: '',
                    subject : ''
                },
                form: {
                    errors: {},
                    submitting: false
                }
            }
        }

        mounted() {
            // get this contact form detail
            this.$http.get(this.$store.state.config.api_url + 'forms/contact/' + this.$route.params.id)
                .then(response => {
                    this.contact = response.data.data;
                    this.reply.subject = 'Reply To : ' + this.contact.subject;
                });

        }

        save() {
            this.form.submitting = true;
            this.$http.post(this.$store.state.config.api_url + 'forms/contact/' + this.$route.params.id, this.reply)
                .then(res => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: 'Your Reply Was Successfully Sent To ' + this.contact.email
                    });
                    this.$router.push({name: 'forms.contact.index'});
                })
                .catch(error => {
                    this.form.errors = error.data;
                    this.form.submitting = false;
                });
        }

    }
</script>
