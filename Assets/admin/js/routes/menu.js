// lazy loading Components
// https://github.com/vuejs/vue-router/blob/dev/examples/lazy-loading/app.js#L8
const lazyLoading = (name, index = false) => resolve => require([`../views/${name}${index ? '/index' : ''}.vue`], resolve);

export default [
    {
        path: '/menu',
        name: 'menu.index',
        meta: {
            icon: 'fa-bars',
            menu: true,
            auth: false,
            permission: 'view_menu'
        },
        component: lazyLoading('+menu', true),
        children: [
            /*
             * Pages Routes
             */
            {
                path: '/menu/',
                name: 'menu.all',
                meta: {
                    menu: true,
                    auth: true,
                    permission: 'view_menu'
                },
                component: lazyLoading('+menu', true)
            },
            {
                path: '/menu/add',
                name: 'menu.add',
                meta: {
                    menu: true,
                    auth: true,
                    permission: 'create_menu'
                },
                component: lazyLoading('+menu/create')
            },

            {
                path: '/menu/:id/edit',
                name: 'menu.edit',
                meta: {
                    auth: true,
                    permission: 'update_menu'
                },
                component: lazyLoading('+menu/create')
            },
            {
                path: '/menu/:id/items',
                name: 'menu.items.index',
                meta: {
                    auth: true,
                    permission: 'create_menu'
                },
                component: lazyLoading('+menu/items')
            }
        ]
    }
]