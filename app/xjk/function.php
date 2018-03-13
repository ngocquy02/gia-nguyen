<?php 


function menuMutil($data,$ParentId=0,$Level=0)
{   //$Level=($Level==0)?'': $Level;
	$flag=0;
	foreach ($data as $kt) {
		$flag=($kt['ParentID']==$ParentId)? 1 : $flag;
	}
	echo ($flag==1)?'<ol class="dd-list ui-sortable show" show="1" id="'.$ParentId.'">':'';
	foreach ($data as $value) {
		$id=$value['id'];
		switch ($value['Type']) {
			case 1:
				$routeAddCate  		=		'getAddCategoryArticle';
				$routeEditCate 		=		'getCategory';
				$routeDelCate  		=		'getCategory';
				$routeList     		=		'getArticles';
				$routeAdd      		=		'getAddArticle';
				$note          		=		"";
				break;
			case 2:
				$routeAddCate  		=		'getAddCategoryArticle';
				$routeEditCate 		=		'getCategory';
				$routeDelCate  		=		'getArticles';
				$routeAdd      		=		'getAddArticle';
				$note          		=		"";
				break;
			case 3:
				$routeAddCate  		=		'getAddCategoryProduct';
				$routeEditCate 		=		'getCategory';
				$routeDelCate  		=		'getCategory';
				$routeList     		=		'getProductsByCatId';
				$routeAdd      		=		'getAddProduct';
				$note          		=		"";
				break;
			case 4:
				$routeAddCate  		=		'getAddCategoryArticle';
				$routeEditCate 		=		'getCategory';
				$routeDelCate  		=		'getCategory';
				$routeList     		=		'getArticles';
				$routeAdd      		=		'getAddArticle';
				$note          		=		"";
				break;
			case 5:
				$routeAddCate  		=		'getAddCategoryArticle';
				$routeEditCate 		=		'getCategory';
				$routeDelCate  		=		'getCategory';
				$routeList     		=		'getArticles';
				$routeAdd      		=		'getAddArticle';
				$note          		=		"";
				break;
		}
		$IsActive=($value['IsActive']==0)?'<button type="button" class="btn btn-xs btn-darkorange active" IsActive="'.$value['id'].'"> Ẩn</button>':'<button type="button" class="btn btn-xs btn-blue active" IsActive="'.$value['id'].'"> Hiện</button>';
		$custum=($Level<2)?'<div class="rigth">'.$IsActive.
		        '   <a class="btn btn-blue  btn-xs white" href="'.route($routeList,['CatId'=>$id]).'" style=""><i class="glyphicon glyphicon-list"></i>Danh sách '.$note.'</a>
		        <a class="btn btn-blue  btn-xs white" href="'.route($routeAdd,['CatId'=>$id]).'" style="">Thêm mới</a>
		        <a class="btn btn-blue  btn-xs white" href="'.route($routeAddCate,['ParentId'=>$id]).'" style=""><i class="fa fa-plus"> Danh mục con</i></a>
		        <a class="btn btn-blue  btn-xs white" href="'.route($routeEditCate,['ParentId'=>$id]).'" style=""><i class="fa fa-edit"> Sửa</i></a>
		        <button class="btn btn-danger btn-xs delete" data-toggle="modal" data-target="#modal-danger'.$id.'" ><i class="fa fa-trash-o"> Xóa</i></button>
		        <div id="modal-danger'.$id.'" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Cảnh báo!!!!</h4>
                            </div>
                            <div class="modal-body">
                                <p>Bạn có muốn xóa '.$value['Name'].'</p>
                            </div>
                            <div class="modal-footer">
                            <form action="'.route('postCategoryDel').'" method="post" accept-charset="utf-8">
                            '.csrf_field().'
                            <input type="hidden" name="id" value="'.$id.'">
                                <button type="submit" class="btn btn-primary ok">Đồng ý</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Hủy</button>
                            </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->                                            
                </div>
		        </div>':'<div class="rigth">'.$IsActive.'   
		        <a class="btn btn-blue  btn-xs white" href="'.route($routeList,['CatId'=>$id]).'" style=""><i class="glyphicon glyphicon-list"></i>Danh sách '.$note.'</a>
		        <a class="btn btn-blue  btn-xs white" href="'.route($routeAdd,['CatId'=>$id]).'" style="">Thêm mới</a>
		        <a class="btn btn-blue  btn-xs white" href="'.route($routeEditCate,['ParentId'=>$id]).'" style=""><i class="fa fa-edit"> Sửa</i></a>
		        <button class="btn btn-danger btn-xs delete" data-toggle="modal" data-target="#modal-danger'.$id.'" ><i class="fa fa-trash-o"> Xóa</i></button>
		        <div id="modal-danger'.$id.'" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Cảnh báo!!!!</h4>
                            </div>
                            <div class="modal-body">
                                <p>Bạn có muốn xóa '.$value['Name'].'</p>
                            </div>
                            <div class="modal-footer">
                            <form action="'.route('postCategoryDel').'" method="post" accept-charset="utf-8">
                            '.csrf_field().'
                            <input type="hidden" name="id" value="'.$id.'">
                                <button type="submit" class="btn btn-primary ok">Đồng ý</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Hủy</button>
                            </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->                                            
                </div>
		        </div>';
		if($value['ParentID']==$ParentId)
		{
			$flag1=0;
			foreach ($data as $kt1) {
				$flag1=($kt1['ParentID']==$value['id'])? 1 : $flag1;
			}
			$child=($flag1==1)? '<i class="normal-icon fa fa-angle-down"></i>' :'';
			echo '<li class="dd-item dd2-item ui-state-default"  data-id="'.$value["id"].'">
		        <div class="dd-handle dd2-handle">
		            <i class="normal-icon fa fa-th-list "></i> '.$child.'
		        </div>
		        <div class="dd2-content">'.$value["Name"].$custum.'
		        </div>';
		menuMutil($data,$id,$value['Level']+1);
		    echo '</li>';
		}
	}
	echo ($flag==1)?'</ol>':'';
}

