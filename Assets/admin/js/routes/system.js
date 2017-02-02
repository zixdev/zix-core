// lazy loading Components
// https://github.com/vuejs/vue-router/blob/dev/examples/lazy-loading/app.js#L8
const lazyLoading = (name, index = false) => resolve => require([`../views/${name}${index ? '/index' : ''}.vue`], resolve);

export default [
    {
        path: '/system',
        name: 'system.index',
        meta: {
            icon: 'fa-cogs',
            menu: true,
            auth: false,
            permission: 'view_admin'
        },
        component: lazyLoading('+system', true),
        children: [
            /*
             * Systems Sites Routes
             */
            {
                path: '/system/sites',
                name: 'system.sites.index',
                meta: {
                    menu: true,
                    auth: true,
                    permission: 'view_sites'
                },
                component: lazyLoading('+system/sites', true)
            },
            {
                path: '/system/sites/add',
                name: 'system.sites.add',
                meta: {
                    auth: true,
                    permission: 'create_sites'
                },
                component: lazyLoading('+system/sites/create')
            },
            {
                path: '/system/sites/:id/edit',
                name: 'system.sites.edit',
                meta: {
                    auth: true,
                    permission: 'update_sites'
                },
                component: lazyLoading('+system/sites/create')
            },
            /*
             * Site Config Routers.
             */
            {
                path: '/system/sites/:id/config',
                name: 'system.sites.config.index',
                meta: {
                    auth: true,
                    permission: 'view_site_configs'
                },
                component: lazyLoading('+system/sites/config')
            },
            {
                path: '/system/file-manager',
                name: 'system.file_manager.index',
                meta: {
                    menu: true,
                    auth: true,
                    permission: 'view_sites'
                },
                component: lazyLoading('+system/file-manager', true)
            },
            {
                path: '/system/logs',
                name: 'system.logs.index',
                meta: {
                    menu: true,
                    auth: true,
                    permission: 'view_sites'
                },
                component: lazyLoading('+system/logs', true)
            },
        ]
    }
]