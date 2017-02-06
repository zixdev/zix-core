import Vue from "vue";
const lazyLoading = (name, index = false) => resolve => require([`../views/${name}${index ? '/index' : ''}.vue`], resolve);

const FormRoutes = [
    {
        path: '/forms',
        name: 'forms.index',
        meta: {
            icon: 'fa-pencil-square-o',
            menu: true,
            auth: false,
            permission: 'view_forms'
        },
        component: lazyLoading('+forms', true),
        children: [
            /*
             * Contact Us Routes
             */
            {
                path: '/forms/contact-us',
                name: 'forms.contact.index',
                meta: {
                    menu: true,
                    auth: true,
                    permission: 'view_forms'
                },
                component: lazyLoading('+forms/contact', true)
            },
            {
                path: '/forms/contact-us/:id/reply',
                name: 'forms.contact.reply',
                meta: {
                    auth: true,
                    permission: 'update_forms'
                },
                component: lazyLoading('+forms/contact/reply')
            },
        ]
    }
];


export default FormRoutes;
