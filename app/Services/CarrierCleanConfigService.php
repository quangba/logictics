<?php

namespace App\Services;

use App\Entities\Carrier;
use App\Contracts\Repositories\CarrierCleanConfigRepository;;
use Illuminate\Support\Facades\DB;

class CarrierCleanConfigService
{

    protected $carrierCleanConfigRepository;

    public function __construct(CarrierCleanConfigRepository $carrierCleanConfigRepository)
    {
        $this->carrierCleanConfigRepository = $carrierCleanConfigRepository;
    }

    public function getCarrierCleanConfig()
    {
        return $this->carrierCleanConfigRepository->first();
    }

    public function updateCarrierCleanConfig($data)
    {
        DB::beginTransaction();
        try {
            $config = $this->carrierCleanConfigRepository->firstOrNew([]);
            $config->fill([
                'duration' => $data['duration'],
            ])->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

}

