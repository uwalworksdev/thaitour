<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    // public array $templates = [
    //     'list'   => 'CodeIgniter\Validation\Views\list',
    //     'single' => 'CodeIgniter\Validation\Views\single',
    // ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $login = [
        'user_id' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => '아이디를 입력해 주세요.',
                'min_length' => '아이디는 최소 5자 이상이어야 합니다.'
            ]
        ],
        'user_pw' => [
            'rules' => 'required|min_length[6]',
            'errors' => [
                'required' => '비밀번호를 입력해 주세요.',
                'min_length' => '패스워드는 최소 6자 이상이어야 합니다.'
            ]
        ]
    ];

}