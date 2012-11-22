<?php

/**
 * Classe que contem metodos estaticos para exibicao de conteudo
 * @access public
 * @package PageViews
 */
class PageViews {

	// Menu Superior
	public static function menuSuperior($usuario, $logado) {
		?>
<div id="main_container">
	<div class="top_bar">
		<div class="top_search">
			<div class="languages">
				<?php if($logado){ ?>
					<p>Ol&aacute;, <?php echo $usuario->nome; ?> &nbsp;|&nbsp; <a href="logout.php">Logout</a></p>
				<?php } else { ?>
					<p><a href="login.php">Login</a></p>
				<?php } ?>
			</div>
		</div>
	</div>
	<div id="header">

		<div id="logo">
			<a href="index.php"><img src="images/logo.png" alt="" title=""
				border="0" width="237" height="140" /> </a>
		</div>

		<div class="oferte_content">
			<div class="top_divider">
				<img src="images/header_divider.png" alt="" title="" width="1"
					height="164" />
			</div>
			<div class="oferta">

				<div class="oferta_content">
					<img src="images/laptop.png" width="94" height="92" border="0"
						class="oferta_img" />

					<div class="oferta_details">
						<div class="oferta_title">Sindo Shop</div>
						<div class="oferta_text">A maior loja virtual do grupo 6 de MC437 de todos os tempos!</div>
						<a href="produtos.php" class="details">Produtos</a>
					</div>
				</div>
				<div class="oferta_pagination"></div>

			</div>
			<div class="top_divider">
				<img src="images/header_divider.png" alt="" title="" width="1"
					height="164" />
			</div>

		</div>
		<!-- end of oferte_content-->


	</div>

	<div id="main_content">

		<div id="menu_tab">
			<div class="left_menu_corner"></div>
			<ul class="menu">
				<li><a href="index.php" class="nav1"> Home </a></li>
				<li class="divider"></li>
				<li><a href="minhas_compras.php" class="nav2">Minhas compras</a></li>
				<li class="divider"></li>
				<!--<li><a href="categorias.php" class="nav3">Categorias</a></li>
				<li class="divider"></li>-->
				<li><a href="atendimento.php" class="nav6">Atendimento</a></li>
				<li class="divider"></li>
				<li class="currencies">Moeda<select>
						<option>Sindo Money</option>
						<option>Reais</option>
				</select>
				</li>
			</ul>

			<div class="right_menu_corner"></div>
		</div>
		<!-- end of menu tab -->

		<!-- <div class="crumb_navigation">
			Navigation: <span class="current">Home</span>
		</div> -->
		<?php 
	} 
	
	// Menu Lateral Esquerda
	public static function menuLateralEsquerda($categorias) {
		?>
		<div class="left_content">
			<div class="title_box">Categorias</div>
			<ul class="left_menu"> 
			<?php 
			//$categorias = Produto::getCategories();
			//print_r($categorias["return"]);
            $key = 0;
			foreach($categorias["return"] as $categoria) { 
				$class = "even";
				if(($key % 2) == 0) $class = "odd"; 
                $key = $key + 1;
				?>
				<li class="<?php echo $class ?>"><a href="produtos_da_categoria.php?categID=<?php echo utf8_encode($categoria["nome"]); ?>"><?php echo utf8_encode($categoria["nome"]); ?></a></li>
			<?php } ?>
			</ul>
		</div>
		<!-- end of left content -->
	<?php 
	} 
	
	// Menu Lateral Direita
	public static function menuLateralDireita() {
		?>
		<div class="right_content">
			<div class="shopping_cart">
				<div class="cart_title">Carrinho</div>
		
				<div class="cart_details">
					<?php if($_SESSION["quantidadeProdutos"]){ echo $_SESSION["quantidadeProdutos"]; } else { echo "0"; } ?> iten(s) <br /> <span class="border_cart"></span> Total: <span
						class="price">R$<?php echo number_format($_SESSION["valorCarrinho"], 2, ",", "")?></span>
				</div>
		
				<div class="cart_icon">
					<a href="carrinho.php" title="header=[Checkout] body=[&nbsp;] fade=[on]"><img
						src="images/shoppingcart.png" alt="" title="" width="48" height="48"
						border="0" />
					</a>
				</div>
		
			</div>
		</div>
		<!-- end of right content -->
	<?php 
	} 
	
	// Menu Lateral Direita
	public static function footer() {
	?>
		<div class="footer">
			<div class="left_footer">
				<img src="images/footer_logo.png" alt="" title="" width="170"
					height="49" />
			</div>
		
			<div class="center_footer">
				Sindo Shop. Direitos Reservados 2012
			</div>
		
			<div class="right_footer">
				<a href="index.php">home</a> 
				<a href="atendimento.php">atendimento</a>
			</div>
		
		</div>
	<?php 
	}
	
} ?>
