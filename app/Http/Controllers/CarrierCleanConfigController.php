<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarrierCleanConfigRequest;
use App\Services\CarrierCleanConfigService;

class CarrierCleanConfigController extends Controller
{

    protected $carrierCleanConfigService;

    /**
     * CarriersController constructor.
     *
     * @param CarrierCleanConfigService $carrierCleanConfigService
     */
    public function __construct(CarrierCleanConfigService $carrierCleanConfigService)
    {
        $this->middleware('only_superadmin');
        $this->carrierCleanConfigService = $carrierCleanConfigService;
    }
    public function index()
    {
        $config = $this->carrierCleanConfigService->getCarrierCleanConfig();

        return view('pages.carriers.clean_config', compact('config'));
    }
    public function update(CarrierCleanConfigRequest $request)
    {
        $this->carrierCleanConfigService->updateCarrierCleanConfig($request->all());
        $response = [
            'error' => false,
            'message' => 'Thiết lập xoá dữ liệu Freight đã được cập nhật thành công.',
        ];

        return redirect()
            ->route('carrier.clean_config')
            ->with(['response' => $response]);
    }
}
