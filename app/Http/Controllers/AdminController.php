<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\User;
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
        $cat01 = 0;
        $cat02 = 0;

        $orders = Auth::user()->orders->where('status','完成訂購')->where('pay',1);
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        //根據等級去設定達成目標
        if (Auth::user()->levelcat01 == "F")
        {
            Session::put('cat01NextLevelnum', 10);
        }
        if (Auth::user()->levelcat01 == "E")
        {
            Session::put('cat01NextLevelnum', 40);
        }
        if (Auth::user()->levelcat01 == "D")
        {
            Session::put('cat01NextLevelnum', 120);
        }
        if (Auth::user()->levelcat01 == "C")
        {
            Session::put('cat01NextLevelnum', 320);
        }
        if (Auth::user()->levelcat01 == "B")
        {
            Session::put('cat01NextLevelnum', 780);
        }
        if (Auth::user()->levelcat01 == "A")
        {
            Session::put('cat01NextLevelnum', 2220);
        }

        //根據等級去設定達成目標
        if (Auth::user()->levelcat02 == "F")
        {
            Session::put('cat02NextLevelnum', 10);
        }
        if (Auth::user()->levelcat02 == "E")
        {
            Session::put('cat02NextLevelnum', 40);
        }
        if (Auth::user()->levelcat02 == "D")
        {
            Session::put('cat02NextLevelnum', 120);
        }
        if (Auth::user()->levelcat02 == "C")
        {
            Session::put('cat02NextLevelnum', 320);
        }
        if (Auth::user()->levelcat02 == "B")
        {
            Session::put('cat02NextLevelnum', 780);
        }
        if (Auth::user()->levelcat02 == "A")
        {
            Session::put('cat02NextLevelnum', 2220);
        }

        //算出$cat01 $cat02數量
        $arrForName = array();
        $arrForQty = array();
        $arrForCat = array();
        $result = array();

        foreach ($orders as $order)
        {
            foreach ($order->cart->items as $item)
            {
                if (empty($arrForName) || !in_array($item['item']['name'], $arrForName))
                {
                    array_push($arrForName, $item['item']['name']);
                    array_push($arrForQty, $item['qty']);
                }
                else if(in_array($item['item']['name'], $arrForName))
                {
                    $key = array_search($item['item']['name'], $arrForName);//找到商品在陣列中的位置
                    $arrForQty[$key] += $item['qty'];
                }
                array_push($arrForCat, $item['item']['category']);
            }
        }

        foreach ($arrForName as $id => $key)
        {
            $result[$key] = array(
                'name' => $arrForName[$id],
                'qty' => $arrForQty[$id],
                'category' => $arrForCat[$id],
            );
        }

        foreach ($result as $r)
        {
            if ($r['category'] == '美妝')
            {
                $cat01 = max($cat01, $r['qty']);
                Session::put('cat01', $cat01);
            }
            else if ($r['category'] == '保健')
            {
                $cat02 = max($cat02, $r['qty']);
                Session::put('cat02', $cat02);
            }
        }

        $uid = Auth::user()->id;
        $member_orders = Order::where('leader_id', $uid)->where('status', '已通知店家')->get();
        $my_member = User::where('leader_id', $uid)->get();

        $sum = 0;
        foreach ($orders as $order)
        {
            foreach ($order->cart->items as $item)
            {
                $sum += $item['qty'];
            }
        }

        $this->sumBox = $sum;
        $users = User::where('id', $uid)->get();
        $tree = $this->treeView($users);

        $data = [
            'USER' => Auth::user(),
            'ORDERS' => $orders,
            'MEM' => $my_member,
            'MEMORDER' => $member_orders,
            'BOXNUM' => $this->sumBox,
            'OUTPUTS' => $this->coutMem
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
        $member = User::where('id',$id)->first();
        $leaders = User::where('id', '!=', $id)->get();

        $data = [
            'MEM' => $member,
            'USER' => Auth::user(),
            'LEADERS' => $leaders
        ];
        return view('back.member.member-edit')->with($data);
    }

    //更新線下會員資料
    public function UpdateYourMembersInfo($id, Request $request)
    {
        $user = User::find($id);

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
        $user->fb_account = $request->input('fb_account');
        $user->ig_account = $request->input('ig_account');
        $user->role = $request->input('role');
        $user->milage = $request->input('milage');
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

    //顯示歷史訂單
    public function getHistoryOrders()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        $data = [
            'USER' => Auth::user(),
            'ORDERS' => $orders
        ];

        return view('back.shop.order-history')->with($data);
    }

    //顯示歷史訂單細項
    public function showHistoryOrdersDetail($id)
    {
        $order = Order::where('id', $id)->first();
        $order->cart = unserialize($order->cart);
        //return response()->json($order->cart);
        $data = [
            'ORDER' => $order,
            'USER' => Auth::user(),
            'CART' => $order->cart,
            'TOTALPRICE' => $order->totalprice,
            'STATUS' => $order->status
        ];

        return view('back.shop.order-history-detail')->with($data);
    }

    //顯示下線訂單
    public function showYourMemberOrders()
    {
        $uid = Auth::user()->id;
        $orders = Order::where('leader_id', $uid)->get();
        //dd($orders);
        $data = [
            'USER' => Auth::user(),
            'ORDERS' => $orders
        ];

        return view('back.shop.order-history-members')->with($data);
    }

    //更新下線訂單狀態
    public function updateOrdersStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->address = $request->input('inputAdress');
        $order->name = $request->input('inputName');
        $order->phone = $request->input('inputPhone');
        $order->email = $request->input('inputEmail');
        $order->status = $request->input('inputStatus');
        $order->pay = $request->input('inputPay');

        $order->save();
        return redirect('/admin/order-history-member')->with('SUCCESS', '更新訂單成功');
    }

    //取消訂單
    public function cancelOrders($id)
    {
        $order = Order::find($id);
        $order->status = '取消訂單';

        $order->save();
        //return redirect('/admin/order-history-member')->with('SUCCESS', '更新訂單成功');
    }

    //刪除訂單(其實是隱藏)
    public function deleteOrders($id)
    {
        $order = Order::find($id);
        $order->status = '刪除訂單';

        $order->save();
        //return redirect('/admin/order-history-member')->with('SUCCESS', '更新訂單成功');
    }

    //升級
    public function levelUp()
    {
        
        $user = Auth::user();

        $params = [
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'levelcat01' => $user->levelcat01,
            'levelcat02' => $user->levelcat02,
        ];

        $cat01 = Session::get('cat01');
        $cat02 = Session::get('cat02');

        $user->levelcat01 = 'F';
        $user->levelcat02 = 'F';

        if ($cat01 >=10 && $cat01<40)
        {
            $user->levelcat01 = 'E';
        }
        if ($cat01 >=40 && $cat01<120)
        {
            $user->levelcat01 = 'D';
        }
        if ($cat01 >=120 && $cat01<320)
        {
            $user->levelcat01 = 'C';
        }
        if ($cat01 >=320 && $cat01<780)
        {
            $user->levelcat01 = 'B';
        }
        if ($cat01 >=780 && $cat01<2220)
        {
            $user->levelcat01 = 'A';
        }
        
        if ($cat02 >=10 && $cat02<40)
        {
            $user->levelcat02 = 'E';
        }
        if ($cat02 >=40 && $cat02<120)
        {
            $user->levelcat02 = 'D';
        }
        if ($cat02 >=120 && $cat02<320)
        {
            $user->levelcat02 = 'C';
        }
        if ($cat02 >=320 && $cat02<780)
        {
            $user->levelcat02 = 'B';
        }
        if ($cat02 >=780 && $cat02<2220)
        {
            $user->levelcat02 = 'A';
        }
        $user->update();

        Mail::to('benhuang810406@gmail.com')->send(new LevelUp($params));

        return redirect('/admin')->with('SUCCESS', '晉升成功');
        
    }
}
