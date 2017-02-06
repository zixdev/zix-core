<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    <i class="fa fa-pencil"></i> {{ $t('menu.items.index') }}
                </h5>
            </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="dd">
                            <ol class="dd-list">
                                <li class="dd-item" v-for="link in menu.items"
                                    :data-description="link.description"
                                    :data-url="link.url"
                                    :data-name="link.name"
                                    :data-id="link.id"
                                        >
                                    <div class="dd-handle">
                                        {{ link.name }}
                                        <span class="pull-right dd-nodrag">
                                            <a class="menu-delete btn btn-xs" ><i class="fa fa-trash-o"></i></a>
                                            <a @click="editLink(link)" class="menu-edit btn btn-xs" ><i class="fa fa-edit"></i></a>
                                        </span>
                                    </div>



                                    <ol v-if="link.children" class="dd-list">
                                        <li class="dd-item" v-for="child in link.children"
                                            :data-description="child.description"
                                            :data-url="child.url"
                                            :data-name="child.name"
                                            :data-id="child.id"
                                                >
                                            <div class="dd-handle">
                                                {{ child.name }}
                                                <span class="pull-right dd-nodrag">
                                                    <a class="menu-delete btn btn-xs" ><i class="fa fa-trash-o"></i></a>
                                                    <a @click="editLink(child)" class="menu-edit btn btn-xs" ><i class="fa fa-edit"></i></a>
                                                </span>
                                            </div>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="pull-right ">
                            <button v-if="!new_menu" class="btn btn-primary btn-sm" @click="new_menu = true">
                                <i class="fa fa-plus-circle"></i>
                                Add Menu
                            </button>
                            <button class="btn btn-success btn-sm" @click="saveMenu()">
                                <i class="fa fa-floppy-o"></i>
                                save
                            </button>
                        </div>
                        <br><br>

                        <form v-if="new_menu" class="form-horizontal" @submit.prevent="save()">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    {{ $t('table.name') }} :
                                </label>

                                <div class="col-sm-9">
                                    <input class="form-control" type="text"
                                           v-model="link.name"
                                           required
                                           minlength="3"
                                           maxlength="255"
                                            >
                                    <span v-if="form.errors && form.errors.name"
                                          class="help-block m-b-none text-danger">{{form.errors.name.toString()}}</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    {{ $t('table.url') }} :
                                </label>

                                <div class="col-sm-9">
                                    <input class="form-control" type="text"
                                           v-model="link.url"
                                           required
                                           minlength="3"
                                           maxlength="255"
                                            >
                                    <span v-if="form.errors && form.errors.url" class="help-block m-b-none text-danger">{{form.errors.url.toString()}}</span>
                                    <span v-if="link.url" v-for="site in menu.sites" class="help-block m-b-none info">
                                        <a :href="site.url + '/' + link.url" target="_blank">
                                            {{ site.url + '/' + link.url}}
                                        </a><br>
                                    </span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    {{ $t('table.description') }} :
                                </label>

                                <div class="col-sm-9">
                                    <input class="form-control" type="text"
                                           v-model="link.description"
                                           required
                                           minlength="3"
                                           maxlength="255"
                                            >
                                    <span v-if="form.errors && form.errors.description"
                                          class="help-block m-b-none text-danger">{{form.errors.description.toString()}}</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    {{ $t('table.permission') }} :
                                </label>

                                <div class="col-sm-9">
                                    <input class="form-control" type="text"
                                           v-model="link.permission"
                                           minlength="3"
                                           maxlength="255"
                                            >
                                    <span v-if="form.errors && form.errors.permission"
                                          class="help-block m-b-none text-danger">{{form.errors.permission.toString()}}</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button @click.prevent="cancel()" class="btn btn-white">
                                        {{ $t('form.cancel') }}
                                    </button>
                                    <button v-if="!edit_menu" :disabled="form.submitting" class="btn btn-primary" type="submit">
                                        <i v-if="form.submitting" class="fa fa-spinner fa-pulse"></i>
                                        {{ $t('form.add') }}
                                    </button>
                                    <button v-else :disabled="form.submitting" class="btn btn-primary" @click.prevent="cancel()">
                                        <i v-if="form.submitting" class="fa fa-spinner fa-pulse"></i>
                                        Done
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import Component from 'vue-class-component'


    @Component({
        components: {}
    })
    export default class Create {
        data() {
            return {
                menu: {
                    name: '',
                    sites: [],
                    items: []
                },
                form: {
                    errors: {},
                    submitting: false
                },
                new_menu: false,
                edit_menu: false,
                link: {
                    name: '',
                    url: '',
                    permission: '',
                    description: ''
                }

            }
        }
        editLink(link) {
            this.link = link;
            this.new_menu = true;
            this.edit_menu = true;
        }


        mounted() {
            this.updateEditPage();

            /**
             * When form title changes.
             * Slug will be updated.
             */
            this.$watch('link.name', (title, val) => {
                this.link.url = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '-');
                this.link.description = 'View ' + title + ' Page';
            });
            $('body').on('click', '.menu-delete', function (e) {
                e.preventDefault();
                $(this).closest('li').remove();
                return false;
            });

        }

        save() {
            this.form.submitting = true;
            // if form for create
            let link = this.link;
            this.menu.items.push({...link, id: (this.menu.items.length + 1)})
            $('.dd').nestable();
            this.link = {
                name: '',
                url: '',
                permission: '',
                description: ''
            }
            this.form.submitting = false;
        }


        updateEditPage() {
            this.$http.get(this.$store.state.config.api_url + 'menu/' + this.$route.params.id)
                    .then(res => this.updateMenu(res.data.data));
        }

        updateMenu(data) {
            this.menu = data;
            this.menu.items = JSON.parse(data.items);
            $('.dd').nestable();

        }

        saveMenu() {
            var menu = $('.dd').nestable('serialize');
            menu = JSON.stringify(menu);
            this.$http.put('/api/menu/' + this.$route.params.id, {
                name: this.menu.name,
                items: menu
            }).then(res => {
                this.$events.$emit('notify', {
                    type: 'info',
                    title: 'Success !',
                    message: 'Your Menu Was Updated Successfully!'
                });
                this.$router.push({name: 'menu.all'});
            })
        }

        cancel() {
            this.new_menu = false;
            this.link = {
                name: '',
                url: '',
                permission: '',
                description: ''
            }
        }


    }
</script>
