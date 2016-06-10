<?php

namespace Onicms\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Baum\Node; //https://github.com/etrepat/baum

use Illuminate\Database\Eloquent\SoftDeletes;

class MenuAdmin extends Node
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $table = 'menu_admin';

    protected $fillable = ['nome', 'url', 'icone', 'peso', 'parent_id', 'status'];

    protected $orderColumn = 'peso';

    public function get_menu()
    {
    	$menu_adm  = MenuAdmin::where('status','=','1')->orderBy('peso')->get()->toHierarchy();
    	$menu = '';
    	foreach($menu_adm as $m){
		    $menu .= $this->renderizarMenuAdmin($m);
		}

		return $menu;
    }

    // renderiza o menu do admin
	public function renderizarMenuAdmin($menu) {

	    $icone = '';
	    if(!empty($menu->icone))
	    	$icone = '<i class="'.$menu->icone.'" ></i> '.PHP_EOL;

	    $href = '#';
	    if(!empty($menu->url))
	    	$href = url($menu->url);

	    $class = '';

	    if( $menu->isLeaf() ) {

	      return '<li><a href="'.$href.'">' .$icone. $menu->nome . '</a></li>'.PHP_EOL;

	    } else {
	      $html = '<li><a href="#submenu'.$menu->id.'" data-toggle="collapse" class="'.$class.'">' .$icone. $menu->nome.'</a>'.PHP_EOL;

	      $html .= '<div class="collapse" id="submenu'.$menu->id.'">'.PHP_EOL;
	      $html .= '<ul class="nav">'.PHP_EOL;

	      foreach($menu->children as $filho)
	        $html .= $this->renderizarMenuAdmin($filho);

	      $html .= '</ul>'.PHP_EOL;
	      $html .= '</div>'.PHP_EOL;

	      $html .= '</li>'.PHP_EOL;
	    }

	  return $html;
	}
}
