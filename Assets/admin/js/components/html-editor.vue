<template>
    <textarea
        class="tinymce"
        rows="10"
        >
    </textarea>
</template>

<script type="text/babel">
    import tinymce from "tinymce/tinymce";
    import "tinymce/themes/modern/theme";
    import "tinymce/plugins/paste/plugin";
    import "tinymce/plugins/link/plugin";
    import "tinymce/plugins/image/plugin";
    import "tinymce/plugins/media/plugin";
    import "tinymce/plugins/autoresize/plugin";
    import Component from 'vue-class-component';
    import Vue from 'vue';

    @Component
    export default class HtmlEditor extends Vue {
        mounted() {
            this.$events.$on('update-tinycme', data => {
                this.createTinyMce(data);
            });
        }

        createTinyMce(content) {
            tinymce.remove();
            var self = this;
            // Initialize
            tinymce.init({
                file_picker_callback : self.elFinderBrowser,
                selector: '.tinymce',
                skin: false,
                plugins: ['paste', 'link', 'autoresize', 'image', 'media'],
                setup(editor) {

                    editor.on('init', function () {
                        tinymce.activeEditor.setContent(content);
                    });
                    // when typing keyup event
                    editor.on('keyup', function () {
                        self.$emit('change', tinymce.activeEditor.getContent());
                    });
                }
            });
        }

        elFinderBrowser (field_name, url, type, win) {
            tinymce.activeEditor.windowManager.open({
                file: '/elfinder/tinymce4',// use an absolute path!
                title: 'elFinder 2.0',
                width: 900,
                height: 450,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    field_name(url)
                    tinymce.activeEditor.windowManager.close();
                }
            });
        }

    }
</script>

<style type="text/sass" scoped>
    @import "~tinymce/skins/lightgray/skin.min.css";
    @import "~tinymce/skins/lightgray/content.min.css";
</style>