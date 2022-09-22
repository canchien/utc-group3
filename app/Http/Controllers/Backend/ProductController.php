<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Datatables;
use App\Models\Category;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class ProductController extends Controller
{
    /**
     * Custom function
     */

    public function getData()
    {
        $products = Product::all();
        $images = ProductImage::all();
        return Datatables::of($products)->make(true);
    }

    public function getDataA()
    {
        $products = Product::with('category');
        return response()->json([
            'products' => $products,
        ]);
    }

    //  end
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.index', ['data' => 'index', 'type' => 'product']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', ['data' => 'create', 'type' => 'product', 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // { // Tú
    //     // dd('Tú');
    //     if($request->hasFile('file')){
    //         $file = $request->file;
    //         return $file->move('storage',$file->getClientOriginalName());
    //         // dd('yes');
    //     }
    //     else{
    //         dd('no');
    //     }
    //     $data = $request->all();
    //     // if($data['image']){ // Vinh
    //     if($data['file']){
    //         // lấy tên file :

    //         // $file = $data['image']; // Vinh
    //         // dd($file[0]);
    //         $file_name = $file[0]->getClientOriginalName();
    //         // // lấy đuôi file:
    //         // echo $file->getClientOriginalExtension();
    //         // // lấy kích thước file:
    //         // echo $file->filesize();
    //         // return $file->move('public/uploads',$file->getClientOriginalName());
    //         return $file->move(public_path('/uploads'), end($file_name));
    //     }
    //     dd('Không có ảnh');
    // }
    {
        $data = $request->all();
        $imageArray = [];
        // Upload ảnh
        if (request()->has('image')) {
            foreach ($data['image'] as $image) {
                $filenamewithextension = $image->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename.'.'.$extension;
                $image->move(public_path('storage/uploads'), $fileNameToStore);

                $imagePath = "storage/uploads/".$fileNameToStore;
                // $image = Image::make(public_path("storage/images/".$fileNameToStore))->fit(1000, 1000);
                // $image->save(public_path("storage/public/uploads"));
                $imageArray[] = ['image' => $imagePath];
            }
        }
        try {

            $product = Product::create(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'qty' => $request->qty,
                    'category_id' => $request->category_id,
                    'description' => $request->description,
                    'keyword' => $request->keyword
                ]
            );
            // Thêm ảnh
            if ($imageArray){
                foreach ($imageArray as $image) {
                    $product->productimages()->create([
                        'image' => $image['image'],
                        'alt' => request()->name,
                    ]);
                }
            }
        } catch (Exception $e) {
            // nếu có lỗi khi thêm sp thì sẽ xoá file đã upload
            // foreach ($imageArray as $image) {
            //     Storage::delete('/public/' . $image['image']);
            // }
        }
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\
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
        $product = Product::find($id);
        $categories = Category::all();
        return view('backend.products.edit',
        ['data' => 'edit',
        'type' => 'product',
         'product_data' => $product, 'categories' => $categories]);
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
        $product = Product::find($id);
        // Upload ảnh
        $data = $request->all();
        $imageArray = [];
        // Upload ảnh
        if (request()->has('image')) {
            foreach ($data['image'] as $image) {
                $filenamewithextension = $image->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename.'.'.$extension;
                $image->move(public_path('storage/uploads'), $fileNameToStore);

                $imagePath = "storage/uploads/".$fileNameToStore;
                // $image = Image::make(public_path("storage/images/".$fileNameToStore))->fit(1000, 1000);
                // $image->save(public_path("storage/public/uploads"));
                $imageArray[] = ['image' => $imagePath];
            }
        }
        try {
            $product->update(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'qty' => $request->qty,
                    'category_id' => $request->category_id,
                    'description' => $request->description,
                    'keyword' => $request->keyword
                ]
            );
            if (isset($imageArray)) {
                // Thêm ảnh
                foreach ($imageArray as $image) {
                    $product->productimages()->create([
                        'image' => $image['image'],
                        'alt' => request()->name,
                    ]);
                }
            }
        } catch (Exception $e) {
            // nếu có lỗi khi thêm sp thì sẽ xoá file đã upload
            foreach ($imageArray as $image) {
                Storage::delete('/public/' . $image['image']);
            }
        }
        return redirect(route('product.index', ['data' => 'index', 'type' => 'product']));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { }

    public function destroyA(Request $request)
    {
        return response()->json([
            'status' => Product::destroy($request->id),
        ]);
    }

    public function multiDestroy(Request $request)
    {
        $ids = $request->id;
        Product::whereIn('id', $ids)->delete();
        return response()->json([
            'return' => 'Xoá thành công ' . count($ids) . ' bản ghi !',
        ]);
    }

    public function showUpdateImage(Product $product)
    {
        return view('backend.products.imagesIndex', compact('product'));
    }

    public function doUpdateImage()
    {
        $product = Product::find(request('id'));
        $data = request()->validate(
            [
                'image' => ['required'],
                'alt' => ['required', 'max:255', 'string'],
            ],
            [
                'image.required' => 'Hãy chọn ít nhất 1 ảnh hoặc ảnh bạn chọn không đúng định dạng hoặc số lượng ảnh nhiều hơn 10',
                'alt.required' => 'Hãy nhập mô tả cho ảnh',
                'alt.max' => 'Mô tả tối đã :max ký tự',
                'alt.string' => 'Hãy nhập đúng dạng ký tự',
            ]
        );
        try {
            // nếu có ảnh và số lượng ảnh nhỏ hơn hoặc bằng 10 cái
            if (request()->has('image') && count($data['image']) <= 10) {
                // Thêm ảnh

                foreach ($data['image'] as $image) {
                    $filenamewithextension = $image->getClientOriginalName();
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();
                    $fileNameToStore = $filename.'.'.$extension;
                    $image->move(public_path('storage/uploads'), $fileNameToStore);

                    $imagePath = "storage/uploads/".$fileNameToStore;
                    // $image = Image::make(public_path("storage/images/".$fileNameToStore))->fit(1000, 1000);
                    // $image->save(public_path("storage/public/uploads"));
                    $product->productimages()->create([
                        'image' => $imagePath,
                        'alt' => $data['alt'],
                    ]);
                }
            } else {
                return redirect()->back();
            }
        } catch (Exception $e) {
            // nếu có lỗi khi thêm sp thì sẽ xoá file đã upload
            foreach (request()->image as $image) {
                Storage::delete('/public/uploads/' . $image['image']);
            }
        }
        return redirect()->back();
    }

    public function deleteImage()
    {
        $image = ProductImage::find(request('id'));
        Storage::delete('/public/' . $image->image);
        return response()->json([
            'status' => $image->delete(),
        ]);
    }

    public function setActive()
    {
        // Lấy số lượng flag status trong bảng ảnh
        $product = Product::find(request()->id);
        $statusCount = $product->productimages()->where('status', 1)->count();
        // Nếu đã có 3 ảnh được active thì đẩy về json tbao kq
        if ($statusCount >= 3) {
            return response()->json([
                'status' => 'has3count',
            ]);
            // Con ngược lại
        } else {
            $ids = request()->ids;
            ProductImage::whereIn('id', $ids)->update([
                'status' => 1,
            ]);
            return response()->json([
                'status' => 'success',
            ]);
        }
    }

    public function setUnactive()
    {
        $ids = request()->ids;
        ProductImage::whereIn('id', $ids)->update([
            'status' => 0,
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }


}
