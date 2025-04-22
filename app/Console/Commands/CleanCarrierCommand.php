<?php

namespace App\Console\Commands;

use App\Entities\Carrier;
use App\Entities\CarrierCleanConfig;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanCarrierCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carrier:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xoá mềm các bản ghi Carrier theo cấu hình định kỳ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $config = CarrierCleanConfig::first();

        if (!isset($config) || $config->duration <= 0) {
            \Log::channel('carrier_clean')->info("[Freight] Chưa thiết lập điều kiện xoá.");
            return true;
        }

        $cutoff = Carbon::now()->subMonths($config->duration);

        DB::beginTransaction();
        try {
            $records = Carrier::whereDate('updated_at', '<=', $cutoff)->get();

            if ($records->isEmpty()) {
                \Log::channel('carrier_clean')->info("[Freight] Không có bản ghi nào bị xoá. (Điều kiện: {$config->duration} tháng)");
                DB::commit();
                return true;
            }

            $ids = $records->pluck('id')->toArray();
            $count = count($ids);

            Carrier::whereIn('id', $ids)->delete();

            \Log::channel('carrier_clean')->info(
                "[Freight] Đã xoá $count bản ghi Carrier (Điều kiện: {$config->duration} tháng). IDs bị xoá: " . implode(',', $ids)
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::channel('carrier_clean')->error("[Freight] Đã xảy ra lỗi khi xoá dữ liệu: " . $e->getMessage() . "(Điều kiện: {$config->duration} tháng)");
        }

        return true;
    }
}
