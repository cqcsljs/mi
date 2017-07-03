<?php
/**
 * File Name: ProductModelController.php
 * Description: 商品模型控制器
 * Created by PhpStorm.
 * Group: FiresGroup
 * Auth: Showkw
 * Date: 2017/6/23
 * Time: 10:51
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\ProductModelRequest;
use App\Entity\ProductModel;
use DB;
use App\Http\Controllers\Controller;

class ProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     * 商品模型列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelList = ProductModel::paginate(10);
        return view('admin.product.model.index', compact('modelList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.product.model.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductModelRequest $request)
    {
        $model_name = $request->model_name;
        $res = ProductModel::create(['model_name'=>$model_name])->id;
        return $res?0:1;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($model_id)
    {
        $model = ProductModel::find($model_id);
        return view('admin.product.model.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductModelRequest $request, $model_id)
    {
        $res = ProductModel::where('id',$model_id)->update(['model_name'=>$request->model_name ]);
        return $res != -1?0:1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($model_id)
    {
        $model = ProductModel::find($model_id);
        $specs = $model->spec->toArray();
        $attrs = $model->attr->toArray();
        if( !empty($specs) && !empty($attrs) ){
            return 2;//模型下存在规格和属性
        }else{
            //模型下没有规格和属性才能删除
            $res = ProductModel::destroy($model_id);
            return $res?0:1;
        }

    }

}