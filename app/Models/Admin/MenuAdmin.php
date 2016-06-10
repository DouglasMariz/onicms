<?php

namespace Onicms\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Baum\Node; //https://github.com/etrepat/baum

use Route;

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

		$menu_clicado = $this->get_menu_clicado();

	    $icone = '';
	    if(!empty($menu->icone))
	    	$icone = '<i class="'.$menu->icone.'" ></i> '.PHP_EOL;

	    $href = '#';
	    if(!empty($menu->url))
	    	$href = url($menu->url);

	    $class = '';
	    $collapse = '';

	    if( $menu->isLeaf() ) {

	    	if(isset($menu_clicado->id) && $menu_clicado->id == $menu->id)
	    		$class = 'active';
	      	return '<li class="'.$class.'" ><a href="'.$href.'">' .$icone. $menu->nome . '</a></li>'.PHP_EOL;

	    } else {

	      // Verifica se este menu parent é pai do menu clicado, para ficar collapse in:
	      if(isset($menu_clicado->id) && ($menu_clicado->parent()->first()->id == $menu->id) )
	      		$collapse = 'in';

	      $html = '<li><a href="#submenu'.$menu->id.'" data-toggle="collapse" class="'.$class.'">' .$icone. $menu->nome.'</a>'.PHP_EOL;

	      $html .= '<div class="collapse '.$collapse.'" id="submenu'.$menu->id.'">'.PHP_EOL;
	      $html .= '<ul class="nav">'.PHP_EOL;

	      foreach($menu->children as $filho)
	        $html .= $this->renderizarMenuAdmin($filho);

	      $html .= '</ul>'.PHP_EOL;
	      $html .= '</div>'.PHP_EOL;

	      $html .= '</li>'.PHP_EOL;
	    }

	  	return $html;
	}

	// Obtém o id do menu clicado pelo usuário
	public function get_menu_clicado()
	{
		$rota = Route::getCurrentRoute()->getPath();
		// as rotas salvas sempre tem '/' no final, então:
		$rota = $rota.'/';
		// previne duplicado:
		$rota = str_replace("//", "/", $rota);
		// obtém o menu desta rota:
		$menu = MenuAdmin::where('url', '=', $rota)->first();
		if(isset($menu->id)){
			return $menu;
		}
		return false;
	}
}
















