<?php $this->layout('choristes', ['title' => 'Actualités', 'layout_data' => $data['options'][0]['copyrights'], 'layout' => $layout, 'user' => $data['user'] ]); ?>

<?php $this->start('main_content'); /*print_r($news); print_r($presse);*/ ?>
	<main>

		<h2>Actualité des news</h2>

		<?php
			$articlesParPage = 5;
			if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
				{
				     $pageActuelle=intval($_GET['page']);
				 
				     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
				     {
				          $pageActuelle=$nombreDePages;
				     }
				}
				else // Sinon
				{
				     $pageActuelle=1; // La page actuelle est la n°1    
				}
				 
				$premiereEntree=($pageActuelle-1)*$articlesParPage; // On calcul la première entrée à lire

			 
			for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
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
			echo '</p>';?>
					
					
						<?php foreach ($pages as $page) {
							echo "<article >
										<h3>".$page['titre']."</h3>
										<figure>
											<img src='".$this->assetUrl($page['url'])."'>
											<figcaption>".$page['description']."</figcaption>
										</figure>
										<p>".$page['extrait']."</p></article>";
							} ?>

		<h2>Actualités de presse</h2>
		
	</main>
<?php $this->stop('main_content'); ?>