<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component'

    @Component
    export default class UserPassword extends Vue {
        user = {}
        password = {
            current_password: '',
            password: '',
            password_confirmation: ''
        };
        form = {
            submitting: false,
            submitted: false,
            errors: {}
        };

        mounted() {
//            if (this.$route.query.setPassword) this.password.current_password = this.$route.query.setPassword;
        }

        getError(name) {
            return (this.form.errors && this.form.errors[name]) ? this.form.errors[name].toString() : false;
        }

        update() {
            this.form.submitting = true;
            this.$http.post('/web/user/change-password', this.password)
                    .then(response => {
                        this.form.submitted = true;
                        this.form.submitting = false;
                        this.form.errors = {
                            message: response.data.data.message
                        };
                        this.password = {
                            current_password: '',
                            password: '',
                            password_confirmation: ''
                        }
                    })
                    .catch(error => {
                        this.form.submitted = true;
                        this.form.submitting = false;
                        this.form.errors = error.data;
                    });
        }

    }
</script>
