<div class="container mt-4">
    <form method="GET" action="pesquisa.php" class="form-inline justify-content-center">
        <input type="text" name="q" class="form-control mr-2" placeholder="Buscar produtos..." required>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> Pesquisar
        </button>
    </form>
</div>

<?php
// Exemplo de busca
if (isset($_GET['q'])) {
    $q = $conn->real_escape_string($_GET['q']);
    $sql = "SELECT * FROM produtos WHERE nome LIKE '%$q%' OR descricao LIKE '%$q%'";
    $result = $conn->query($sql);

    echo '<div class="container mt-4">';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($row['nome']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars($row['descricao']) . '</p>';
            echo '</div></div>';
        }
    } else {
        echo '<div class="alert alert-warning">Nenhum produto encontrado.</div>';
    }
    echo '</div>';
}
?>
<!-- ...existing code... -->