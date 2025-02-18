<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Bbs;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
	 
    protected $globalVars = [];

    public function __construct()
    {
        $this->setGlobalVars();
    }

    private function setGlobalVars()
    {
        $model  = new AllimModel(); // 모델 호출
        $result = $model->getAllimSettings(); // DB에서 설정 정보 가져오기

        $this->globalVars = [
            'apikey'    => $result['apikey']    ?? '',
            'userid'    => $result['userid']    ?? '',
            'senderkey' => $result['senderkey'] ?? '' 
        ];
    }
	
    protected $request;
    protected $session;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;
    protected $data = [];
    protected $setting;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // 세션 서비스 시작
        $this->session = \Config\Services::session();

        $model = new Bbs();
        $settingModel = new \App\Models\Setting();
        $this->data['notice_list_footer'] = $model->List('b2b_notice')->get()->getResultArray();
        $this->setting = $settingModel->info(1);

        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

        db_connect()->query("SET sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

    }

    protected function renderView($view, $additionalData = [])
    {
        $data = array_merge($this->data, $additionalData);
        return view($view, $data);
    }

    public function getData($key)
    {
        return $this->data[$key];
    }
}
