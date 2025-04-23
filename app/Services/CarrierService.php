<?php

namespace App\Services;

use App\Entities\Carrier;
use App\Contracts\Repositories\CarrierRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CarrierService
{

    protected $carrierRepository;


    public function __construct(CarrierRepository $carrierRepository)
    {
        $this->carrierRepository = $carrierRepository;
    }

    public function create($data)
    {

        DB::beginTransaction();
        try {
            /** @var Carrier $carrier */

            $carrier = $this->carrierRepository->create([
                    'carrier' => $data['carrier'],
                    'pic' => $data['pic'] !== null ? $data['pic'] : '',
                    'pol' => $data['pol'],
                    'pod' => $data['pod'],
                    'effective_date' => $data['effective'] !== null ? $data['effective'] : '',
                    'expired_date' => $data['expired'] !== null ? $data['expired'] : '',
                    'freight' => $data['freight'],
                    'freight_note' => $data['note'] !== null ? $data['note'] : '',
                    'frequency' => $data['frequency'] !== null ? $data['frequency'] : '',
                    'transit_time' => $data['transit'] !== null ? $data['transit'] : '',
                    'remarks' => $data['remarks'] !== null ? $data['remarks'] : '',
                    'input_user' => Auth::user()->name,
                ]);

            DB::commit();

            logActivity('create carrier', $carrier['id']);
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function update($data, $id)
    {
        DB::beginTransaction();
        try {
            /** @var Carrier $carrier */
            $oldCarrier = $this->carrierRepository->find($id);
            $this->carrierRepository->update([
                'carrier' => $data['carrier'],
                'pic' => $data['pic'],
                'pol' => $data['pol'],
                'pod' => $data['pod'],
                'effective_date' => $data['effective'],
                'expired_date' => $data['expired'],
                'freight' => $data['freight'],
                'freight_note' => $data['note'],
                'frequency' => $data['frequency'],
                'transit_time' => $data['transit'],
                'remarks' => $data['remarks'],
                'editor' => Auth::user()->name,
            ], $id);
            DB::commit();
            logActivity('update carrier', $id, [
                'before' => $oldCarrier->toArray(),
                'after' => $data
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function bulkDelete($data)
    {
        DB::beginTransaction();
        try {
            $this->carrierRepository->whereIn('id', $data)->delete();

            DB::commit();
            logActivity('delete carrier', $data);
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

}

