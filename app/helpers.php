<?php

// renderiza o menu do admin
function renderizarMenuAdmin($menu) {

    $icone = '';
    if(!empty($menu->icone))
    	$icone = '<i class="'.$menu->icone.'" ></i> ';

    $href = '#';
    if(!empty($menu->url))
    	$href = url($menu->url);

    if( $menu->isLeaf() ) {
      return '<li><a href="'.$href.'" >' .$icone. $menu->nome . '</a></li>';
    } else {
      $html = '<li><a href="#submenu'.$menu->id.'" data-toggle="collapse">' .$icone. $menu->nome.'</a>';

      $html .= '<div class="collapse" id="submenu'.$menu->id.'">';
      $html .= '<ul class="nav">';

      foreach($menu->children as $filho)
        $html .= renderizarMenuAdmin($filho);

      $html .= '</ul>';
      $html .= '</div>';

      $html .= '</li>';
    }

  return $html;
}

function renderizarProdutosCategorias($categoria, $somente_pais = false) {

    $html = '';
    $href = route('categoria', ['categoria' => str_slug($categoria->nome).'-'.$categoria->id]) ;

    if( $categoria->isLeaf() || $somente_pais == false ) {
      $html .= '<li><a href="'.$href.'" >'.$categoria->nome.'</a>';
    } else {
      $html .= '<li><a href="'.$href.'" >'.$categoria->nome.'</a>';

      $html .= '<ul class="dropdown">';

      foreach($categoria->children as $filho)
        $html .= renderizarProdutosCategorias($filho);

      $html .= '</ul>';

      $html .= '</li>';
    }

  return $html;
}

// monta o select do form de categorias para o admin
function montar_select($cat, $separador = '', $id_selecionado)
{
    $selected = '';
    if($id_selecionado == $cat->id)
      $selected = 'selected="selected"';

    if( $cat->isLeaf() ) {
        return '<option value="'.$cat->id.'" '.$selected.' >' . $separador.' '.$cat->nome . '</option>'.PHP_EOL;
    } else {
        $html = '<option value="'.$cat->id.'" '.$selected.' >' .$separador.' '. $cat->nome . '</option>'.PHP_EOL;
          foreach($cat->children as $filho){
            $separador .= "-";
            $html .= montar_select($filho, $separador, $id_selecionado);
          }
    }
    return $html;
}

/**
 * Busca as rotas disponíveis do admin e retorna o array com elas
 */
function getRotasAdmin()
{
    $rotas = array();
    // Algumas rotas devem ser manualmente adicionadas:
    //$rotas['admin/configuracoes_site/1/edit'] 	 = 'admin/configuracoes_site/1/edit';
    //$rotas['admin/configuracoes_empresa/1/edit'] = 'admin/configuracoes_empresa/1/edit';
    //$rotas['admin/configuracoes_home/1/edit'] = 'admin/configuracoes_home/1/edit';

    $routeCollection = Route::getRoutes();
    foreach ($routeCollection as $value) {
        $url = $value->getPath();
        $partes = explode('/', $url);
        $methods = $value->getMethods();
        if($methods[0] == 'GET' && (strpos($url, 'admin') !== FALSE) && (count($partes) > 1)){

        	if($partes[1] == 'configuracoes_home' || ($partes[1] == 'configuracoes_site') )
        		continue;
        	$rota = $partes[0].'/'.$partes[1].'/';
        	if(!in_array($rota, $rotas))
            	$rotas[$rota] = $rota;
        }
    }
    return $rotas;
}

/*
  ** Função para padronizar o html do toggle
    $coluna = coluna no banco, nome padrao em caso de vazio: status
    $id = $id do item no banco,
    $status = valor salvo no banco, 
    $texto_ativo = texto que melhor ilusta o satus quando ativo, 
    $texto_inativo = Texto  que melhor ilustra o status quando inativo,
    $ajax = true para listagens e false para páginas com post de formulario
    $ajax_funcao = Ou use o padrão Ou crie sua função específica para atlerar o status do item
    -- Atualização:
    Joguei num array os parâmetros, estavam muitos e precisei criar mais um(url do ajax - opcional)
*/
  function gerar_status_toggle($opcoes = array())
  { 
    if(!isset($opcoes['ajax_funcao']))
      $opcoes['ajax_funcao'] = 'update';
    if(!isset($opcoes['coluna']))
      $opcoes['coluna'] = 'status';
    if(!isset($opcoes['ajax']))
      $opcoes['ajax'] = FALSE;
    if(!isset($opcoes['status']))
      $opcoes['status'] = '0';
    if(!isset($opcoes['texto_ativo']))
      $opcoes['texto_ativo'] = 'Ativo';
    if(!isset($opcoes['texto_inativo']))
      $opcoes['texto_inativo'] = 'Inativo';
    //
    if($opcoes[$opcoes['coluna']])
      $checked = 'checked="checked"';
    else
      $checked = '';

    if(!isset($opcoes['input_id']))
      $opcoes['input_id'] = $opcoes['coluna'];

    //Renderizando o html
    $html = '<input type="checkbox" name="'.$opcoes['input_id'].'" id="'.$opcoes['input_id'].'" '.$checked.' ';
    $html .= 'data-token = "'.csrf_token().'" ';
    if($opcoes['ajax']){
      $data_toggle = 'switch-ajax';
    }else{
      $data_toggle = 'switch';
    }
    $html .= 'data-toggle="'.$data_toggle.'" ';
    $html .= 'data-on-text="'.$opcoes['texto_ativo'].'" ';
    $html .= 'data-off-text="'.$opcoes['texto_inativo'].'" ';
    $html .= 'value="1"  ';
    $html .= 'data-size="mini" ';
    if( $opcoes['ajax'] && (isset($opcoes['ajax_url'])) ){
      $html .= 'data-ajax-url="'.url($opcoes['ajax_url']).'" ';
    };
    $html .= ' >'.PHP_EOL;
    return $html;
}

/**
 * Configura o array para utilizar na função de gerar o toogle:
 * $name = coluna no banco, 
 * $id = $id do item no banco,
 * $status = valor salvo no banco, 
 * $texto_ativo = texto que melhor ilusta o satus quando ativo, 
 * $texto_inativo = Texto  que melhor ilustra o status quando inativo,
 * $ajax = true para listagens e false para páginas com post de formulario
 * $ajax_funcao = Ou use o padrão Ou crie sua função específica para atlerar o status do item
 */
function configurar_status_toogle($registros, $caminho, $ajax = TRUE)
{
    foreach($registros as $registro){
        $opcoes['status'] = $registro->status;
        $opcoes['ajax']   = $ajax;
        $opcoes['ajax_url'] = $caminho.$registro->id.'/atualizar_status';
        $registro->html_toogle = gerar_status_toggle($opcoes);
    }
    return $registros;
}

// Retorna o id de um determinado slug:
function get_id_slug($slug){

  // caso tenha query string(paginacao)
  $url = explode('?', $slug);
  $id = explode('-', $url[0]);
  return end($id);
}

if ( ! function_exists('prep_url'))
{
    /**
     * Prep URL
     *
     * Simply adds the http:// part if no scheme is included
     *
     * @param   string  the URL
     * @return  string
     */
    function prep_url($str = '')
    {
        if ($str === 'http://' OR $str === '')
        {
            return '';
        }
        $url = parse_url($str);
        if ( ! $url OR ! isset($url['scheme']))
        {
            return 'http://'.$str;
        }
        return $str;
    }
}






