function subMenu($data,$ParentId=0,$active='')
{   
	$flag=0;
	$submenu='';

	$flagActive='';
	foreach ($data as $kt) {
		if($kt['ParentID']==$ParentId)
		{
			$flag=1 ;			
		}		
	}
	echo ($flag==1)?'<ul >':'';
	foreach ($data as $value) {
		$classSub='';
		$flagActive=($value['Level']==0 && $value['Alias']==$active) ? 'class="active"': (($value['Level']==0 && $active=='' && $value['Type']==1) ? 'class="active"' :'');
		$id=$value['id'];		
		if($value['ParentID']==$ParentId)
		{
			$icon=($value['Level']!=0 and $value['Icon']=='') ? '> ':'';
			echo '<li '.$flagActive.'><a href="'.(($value['Type']==1)? "": getLinkById($value['id'])).'">'.$icon.$value['Name'].'</a>';
			subMenu($data,$id);
		    echo '</li>';
		}
	}
	echo ($flag==1)?'</ul>':'';
}
function getLinkById($id)
{
	$url='';
	$cate=App\Models\Category::select('ParentID','Alias','Level')->where('id',$id)->get()->ToArray()[0];
	switch ($cate['Level']) {
		case '0':
			$url=$cate['Alias'];
			break;
		case '1':
			$url=$cate['Alias'];
			$cate=App\Models\Category::select('ParentID','Alias','Level')->where('id',$cate['ParentID'])->get()->ToArray()[0];
			$url=$cate['Alias'].'/'.$url;
			break;
		case '2':
			$url=$cate['Alias'];
			$url=$cate['Alias'];
			$cate=App\Models\Category::select('ParentID','Alias','Level')->where('id',$cate['ParentID'])->get()->ToArray()[0];
			$url=$cate['Alias'].'/'.$url;
			$cate=App\Models\Category::select('ParentID','Alias','Level')->where('id',$cate['ParentID'])->get()->ToArray()[0];
			$url=$cate['Alias'].'/'.$url;
			break;
	}
	return $url;
}
function getMenuSidebar($active='')
{	
	$category=App\Models\Category::where(['type' =>3])->get();
	// echo $category->count();die; 
	$class="active";
	$sidebar='<ul class="nav sidebar-menu">
    <li  class="';
    $sidebar.=($active=='') ? 'active' : "";
    $sidebar.='">
        <a href="'.route('controller').'">
            <i class="menu-icon glyphicon glyphicon-home"></i>
            <span class="menu-text"> Dashboard </span>
        </a>
    </li>
    <li class="';
    $sidebar.=($active=='company') ? 'active' : "";
    $sidebar.='">
        <a href="'.route('getCompany').'">
            <i class="fa fa-windows"></i>
            <span class="menu-text"> THÔNG TIN CÔNG TY </span>
        </a>
    </li>
    <li class="';
    $sidebar.=($active=='menu') ? 'active' : "";
    $sidebar.='">
        <a href="'.route('getCategorys').'">
            <i class="fa fa-server"></i>
            <span class="menu-text"> QUẢN LÝ MENU</span>
        </a>
    </li>
    <li class="';
    $sidebar.=($active=='slider') ? 'active' : "";
    $sidebar.='">
        <a href="" class="menu-dropdown">
            <i class="fa fa-photo"></i>
            <span class="menu-text"> QUẢN LÝ SLIDER </span>
            <i class="menu-expand"></i>
             
        </a>
        <ul class="submenu" style="display: none;">
			<li>
				<a href="'.route("getAds").'">Quảng cáo</a>
			</li>
			<li>
				<a href="'.route("getPopup").'">Popup</a>
			</li>
			<li>
				<a href="'.route("getSliders").'">Slider</a>
			</li>
        </ul>
    </li>
    <li class="';
    $sidebar.=($active=='partner') ? 'active' : "";
    $sidebar.='">
        <a href="'.route('getPartner').'">
            <i class="fa fa-share-alt"></i>
            <span class="menu-text"> QUẢN LÝ ĐỐI TÁC</span>
        </a>
    </li>
    <li class="';
    $sidebar.=($active=='account') ? 'active' : "";
    $sidebar.='">
        <a href="'.route('getAccountAdmin').'">
            <i class="fa fa-diamond"></i>
            <span class="menu-text"> QUẢN LÝ THÀNH VIÊN</span>
        </a>
    </li>
    <li class="';
    $sidebar.=($active=='cart') ? 'active' : "";
    $sidebar.='">
        <a href="'.route('getCartControl').'">
            <i class="fa fa-shopping-cart"></i>
            <span class="menu-text"> QUẢN LÝ GIỎ HÀNG</span>
        </a>
    </li>
   <li class="';
    $sidebar.=($active=='admin') ? 'active' : "";
    $sidebar.='">
        <a href="" class="menu-dropdown">
            <i class="fa fa-user"></i>
            <span class="menu-text"> QUẢN LÝ ADMIN </span>
            <i class="menu-expand"></i>
             
        </a>
        <ul class="submenu" style="display: none;">
			<li>
				<a href="'.route("role-user",['role'=>1]).'">Admintrator</a>
			</li>
			<li>
				<a href="'.route("role-user",['role'=>2]).'">Quản lý</a>
			</li>
			<li>
				<a href="'.route("role-user",['role'=>3]).'">Nhân viên</a>
			</li>
        </ul>
    </li>
    <li class="';
    $sidebar.=($active=='contact') ? 'active' : "";
    $sidebar.='">
        <a href="'.route('getContact').'">
            <i class="fa fa-envelope"></i>
            <span class="menu-text"> QUẢN LÝ LIÊN HỆ</span>
        </a>
    </li>
    <li class="';
    $sidebar.=($active=='contact') ? 'active' : "";
    $sidebar.='">
         <a href="" class="menu-dropdown">
            <i class="fa fa-qrcode"></i>
            <span class="menu-text"> QUẢN LÝ SẢN PHẨM </span>
            <i class="menu-expand"></i>
             
        </a>
        <ul class="submenu" style="display: none;">
			';
echo $sidebar;
	foreach ($category as $value) {
		echo "<li><a href=".route('getProductsByCatId',['CatId'=>$value->id]).">$value->Name</a></li>";
	}
echo '
        </ul>
    </li>
</ul>';
}

function catchuoi($chuoi,$gioihan){
// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
// thì không thay đổi chuỗi ban đầu
if(mb_strlen($chuoi,'UTF-8')<=$gioihan)
{
return $chuoi;
}
else{
/*
so sánh vị trí cắt
với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
nếu vị trí khoảng trắng lớn hơn
thì cắt chuỗi tại vị trí khoảng trắng đó
*/
	if(mb_strpos($chuoi," ",$gioihan,'UTF-8') > $gioihan){
		$new_gioihan=mb_strpos($chuoi," ",$gioihan,'UTF-8');
		$new_chuoi = mb_substr($chuoi,0,$new_gioihan,'UTF-8')."...";
		return $new_chuoi;
	}
	// trường hợp còn lại không ảnh hưởng tới kết quả
	$new_chuoi = mb_substr($chuoi,0,$gioihan,'UTF-8')."...";
	return $new_chuoi;
}
}
?>
