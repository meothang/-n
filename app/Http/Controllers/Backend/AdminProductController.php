<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests\RequestProduct;
use App\Http\Requests\EditProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\ProductType;
use App\Http\Controllers\Controller as Controllers;


class AdminProductController extends Controllers
{
    public function index(Request $req )
    {  

        $products = Product::with('categories:id,name');
        if($req->name)
        {
            $products->where('pro_name','like','%'.$req->name.'%');
        }
        if($req->cate) 
        {
            $products =$products->where('pro_cate_id',$req->cate);
        }
        $products = $products-> orderBy('id','DESC')->paginate(10);
        $categories = Category::all();
        $viewData =[
            'categories' => $categories,
            'products' => $products,
            'index' => 0
        ];
        return view('backend.product.product',$viewData);
    }
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.addProduct',compact('categories'));
    }

    public function store(RequestProduct $req)
    {
        $product= new Product();
        $product->pro_name = $req->pro_name;
        $product->pro_type = $req->pro_type;
        $product->pro_sale = $req->pro_sale;
        $product->pro_slug =Str::slug($req->pro_name,'-');
        $product->pro_content= $req->pro_content;
        $product->pro_price  = $req->pro_price;
        $product->pro_cate_id = $req->pro_cate_id;
        $product ->pro_amount = $req ->pro_amount;
        $pro_cate_path = Category::find($req -> pro_cate_id);
        if($req->hasFile('pro_image'))
        {
            $file = $req->file('pro_image');
            $filename = $file->getclientoriginalName();
            $filename = date('d-m-yy').'_'.rand().'_'.$filename;
            $file->move('img/product/'.$pro_cate_path -> name.'/' ,$filename);
            $product->pro_image = $filename;
        }

        if($req->hasFile('image1'))
        {
            $file = $req->file('image1');
            $filename = $file->getclientoriginalName();
            $filename = date('d-m-yy').'_'.rand().'_'.$filename;
            $file->move('img/product/'.$pro_cate_path -> name .'/',$filename);
            $product->image1 = $filename;
        }

        if($req->hasFile('image2'))
        {
            $file = $req->file('image2');
            $filename = $file->getclientoriginalName();
            $filename = date('d-m-yy').'_'.rand().'_'.$filename;
            $file->move('img/product/'.$pro_cate_path -> name.'/' ,$filename);
            $product->image2 = $filename;
        }

        if($req->hasFile('image3'))
        {
            $file = $req->file('image3');
            $filename = $file->getclientoriginalName();
            $filename = date('d-m-yy').'_'.rand().'_'.$filename;
            $file->move('img/product/'.$pro_cate_path -> name.'/' ,$filename);
            $product->image3 = $filename;
        }
        $pro_detail = $req->only('cpu','ram', 'screen', 'card','harddrive','weight', 'camera', 'port','pin');
        $product->pro_detail = implode(",", $pro_detail);
        $product->pro_amount += $req->pro_amount; 
        $product->save();
        return redirect()->back()->with('success','Thêm sản phẩm thành công');
    }
    public function edit($id)
    {  
        $categories = Category::all();
        $product = Product::find($id);
        $pro_detail = explode(',',$product->pro_detail);
        $viewData =[
            'categories' => $categories,
            'product' => $product,
            'pro_detail' => $pro_detail,
            'index' => 0
        ];
        return view('backend.product.editProduct',$viewData);
    }


    public function update(EditProductRequest $req,$id)
    {

        $product= Product::find($id);
        $product->pro_name = $req->pro_name;
        $product->pro_type = $req->pro_type;
        $product->pro_sale = $req->pro_sale;
        $product->pro_slug =Str::slug($req->pro_name,'-');
        $product->pro_content= $req->pro_content;
        $product->pro_price  = $req->pro_price;
        $product->pro_amount  = $req->pro_amount;
        $product->pro_cate_id = $req->pro_cate_id;
        $pro_cate_path = Category::find($req -> pro_cate_id);
        if($req->hasFile('pro_image'))
        {
            $path_img_old ="img/product/".$pro_cate_path -> name.'/'.$product->pro_image;
            // dd($path_img_old);
            if(file_exists($path_img_old))
            {
                @unlink($path_img_old);
            }
            $file = $req->file('pro_image');
            $filename = $file->getclientoriginalName();
            $filename = date('d-m-yy').'_'.rand().'_'.$filename;
            $file->move('img/product/'.$pro_cate_path -> name .'/',$filename);
            $product->pro_image = $filename;
        }
        if($req->hasFile('image1'))
        {
            $path_img_old1 ="img/product/".$pro_cate_path -> name.'/'.$product->image1;
            // dd($path_img_old);
            if(file_exists($path_img_old1))
            {
                @unlink($path_img_old1);
            }
            $file = $req->file('image1');
            $filename = $file->getclientoriginalName();
            $filename = date('d-m-yy').'_'.rand().'_'.$filename;
            $file->move('img/product/'.$pro_cate_path -> name .'/',$filename);
            $product->image1 = $filename;
        }

        if($req->hasFile('image2'))
        {
           $path_img_old2 ="img/product/".$pro_cate_path -> name.'/'.$product->image2;
            // dd($path_img_old);
           if(file_exists($path_img_old2))
           {
            @unlink($path_img_old2);
        }
        $file = $req->file('image2');
        $filename = $file->getclientoriginalName();
        $filename = date('d-m-yy').'_'.rand().'_'.$filename;
        $file->move('img/product/'.$pro_cate_path -> name.'/' ,$filename);
        $product->image2 = $filename;
    }

    if($req->hasFile('image3'))
    {
       $path_img_old3 ="img/product/".$pro_cate_path -> name.'/'.$product->image3;
            // dd($path_img_old);
       if(file_exists($path_img_old3))
       {
        @unlink($path_img_old3);
    }
    $file = $req->file('image3');
    $filename = $file->getclientoriginalName();
    $filename = date('d-m-yy').'_'.rand().'_'.$filename;
    $file->move('img/product/'.$pro_cate_path -> name.'/' ,$filename);
    $product->image3 = $filename;
}
        // $product->pro_amount = $req->pro_amount;
$pro_detail = $req->only('cpu','ram', 'screen', 'card','harddrive','weight', 'camera', 'port','pin');
$product->pro_detail = implode(",", $pro_detail);
$product->save();
return redirect()->back()->with('success','Cập nhật sản phẩm thành công');
}


public function action($action,$id)
{
    if(isset($action))
    {   
       $product   = Product::find($id);
       switch($action)
       {
        case 'delete':
        $product->delete();
        return response()-> json(['success' => 'Xóa Thành Công']);
        break;
        case 'status':
        $product -> status = $product-> status ? 0 : 1;
        $product -> save();
        break;
    }
}
return redirect()->back();
}
}
