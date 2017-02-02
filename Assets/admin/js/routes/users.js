// lazy loading Components
// https://github.com/vuejs/vue-router/blob/dev/examples/lazy-loading/app.js#L8
const lazyLoading = (name, index = false) => resolve => require([`../views/${name}${index ? '/index' : ''}.vue`], resolve);

export default [
    {
        path: '/accounts',
        name: 'accounts.index',
        meta: {
            icon: 'fa-user',
            menu: true,
            auth: false,
            permission: 'view_users'
        },
        component: lazyLoading('+pages', true),
        children: [
            /*
             * Users Routes
             */
            {
                path: '/accounts/',
                name: 'accounts.users.index',
                meta: {
                    menu: true,
                    auth: true,
                    permission: 'view_users'
                },
                component: lazyLoading('+accounts/users', true)
            },
            {
                path: '/accounts/add',
                name: 'accounts.users.add',
                meta: {
                    auth: true,
                    permission: 'create_users'
                },
                component: lazyLoading('+accounts/users/create')
            },

            {
                path: '/accounts/:id/edit',
                name: 'accounts.users.edit',
                meta: {
                    auth: true,
                    permission: 'update_users'
                },
                component: lazyLoading('+accounts/users/create')
            },

            {
                path: '/accounts/:id/roles',
                name: 'accounts.users.roles',
                meta: {
                    auth: true,
                    permission: 'update_roles'
                },
                component: lazyLoading('+accounts/users/user-role')
            },

            {
                path: '/accounts/roles',
                name: 'accounts.roles.index',
                meta: {
                    menu: true,
                    auth: true,
                    permission: 'full_access'
                },
                component: lazyLoading('+accounts/roles', true)
            },
            {
                path: '/accounts/roles/create',
                name: 'accounts.roles.create',
                meta: {
                    auth: true,
                    permission: 'full_access'
                },
                component: lazyLoading('+accounts/roles/create')
            },
            {
                path: '/accounts/roles/:id/edit',
                name: 'accounts.roles.edit',
                meta: {
                    auth: true,
                    permission: 'full_access'
                },
                component: lazyLoading('+accounts/roles/create')
            },
            {
                path: '/accounts/roles/:id/permissions',
                name: 'accounts.permissions.index',
                meta: {
                    auth: true,
                    permission: 'full_access'
                },
                component: lazyLoading('+accounts/roles/permissions')
            },
        ]
    },

];
