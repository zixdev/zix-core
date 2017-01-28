<?php namespace Zix\Core\Libraries\Modules\Contracts;

interface PackagerInterface
{
    /*
     * Set The Package.
     */
    public function set($module);
    /*
     * Enable The current Package.
     */
    public function enable();

    /*
     * Disable The current Package.
     */
    public function disable();

    /*
     * Get The current Package Config.
     */
    public function config();

    /*
     * Get The current Package Version.
     */
    public function version();

    /*
     * Determine If The current Package Enabled or not
     */
    public function enabled();

    /*
     * Get The current Package Providers
     */
    public function providers();

    /*
     * Get The current Package Path
     */
    public function path();

    /*
     * Get Package name.
     */
    public function name();

    /*
     * Get The current Package Extra Path.
     */
    public function getExtraPath($extra);





}