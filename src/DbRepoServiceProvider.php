<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 13/07/2016
 * Time: 22:57
 */

namespace Art;

use Pimple\Container;
use Pimple\ServiceProviderInterface;


/**
 * Class DbRepoServiceProvider
 * @package Art
 */
class DbRepoServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['dbrepo'] = function() use($app){
           return new DbRepo($app['db']);
        };
    }
}
