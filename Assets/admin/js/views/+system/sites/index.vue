<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5> {{ $t('system.sites.index_title') }}</h5>
                <div class="ibox-tools">
                    <router-link :to="{name: 'system.sites.add'}" class="btn btn-success">
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
                        <!--<th>Theme</th>-->
                        <th>Url</th>
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
    export default class Index {
        mounted() {
            var self = this;
            var table = DataTable;
            table.url = '/api/sites';
            table.edit = 'system.sites.edit';
            table.delete = 'pages.delete';
            table.actions = `<a title="${this.$t('system.sites.config.index')}" class="config btn btn-default"> <i class="fa fa-cog"></i></a>`;
            table.columns = [
                {data: 'id'},
                {data: 'name'},
//                {
//                    render: function (e, v, data) {
//                        return `<a data-href="${data.id}" title="${self.$t('system.sites.config.index')}" class="theme"> @${data.ui}</a>`;
//                    }
//                },
                {data: 'url'},
                {data: 'created_at'}
            ];
            table.init()
                    .on('click', 'a.config', function (e) {
                        self.$router.push({name: 'system.sites.config.index', params: {id: $(this).parent().data('href')}});
                    })
                    .on('click', 'a.theme', function (e) {
                        self.$router.push({name: 'system.sites.theme.index', params: {id: $(this).data('href')}});
                    })
        }

    }
</script>
