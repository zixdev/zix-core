<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component'
    import Dropzone from 'dropzone'

    @Component
    export default class UserBasics extends Vue {
        user = Laravel.user;
        images = [];
        form = {
            submitting: false,
            submitted: false,
            successful: false,
            errors: {}
        };

        mounted() {
            Dropzone.autoDiscover = false;
            new Dropzone('form.dropzone', {
                url: '/web/user/upload-avatar',
                dictDefaultMessage: "<strong class='text-center'>Drop New Image Here. </strong>",
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                    'X-CSRF-TOKEN': Laravel.csrfToken

                },
                paramName: "avatar", // The name that will be used to transfer the file
                maxFilesize: 100, // MB,

                success: (response, server) => {
                    this.user = server.data.user
                    $('#select-avatar').modal('hide');
                },

                error: (item, err) => {
                    console.log(err);
                    this.form.errors = err;
                }
            });

            this.getUserImages()
        }

        getUserImages() {
            this.$http.get('/web/user/images')
                    .then(response => {
                        this.images = response.data.data.images
                    })
        }
        selectAvatar(image) {
            console.log('callded')
            let param = {url: image.url}
            this.$http.post('/web/user/select-avatar', param)
                    .then(response => {
                        this.user = response.data.data.user
                        $('#select-avatar').modal('hide');
                    });
        }
        getError(name) {
            return (this.form.errors && this.form.errors[name]) ? this.form.errors[name].toString() : false;
        }
    }
</script>
<style type="text/sass">
</style>