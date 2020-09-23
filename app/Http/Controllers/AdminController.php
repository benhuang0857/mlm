<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use App\Mail\LevelUp;
use Illuminate\Support\Facades\Mail;
use Auth;
use Session;
use Cookie;
use PDF;

class AdminController extends Controller
{
    private $sumBox = 0;
    private $coutMem = 0;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = Auth::user()->id;
        $users = User::where('id', $uid)->get();
        $tree = $this->treeView($users);

        $levelArray = Auth::user()->level;

        $data = [
            'USER' => Auth::user(),
            'OUTPUTS' => $this->coutMem,
            'LEVEL' => $levelArray,
        ];

        return view('back.admin')->with($data);
    }

    //更新資料頁面
    public function edit()
    {
        $user = Auth::user();

        $data = [
            'USER' => $user
        ];

        return view('back.admin-edit')->with($data);
    }

    //更新資料
    public function update(Request $request)
    {
        $user = Auth::user();

        if(request()->hasFile('AvatarImage'))
        {
            $avatar = request()->file('AvatarImage')->getClientOriginalName();
            $imageName = pathinfo($avatar, PATHINFO_FILENAME);
            $extension = request()->file('AvatarImage')->getClientOriginalExtension();
            $imageNametoStore = $imageName.'_'.time().'.'.$extension;
            $path = request()->file('AvatarImage')->storeAs('public/images/avatar', $imageNametoStore);
            Storage::delete('public/images/avatar/'.$user->image);
        }

        if($request->hasFile('AvatarImage')){
            $user->image = $imageNametoStore;
        }

        $user->name = $request->input('name');
        $user->nickname = $request->input('nickname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->fb_account = $request->input('fb_account');
        $user->ig_account = $request->input('ig_account');
        if(!empty($request->input('password')))
        {
            $user->password = bcrypt($request->input('password'));
        }
        
        $user->save();
        return redirect('/admin')->cookie('MSG', '資料更新成功', 0.05);
    }

    /**
     * Show the pdf contract.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_pdf()
    {
        $user = Auth::user();
        $leader = User::where('id', $user->leader_id)->first();

        $pdf = PDF::loadView('back.contract', array('user' => $user, 'leader' => $leader));
        return $pdf->stream('contract.pdf'); 
    }
    //尋訪
    function treeView($Me)
    {
        $users = $Me;
        $tree = '<ul class="tree">';
        
        foreach ($users as $user)
        {
            if (Auth::user()->role != "一般會員")
            {
                $tree .= '<li><span><a href="/admin/members/'.$user->id.'" class="tree-name">
                <div class="image">
                    <img src="/storage/images/avatar/'.$user->image.'" class="img-circle elevation-2" style="width:80px;height:80px" alt="User Image">
                </div>
                </a>
                <p>姓名：'.$user->name.'<br>'.$user->nickname.'</br></p>
                </span>';
            }
            else
            {
                $tree .= '<li><span><a href="#" class="tree-name">
                <div class="image">
                    <img src="/storage/images/avatar/'.$user->image.'" class="img-circle elevation-2" style="width:80px;height:80px" alt="User Image">
                </div>
                </a>
                <p>姓名：'.$user->name.'<br>'.$user->nickname.'</br></p>
                
                </span>';
            }


            if(count($user->childs)) {
                $tree .=$this->childView($user);
            }
        }
        //$tree .= '<ul>';

        return $tree;
    }

    public function childView($user)
    {
        $html ='<ul>';
        foreach ($user->childs as $arr) {
            $this->coutMem += 1;
            if(count($arr->childs)){

                if (Auth::user()->role != "一般會員")
                {
                    $html .='<li><span><a href="/admin/members/'.$arr->id.'" class="tree-name">
                    <div class="image">
                    <img src="/storage/images/avatar/'.$arr->image.'" class="img-circle elevation-2" style="width:60px;height:60px" alt="User Image">
                    </div>
                    </a><p>姓名：'.$arr->name.'<br>'.$arr->nickname.'</br></p></span>';  
                }
                else
                {
                    $html .='<li><span><a href="#" class="tree-name">
                    <div class="image">
                    <img src="/storage/images/avatar/'.$arr->image.'" class="img-circle elevation-2" style="width:60px;height:60px" alt="User Image">
                    </div>
                    </a><p>姓名：'.$arr->name.'<br>'.$arr->nickname.'</br></p></span>';  
                }

                $html.= $this->childView($arr);

            }else{

                if (Auth::user()->role != "一般會員")
                {
                    $html .='<li><span><a href="/admin/members/'.$arr->id.'" class="tree-name">
                    <div class="image">
                    <img src="/storage/images/avatar/'.$arr->image.'" class="img-circle elevation-2" style="width:60px;height:60px" alt="User Image">
                    </div>
                    </a><p>姓名：'.$arr->name.'<br>'.$arr->nickname.'</br></p></span>';   
                }
                else
                {
                    $html .='<li><span><a href="#" class="tree-name">
                    <div class="image">
                    <img src="/storage/images/avatar/'.$arr->image.'" class="img-circle elevation-2" style="width:60px;height:60px" alt="User Image">
                    </div>
                    </a><p>姓名：'.$arr->name.'<br>'.$arr->nickname.'</br></p></span>';   
                }                   
                $html .="</li>";
            }             
        }
        $html .="</ul>";
        return $html;
    }

    //顯示線下會員
    public function ShowMembersPage()
    {
        $uid = Auth::user()->id;
        $users = User::where('id', $uid)->get();
        $tree = $this->treeView($users);

        $data = [
            'LEADER' => User::where('id', Auth::user()->leader_id)->first(),
            'USER' => Auth::user(),
            'TREE' => $tree
        ];
        return view('back.member.members')->with($data);
    }

    //顯示所有線下會員
    public function ShowAllMembersPage()
    {
        $uid = Auth::user()->id;
        $users = User::where('id', $uid)->get();
        $tree = $this->treeView($users);

        $data = [
            'USER' => Auth::user(),
            'OUTPUTS' => User::all(),
            'TREE' => $tree
        ];
        return view('back.member.showallmembers')->with($data);
    }

    //顯示所有線下會員
    public function SearchMember(Request $request)
    {
        //$request->get('searchQ');

        $members = User::where('name', 'like', '%'.$request->get('searchQ').'%')
        ->orWhere('email', 'like', '%'.$request->get('searchQ').'%')
        ->orWhere('phone', 'like', '%'.$request->get('searchQ').'%')
        ->orWhere('authorization_code', 'like', '%'.$request->get('searchQ').'%')
        ->get();

        return json_encode($members);
    }


    //顯示線下會員資料
    public function ShowYourMembersInfo($id)
    {
        $member = User::where('id', $id)->first();
        $leaders = User::where('id', '!=', $id)->get();

        $levelArray = $member->level;

        $data = [
            'MEM' => $member,
            'USER' => Auth::user(),
            'LEADERS' => $leaders,
            'LEVEL' => $levelArray,
        ];
        return view('back.member.member-edit')->with($data);
    }

    //更新線下會員資料
    public function UpdateYourMembersInfo($id, Request $request)
    {
        $user = User::where('id', $id)->first();

        if(request()->hasFile('AvatarImage'))
        {
            $avatar = request()->file('AvatarImage')->getClientOriginalName();
            $imageName = pathinfo($avatar, PATHINFO_FILENAME);
            $extension = request()->file('AvatarImage')->getClientOriginalExtension();
            $imageNametoStore = $imageName.'_'.time().'.'.$extension;
            $path = request()->file('AvatarImage')->storeAs('public/images/avatar', $imageNametoStore);
            Storage::delete('public/images/avatar/'.$user->image);
        }

        if($request->hasFile('AvatarImage')){
            $user->image = $imageNametoStore;
        }

        $user->name = $request->input('name');
        $user->nickname = $request->input('nickname');
        $user->leader_id = intval($request->input('leader_id'));
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->role = $request->input('role');
        $user->milage = $request->input('milage');

        $categories = Category::all();
        $mergeArray = array();

        foreach($categories as $category)
        {
            $data = $request->input("$category->name");
            $jsonArray = array( "$category->name" => "$data");

            if($mergeArray != NULL)
            {
                $mergeArray = array_merge($jsonArray, $mergeArray);
            }
            else
            {
                $mergeArray = $jsonArray; 
            }   
        }
        $user->level = json_encode($mergeArray,JSON_UNESCAPED_UNICODE);

        if(!empty($request->input('password')))
        {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return redirect('/admin')->cookie('MSG', '會員更新成功', 0.05);
    }

    //刪除會員
    public function DeleteYourMember($id)
    {
        $member = User::where('id',$id)->first();
        $leader_id = $member->leader_id;
        $this->SetMemberLeaderId($id, $leader_id);
        $member->delete();
        
        return redirect('/admin')->cookie('MSG', '刪除成功', 0.05);
    }

    //刪除後自動設定領導ID
    public function SetMemberLeaderId($id, $leader_id)
    {
        $link_leader_id = $leader_id;
        $members = User::where('leader_id', $id)->get();

        foreach($members as $member)
        {
            $member->leader_id = $link_leader_id;
            $member->save();
        }
    }
}
