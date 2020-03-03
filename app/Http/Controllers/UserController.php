<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Socialite;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function redirectProvider($social){
        return Socialite::driver($social)->redirect();
    }
    public function handleProviderCallback($social){
        $user = Socialite::driver($social)->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);
        return back()->with('thongbao','Đăng nhập thành công');
    }
    private function findOrCreateUser($user){
        $authUser = User::where('social_id',$user->id)->first();
        if($authUser){
            return $authUser;
        }else{
            return User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => '',
                'social_id' => $user->id,
                'role' => 0,
                'status' => 0,
                'avatar' => $user->avatar,
            ]);
        }
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return back()->with('thongbao','Đăng xuất thành công');
        }
    }

    public function updatePassClient(Request $request){
        $this->validate($request,
            [
                'password' => 'required|min:4|max:255',
                're_password' => 'required|same:password',
            ],
            [
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.min' => 'Mật khẩu phải có tối thiểu 4 ký tự',
                'password.max' => 'Mật khẩu tối đa có 255 ký tự',
                're_password.required' => 'Không được bỏ trống',
                're_password.same' => 'Nhập không đúng với trường mật khẩu',
            ]
        );
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('thongbao','Đã cập nhật thành công mật khẩu');
    }

    public function loginClient(Request $request){
        $data = $request->only('email','password');
        if(Auth::attempt($data,$request->has('remember'))){
            return back()->with('thongbao','Đăng nhập thành công');
        }else{
            return back()->with('error','Đăng nhập thất bại. Xin vui lòng kiểm tra lại tài khoản');
        }
    }

    public function registerClient(Request $request){
        $this->validate($request,
            [
                'name' => 'required|min:2|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:255',
                're_password' => 'required|same:password',
            ],
            [
                'name.required' => 'Họ và tên không được bỏ trống',
                'name.min' => 'Họ và tên phải có tối thiểu 2 ký tự',
                'name.max' => 'Họ và tên tối đa có 255 ký tự',
                'email.required' => 'Địa chỉ email không được bỏ trống',
                'email.email' => 'Địa chỉ email nhập không đúng định dạng',
                'email.unique' => 'Đã tồn tại địa chỉ email trong hệ thống',
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.min' => 'Mật khẩu phải có tối thiểu 6 ký tự',
                'password.max' => 'Mật khẩu tối đa có 255 ký tự',
                're_password.required' => 'Không được bỏ trống',
                're_password.same' => 'Nhập không đúng với trường mật khẩu',
            ]
        );
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        Auth::login($user);
        return back()->with('thongbao','Đăng ký tài khoản thành công');
    }

