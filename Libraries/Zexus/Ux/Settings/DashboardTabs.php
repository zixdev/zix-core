<?php

namespace Zix\Core\Libraries\Zexus\Ux\Settings;

use Zexus;

/**
 * Class DashboardTabs
 * @package Zix\Core\Ux\Settings
 */
class DashboardTabs extends Tabs
{
    /**
     * Get the tab configuration for the "profile" tab.
     *
     * @return \Zix\Core\Libraries\Zexus\Ux\Settings\Tab
     */
    public function profile()
    {
        return new Tab('Profile', site()->partial('core::%s.user.settings.tabs.profile'), 'fa-user');
    }

    /**
     * Get the tab configuration for the "teams" tab.
     *
     * @return \Zix\Core\Libraries\Zexus\Ux\Settings\Tab
     */
    public function teams()
    {
        return new Tab('Teams', site()->partial('core::%S.user.settings.tabs.teams'), 'fa-users', function () {
            return Zexus::usingTeams();
        });
    }

    /**
     * Get the tab configuration for the "security" tab.
     *
     * @return \Zix\Core\Libraries\Zexus\Ux\Settings\Tab
     */
    public function security()
    {
        return new Tab('Security', site()->partial('core::%s.user.settings.tabs.security'), 'fa-lock');
    }

    /**
     * Get the tab configuration for the "subscription" tab.
     *
     * @param  bool  $force
     * @return \Zix\Core\Libraries\Zexus\Ux\Settings\Tab|null
     */
    public function subscription($force = false)
    {
        return new Tab('Subscription', site()->partial('core::%s.user.settings.tabs.subscription'), 'fa-credit-card', function () use ($force) {
            return count(Zexus::plans()->paid()) > 0 || $force;
        });
    }
}
