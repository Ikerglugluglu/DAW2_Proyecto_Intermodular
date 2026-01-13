<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($email == '' || $password == '') {
        $error = "Todos los campos son obligatorios.";
    } else {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Guardar sesión
                $_SESSION['id'] = $user['id'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['rol'] = $user['rol'];

                // Redirigir según rol
                switch ($user['rol']) {
                    case 'cliente':
                        header("Location: ../cliente/index.php");
                        break;
                    case 'empleado':
                        header("Location: ../empleado/index.php");
                        break;
                    case 'admin':
                        header("Location: ../admin/index.php");
                        break;
                    default:
                        header("Location: ../index.php");
                        break;
                }
                exit;

            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Usuario no encontrado.";
        }
    }
}
?>

<h2>Login</h2>
<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>
<form method="post">
    Email: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<form action="/PROYECTO/auth/go_index.php" method="post">
    <button type="submit">Inicio</button>
</form>