//    public function getLogin()
//    {
//        return view('admin.login');
//    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|min:5|max:25',
            'password' => 'required|min:5',
        ],
            [
                'email.required' => 'Bạn chưa nhập Email !',
                'email.min' => 'Email phải ít nhất 5 ký tự',
                'email.max' => 'Email phải bé hơn hoặc bằng 25 ký tự',
                'password.required' => 'Bạn chưa nhập Password !',
                'password.min' => ' Password phải ít nhất 5 ký tự',
            ]
        );
        $data = $request->only('email','password');
        if(!Auth::attempt($data,$request->has('remember'))) {
            return redirect('admin/login')->with('thongbaoloi','Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin tài khoản !');

        }
        else {
            if(Auth::user()->role==1) {
                return redirect('admin/')->with('thongbao','Đăng nhập thành công');

            }
            else if (Auth::user()->role==2) {
                return redirect('admin/categories')->with('thongbao','Đăng nhập thành công');
            }
            else if (Auth::user()->role==3) {
                return redirect('admin/product')->with('thongbao','Đăng nhập thành công');
            }
            else if (Auth::user()->role==4) {
                return redirect()->route('order.index');
            }
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('admin.pages.user.list_user',['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $user = User::find($id);
            return response()->json(['user' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//            $validator = Validator::make($request->all(),
//                [
//                    'name' => 'required|min:3|max:255',
//                    'email' => 'required|min:3',
//                    'password' => 'required',
//                    'phone' => 'required|numeric',
//                    'avatar' => 'image'
//                ],
//                [
//                    'required' => ':attribute không được để trống',
//                    'min' => ':attribute phải từ 3 đến 255 kí tự',
//                    'max' => ':attribute phải từ 3 đến 255 kí tự',
//                    'numeric' => ':attribute phải là số nguyên',
//                    'avatar' => ':attribute phải là hình ảnh'
//
//                ],
//                [
//                    'name' => 'Tên người dùng',
//                    'email' => 'Địa chỉ Email',
//                    'password' => 'Mật khẩu',
//                    'phone' => 'Số điện thoại',
//                    'avatar' => 'Ảnh đại diện',
//                ]
//            );
//            if ($validator->fails()) {
//                return response()->json(['error' => 'true', 'message' => $validator->errors()], 200);
//            }
//                $user = User::find($id);
//                $data = $request->all();
//                $data['password'] = $user->password;
//                if (Hash::check($data['password'])) {
//                    if ($request->hasFile('avatar')) {
//                        $file = $request->avatar;
//                        //lay tên file getClient
//                        $file_name = $file->getClientOriginalName();
//                        // loại file
//                        $file_type = $file->getMimeType();
//                        //kick thuoc file
//                        $file_size = $file->getSize();
//                        if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
//                            if ($file_size <= 1048576) {
//                                $file_name = date('d-m-y') . '-' . rand() . '-' . utf8tourl($file_name);
//                                if ($file->move('img/upload/user', $file_name)) {
//                                    $data['avatar'] = $file_name;
//                                    if (File::exists('img/upload/user' . $user->avatar)) {
//                                        unlink('img/upload/user' . $user->avatar);
//                                    }
//                                }
//
//                            } else {
//                                return response()->json(['error', 'Ảnh của bạn có dung lượng quá lớn'], 200);
//                            }
//                        } else {
//                            return response()->json(['error', 'File đã chọn không phải là ảnh'], 200);
//                        }
//
//                    } else {
//                        $data['avatar'] = $user->avatar;
//                    }
//                }
//                $user->update([
//                    'name' => $data['name'],
//                    'email' => $data['email'],
//                    'password' => Hash::make($data['password']),
//                    'phone' => $data['phone'],
//                    'role' => $data['role'],
//                    'status' => $data['status'],
//                    'avatar' => $data['avatar'],
//                ]);
//                return response()->json(['result' => 'Đã sửa thành công sản phẩm'], 200);
    }

    public function postEditUser(Request $request)
    {
        $countUser = count(User::all());
        for ($cnt = 1; $cnt <= $countUser; $cnt++) {
            if (isset($_POST['edit_user_' . $cnt])) {

                $id = $request->input("id_user_" . $cnt);
                $passold = User::find($id)->password;
                if ($request->file("fmi_avatar_edit_" . $cnt) != NULL) {
                    $avatar = date('Y-m-d') . '_' . round(microtime(true) * 1000) . '_' . $request->file("fmi_avatar_edit_" . $cnt)->getClientOriginalName();
                } else {
                    $avatar = $request->input("fmi_avatar_" . $cnt);
                }
                $name = $_POST["fmi_fullname_edit_" . $cnt];
                $email = $_POST["fmi_email_edit_" . $cnt];
                $phone = $_POST["fmi_phone_edit_" . $cnt];
                $role = $_POST["fmi_role_edit_" . $cnt];
                $password = $_POST["fmi_pass_old_edit_" . $cnt];
                $password1 = $_POST["fmi_pass_new_edit_" . $cnt];
                $password2 = $_POST["fmi_pass_new2_edit_" . $cnt];
                if (Hash::check($password, $passold)) {
                    if ($password1 == $password2) {
                        $typefile = $request->file("fmi_avatar_edit_" . $cnt)->getMimeType();
                        $type = explode("/", $typefile)[0];// Hàm explode biến 1 chuỗi về 1 mảng
                        if ($type != "image") {
                            return back()->with('noti1', "FILE upload phải là FILE Image!");
                        } else {
                            $updateuser = User::find($id);
                            $updateuser->name = $name;
                            $updateuser->email = $email;
                            $updateuser->phone = $phone;
                            $updateuser->avatar = $avatar;
                            $updateuser->role = $role;
                            $updateuser->password = Hash::make($password1);
                            if ($request->file("fmi_avatar_edit_" . $cnt) != NULL) {

                                $request->file("fmi_avatar_" . $cnt)->move(public_path('libraries/images/avatar'), $avatar);
                            }
                            $updateuser->save();
                        }

                    } else {
                        return back()->with('noti1', "Mật khẩu không trùng khớp!");
                    }
                } elseif ($password == "" && $password1 == "" && $password2 == "") {

                    $typefile = $request->file("fmi_avatar_edit_".$cnt)->getMimeType();
                    $type = explode("/", $typefile)[0]; //Hàm ex

                    if ($type != "image") {
                        return back()->with('noti1', "FILE upload phải là FILE Image!");
                    } else {
                        $updateuser = User::find($id);
                        //$typefile này sẽ luôn cho 1 chuỗi dạng như thế này xxx/yyy. xxx và yyy được cách nhau 1 dấu
                        //thì giờ ta dùng explode để đưa về 2 phần tử của mảng
                        $updateuser->name = $name;
                        $updateuser->email = $email;
                        $updateuser->phone = $phone;
                        $updateuser->avatar = $avatar;
                        if ($request->file("fmi_avatar_edit_".$cnt) != NULL) {
                            $request->file("fmi_avatar_edit".$cnt)->move(public_path('libraries/images/avatar'), $avatar);
                        }

                        $updateuser->role = $role;
                        $updateuser->save();
                        return back();
                    }
                } else {
                    return back()->with('noti1', "Mật khẩu cũ không đúng!");
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

}
