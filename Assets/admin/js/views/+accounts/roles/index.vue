<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$t('accounts.roles.index_title')}}</h5>
                <div class="ibox-tools">
                    <router-link :to="{name: 'accounts.roles.create'}" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                    </router-link>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-striped data-table">
                    <thead class="list_head">
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

<script>
    import Component from 'vue-class-component'

    @Component
    export default class IndexRoles {
        mounted() {
        	var self = this;
            let table = DataTable;
            table.url = this.$store.state.config.api_url + 'roles';
            table.edit = 'accounts.roles.edit';
            table.delete = true;
            table.actions = `<a title="${this.$t('accounts.permissions.index')}" class="permissions btn btn-default"> <i class="fa fa-cog"></i></a>`;
            table.columns = [
                {data: 'id'},
                {data: 'name'},
                {data: 'created_at'},
            ];
            table.init()
                .on('click', 'a.permissions', function (e) {
                    self.$router.push({name: 'accounts.permissions.index', params: {id: $(this).parent().data('href')}});
                })
        }
    }
</script>
