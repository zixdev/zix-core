<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$t('menu.index_title')}}</h5>
                <div class="ibox-tools">
                    <router-link :to="{name: 'menu.add'}" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                    </router-link>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-striped data-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import Component from 'vue-class-component'

    @Component
    export default class Menus {
        mounted() {
            let self = this;
            let table = DataTable;
            table.url = '/api/menu';
            table.edit = 'menu.edit';
            table.delete = 'menu.delete';
            table.actions = `<a title="${this.$t('menu.items.index  ')}" class="items btn btn-default"> <i class="fa fa-bars"></i></a>`;
            table.columns = [
                {data: 'id'},
                {data: 'name'},
                {data: 'created_at'}
            ];
            table.init()
                .on('click', 'a.items', function (e) {
                    self.$router.push({name: 'menu.items.index', params: {id: $(this).parent().data('href')}});
                })
        }

    }
</script>
