<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\Setting;

class UpdateExchangeRate extends BaseCommand
{
    protected $group = 'Custom';
    protected $name = 'update:exchangerate';
    protected $description = 'Update exchange rate THB → KRW';

    public function run(array $params)
    {
        $apiKey = 'ee1509b5c63350da2ab652a5';
        $url = "https://v6.exchangerate-api.com/v6/{$apiKey}/pair/THB/KRW";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            CLI::error("cURL error: " . curl_error($ch));
            curl_close($ch);
            return;
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            CLI::error("Error HTTP code: $httpCode");
            return;
        }

        $data = json_decode($response, true);

        if (isset($data['conversion_rate'])) {
            $rate = $data['conversion_rate'];
            $model = new Setting();
            $model->updateSettings([
                "baht_thai" => $rate
            ]);

            CLI::write("Updated exchange rate: THB → KRW = $rate", 'green');
        } else {
            CLI::error("No conversion_rate found in data.");
        }
    }
}
