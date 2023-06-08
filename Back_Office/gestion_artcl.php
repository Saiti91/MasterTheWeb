<?php
// Vérifier si c'est l'admin qui est connecté pour avoir accès à la page
$isAdmin = true; // Remplacez par votre logique de vérification de l'administrateur

if (!$isAdmin) {
    echo "Accès refusé.";
    exit;
}

require_once '../includes/connexion_bdd.php';

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $query = 'SELECT id, title, user_id, date_of_publ, category, image FROM article WHERE title LIKE "%' . $search . '%"  OR body LIKE "%' . $search . '%" ORDER BY id DESC';

} elseif (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = htmlspecialchars($_GET['category']);
    $query = 'SELECT id, title, user_id, date_of_publ, category, image FROM article WHERE category = "' . $category . '" ORDER BY id DESC';

} elseif (isset($_GET['recent'])) {
    $threeMonthsAgo = date('Y-m-d', strtotime('-3 months'));
    $query = 'SELECT id, title, user_id, date_of_publ, category, image FROM article WHERE date_of_publ >= "' . $threeMonthsAgo . '" ORDER BY id DESC';

} else {
    $query = 'SELECT id, title, user_id, date_of_publ, category, image FROM article ORDER BY id DESC';
}

$result = $bdd->query($query);

if (!$result) {
    die("Erreur dans la requête : " . $bdd->errorInfo()[2]);
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);
    // require_once 'connexion_bdd.php';
    $deleteQuery = 'DELETE FROM article WHERE id =?';
    $deleteStmt = $bdd->prepare($deleteQuery);
    $deleteStmt->execute(array($get_id));
    $message = "Article deleted successfully!";
}
?>

<?php
$titre = 'Article Management';
$link = '../CSS/Style_gestion_article.css';
include '../includes/header_backoffice.php'
?>

<div class="container">
    <header></header>


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


    <table class="table table-bordered table-striped table-white">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>User id</th>
            <th>Date of Publication</th>
            <th>Category</th>
            <th>image</th>
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
                    <td><?php echo isset($row["user_id"]) ? $row["user_id"] : ""; ?></td>
                    <td><?php echo isset($row["date_of_publ"]) ? $row["date_of_publ"] : ""; ?></td>
                    <td><?php echo isset($row["category"]) ? $row["category"] : ""; ?></td>
                    <td><?php echo isset($row["image"]) ? $row["image"] : ""; ?></td>
                    <td>
                        <a href="article_read_more.php?id=<?php echo $row["id"] ?>" class="btn btn-info">Read more</a>
                        <a href="gestion_artcl.php?id=<?php echo $row["id"] ?>" class="btn btn-danger">Delete</a>

                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">No articles found.</td>
            </tr>
            <?php
        }
        ?>

        </tbody>
    </table>
</div>


<?php
if (isset($message)) {
    echo '<div class="alert alert-success custom-alert  alert-dismissible fade show">' . $message . '
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
?>


</body>
</html>
