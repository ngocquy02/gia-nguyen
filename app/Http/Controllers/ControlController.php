<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Product;

class ControlController extends Controller
{
    public function __construct()
	{
	    $this->middleware('auth');
	}
	public function getController()
    {
        return view('control.index');
    }
    public function getSitemap()
    {
    	$newfile=fopen("sitemap.xml","w+");
    	$base=asset('');
		if (!$newfile) {
	    echo 'Mở file không thành công';
		}
		else
		{
		    $data = '<?xml version="1.0" encoding="UTF-8"?>
		    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
		    <url>
		    	<loc>'.$base.'</loc>
		    </url>';
			$get_menus=Category::select('id','ParentID','Type')->where([['IsActive','=',1]])->get();
			if(count($get_menus)>0){
				foreach ($get_menus as $get_menu) {
					$data.="<url>
								<loc>".$base.getLinkById($get_menu->id)."</loc>
							</url>";
					switch ($get_menu->Type) {
						case '1':
						case '2':
						case '4':
						case '5':
							$link_arti=Article::select('CatId','Alias')->where('IsActive',1)->get();
							if(count($link_arti)>0){
								foreach ($link_arti as $link_arti) {
									$data.="<url>
												<loc>".$base.getLinkById($link_arti->CatId)."/".$link_arti->Alias.".html
												</loc>
											</url>";
								}
							}							
							break;
						
						case '3':
							$link_prod=Product::select('CatId','Alias')->where('IsActive',1)->get();
							if(count($link_prod)>0){
								foreach ($link_prod as $link_prod) {
									$data.="<url>
												<loc>".$base.getLinkById($link_prod->CatId)."/".$link_prod->Alias.".html</loc>
											</url>";
								}
							}
							break;
					}
				}
			}
			$data.="</urlset>";
			fwrite($newfile, $data);
		    	echo "yes";
		}
        return redirect()->route('controller');
    }
}
