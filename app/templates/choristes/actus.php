<?php $this->layout('choristes', ['title' => 'CrescendO : Actualités', 'layout' => $layout ]); ?>


<?php $this->start('main_content'); ?>
	<main>

		
		<h2>Actualité des news</h2>

		<nav>
			<?php
			
			$articlesParPage = $data['articlesParPages'];
			if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
				{
				     $pageActuelle=intval($_GET['page']);
				 
				     if($pageActuelle>$data['nombreDePages']) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
				     {
				          $pageActuelle=$data['nombreDePages'];
				     }
				}
				else // Sinon
				{
				     $pageActuelle=1; // La page actuelle est la n°1    
				}
				 
				$premiereEntree=($pageActuelle-1)*$articlesParPage; // On calcul la première entrée à lire

			echo "Page: ";
			for($i=1; $i<=$data['nombreDePages']; $i++) //On fait notre boucle
			{
			     //On va faire notre condition
			     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
			     {
			         echo ' [ '.$i.' ] '; 
			     }	
			     else //Sinon...
			     {
			          echo ' <a href="actus?page='.$i.'">'.$i.'</a> ';
			     }
			}

			?>
		</nav>
		<section>
			
		<?php 					
			foreach ($data['pages'] as $page) {
					echo "<article class='actus'>
								<h3>".$page['titre']."</h3>
								<figure>
									<img src='".$this->assetUrl($page['url'])."'>
									<figcaption> Image de l'article </figcaption>
								</figure>
								<p>".$page['extrait']."</p><a href='".$page['type']."/".$page['id']."'>Lien vers l'article</a></article>";
					} ?>
		</section>



		<nav>
			<?php
			//echo "<pre>"; print_r($data['pages']); echo "</pre>";
			$articlesParPage = $data['articlesParPages'];
			if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
				{
				     $pageActuelle=intval($_GET['page']);
				 
				     if($pageActuelle>$data['nombreDePages']) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
				     {
				          $pageActuelle=$data['nombreDePages'];
				     }
				}
				else // Sinon
				{
				     $pageActuelle=1; // La page actuelle est la n°1    
				}
				 
				$premiereEntree=($pageActuelle-1)*$articlesParPage; // On calcul la première entrée à lire

			echo "Page: ";
			for($i=1; $i<=$data['nombreDePages']; $i++) //On fait notre boucle
			{
			     //On va faire notre condition
			     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
			     {
			         echo ' [ '.$i.' ] '; 
			     }	
			     else //Sinon...
			     {
			          echo ' <a href="actus?page='.$i.'">'.$i.'</a> ';
			     }
			}

			?>
		</nav>
		
	</main>
<?php $this->stop('main_content'); ?>