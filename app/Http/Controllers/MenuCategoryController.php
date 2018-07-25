<?php

namespace App\Http\Controllers;

use App\Model\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    //判断是否登录
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menucategories = MenuCategory::paginate(5);
        return view('menucategory/index',compact('menucategories'));
    }

    public function create()
    {
        return view('menucategory/create');
    }

    public function store(Request $request)
    {
        //数据验证
        $request->validate([
            'name' =>'required|max:20',
            'description'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=> '分类名称不能为空',
            'name.max'=>'分类名称长度不能大于20个字符',
            'description.required'=>'分类描述不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if (!$request->is_selected){
            $request->is_selected =0;
        }
        //根据微秒自动生成编号
        $type_accumulation = uniqid();
        //dd($type_accumulation);
        //所属商家ID
        $shop_id = auth()->user()->shop_id;
        //当前选中默认分类其他分类都不选中
        if($request->is_selected == 1){
            $count = DB::table('menu_categories')->where('is_selected',1)->count();
            if ($count > 0){
                DB::table('menu_categories')
                    ->update([
                        'is_selected'=>0,
                    ]);
            }
        }
        MenuCategory::create([
            'name'=>$request->name,
            'type_accumulation'=>$type_accumulation,
            'shop_id'=>$shop_id,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
        ]);
        return redirect()->route('menucategories.index')->with('success','添加成功');
    }

    public function show()
    {
        
    }

    public function edit(Menucategory $menucategory)
    {
        return view('menucategory/edit',compact('menucategory'));
    }

    public function update(Menucategory $menucategory,Request $request)
    {
        //数据验证
        $request->validate([
            'name' =>'required|max:20',
            'description'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=> '分类名称不能为空',
            'name.max'=>'分类名称长度不能大于20个字符',
            'description.required'=>'分类描述不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if (!$request->is_selected){
            $request->is_selected =0;
        }
        //当前选中默认分类其他分类都不选中
        if($request->is_selected == 1){
            $count = DB::table('menu_categories')->where('is_selected',1)->count();
            if ($count > 0){
                DB::table('menu_categories')
                    ->update([
                        'is_selected'=>0,
                    ]);
            }
        }
        $menucategory->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
        ]);
        return redirect()->route('menucategories.index')->with('success','更新成功');
    }

    public function destroy(Menucategory $menucategory)
    {
//        $menucategory->delete();
//        return redirect()->route('menucategories.index')->with('success','删除成功');
        //查询分类菜品下是否还有菜品
        $count = DB::table('menus')->where('category_id',$menucategory->id)->count();
        //dd($count);
        if ($count > 0){
            //如果大于0,说明分类下有菜品
            return redirect()->route('menucategories.index')->with('danger','该分类下有菜品,不能删除');
        }else{
            $menucategory->delete();
            return redirect()->route('menucategories.index')->with('success','删除成功');
        }
    }
}
