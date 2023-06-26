<?php
// Vérifier si c'est l'admin qui est connecté pour avoir accès à la page
$isAdmin = true; // Remplacez par logique de vérification de l'administrateur

if (!$isAdmin) {
    echo "Accès refusé.";
    exit;
}
include '../includes/connexion_bdd.php';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = trim($_GET['search']); // Supprime les espaces en début et en fin de chaîne
    $search = htmlspecialchars($search);
    $query = 'SELECT Article.id, Article.title, User.username, Article.date_of_publ, Category.name FROM Article
              INNER JOIN User ON Article.User_id = User.idUser JOIN Category ON Article.Category_id = Category.id
              WHERE Article.title LIKE "%' . $search . '%" OR Article.body LIKE "%' . $search . '%" OR User.username 
              LIKE "%' . $search . '%" ORDER BY Article.id DESC';
} elseif (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = htmlspecialchars($_GET['category']);
    $query = 'SELECT Article.id, Article.title, User.username, Article.date_of_publ, Category.name FROM Article
              INNER JOIN User ON Article.User_id = User.idUser JOIN Category ON Article.Category_id = Category.id
              WHERE Category.name = "' . $category . '"
              ORDER BY Article.id DESC';
} elseif (isset($_GET['recent'])) {
    $threeMonthsAgo = date('Y-m-d', strtotime('-3 months'));
    $query = 'SELECT Article.id, Article.title, User.username, Article.date_of_publ, Category.name FROM Article
              INNER JOIN User ON Article.user_id = User.idUser JOIN Category ON Article.Category_id = Category.id
              WHERE Article.date_of_publ >= "' . $threeMonthsAgo . '"
              ORDER BY Article.id DESC';
} else {
    $query = 'SELECT Article.id, Article.title, User.username, Article.date_of_publ, Category.name FROM Article
              INNER JOIN User ON Article.user_id = User.idUser JOIN Category ON Article.Category_id = Category.id
              ORDER BY Article.id DESC';
}

$result = $bdd->query($query);

if (!$result) {
    die("Erreur dans la requête : " . $bdd->errorInfo()[2]);
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);

    // Vérifier si l'article existe
    $checkQuery = 'SELECT id FROM Article WHERE id = ?';
    $checkStmt = $bdd->prepare($checkQuery);
    $checkStmt->execute(array($get_id));
    $articleExists = $checkStmt->rowCount() > 0;

    if ($articleExists) {
        $deleteQuery = 'DELETE FROM Article WHERE id = ?';
        $deleteStmt = $bdd->prepare($deleteQuery);
        $deleteStmt->execute(array($get_id));
        $message = "Article deleted successfully!";
    }
}
?>

<?php
$link = '../CSS/Style_gestion_article.css';
$titre = "Article Management";
include '../includes/header_backoffice.php';

?>
<div class="container pt-5">
    <div class="d-md-flex justify-content-between align-items-center my-5">
        <h1 class="mb-3 mb-md-0">Article</h1>
        <div class="order-md-1">
            <form method="GET" action="" class="row align-items-center">
                <div class="col-md">
                    <input class="form-control mb-2 mb-md-0" type="text" name="search" placeholder="Search..."
                           value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </div>
                <div class="col-auto">
                    <button class="btn custom-button" type="submit">Search</button>
                </div>
                <div class="col-md">
                    <select class="form-select" name="category">
                        <option value="">All Categories</option>
                        <option value="classical" <?php echo isset($_GET['category']) && $_GET['category'] === 'classical' ? 'selected' : ''; ?>>
                            Classical
                        </option>
                        <option value="Country" <?php echo isset($_GET['category']) && $_GET['category'] === 'Country' ? 'selected' : ''; ?>>
                            Country
                        </option>
                        <option value="pop" <?php echo isset($_GET['category']) && $_GET['category'] === 'pop' ? 'selected' : ''; ?>>
                            Pop
                        </option>
                        <option value="Jazz" <?php echo isset($_GET['category']) && $_GET['category'] === 'Jazz' ? 'selected' : ''; ?>>
                            Jazz
                        </option>
                        <option value="rock" <?php echo isset($_GET['category']) && $_GET['category'] === 'rock' ? 'selected' : ''; ?>>
                            Rock
                        </option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn custom-button" type="submit" name="recent" value="1">Recent Articles</button>
                </div>
            </form>
        </div>
        <div class="order-md-2 mt-3 mt-md-0">
            <a href="article_post.php" class="btn btn-sm custom-button">Add New Article</a>
        </div>
    </div>
    <table class="table table-bordered table-success table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Username</th>
            <th>Date of Publication</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo isset($row["username"]) ? $row["username"] : ""; ?></td>
                    <td><?php echo isset($row["date_of_publ"]) ? $row["date_of_publ"] : ""; ?></td>
                    <td><?php echo isset($row["name"]) ? $row["name"] : ""; ?></td>
                    <td>
                        <a href="article_read_more.php?id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-info ">Read
                            More</a>
                        <a href="gestion_artcl.php?id=<?php echo $row["id"]; ?>"
                           class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6">No articles found.</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <?php
    if (isset($message)) {
        echo '<div class="alert alert-success custom-alert  alert-dismissible fade show">' . $message . '
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>
    <script>
        document.getElementById('closeButton').addEventListener('click', function () {
            document.getElementById('customAlert').style.display = 'none';
        });
    </script>


</div>
</body>
</html>

