<?php namespace Zix\Core\Libraries\Sites\Contracts;

interface SiteInterface
{
    /*
     * Should Return Site from the header request site public code
     * or the user or the default client site.
     */
    public function getSite();

    /*
     * Get site by id
     * and return the site instance as it is.
     */
    public function getSiteById();

    /*
     * Get site by id
     * and return the site instance as it is.
     */
    public function getSiteByName();

    /*
     * Get Site Config.
     */
    public function config();

    /*
     * Get Site Packages.
     */
    public function packages();



}