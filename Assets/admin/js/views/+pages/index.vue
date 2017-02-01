<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$t('pages.index_title')}}</h5>
                <div class="ibox-tools">
                    <router-link :to="{name: 'pages.add'}" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                    </router-link>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-striped data-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
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
    export default class Pages {
        mounted() {
            let table = DataTable;
            table.url = '/api/pages';
            table.edit = 'pages.edit';
            table.delete = 'pages.delete';
            table.actions = '';
            table.columns = [
                {data: 'id'},
                {data: 'title'},
                {data: 'slug'},
                {
                    render: function (e, v, data) {
                        return data.status ? '<i class="fa fa-circle text-success"></i> active' : '<i class="fa fa-circle text-danger"></i> disabled';
                    }
                },
                {data: 'created_at'}
            ];
            table.init();
        }

    }
</script>
