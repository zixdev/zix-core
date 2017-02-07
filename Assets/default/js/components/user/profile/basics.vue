<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component'

    @Component
    export default class UserBasics extends Vue {
        user = Laravel.user;
        form = {
            submitting: false,
            submitted: false,
            successful: false,
            errors: {}
        };

        updateProfile() {
            this.form.submitting = true;
            this.form.errors = {};

            let user = {
                username: this.user.username,
                email: this.user.email
            }
            this.$http.post('/web/user', user)
                    .then(response => {
                        this.form.errors = {
                            message: response.data.data.message
                        };
                        this.form.submitting = false;
                        this.form.successful = true;
                        this.$dispatch('updateUser');
                    })
                    .catch(error => {
                        this.form.errors = error.data;
                        this.form.submitting = false;
                    });


        }
        getError(name) {
            return (this.form.errors && this.form.errors[name]) ? this.form.errors[name].toString() : false;
        }
    }
</script>
