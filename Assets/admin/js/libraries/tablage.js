export default function (app) {
    return {
        columns: [],
        view: null,
        edit: null,
        delete: null,
        url: '/api/users',
        eloquent: 'active',
        actions: '',
        init: function () {
            let self = this;
            this.columns.push({
                render: function (e, v, data) {
                    let actions = '';
                    if(!data.deleted_at) {
                        actions = `<span data-href="${data.id}">${self.actions}</span>`;
                    }
                    if (self.edit && !data.deleted_at) {
                        actions += `<a data-href="${data.id}" title="${app.$t(self.edit)}" class="edit btn btn-success"> <i class="fa fa-edit"></i></a>`;
                    }

                    if (self.view) {
                        actions += `<a data-href="${data.id}" title="${app.$t(self.view)}" class="view btn btn-info"> <i class="fa fa-eye"></i></a>`;
                    }

                    if (self.delete && !data.deleted_at) {
                        actions += `<a data-href="${data.id}" title="${app.$t('accounts.users.delete')}" class="delete btn btn-danger"><i class="fa fa-trash"></i></a>`
                    }

                    if(data.deleted_at  && self.eloquent == 'trashed') {
                        actions += `<a data-href="${data.id}" title="Remove Forever" class="force-delete btn btn-danger"> <i class="fa fa-eraser"></i></a>`;
                    }

                    if(data.deleted_at && self.eloquent == 'trashed') {
                        actions += `<a data-href="${data.id}" title="Restore" class="restore btn btn-info"> <i class="fa fa-refresh"></i></a>`;
                    }

                    return actions;
                }
            });
            let table = $('.table')
                .DataTable({
                    processing: true,
                    serverSide: true,
                    // ajax: ,
                    ajax: {
                        url: self.url,
                        data: function (d) {
                            d.eloquent = self.eloquent;
                        }
                    },
                    columns: self.columns,
                }) // View record
                .on('click', 'a.view', function (e) {
                    e.preventDefault();
                    console.log('view me')
                }) // Edit record
                .on('click', 'a.edit', function (e) {
                    e.preventDefault();
                    app.$router.push({name: self.edit, params: {id: $(this).data('href')}});
                }) // Delete a record
                .on('click', 'a.delete', function (e) {
                    e.preventDefault();
                    axios.delete(self.url + '/' + $(this).data('href') + '?action=delete')
                        .then(() => {
                            table.ajax.reload();
                            app.$events.$emit('notify', {
                                type: app.$t('table.notification.type.delete'),
                                title: app.$t('table.notification.title.delete'),
                                message: app.$t('table.notification.message.delete')
                            });
                        });

                })
                .on('click', 'a.restore', function (e) {
                    e.preventDefault();
                    axios.delete(self.url + '/' + $(this).data('href') + '?action=restore')
                        .then(() => {
                            table.ajax.reload();
                            app.$events.$emit('notify', {
                                type: app.$t('table.notification.type.restore'),
                                title: app.$t('table.notification.title.restore'),
                                message: app.$t('table.notification.message.restore')
                            });
                        });
                })
                .on('click', 'a.force-delete', function (e) {
                    e.preventDefault();
                    axios.delete(self.url + '/' + $(this).data('href') + '?action=force-delete')
                        .then(() => {
                            table.ajax.reload();
                            app.$events.$emit('notify', {
                                type: app.$t('table.notification.type.force-delete'),
                                title: app.$t('table.notification.title.force-delete'),
                                message: app.$t('table.notification.message.force-delete')
                            });
                        });

                });
            $('.dataTables_length')
                .prepend(`
                <div data-toggle="buttons" class="btn-group">
                    <button class="btn btn-sm btn-white active"> All </button>
                    <button class="btn btn-sm btn-white deleted"> Deleted </button>
                </div>
            `)
                .on('click', 'button.active', function () {
                    self.eloquent = 'active';
                    table.draw();
                })
                .on('click', 'button.deleted', function () {
                    self.eloquent = 'trashed';
                    table.draw();
                });

            return table;
        }
    }
}
