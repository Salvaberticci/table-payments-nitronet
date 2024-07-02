<?php
require_once('config_db.php');

try {
    // Conectar a la base de datos
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si la tabla "users" existe en el esquema "public"
    $stmt = $pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'users'");
    if ($stmt->rowCount() == 0) {
        throw new Exception('La tabla "users" no existe en el esquema "public".');
    }

    // Listar el contenido de la tabla "users"
    $stmt = $pdo->query("SELECT * FROM public.users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<pre>'; print_r($users); echo '</pre>';

} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
