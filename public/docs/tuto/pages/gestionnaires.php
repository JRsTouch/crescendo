<h2>Les gestionnaires</h2>
<h3>À quoi servent les gestionnaires ?</h3>
<p>Les gestionnaires (ou <span class="code">Manager</span>) sont les classes responsables d'exécuter <em>les requêtes à votre base de données</em>. C'est le coeur de votre "modèle".</p>
<p>Concrètement, chaque fois que vous souhaitez faire une requête à la base de données, vous devriez venir y créer une fonction qui s'en chargera (sauf si elle existe déjà dans les gestionnaires de base du framework).</p>

<h3>Comment créer un nouveau gestionnaire ?</h3> 
<p>Dans votre application, vous pourriez avoir un gestionnaire par table MySQL (sans obligation). Chacune de ces classes devraient hériter de <span class="code">\W\Manager\Manager</span>, le gestionnaire de base du framework, qui vous fera profiter de quelques méthodes utiles pour les requêtes simples à la base de données.</p>

<p>Par exemple, pour créer un gestionnaire relié à une table fictive de commentaires nommées <span class="code">comments</span> : </p>
<pre><code>&lt;?php /* app/Manager/CommentManager.php */
namespace Manager;

class CommentManager extends \W\Manager\Manager 
{
	//Récupère les commentaires associés à un article
	public function findPostComments($postId)
	{
		//...
	}
}
</code></pre>


<h3>Les propriétés et méthodes héritées du Manager</h3>
<p>Voici les propriétés et les méthodes les plus utiles, héritées du gestionnaire de base. Vous devrez créer vos propres méthodes pour réaliser toutes les requêtes SQL plus complexes !</p>
<pre><code>/* W/Manager/Manager.php */

//propriété contenant le nom de la table (deviné grâce au nom de votre gestionnaire)
protected $table;

//connexion à la base de données
protected $dbh;

// Définit le nom de la table (si le nom déduit ne convient pas)
public function setTable($table)


// Récupère une ligne de la table en fonction d'un identifiant
public function find($id)

// Récupère toutes les lignes de la table
public function findAll($orderBy = "", $orderDir = "ASC")

// Efface une ligne en fonction de son identifiant
public function delete($id)

// Ajoute une ligne
//Le premier argument est un tableau associatif de valeurs à insérer
public function insert(array $data, $stripTags = true)

// Modifie une ligne en fonction d'un identifiant
// Le premier argument est un tableau associatif de valeurs à insérer
// Le second est l'identifiant de la ligne à modifier
public function update(array $data, $id, $stripTags = true)
</code></pre>


<h3>Le cas spécifique du UserManager</h3>
<p>Puisque W a besoin lui-même d'un gestionnaire d'utilisateur, pour les fonctionnalités de sécurité, et puisque <a href="?p=utilisateurs" title="La configuration du système d'authentification">W connait les détails de votre table d'utilisateurs</a>, vous pouvez avoir accès à quelques méthodes supplémentaires en faisant en sorte que votre gestionnaire d'utilisateur hérite non pas du <span class="code">\W\Manager\Manager</span>, mais plutôt du <span class="code">\W\Manager\UserManager</span>. Cette classe hérite elle-même du gestionnaire de base.</p>

<p>Voici les méthodes que vous fournit le <span class="code">\W\Manager\UserManager</span> : </p>
<pre><code> /* W/Manager/Manager.php */

// Hérite de toutes les méthodes du Manager, plus : 

// Récupère un utilisateur en fonction de son email ou de son pseudo
public function getUserByUsernameOrEmail($usernameOrEmail)

// Teste si un email est présent en base de données
public function emailExists($email)

// Teste si un pseudo est présent en base de données
public function usernameExists($username)	
</code></pre>
