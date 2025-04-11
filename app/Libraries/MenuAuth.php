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

    private function compareParams($params, $current_params) {
        $result = true;
        foreach ($params as $key => $param) {
            if (!array_key_exists($key, $current_params)) {
                $result = false;
                break;
            }

            if ($current_params[$key] != $param) {
                $result = false;
                break;
            }
        }
        return $result;
    }

    // public function getUserMenus($userPermissions)
    // {
    //     $router = service('router');
    //     $fullControllerName = $router->controllerName();
    //     $controller = basename(str_replace('\\', '/', $fullControllerName));
    //     $method = $router->methodName();
    //     $alias = $controller . '::' . $method;

    //     $current_params = $this->request->getGet();

    //     $allowedMenus = [];
    //     $permissions = array_map('trim', explode(',', $userPermissions));

    //     foreach ($this->adminMenus->menus as $menu) {
    //         $allowedSubMenus = array_filter($menu['submenus'], function ($submenu) use ($permissions) {
    //             return in_array(trim($submenu['code']), $permissions) || session('member.id') == 'admin';
    //         });

    //         if (!empty($allowedSubMenus)) {
    //             $is_menu_active = "";

    //             foreach ($allowedSubMenus as $key => $submenu) {
    //                 $aliasList = $submenu['alias'] ?? [];
    //                 $submenu['active'] = "";

    //                 if (in_array($alias, $aliasList)) {
    //                     $parsedUrl = parse_url($submenu['url']);
    //                     if (($controller == "AdminBbsController" 
    //                             || $controller == "BoardController"
    //                             || $controller == "Member") 
    //                         && isset($parsedUrl['query']) ) {
    //                         parse_str($parsedUrl['query'], $params);

    //                         $result = $this->compareParams($params, $current_params);

    //                         if($result) {
    //                             $is_menu_active = "on";
    //                             $submenu['active'] = "on";
    //                         }

    //                         // $scategory = $params['scategory'] ?? '';
    //                         // $code = $params['code'] ?? '';

    //                         // $current_code = $current_params['code'] ?? '';
    //                         // $current_scategory = $current_params['scategory'] ?? '';

    //                         // if ($scategory) {
    //                         //     if ($scategory == $current_scategory && $code == $current_code) {
    //                         //         $is_menu_active = "on";
    //                         //         $submenu['active'] = "on";
    //                         //     }
    //                         // } elseif ($code == $current_code) {
    //                         //     $is_menu_active = "on";
    //                         //     $submenu['active'] = "on";
    //                         // }

    //                     } else {
    //                         $is_menu_active = "on";
    //                         $submenu['active'] = "on";
    //                     }
    //                 }
    //                 $allowedSubMenus[$key] = $submenu;
    //             }


    //             $allowedMenus[] = [
    //                 'name' => $menu['name'],
    //                 'code' => $menu['code'],
    //                 'active' => $is_menu_active,
    //                 'submenus' => array_values($allowedSubMenus)
    //             ];
    //         }
    //     }

    //     return $allowedMenus;
    // }

    public function getUserMenus($userPermissions)
    {
        $router = service('router');
        $fullControllerName = $router->controllerName();
        $controller = basename(str_replace('\\', '/', $fullControllerName));
        $method = $router->methodName();
        $alias = $controller . '::' . $method;
        $current_path = $this->request->getUri()->getPath();
        $parent_path = dirname($current_path);
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
                        $urls = is_array($submenu['url']) ? $submenu['url'] : [$submenu['url']];
                        
                        foreach ($urls as $url) {
                            $parsedUrl = parse_url($url);

                            $match = false;

                            if (
                                in_array($controller, ["AdminBbsController", "BoardController", "Member"])
                                && isset($parsedUrl['query'])
                            ) {
                                parse_str($parsedUrl['query'], $params);
                                
                                $result = $this->compareParams($params, $current_params);

                                if ($result) {
                                    $match = true;
                                }
                                
                            } else if(strpos($parsedUrl['path'], $parent_path) !== false) {
                                $match = true;
                            }
                            if ($match) {
                                $is_menu_active = "on";
                                $submenu['active'] = "on";
                                break;
                            }


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
