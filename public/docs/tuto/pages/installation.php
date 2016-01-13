<h2>Installation</h2>
<h3>Prérequis</h3>
<ul>
	<li>PHP >= 5.4</li>
	<li>Composer</li>
	<li>MySQL avec PDO</li>
</ul>
<h3>Étapes pour l'installation</h3>
<p>Pour installer le framework :</p>
<p>1. Dans un terminal, naviguez vers votre dossier contenant vos projets web (htdocs/ ou www/).</p>
<pre><code>cd C:/xampp/htdocs/</code></pre>
<p>2. Cloner le repo :</p>
<pre><code>git clone https://github.com/guillaumewf3/W.git votre_nouveau_dossier/</code></pre>
<p>3. Installer les dépendances avec Composer :</p>
<pre><code>cd votre_nouveau_dossier/
composer install</code></pre>
<p>4. Configurez votre application dans <span class="code">app/config.php</span> et <span class="code">app/routes.php</span></p>
<h3>Tester l'installation</h3>
<p>Naviguez vers <span class="code">http://localhost/votre_nouveau_dossier/public/</span></p>