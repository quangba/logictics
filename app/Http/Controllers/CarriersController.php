<?php

namespace App\Http\Controllers;

use App\Entities\Carrier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CarrierCreateRequest;
use App\Http\Requests\CarrierUpdateRequest;
use App\Contracts\Repositories\CarrierRepository;
use App\Validators\CarrierValidator;
use App\Services\CarrierService;
use Maatwebsite\Excel\Facades\Excel;
use DB;

/**
 * Class CarriersController.
 *
 * @package namespace App\Http\Controllers;
 */
class CarriersController extends Controller
{
    /**
     * @var CarrierRepository
     */
    protected $repository;

    /**
     * @var CarrierValidator
     */
    protected $validator;

    protected $carrierService;

    /**
     * CarriersController constructor.
     *
     * @param CarrierRepository $repository
     * @param CarrierValidator $validator
     * @param CarrierService $carrierService
     */
    public function __construct(CarrierRepository $repository, CarrierValidator $validator, CarrierService $carrierService)
    {
        $this->middleware('carrier_permission');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->carrierService = $carrierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();
        session_unset();
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $carriers = $this->repository->orderBy('carrier')->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $carriers,
            ]);
        }
        if (request()->ajax()) {
            return view('includes.carriers.table', compact('carriers'))->render();
        }

        return view('pages.carriers.index', compact('carriers'));
    }

    public function create()
    {
        return view('pages.carriers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CarrierCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CarrierCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $this->carrierService->create($request->all());

            $response = [
                'error' => false,
                'message' => 'Carrier created.',
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return redirect()->route('carrier.index')->with(['response' => $response]);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrier = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $carrier,
            ]);
        }

        return view('pages.carriers.show', compact('carrier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrier = $this->repository->find($id);

        return view('pages.carriers.edit', compact('carrier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarrierUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CarrierUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $this->carrierService->update($request->all(), $id);

            $response = [
                'error'   => false,
                'message' => 'Carrier updated.',
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('carrier.index')->with(['response' => $response]);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return redirect()->route('dashboard');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Carrier deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Carrier deleted.');
    }

    public function search(Request $request)
    {
        session_start();
        if($request->carrier || $request->pol || $request->pod || $request->freight ){
            $carriers = Carrier::where('carrier', 'LIKE', '%'.$request->carrier.'%')
                ->where('pol', 'LIKE', '%' . $request->pol.'%')
                ->where('pod', 'LIKE', '%'.$request->pod.'%')
                ->where('freight', 'LIKE', '%'.$request->freight.'%')
                ->paginate(10)
                ->appends($request->query());
            $count = count(Carrier::where('carrier', 'LIKE', '%'.$request->carrier.'%')
                ->where('pol', 'LIKE', '%' . $request->pol.'%')
                ->where('pod', 'LIKE', '%'.$request->pod.'%')
                ->where('freight', 'LIKE', '%'.$request->freight.'%')->get());
            $values = [
                'carrier' => trim($request->carrier),
                'pol' => trim($request->pol),
                'pod' => trim($request->pod),
                'freight' => trim($request->freight)
            ];
            $_SESSION["advanced"] = $values;
            if (request()->ajax()) {
                return view('includes.carriers.table', compact('carriers'))->render();
            }
            return view('pages.carriers.search', compact('carriers', 'values', 'count'));
        }else{
            $keywords = trim($request->keywords);
            $carriers = Carrier::where('carrier', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('pod', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('pic', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('pol', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('freight', 'LIKE', '%'.$request->keywords.'%')
                ->paginate(10)
                ->appends($request->query());
            $count = count(Carrier::where('carrier', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('pod', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('pic', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('pol', 'LIKE', '%'.$request->keywords.'%')
                ->orWhere('freight', 'LIKE', '%'.$request->keywords.'%')->get());
            $_SESSION["keywords"] = $request->keywords;
            if (request()->ajax()) {
                return view('includes.carriers.table', compact('carriers'))->render();
            }
            return view('pages.carriers.search', compact('carriers', 'keywords', 'count'));
        }
    }

    public function import(){
        return view('pages.carriers.import');
    }

    public function storeImport(Request $request){
        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path)->get();
        if($data->count()){
            foreach ($data as $key => $value) {
                $arr = ['carrier' => $value->carrier,
                    'pic' => $value->pic ? $value->pic : '',
                    'pol' => $value->pol ? $value->pol : '',
                    'pod' => $value->pod ? $value->pod : '',
                    'expired_date' => $value->valid ? Carbon::parse($value->valid)->format('Y-m-d') : '',
                    'freight' => $value->frt ? $value->frt : '',
                    'freight_note' => $value->frt_note ? $value->frt_note : '',
                    'frequency' => $value->schedule ? $value->schedule : '',
                    'input_user' => $value->sales ? $value->sales : '',
                    'remarks' => $value->remarks ? $value->remarks : '',
                    'created_at' => $value->ngay ? Carbon::parse($value->ngay)->format('Y-m-d') : ''
                    ];
                Carrier::insert($arr);
            }
        }

        return back()->with([
            'error'   => false,
            'message' => 'Import Success.',
        ]);
    }

    public function export()
    {
        session_start();
        $carriers = Carrier::all();
        if(isset($_SESSION["keywords"])){
            $keywords = $_SESSION["keywords"];
            $carriers = Carrier::where('carrier', 'LIKE', '%'.$keywords.'%')
                ->orWhere('pod', 'LIKE', '%'.$keywords.'%')
                ->orWhere('pic', 'LIKE', '%'.$keywords.'%')
                ->orWhere('pol', 'LIKE', '%'.$keywords.'%')
                ->orWhere('freight', 'LIKE', '%'.$keywords.'%')
                ->get();
        }
        if(isset($_SESSION["advanced"])){
            $keywords = $_SESSION["advanced"];
            $carriers = Carrier::where('carrier', 'LIKE', '%'.$keywords['carrier'].'%')
                ->where('pol', 'LIKE', '%' . $keywords['pol'] .'%')
                ->where('pod', 'LIKE', '%'.$keywords['pod'] .'%')
                ->where('freight', 'LIKE', '%'.$keywords['freight'] .'%')
                ->get();
        }

        $fileName = 'freight'.time();

        Excel::create($fileName, function($excel) use ($carriers){ // su dung use($books) moi co the truyen gia tri bien $books tu ben ngoai vao ham
            $excel->sheet('Thống kê Freight', function ($sheet) use ($carriers) {
                $sheet->mergeCells('A1:I1');

                $sheet->cell('A1', function ($cell) {
                    $cell->setValue('Danh sách carriers');

                    $cell->setFontWeight('bold');
                });

                $result = $this->getDataToLaravelExcel($carriers); //Goi den ham getDataToLaravelExcel de tạo mang du lieu can in ra Excel

                $sheet->fromArray($result, null, 'A3', false, true);
            });
        })->store('xlsx', public_path('/excel/import'));

        $path = 'excel/import/' . $fileName . '.xlsx';

        return redirect(url('/' . $path));
    }

    private function getDataToLaravelExcel($carriers)
    {
        $result = [];

        foreach ($carriers as $key => $value) {
            $result[] = [
                'Carrier' => isset($value->carrier) ? $value->carrier : '',
                'PIC' => isset($value->pic) ? $value->pic : '',
                'POL' => isset($value->pol) ? $value->pol : '',
                'Effective Date' => isset($value->effective_date) ? $value->effective_date : '',
                'Expired Date' => isset($value->expired_date) ? $value->expired_date : '',
                'Freight' => isset($value->freight) ? $value->freight : '',
                'Freight Note' => isset($value->freight_note) ? $value->freight_note : '',
                'Frequency' => isset($value->frequency) ? $value->frequency : '',
                'Transit Time' => isset($value->transit_time) ? $value->transit_time : '',
                'Input User' => isset($value->input_user) ? $value->input_user : '',
                'Create At' => isset($value->created_at) ? $value->created_at : '',
                'Editor' => isset($value->editor) ? $value->editor : '',
                'Update At' => isset($value->updated_at) ? $value->updated_at : '',

            ];
        }
        return $result;
    }

    public function bulkDelete(Request $request)
    {
        $dataIds = $request->ids;

        if (auth()->id() != SUPER_ADMIN_ID) {
            return response()->json([
                'message' => 'Bạn không đủ thẩm quyền để xoá .',
                'deleted' => false
            ], 403);
        }

        $isSearch = $request->hasAny(['carrier', 'pol', 'pod', 'freight', 'keywords']);
        $deleted = $this->carrierService->bulkDelete($dataIds);

        if ($isSearch) {
            if ($request->carrier || $request->pol || $request->pod || $request->freight) {
                $carriers = Carrier::where('carrier', 'LIKE', '%'.$request->carrier.'%')
                    ->where('pol', 'LIKE', '%' . $request->pol.'%')
                    ->where('pod', 'LIKE', '%'.$request->pod.'%')
                    ->where('freight', 'LIKE', '%'.$request->freight.'%');
            } else {
                $carriers = Carrier::where('carrier', 'LIKE', '%'.$request->keywords.'%')
                    ->orWhere('pod', 'LIKE', '%'.$request->keywords.'%')
                    ->orWhere('pic', 'LIKE', '%'.$request->keywords.'%')
                    ->orWhere('pol', 'LIKE', '%'.$request->keywords.'%')
                    ->orWhere('freight', 'LIKE', '%'.$request->keywords.'%');
            }

            $carriers = $carriers
                ->paginate(10, ['*'], 'page', 1)
                ->appends($request->except('page'))
                ->setPath(route('carrier.search'));
        }else {
            $carriers = $this->repository->orderBy('carrier')->paginate()
                ->setPath(route('carrier.index'));
        }

        $html =  view('includes.carriers.table', compact('carriers'))->render();

        return response()->json([
            'message' => 'Đã xoá thành công các Freight.',
            'html' => $html
        ]);
    }
}
