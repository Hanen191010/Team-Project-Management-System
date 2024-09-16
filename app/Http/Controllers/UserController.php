<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{   
    protected $UserService; 

    // Dependency Injection of UserService
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService; 
    }
        /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // الحصول على جميع المستخدمين من قاعدة البيانات وإرجاعهم كاستجابة JSON
        return response()->json(User::all());
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // التحقق من صحة البيانات الواردة في الطلب
        $request->validate([
            'name' => 'required|string', // الاسم مطلوب ونوعه نصي
            'email' => 'required|string|email|unique:users', // البريد الإلكتروني مطلوب ونوعه نصي وصحيح و فريد
            'password' => 'required|string', // كلمة المرور مطلوبة ونوعها نصي
            'role' => 'required|in:developer,tester',
            'project_id'=>'required|exists:projects,id'
        ]);

        $user=$this->UserService->createUser($request->all());
        // إرجاع المستخدم الجديد كاستجابة JSON مع رمز 201 (تم إنشاء المورد بنجاح)
        return response()->json($user, 201);
    }

    /*
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // الحصول على المستخدم المطلوب من قاعدة البيانات باستخدام ID
        $user = User::findOrFail($id);

        // إرجاع المستخدم كاستجابة JSON
        return response()->json($user);
    }

    /*
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // الحصول على المستخدم المطلوب من قاعدة البيانات باستخدام ID
        $user = User::findOrFail($user->id);
        // التحقق من صحة البيانات الواردة في الطلب
        $request->validate([
            'name' => 'nullable|string', // الاسم مطلوب ونوعه نصي
            'email' => 'nullable|string|email|unique:users', // البريد الإلكتروني مطلوب ونوعه نصي وصحيح و فريد
            'password' => 'nullable|string', // كلمة المرور مطلوبة ونوعها نصي
        ]);

        // إنشاء مستخدم جديد باستخدام البيانات المصادقة
        $updated_User = $this->UserService->updateUser($user, $request->all());
        
        return response()->json($updated_User, 201);
        
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // حذف المستخدم من قاعدة البيانات باستخدام ID
        $User = $this->UserService->deleteUser($user);

        // إرجاع استجابة JSON فارغة مع رمز 204 (لا يوجد محتوى)
        return response()->json(null, 204);
    }

}
