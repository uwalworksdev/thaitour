<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function iniStdPayUtil($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('iniStdPayUtil');
        }

        require_once ROOTPATH . 'public/inicis/libs/INIStdPayUtil.php';
        require_once ROOTPATH . 'public/inicis/libs/HttpClient.php';
        require_once ROOTPATH . 'public/inicis/libs/properties.php';


        return new \INIStdPayUtil();
    }
}

