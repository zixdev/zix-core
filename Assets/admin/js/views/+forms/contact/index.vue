<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$t('forms.contact.index_title')}}</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-striped data-table">
                    <thead>
                    <tr>
                        <th>{{ $t('table.id') }}</th>
                        <th>{{ $t('table.name') }}</th>
                        <th>{{ $t('table.email') }}</th>
                        <th>{{ $t('table.phone') }}</th>
                        <th>{{ $t('table.status') }}</th>
                        <th>{{ $t('table.created_at') }}</th>
                        <th></th>
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
    export default class Contact {
        mounted() {
        	let self = this;
            let table = DataTable;
            table.url = this.$store.state.config.api_url + 'forms/contact';
            table.edit = false;
            table.delete = 'pages.delete';
            table.actions = `<a title="${this.$t('forms.contact.reply')}" class="reply btn btn-default"> <i class="fa fa-reply"></i></a>`;
            table.columns = [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {
                    render: function (e, v, data) {
                        return data.status ? '<i title="Viewed" class="fa fa-eye fa-2x text-success"></i> ' : '<i title="Not Viewed" class="fa fa-eye-slash fa-2x text-danger"></i> ';
                    }
                },
                {data: 'created_at'}
            ];
            table.init()
                .on('click', 'a.reply', function (e) {
                    self.$router.push({name: 'forms.contact.reply', params: {id: $(this).parent().data('href')}});
                });
        }

    }
</script>
