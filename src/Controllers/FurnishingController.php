<?php

namespace Fieroo\Furnitures\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Fieroo\Furnitures\Models\Furnishing;
use Validator;
use DB;

class FurnishingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_furnishings = DB::table('furnishings_translations')
            ->leftJoin('furnishings','furnishings_translations.furnishing_id','=','furnishings.id')
            ->select('furnishings.price','furnishings.size','furnishings.file_path','furnishings_translations.*')
            ->get();
        $it_furnishings = [];
        $en_furnishings = [];
        foreach($all_furnishings as $furnishing) {
            if($furnishing->locale === 'it') {
                array_push($it_furnishings, $furnishing);
            } else {
                array_push($en_furnishings, $furnishing);
            }
        }
        return view('furnitures::index', ['it_furnishings' => $it_furnishings, 'en_furnishings' => $en_furnishings]);
    }

    public function indexVariant($id)
    {
        $list = DB::table('furnishings')->where('variant_id', '=', $id)->get();
        $furnishing = DB::table('furnishings_translations')
            ->leftJoin('furnishings', 'furnishings_translations.furnishing_id', '=', 'furnishings.id')
            ->where([
                ['furnishings.id', '=', $id],
                ['furnishings_translations.locale', '=', App::getLocale()]
            ])
            ->select('furnishings_translations.description')
            ->first();

        return view('furnitures::variants.index', ['list' => $list, 'furnishing_id' => $id, 'furnishing_description' => $furnishing->description]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('furnitures::create');
    }

    public function createVariant($id)
    {
        $furnishing = DB::table('furnishings')
            ->leftJoin('furnishings_translations', 'furnishings.id', '=', 'furnishings_translations.furnishing_id')
            ->where([
                ['furnishings_translations.locale', '=', 'it'],
                ['furnishings.id', '=', $id]
            ])
            ->select('furnishings_translations.description', 'furnishings.*')
            ->first();

        return view('furnitures::variants.create', ['furnishing' => $furnishing]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation_data = [
            'stand_type_id' => ['required', 'array'],
            'description' => ['required', 'string', 'max:255'],
            'description_en' => ['required', 'string', 'max:255'],
            'file' => ['required', 'mimes:jpeg,bmp,png,gif']
        ];

        $validator = Validator::make($request->all(), $validation_data);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $image = $request->file('file');
            $rename_file = time().'.'.$request->file->getClientOriginalExtension();
            $request->file->storeAs('furnishings', $rename_file);
            
            $furnishing = Furnishing::create([
                'size' => $request->size,
                'price' => $request->price ?? 0,
                'file_path' => $rename_file,
                'color' => $request->color,
                'is_variant' => 0,
                'variant_id' => null,
                'extra_price' => 0
            ]);

            foreach($request->stand_type_id as $index => $stand_type_id) {
                $is_supplied = 'is_supplied_'.$stand_type_id;
                $min = 'min_'.$stand_type_id;
                $max = 'max_'.$stand_type_id;
                DB::table('furnishings_stands_types')->insert([
                    'stand_type_id' => $stand_type_id,
                    'furnishing_id' => $furnishing->id,
                    'is_supplied' => isset($request->$is_supplied) ? 1 : 0,
                    'min' => isset($request->$min) ? $request->$min : null,
                    'max' => isset($request->$max) ? $request->$max : null,
                ]);
            }

            $furnishing_translations = DB::table('furnishings_translations')->insert([
                [
                    'furnishing_id' => $furnishing->id,
                    'locale' => 'it',
                    'description' => $request->description,
                ],
                [
                    'furnishing_id' => $furnishing->id,
                    'locale' => 'en',
                    'description' => $request->description_en,
                ]
            ]);

            $entity_name = trans('entities.furnishing');
            return redirect('admin/furnishings')->with('success', trans('forms.created_success',['obj' => $entity_name]));
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function storeVariant(Request $request, $id)
    {
        $validation_data = [
            'furnishing_id' => ['required', 'exists:furnishings,id'],
            'file' => ['required', 'mimes:jpeg,bmp,png,gif']
        ];

        $validator = Validator::make($request->all(), $validation_data);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $image = $request->file('file');
            $rename_file = time().'.'.$request->file->getClientOriginalExtension();
            $request->file->storeAs('furnishings', $rename_file);
            
            $furnishing = Furnishing::create([
                'size' => $request->size,
                'price' => $request->price ?? 0,
                'file_path' => $rename_file,
                'color' => $request->color,
                'is_variant' => 1,
                'variant_id' => $id,
                'extra_price' => !is_null($request->extra_price) ? 1 : 0
            ]);

            $entity_name = trans('entities.variant');
            return redirect('admin/furnishings/'.$id.'/variants')->with('success', trans('forms.created_success',['obj' => $entity_name]));
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $furnishing = DB::table('furnishings_translations')
            ->leftJoin('furnishings','furnishings_translations.furnishing_id','=','furnishings.id')
            ->where('furnishings_translations.id', '=', $id)
            ->select('furnishings_translations.*','furnishings.size','furnishings.price','furnishings.color','furnishings.file_path')
            ->first();
        if(is_null($furnishing) || !is_object($furnishing)) {
            abort(404);
        }
        $only_stands_types_id = DB::table('furnishings_stands_types')->where('furnishing_id', '=', $furnishing->furnishing_id)->pluck('stand_type_id');

        return view('furnitures::edit', ['furnishing' => $furnishing, 'only_stands_types_id' => $only_stands_types_id]);
    }

    public function editVariant($parent_id, $id)
    {
        $variant_data = DB::table('furnishings')
            ->where([
                ['variant_id', '=', $parent_id],
                ['id', '=', $id],
            ])
            ->first();
            
        $parent_data = DB::table('furnishings_translations')->where([
            ['furnishing_id', '=', $parent_id],
            ['locale', '=', 'it']
        ])->first();

        return view('furnitures::variants.edit', ['variant_data' => $variant_data, 'parent_id' => $parent_id, 'description' => $parent_data->description]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation_data = [
            'furnishing_id' => ['required', 'exists:furnishings,id'],
            'stand_type_id' => ['required', 'array'],
            'description' => ['required', 'string', 'max:255'],
            'file' => ['mimes:jpeg,bmp,png,gif'],
        ];

        $validator = Validator::make($request->all(), $validation_data);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $update_data = [
                'color' => $request->color,
                'size' => $request->size,
                'price' => $request->price ?? 0,
                'is_variant' => 0,
                'variant_id' => null,
                'extra_price' => 0
            ];

            if($request->hasFile('file')) {
                $file_path = Furnishing::findOrFail($request->furnishing_id)->file_path;
                unlink(public_path('upload/furnishings/'.$file_path));
                $image = $request->file('file');
                $rename_file = time().'.'.$request->file->getClientOriginalExtension();
                $request->file->storeAs('furnishings', $rename_file, ['disk' => 'upload']);
                $update_data['file_path'] = $rename_file;
            }
            
            $furnishing = Furnishing::find($request->furnishing_id)->update($update_data);

            $old_furnishings_stands_types = DB::table('furnishings_stands_types')->where('furnishing_id', '=', $request->furnishing_id)->pluck('stand_type_id')->toArray();

            // insert the new ones that are not in the old array
            foreach($request->stand_type_id as $index => $stand_type_id) {
                $is_supplied = 'is_supplied_'.$stand_type_id;
                $min = 'min_'.$stand_type_id;
                $max = 'max_'.$stand_type_id;
                if(isset($request->$is_supplied) && (!isset($request->$min) || !isset($request->$max))) {
                    return redirect()
                        ->back()
                        ->withErrors([ trans('messages.min_max_empty') ]);
                }
                if($request->$min > $request->$max) {
                    return redirect()
                        ->back()
                        ->withErrors([ trans('messages.min_greater_than_max') ]);
                }
                if(!in_array($stand_type_id, $old_furnishings_stands_types)) {
                    DB::table('furnishings_stands_types')->insert([
                        'stand_type_id' => $stand_type_id,
                        'furnishing_id' => $request->furnishing_id,
                        'is_supplied' => isset($request->$is_supplied) ? 1 : 0,
                        'min' => isset($request->$min) ? $request->$min : null,
                        'max' => isset($request->$max) ? $request->$max : null,
                    ]);
                } else {
                    DB::table('furnishings_stands_types')->where([
                        ['stand_type_id', '=', $stand_type_id],
                        ['furnishing_id', '=', $request->furnishing_id]
                    ])->update([
                        'is_supplied' => isset($request->$is_supplied) ? 1 : 0,
                        'min' => isset($request->$min) ? $request->$min : null,
                        'max' => isset($request->$max) ? $request->$max : null,
                    ]);
                }
            }

            // delete the old ones that are not in the new array
            foreach($old_furnishings_stands_types as $index => $stand_type_id) {
                if(!in_array($stand_type_id, $request->stand_type_id)) {
                    DB::table('furnishings_stands_types')->where([
                        ['stand_type_id', '=', $stand_type_id],
                        ['furnishing_id', '=', $request->furnishing_id]
                    ])->delete();
                }
            }

            $furnishing_translations = DB::table('furnishings_translations')->where('id','=',$id)->update([
                'description' => $request->description,
            ]);

            $entity_name = trans('entities.furnishing');
            return redirect('admin/furnishings')->with('success', trans('forms.updated_success',['obj' => $entity_name]));
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function updateVariant(Request $request, $variant_id)
    {
        $validation_data = [
            'furnishing_id' => ['required', 'exists:furnishings,id'],
            'color' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'file' => ['mimes:jpeg,bmp,png,gif']
        ];

        $validator = Validator::make($request->all(), $validation_data);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $update_data = [
                'price' => $request->price ?? 0,
                'color' => $request->color,
                'extra_price' => !is_null($request->extra_price) ? 1 : 0
            ];
            if($request->hasFile('file')) {
                $file_path = Furnishing::findOrFail($request->furnishing_id)->file_path;
                unlink(public_path('upload/furnishings/'.$file_path));
                $image = $request->file('file');
                $rename_file = time().'.'.$request->file->getClientOriginalExtension();
                $request->file->storeAs('furnishings', $rename_file, ['disk' => 'upload']);
                $update_data['file_path'] = $rename_file;
            }
            
            $furnishing = Furnishing::find($request->furnishing_id)->update($update_data);

            $entity_name = trans('entities.variant');
            return redirect('admin/furnishings/'.$request->parent_id.'/variants')->with('success', trans('forms.created_success',['obj' => $entity_name]));
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function getStandsList()
    {
        $response = [
            'status' => false,
            'message' => trans('api.error_general')
        ];

        try {
            $response['status'] = true;
            $response['data'] = DB::table('stands_types_translations')->where('locale','=','it')->select('stand_type_id','name','size')->get();
            return response()->json($response);
        } catch(\Exception $e){
            $response['message'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function getStandType(Request $request)
    {
        $response = [
            'status' => false,
            'message' => trans('api.error_general')
        ];

        $validation_data = [
            'furnishing_id' => ['required', 'exists:furnishings,id'],
            'stand_type_id' => ['required', 'exists:stands_types,id']
        ];

        $validator = Validator::make($request->all(), $validation_data);

        if ($validator->fails()) {
            $response['message'] = trans('api.error_validation');
            return response()->json($response);
        }

        try {
            $furnishing_stand_type = DB::table('furnishings_stands_types')
                ->leftJoin('stands_types_translations', 'furnishings_stands_types.stand_type_id', '=', 'stands_types_translations.stand_type_id')
                ->where([
                    ['furnishings_stands_types.furnishing_id', '=', $request->furnishing_id],
                    ['furnishings_stands_types.stand_type_id', '=', $request->stand_type_id],
                    ['stands_types_translations.locale', '=', 'it']
                ])->select('stands_types_translations.name', 'stands_types_translations.size', 'furnishings_stands_types.*')->first();
            if(!is_object($furnishing_stand_type)) {
                $response['message'] = trans('api.obj_not_found', ['obj' => 'Relationship']);
                return response()->json($response);
            }
            $response['status'] = true;
            $response['data'] = $furnishing_stand_type;
            return response()->json($response);
        } catch(\Exception $e){
            $response['message'] = $e->getMessage();
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file_path = Furnishing::findOrFail($id)->file_path;
        unlink(public_path('upload/furnishings/'.$file_path));
        Furnishing::findOrFail($id)->delete();
        $entity_name = trans('entities.furnishings');
        return redirect('admin/furnishings')->with('success', trans('forms.deleted_success',['obj' => $entity_name]));
    }

    public function destroyVariant($id)
    {
        $furnishing = Furnishing::findOrFail($id);
        unlink(public_path('upload/furnishings/'.$furnishing->file_path));
        Furnishing::findOrFail($id)->delete();
        $entity_name = trans('entities.variant');
        return redirect('admin/furnishings/'.$furnishing->variant_id.'/variants')->with('success', trans('forms.deleted_success',['obj' => $entity_name]));
    }
}
