<h2>Conventions du framework W.</h2>

<h3>Conventions obligatoires</h3>
<ul>
	<li>La variable contenant l'instance de l'applicaiton doit être nommée <span class="code">$app</span></li>
	<li>Les contrôleurs doivent être dans l'espace de nom <span class="code">\Controller\</span>, donc dans le dossier <span class="code">app/Controller/</span></li>
	<li>Le nom des contrôleurs doit être suffixé par le mot <span class="code">Controller</span> (ie <span class="code">PostController</span>)</li>
</ul>

<h3>Conventions d'usage</h3>
<ul>
	<li>Le nom des routes et des fichiers de vue sont écrit en minuscules, les mots séparés par des underscore (<span class="code">_</span>)</li>
	<li>Les tables MySQL sont nommées au pluriel</li>
	<li>Le fichier de vue associé à une méthode de contrôleur devrait être placé dans un dossier portant le même nom que le contrôleur, sans le suffixe <span class="code">Controller</span> (ie le fichier de vue de <span class="code">PostController->showAll()</span> est <span class="code">app/templates/post/show_all.php</span>)</li>
	<li>Le fichier de vue devrait être nommé exactement comme la méthode de contrôleur y menant, en minuscules et underscores.</li>
	<li>Le nom des gestionnaires doit être composé du nom de la table au singulier, suivi du suffixe Manager (ie <span class="code">PostManager</span> pour une table nommée <span class="code">posts</span>)</li>
</ul>