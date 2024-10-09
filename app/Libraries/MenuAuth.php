<?php

namespace App\Libraries;

use Config\AdminMenus;

class MenuAuth
{
    protected $adminMenus;
    public function __construct()
    {
        $this->adminMenus = new AdminMenus();
        $this->request = \Config\Services::request();
    }

    public function getUserMenus($userPermissions)
    {
        $router = service('router');
        $fullControllerName = $router->controllerName();
        $controller = basename(str_replace('\\', '/', $fullControllerName));
        $method = $router->methodName();
        $alias = $controller . '::' . $method;

        $current_params = $this->request->getGet();

        $allowedMenus = [];
        $permissions = array_map('trim', explode(',', $userPermissions));

        foreach ($this->adminMenus->menus as $menu) {
            $allowedSubMenus = array_filter($menu['submenus'], function ($submenu) use ($permissions) {
                return in_array(trim($submenu['code']), $permissions) || session('member.id') == 'admin';
            });



            if (!empty($allowedSubMenus)) {
                $is_menu_active = "";

                foreach ($allowedSubMenus as $key => $submenu) {
                    $aliasList = $submenu['alias'] ?? [];
                    $submenu['active'] = "";

                    if (in_array($alias, $aliasList)) {
                        $parsedUrl = parse_url($submenu['url']);
                        if (
                            ($alias == "AdminBbsController::boardList"
                                || $alias == "AdminBbsController::boardView"
                                || $alias == "AdminBbsController::boardWrite")
                            && isset($parsedUrl['query'])
                        ) {
                            parse_str($parsedUrl['query'], $params);

                            $scategory = $params['scategory'] ?? '';
                            $code = $params['code'] ?? '';

                            $current_code = $current_params['code'] ?? '';
                            $current_scategory = $current_params['scategory'] ?? '';

                            if ($scategory) {
                                if ($scategory == $current_scategory && $code == $current_code) {
                                    $is_menu_active = "on";
                                    $submenu['active'] = "on";
                                }
                            } elseif ($code == $current_code) {
                                $is_menu_active = "on";
                                $submenu['active'] = "on";
                            }

                        } else {
                            $is_menu_active = "on";
                            $submenu['active'] = "on";
                        }
                    }
                    $allowedSubMenus[$key] = $submenu;
                }


                $allowedMenus[] = [
                    'name' => $menu['name'],
                    'code' => $menu['code'],
                    'active' => $is_menu_active,
                    'submenus' => array_values($allowedSubMenus)
                ];
            }
        }

        return $allowedMenus;
    }
}
