/**
 * Load all of the core Spark Vue components.
 */
require('./../common/errors');
require('./../nav');
require('./../auth/registration/simple');
require('./../auth/registration/subscription');
require('./../settings/dashboard');
//require('./../settings/dashboard/profile/basics')
require('./../settings/dashboard/subscription');
require('./../settings/dashboard/security/password')
require('./../settings/dashboard/security/two-factor')
require('./../settings/dashboard/teams');
require('./../settings/team');
require('./../settings/team/owner/basics')
require('./../settings/team/membership');
require('./../settings/team/membership/edit-team-member')

import Vue from 'vue';

Vue.component('default-settings-profile-basics-screen', require('./../components/user/profile/basics.vue'));
Vue.component('default-settings-profile-avatar-screen', require('./../components/user/profile/avatar.vue'));

Vue.component('default-settings-security-password-screen', require('./../components/user/security/password.vue'));